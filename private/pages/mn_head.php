<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/init/mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/class/easydarkcoin.php');

$cache = new Memcache();
$cache->connect('unix:///tmp/memcached.socket', 0, 30);

$darkcoin = new Darkcoin($config['dash_user'], $config['dash_pass'], $config['dash_host'], $config['dash_port']);
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

$query = $db->query("SELECT * FROM `price` WHERE `name` = 'USDT_DASH'");
$query->execute();
$price = $query->fetch();
$price = round(10/$price['value']/3, 2);

$mn_online = 0;
$query = $db->query("SELECT * FROM `hosting`");
$query->execute();
$mn_all = $query->rowCount();
	while($row=$query->fetch()){
		if((check_mn($row['ip']) == 'OK' || time()-60*60*24 < $row['last'] || time()-60*60*12 < $row['time']) && $row['pay_time'] > time()){
			$mn_online++;	
		}
	}

$fail_mn = ''; $pay_mn = '';
$j_time = time()-60*60;
$query = $db->query("SELECT * FROM `hosting` WHERE `last` < $j_time AND `pay_time` > UNIX_TIMESTAMP(NOW())"); // AND `last` > $k_time
$query->execute();
while($row = $query->fetch()){
	$balance = $cache->get($row['address']);
	if($balance === FALSE){
		$balance = @file_get_contents("https://explorer.dash.org.ru/chain/Dash/q/addressbalance/{$row[address]}");
		$cache->set($row['address'], $balance, MEMCACHE_COMPRESSED, 600);
	}
	if($balance < 1000) continue;
	if(array_key_exists($row['txid'].'-'.$row['out'], $info)) continue;
	
	$fail_mn = "$fail_mn <tr><td><center>$row[ip]</center></td><td><center>$row[address]<center></td><td><center>".date("Y-m-d H:i", $row['last'])."</center></td></tr>";
}
$mn_free = $mn_all - $mn_online; 

$query = $db->query("SELECT * FROM `hosting` WHERE `address` IS NOT NULL AND `last` > $j_time");
$query->execute();
while($row = $query->fetch())
	$pay_mn = "$pay_mn <tr><td><center>$row[ip]</center></td><td><center><a href=\"https://dashninja.pl/mndetails.html?mnpubkey=$row[address]\" target=\"_blank\">$row[address]</a><center></td><td><center><a href=\"https://chainz.cryptoid.info/dash/address.dws?$row[pay_address].htm\" target=\"_blank\">$row[pay_address]</a><center></td><td><center>".date("Y-m-d", $row['pay_time'])."</center></td></tr>";
