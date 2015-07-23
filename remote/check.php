<?php
// check mn and if stop - start it.
$mn_ips = ['149.202.239.228', '149.202.239.229', '149.202.239.230', '149.202.239.231'];

function check_mn($ip){
	$status = 'work';
	$i = explode("\n", shell_exec("ps aux | grep $ip | awk '{print $11\" \"$12\" \"$13}'"));
	if (!in_array("dashd -datadir=/home/dash/data/$ip -daemon", $i)){
		shell_exec("su - dash -c \"dashd -datadir=/home/dash/data/$ip -daemon > /dev/null 2>/dev/null &\"");
		$status = 'not_work';
	}
	return $status;
}

foreach ($mn_ips as $value) {
	echo "$value => ".check_mn($value)."\n";
}
