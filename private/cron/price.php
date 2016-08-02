<?php
require_once('/var/www/dash.org.ru/site/private/config.php');
require_once('/var/www/dash.org.ru/site/private/init/mysql.php');
$i = json_decode(file_get_contents('https://poloniex.com/public?command=returnTicker'), true);

if(!empty($i['USDT_DASH']['low24hr']) && is_numeric($i['USDT_DASH']["low24hr"])){
	$update = $db->prepare("UPDATE `price` SET `value` = :val WHERE `name` = 'USDT_DASH'");
	$update->bindParam(':val', round($i['USDT_DASH']['low24hr'], 2), PDO::PARAM_STR);
	$update->execute();
}
