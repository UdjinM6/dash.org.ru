<?php
$pages = ['/' => 'Install',	'/pages/online.php' => 'Online', '/pages/offline.php' => 'Offline', '/pages/emission.php' => 'Emission'];
$navi = '<nav class="navbar navbar-default"><div class="container"><div class="navbar-header"><a class="navbar-brand" href="/" ><img alt="Brand" src="/img/logo.png" style="max-width: 150px;"></a><ul class="nav navbar-nav">';
foreach($pages as $key => $val){
	if($_SERVER["REQUEST_URI"] == $key)
		$navi .= "<li class=\"active\"><a href=\"$key\">$val</a></li>";
	else
		$navi .= "<li><a href=\"$key\">$val</a></li>";
}
$navi .= '</ul></div></div></nav>';
