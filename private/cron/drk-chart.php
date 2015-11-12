<?php
require_once('/var/www/dash/root/private/config.php');
require_once('/var/www/dash/root/private/init/mysql.php');
require_once('/var/www/dash/root/private/class/easydarkcoin.php');
require_once('/var/www/dash/root/private/class/pData.class.php'); 
require_once('/var/www/dash/root/private/class/pDraw.class.php'); 
require_once('/var/www/dash/root/private/class/pPie.class.php'); 
require_once('/var/www/dash/root/private/class/pImage.class.php'); 

$darkcoin = new Darkcoin($config['dash_user'], $config['dash_pass'], $config['dash_host'], $config['dash_port']);

while(1){
	drk_start();
	sleep(10);
}

function drk_start(){
	global $db, $darkcoin;
	$drk_price = file_get_contents("http://dash.org.ru/price.php?name=DRK");
	$hash_block = $darkcoin->getbestblockhash();
	$info_block = $darkcoin->getblock($hash_block);
	$tx = $info_block["tx"][0];
	$diff = round($info_block["difficulty"]);
	$last_block = $block_id = $info_block["height"];
	$block_time = $info_block["time"];
	$encode_tx = $darkcoin->getrawtransaction($tx);
	$tx_info = $darkcoin->decoderawtransaction($encode_tx);

	$address = $tx_info["vout"][0]["scriptPubKey"]["addresses"][0];
		
	// Определеяем P2Pool
	$p2p = json_decode(file_get_contents("http://eu.p2pool.pl:7903/recent_blocks"), TRUE); 

	foreach ($p2p as $data){
		if($block_id == $data["number"]){
			$address = 'P2Pool';
			break;
		} 
	}

	// Записываем данные в базу
	$query_select = $db->prepare("SELECT * FROM `address` WHERE `address` =:address");
	$query_select->bindParam(':address', $address, PDO::PARAM_STR);
	$query_select->execute();
	if($query_select->rowCount() != 1){
		$query_insert = $db->prepare("INSERT INTO `address` (`address`) VALUES (:address)");
		$query_insert->bindParam(':address', $address, PDO::PARAM_STR);
		$query_insert->execute();
	}

	// Записываем статистику по блокам
	$query_select = $db->prepare("SELECT * FROM `data` WHERE `bid` =:bid");
	$query_select->bindParam(':bid', $block_id, PDO::PARAM_STR);
	$query_select->execute();
	if($query_select->rowCount() == 1){ 
		echo "Find new block... \n";
		return; 
	}else{
		echo "\033[36mBlock: $block_id | Find: $address | Time: $block_time | Diff: $diff | Price: $drk_price$ \033[0m \n";
		$query_insert = $db->prepare("INSERT INTO `data` (`bid`, `diff`, `address`, `time`) VALUES (:bid, :diff, :address, :time)");
		$query_insert->bindParam(':bid', $block_id, PDO::PARAM_STR);
		$query_insert->bindParam(':diff', $diff, PDO::PARAM_STR);
		$query_insert->bindParam(':address', $address, PDO::PARAM_STR);
		$query_insert->bindParam(':time', $block_time, PDO::PARAM_STR);
		$query_insert->execute();
		$lastId = $db->lastInsertId();
	}

	$k = 0;
 
	$query_select = $db->prepare("SELECT * FROM `data` WHERE `time` > UNIX_TIMESTAMP()-86400");
	$query_select->execute();
	$all_data = $query_select->rowCount();
	
	$query_select = $db->prepare("SELECT SUM(diff) FROM `data` WHERE `time` > UNIX_TIMESTAMP()-86400");
	$query_select->execute();
	$row = $query_select->fetch();
	$diff_sum = $row['SUM(diff)'];
	
	$avg_diff = $diff_sum/$all_data;
	

	$query_select = $db->prepare("SELECT * FROM `address`");
	$query_select->execute();
	if($query_select->rowCount() == 0) return;
	while($row = $query_select->fetch()){
		$query_data = $db->prepare("SELECT * FROM `data` WHERE `address` = :address AND `time` > UNIX_TIMESTAMP()-86400");
		$query_data->bindParam(':address', $row['address'], PDO::PARAM_STR);
		$query_data->execute();
		
		if($row['address'] == 'P2Pool') $row['label'] = 'P2Pool';
		if(($query_data->rowCount()/$all_data * 100 < 3) || empty($row['label'])){ $k = $k+$query_data->rowCount(); continue;}
		
		$arr_count[] = $query_data->rowCount();
		$arr_label[] = $row['label'];
	}

	if($k > 0){ $arr_label[] = 'Other';  $arr_count[] = $k; }

	array_multisort($arr_count, SORT_DESC, $arr_label);
	
	/* Create and populate the pData object */ 
	$MyData = new pData();    
	$MyData->addPoints($arr_count ,"ScoreA");   
	$MyData->setSerieDescription("ScoreA","Application A"); 


	/* Define the absissa serie */ 
	$MyData->addPoints($arr_label, "Labels"); 
	$MyData->setAbscissa("Labels"); 

	/* Create the pChart object */ 
	$myPicture = new pImage(720,400,$MyData,TRUE);
	$myPicture->Antialias = TRUE; 
	 
	 /* Draw a solid background */ 
	$Settings = array("R"=>255, "G"=>255, "B"=>255); 
	$myPicture->drawFilledRectangle(0,0,920,400,$Settings); 


	/* Write the picture title */  
	$myPicture->setFontProperties(array("FontName"=>"/var/www/dash/root/fonts/verdana.ttf","FontSize"=>14)); 
	$myPicture->drawText(0,20,"At block: $last_block",array("R"=>0,"G"=>0,"B"=>0));
	$myPicture->drawText(210,24,"Difficulty: $diff",array("R"=>0,"G"=>0,"B"=>0));
	$myPicture->drawText(390,24,"Avg difficulty: ".round($avg_diff),array("R"=>0,"G"=>0,"B"=>0));
	$myPicture->drawText(600,23,"Price: $drk_price$",array("R"=>0,"G"=>0,"B"=>0));
	 
	/* Create the pPie object */
	$PieChart = new pPie($myPicture,$MyData);


	/* Enable shadow computing */
	$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 

	/* Draw a splitted pie chart */
	$myPicture->setFontProperties(array("FontName"=>"/var/www/dash/root/fonts/tahoma.ttf","FontSize"=>10));
	$PieChart->draw3DPie(340, 220,array("WriteValues"=>TRUE, "ValueR"=>0,"ValueG"=>0,"ValueB"=>0, "Radius"=>225, "DataGapAngle"=>4, "DataGapRadius"=>6, "DrawLabels"=>TRUE,"Border"=>TRUE)); 

	/* Render the picture (choose the best way) */ 
	$myPicture->Render("/var/www/dash/root/stat/drk.png");
	

unset($data);

$data = ['num' => $last_block, 'diff' => round($avg_diff)];
$query = $db->prepare("SELECT * FROM `params` WHERE `key` = 'block'");
$query->execute();
if($query->rowCount() != 1){
	$query = $db->prepare("INSERT INTO `params` (`key`, `value`) VALUES ('block', :value)");
	$query->bindParam(':value', json_encode($data), PDO::PARAM_STR);
	$query->execute();
}else{
	$query = $db->prepare("UPDATE `params` SET `value` =:value WHERE `key` = 'block'");
	$query->bindParam(':value', json_encode($data), PDO::PARAM_STR);
	$query->execute();
}
	if(!empty($lastId)){
		$j = 0; $tx_coun = count($info_block["tx"]);
			foreach($info_block["tx"] as $value){
			$encode_tx = $darkcoin->getrawtransaction("$value");
			$tx_info = $darkcoin->decoderawtransaction($encode_tx);
			foreach($tx_info["vout"] as $val){
				$j += $val["value"];
			}
			$query = $db->prepare("UPDATE `data` SET `txs` = :count, `tx_sum` = :sum WHERE `id` = :id");
			$query->bindParam(':count', $tx_coun, PDO::PARAM_STR);
			$query->bindParam(':sum', $j, PDO::PARAM_STR);
			$query->bindParam(':id', $lastId, PDO::PARAM_STR);
			$query->execute();
		}
	}
}
