<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/class/easydarkcoin.php');
$darkcoin = new Darkcoin($config['dash_user'], $config['dash_pass'], $config['dash_host'], $config['dash_port']);
$info = $darkcoin->masternode('list', 'addr');

function send_do($command, $ip, $key){
	global $config, $db;
	
	$query = $db->prepare("SELECT * FROM `hosting` WHERE `ip` = :ip");
	$query->bindParam(':ip', $ip, PDO::PARAM_STR);
	$query->execute();
	$row = $query->fetch();
	$api = $row['api'];
	
	$query = $db->prepare("SELECT * FROM `api` WHERE `id` = :id");
	$query->bindParam(':id', $api, PDO::PARAM_STR);
	$query->execute();
	$row = $query->fetch();
	$api = $row['api'];
	
	return file_get_contents("http://$api/index.php?do=$command&ip=$ip&key=$key&auth={$config['api']}");
}

function check_mn($ip){
	global $darkcoin, $info, $db; $i = 'NO';
	$query = $db->prepare("SELECT * FROM `hosting` WHERE `ip` = :ip");
	$query->bindParam(':ip', $ip, PDO::PARAM_STR);
	$query->execute();
	$row = $query->fetch();
	if (in_array("$ip:9999", $info) && $row['txid'] !== NULL) $i = 'OK';
	return $i;
}

if(!empty($_GET['check'])){
$query = $db->query("SELECT * FROM `hosting`");
$query->execute();
$mn_all = $query->rowCount();
	while($row=$query->fetch()){
		if(check_mn($row['ip']) == 'OK' && $row['txid'] !== NULL){
			$query_update = $db->prepare("UPDATE `hosting` SET `last` = :time WHERE `ip` = :ip");
			$query_update->bindParam(':time', time(), PDO::PARAM_STR);
			$query_update->bindParam(':ip', $row['ip'], PDO::PARAM_STR);
			$query_update->execute();
			echo $row['ip'];
		}
	}
die;
}

if(!empty($_GET['last'])){
	$query = $db->query("SELECT * FROM `hosting`");
	$query->execute();	
	while($row=$query->fetch()){
		$info = null;
		$info = $darkcoin->masternodelist('lastseen', $row['txid']);
		if(empty($info)) continue;
		foreach ($info as $value) {
			$x[$row['ip']] = $value;
		}
	}
	die(json_encode($x));
}

if(!empty($_GET['download']) && $_GET['download'] == 'getfile'){
	header("Accept-Ranges: bytes");
	header("Connection: close");
	header("Content-Transfer-Encoding: binary");
	header("Content-Disposition: attachment; filename=masternode.conf");
	echo base64_decode(urldecode($_GET['data']));
	die;
}

sleep(1);

if(empty($_POST['txid'])) die("empty");
if(preg_match('/[^0-9a-z]/', $_POST['txid'])) die('wrong_txid');
$tx = $_POST['txid'];

// Проверим, есть ли такая MN
$query = $db->prepare("SELECT * FROM `hosting` WHERE `txid` = :txid");
$query->bindParam(':txid', $tx, PDO::PARAM_STR);
$query->execute();
if($query->rowCount() != 1){

	// Проверим, есть ли свободные места
	$check_time = time();
	$query = $db->prepare("SELECT * FROM `hosting` WHERE `pay_time` < :time OR `pay_time` IS NULL");
	$query->bindParam(':time', $check_time, PDO::PARAM_STR);
	$query->execute();
	while($row=$query->fetch()){
		if(check_mn($row['ip']) == 'NO' && time()-60*60*24 > $row['last'] && time()-60*60*12 > $row['time']){
			$ip = $row['ip'];
			break;
		}
	}
	
	if(empty($ip)){
		 die('full');
	}

	$raw_tx = $darkcoin->getrawtransaction($tx);
	if(empty($raw_tx)) die('wrong_txid');

	$decode_tx = $darkcoin->decoderawtransaction($raw_tx);
	if($decode_tx["vout"]['0']["value"] != 1000 && $decode_tx["vout"]['1']["value"] != 1000) die('not_1000_DASH_TX');
	
	if($decode_tx["vout"]['0']["value"] == 1000){
		$outputs = $decode_tx["vout"]['0']["n"];
		$address = $decode_tx["vout"]['0']["scriptPubKey"]["addresses"]['0'];
	}
	
	if($decode_tx["vout"]['1']["value"] == 1000){
		$outputs = $decode_tx["vout"]['1']["n"];
		$address = $decode_tx["vout"]['1']["scriptPubKey"]["addresses"]['0'];
	}
	
	$balance = 0; $balance = @file_get_contents("http://explorer.dash.org.ru/chain/Dash/q/addressbalance/$address");
	if($balance < 1000) die('not_1000_DASH_BALANCE');

	$end_block = $darkcoin->getblockcount();
	$start_block = $end_block - 15;

	while($end_block != $start_block){ // check 15 conf
		$hash_block = $darkcoin->getblockhash($start_block);
		$info_block = $darkcoin->getblock($hash_block);
		
		if(in_array($tx, $info_block["tx"])){
			die("not_15_conf");
		}
		
		$start_block++;
	}

	$mn_key = $darkcoin->masternode('genkey');
	$ptime = time()+60*60*24;

	$query = $db->prepare("UPDATE `hosting` SET `txid` = :txid, `address` = :address, `time` = :time, `out` = :out, `key` = :key, `pay_time` = :ptime WHERE `ip` = :ip");
	$query->bindParam(':txid', $tx, PDO::PARAM_STR);
	$query->bindParam(':address', $address, PDO::PARAM_STR);
	$query->bindParam(':time', time(), PDO::PARAM_STR);
	$query->bindParam(':out', $outputs, PDO::PARAM_STR);
	$query->bindParam(':key', $mn_key, PDO::PARAM_STR);
	$query->bindParam(':ptime', $ptime, PDO::PARAM_STR);
	$query->bindParam(':ip', $ip, PDO::PARAM_STR);
	$query->execute();
}else{
	$row=$query->fetch();
	$ip = $row['ip'];
	$mn_key = $row['key'];
	$outputs = $row['out'];
	
	// Не отдаем приватный ключ MN после того как она запустилась.
	if(check_mn($ip) == 'OK' || time()-60*60*24 > $row['time']) die('mn_work');
}

if(empty(send_do('setup', $ip, $mn_key)))
	echo urlencode(base64_encode("mn1 $ip:9999 $mn_key $tx $outputs"));
else
	echo 'error';
