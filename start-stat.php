<?php
$i = explode("\n", shell_exec("ps aux | grep drk-chart.php | awk '{print $11\" \"$12}'"));
if (!in_array('php /var/www/dash/root/private/cron/drk-chart.php', $i)){
	shell_exec("php /var/www/dash/root/private/cron/drk-chart.php >> /var/www/dash/root/private/logs/drk.log &");
	echo "not work! \n";
}else{
	echo "work! \n";
}
