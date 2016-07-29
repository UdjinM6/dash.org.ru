<?php
function conf_dash($command, $ip, $key){
	$conf = "/home/dash/data/$ip/dash.conf";
	$file = file($conf);

	// remove empty lines
	if(count($file) != 8 || count($file) != 6){
		foreach ($file as $key_arr => $value) {
			if($key_arr == 0) $file[$key_arr] = trim($value);
					else  $file[$key_arr] = "\n".trim($value);
			if($key_arr > 5) unset($file[$key_arr]);
		}
		file_put_contents($conf, $file, LOCK_EX);
		unset($conf);
		unset($file);
		$conf = "/home/dash/data/$ip/dash.conf";
		$file = file($conf);
	}
	
	if($command == 'check'){
		if(count($file) == 8){
			$file[7] = trim($file[7]);
			if($file[7] == "masternodeprivkey=$key"){
				return 'ready';
			}
		}
	}
	
	if($command == 'add'){
		if(count($file) == 6){
			$file[6] = "\nmasternode=1";
			$file[7] = "\nmasternodeprivkey=$key";
			file_put_contents($conf, $file, LOCK_EX);
		}
	}
	
	if($command == 'remove'){
		if(count($file) == 8){
			$file[5] = trim($file[5]);
			unset($file[7]);
			unset($file[6]);
			file_put_contents($conf, $file, LOCK_EX);
		}
	}
}

function dash_restart($ip){
	shell_exec("dash-cli -datadir=/home/dash/data/$ip stop > /dev/null 2>/dev/null &");
	sleep(10);
	shell_exec("dashd -datadir=/home/dash/data/$ip -daemon > /dev/null 2>/dev/null &");
}

if(empty($_GET['ip']) || empty($_GET['do']) || empty($_GET['auth'])) die('empty');
if(preg_match('/[^0-9-.]/', $_GET['ip']) || !filter_var($_GET['ip'], FILTER_VALIDATE_IP)) die('wrong_ip');
if($_GET['auth'] != 'xxxxx') die('no_auth');

$ip = $_GET['ip'];

switch($_GET['do']){
	default: echo "no"; break;
	case 'setup': 
		if(empty($_GET['key'])) die('empty_key');
		if(preg_match('/[^0-9a-zA-z]/', $_GET['key'])) die('wrong_key');
		if(conf_dash('check', $ip, $_GET['key']) != 'ready'){
			conf_dash('remove', $ip, NULL);
			conf_dash('add', $ip, $_GET['key']);
		}
		dash_restart($ip);
	break;
}
