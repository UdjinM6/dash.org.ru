<?php
require_once('/home/dash/restart/easydarkcoin.php');
$mn_ips = array_diff(scandir('/home/dash/data/'), array('..', '.'));

function log_restart($ip, $message){
	$file = '/home/dash/restart/restart.log';
	$date = date("[Y-m-d | H:i:s]");
	$text = "$date $ip => $message\n";
	file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
}

function check_mn($ip){
	global $darkcoin; $status = 'work';
	$i = explode("\n", shell_exec("ps aux | grep $ip | awk '{print $11\" \"$12\" \"$13}'"));
	if (!in_array("dashd -datadir=/home/dash/data/$ip -daemon", $i)){ // проверяем есть ли процесс
		shell_exec("ulimit -c unlimited; dashd -datadir=/home/dash/data/$ip -daemon > /dev/null 2>/dev/null &");
		$status = 'not_work';
		log_restart($ip, 'crash');
	}
	if($status == 'work'){ // if dashd freeze
		if($darkcoin->getinfo() === FALSE){ // let`s ping rcp and if no answer => hard kill and restart
			shell_exec("ps aux | grep -i \"dashd -datadir=/home/dash/data/$ip -daemon\" | awk {'print $2'} | xargs kill -9");
			shell_exec("ulimit -c unlimited; dashd -datadir=/home/dash/data/$ip -daemon > /dev/null 2>/dev/null &");
			$status = 'not_work';
			log_restart($ip, 'freeze');
		}
	}
	return $status;
}

foreach ($mn_ips as $value) {
	$i = file_get_contents("/home/dash/data/$value/dash.conf");
	preg_match("/rpcport=(.*)/",$i, $rpcport);
	$darkcoin = new Darkcoin('xxxx','xxxx','localhost', $rpcport[1]);
	echo "$value $rpcport[1] => ".check_mn($value)."\n";
}
