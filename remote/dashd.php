<?php
require_once('/home/dash/restart/easydarkcoin.php');
$i = explode("\n", shell_exec("ps aux | grep /home/dash/.dash | awk '{print $11\" \"$12\" \"$13}'"));
if (!in_array("dashd -datadir=/home/dash/.dash -proxy=127.0.0.1:9050", $i)){ // проверяем есть ли процесс
	shell_exec("ulimit -c unlimited; dashd -datadir=/home/dash/.dash -proxy=127.0.0.1:9050 -externalip=wrwx2dy7jyh32o53.onion -discover -daemon > /dev/null 2>/dev/null &");
}else{
	$darkcoin = new Darkcoin('xxxx','xxxx','localhost', 9000);
	if($darkcoin->getinfo() === FALSE){ // let`s ping rcp and if no answer => hard kill and restart
		shell_exec("ps aux | grep -i \"dashd -datadir=/home/dash/.dash -proxy=127.0.0.1:9050\" | awk {'print $2'} | xargs kill -9");
		shell_exec("ulimit -c unlimited; dashd -datadir=/home/dash/.dash -proxy=127.0.0.1:9050 -externalip=wrwx2dy7jyh32o53.onion -discover -daemon > /dev/null 2>/dev/null &");
	}
}
