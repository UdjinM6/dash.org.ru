<?php
// check mn and if stop - start it.
$mn_ips = ['149.202.239.228', '149.202.239.229', '149.202.239.230', '149.202.239.231', 
			'5.135.29.16', '5.135.29.17', '5.135.29.18', '5.135.29.19', 
			'5.135.29.20', '5.135.29.21', '5.135.29.22', '5.135.29.23', 
			'92.222.108.232', '92.222.108.233', '92.222.108.234', '92.222.108.235'];

function check_mn($ip){
	$status = 'work';
	$i = explode("\n", shell_exec("ps aux | grep $ip | awk '{print $11\" \"$12\" \"$13}'"));
	if (!in_array("dashd -datadir=/home/dash/data/$ip -daemon", $i)){ // проверяем есть ли процесс
		shell_exec("su - dash -c \"dashd -datadir=/home/dash/data/$ip -daemon > /dev/null 2>/dev/null &\"");
		$status = 'not_work';
	}
	
	if($status == 'work'){ // возможно кошелек завис
		$i = shell_exec("dash-cli -datadir=/home/dash/data/$ip getinfo");
		if(strripos($i, 'version') === FALSE){
			shell_exec("ps aux | grep -i \"dashd -datadir=/home/dash/data/$ip -daemon\" | awk {'print $2'} | xargs kill -9");
			shell_exec("su - dash -c \"dashd -datadir=/home/dash/data/$ip -daemon > /dev/null 2>/dev/null &\"");
			$status = 'not_work';
		}
	}
	
	return $status;
}

foreach ($mn_ips as $value) {
	echo "$value => ".check_mn($value)."\n";
}

