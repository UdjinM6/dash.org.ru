<?php
require_once('/var/www/dash/root/private/config.php');
require_once('/var/www/dash/root/private/init/mysql.php');
require_once('/var/www/dash/root/private/func.php');
require_once('/var/www/dash/root/private/class/easydarkcoin.php');
$darkcoin = new Darkcoin($config['dash_user'], $config['dash_pass'], $config['dash_host'], $config['dash_port']);
$price = 3;

// Получаем массив и делаем цикл
$a = $darkcoin->listtransactions("*", 1000);

for ($i=0; count($a) > $i; $i++){
	if($a["$i"]["category"] != "receive" || $a["$i"]["confirmations"] < 6 || $a["$i"]["amount"] < 0.1) continue;
	
	// Есть ли в базе эта транзакция?
	$select_query = $db->prepare("SELECT * FROM `pay_logs` WHERE `txid` =:id");
	$select_query->bindParam(':id', $a["$i"]["txid"], PDO::PARAM_STR);
	$select_query->execute();
	if($select_query->rowCount() > 0) continue;
	
	$select_query = $db->prepare("SELECT * FROM `hosting` WHERE `pay_address` = :address");
	$select_query->bindParam(':address', $a["$i"]["address"], PDO::PARAM_STR);
	$select_query->execute();
	if($select_query->rowCount() != 1) continue;
	$row = $select_query->fetch();
	
	$time_now = time();
	$time_pay = $row['pay_time']+60*60*24*30*($a["$i"]["amount"]/$price);
	$extra =  $row['pay_time']." => $time_pay | price: $price";
	
	// Запишем в лог
	$insert_query = $db->prepare("INSERT INTO `pay_logs` (`txid`, `coins`, `time`, `address`, `extra`) VALUES (:txid, :coins, :time, :address, :extra)");
	$insert_query->bindParam(':txid', $a["$i"]["txid"], PDO::PARAM_STR);
	$insert_query->bindParam(':coins', $a["$i"]["amount"], PDO::PARAM_STR);
	$insert_query->bindParam(':time', $time_now, PDO::PARAM_STR);
	$insert_query->bindParam(':address', $row['address'], PDO::PARAM_STR);
	$insert_query->bindParam(':extra', $extra, PDO::PARAM_STR);
	$insert_query->execute();
	
	// Увеличим время
	$update_query = $db->prepare("UPDATE `hosting` SET `pay_time` = :time WHERE `address` = :address");
	$update_query->bindParam(':time', $time_pay, PDO::PARAM_STR);
	$update_query->bindParam(':address', $row['address'], PDO::PARAM_STR);
	$update_query->execute();
	
	echo $a["$i"]["amount"]." ".$row['address']." $time_now => $time_pay <br/>";
}
