<?
require_once($_SERVER['DOCUMENT_ROOT'].'/private/class/easydarkcoin.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/func.php');
$darkcoin = new Darkcoin('xxx','xxx','localhost','9998');
$info = $darkcoin->masternode('list', 'addr');

function check_mn($ip){
	global $darkcoin, $info, $db; $i = 'NO';
	$query = $db->prepare("SELECT * FROM `hosting` WHERE `ip` = :ip");
	$query->bindParam(':ip', $ip, PDO::PARAM_STR);
	$query->execute();
	$row = $query->fetch();
	if (in_array("$ip:9999", $info) && $row['txid'] !== NULL) $i = 'OK';
	return $i;
}

$mn_online = 1; // +1 => it`s my node work too ;)

$query = $db->query("SELECT * FROM `hosting`");
$query->execute();
$mn_all = $query->rowCount()+1; // +1 => it`s my node work too ;)
	while($row=$query->fetch()){
		if(check_mn($row['ip']) == 'OK' || time()-60*60*24 < $row['last'] || time()-60*60*12 < $row['time']){
			$mn_online++;
		}
	}

$mn_free = $mn_all - $mn_online; 
?>
