<?
require_once($_SERVER['DOCUMENT_ROOT'].'/private/class/easydarkcoin.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
$darkcoin = new Darkcoin('xxx','xxx','localhost','9998');
$info = $darkcoin->masternode('list');

function check_mn($ip){
	global $darkcoin, $info;
	
	if(@$info["$ip:9999"] == 'ENABLED'){
		$i = 'OK';
	}else{
		$i = 'NO';
	}
	return $i;
}

$mn_online = 0;

$query = $db->query("SELECT * FROM `hosting`");
$query->execute();
$mn_all = $query->rowCount();
	while($row=$query->fetch()){
		if(check_mn($row['ip']) == 'OK' || time()-60*60*24 < $row['last'] || time()-60*60*24 < $row['time']){
			$mn_online++;
		}
	}

$mn_free = $mn_all - $mn_online;
?>
