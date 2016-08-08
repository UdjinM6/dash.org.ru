<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/mn_head.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: MasterNode offline</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.min.css" />
	<script type="text/javascript">function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'ru', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script type="text/javascript" charset="utf-8"> $(document).ready(function() { $('#mn_table').dataTable({ "order": [[ 2, "desc" ]] }); }); </script>
	<script type="text/javascript" charset="utf-8"> $(document).ready(function() { $('#pay_table').dataTable({ "order": [[ 3, "desc" ]] }); }); </script>
	<link rel="stylesheet" href="/css/default.css">
	<script src="/js/highlight.pack.js"></script>
	<script src="/js/alertify.js"></script>
	<link rel="stylesheet" href="/css/alertify.core.css">
	<link rel="stylesheet" href="/css/alertify.bootstrap.css">
	<script>hljs.initHighlightingOnLoad();</script>
	<style>.tweaked-margin { margin-right: 30px; }</style>
</head>
<body>
<div class="github-fork-ribbon-wrapper right">
	<div class="github-fork-ribbon">
		<a href="https://github.com/poiuty/dashpay.org.ru">Fork me on GitHub</a>
	</div>
</div>
<div id="myModal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<center> <h4 class="modal-title">Пожалуйста, подождите.</h4> </center>
			</div>
			<div id="modal_info" class="modal-body"></div>
		</div>
	</div>
</div>
<?	echo $navi; ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<div style="width: 100%; padding-bottom:65px;">
				<div style="float: left;">
					<h3>Offline masternodes</h3>
				</div>
				<div class="pull-right" style=" padding-right: 75px; padding-top: 19px;">
				
				<div id="google_translate_element"></div>

        
				
				</div>
			</div>
			<a href="https://github.com/poiuty/dashpay.org.ru/blob/master/remote/check.php">Automatic monitoring</a> checks masternodes. And restart if MN get crash or freeze.<br/>
			Стараемся не допустить выключения мастернод с помощью <a href="https://github.com/poiuty/dashpay.org.ru/blob/master/remote/check.php">мониторинга</a>.<br/><br/>
			
			If you see your masternode in this list => first follow link and check masternode status (dashninja.pl)<br/>
			Если вы увидели свою мастерноду в этом списке. Сначала перейдите по ссылке, проверьте статус на сайте dashninja.pl<br/><br/>
			
			If status <i>Active</i> => all fine, your masternode work.<br/>
			Если статус <i>Active</i> => все хорошо, ваша masternode работает.<br/><br/>
			
			If you cant find you masternode (dashninja.pl), than open <u>masternode.conf</u> and find offline masternode.<br/>
			Если вы не нашли masternode на сайте (dashninja.pl), то вам необходимо, открыть файл <u>masternode.conf</u>, найти название вашей мастерноды.<br/><br/>
			
			For example, if offline masternode IP => 127.0.0.2 and <u>masternode.conf</u><br/>
			Например упала мастернода IP => 127.0.0.2, <u>masternode.conf</u> содержит записи.<br/>
			<blockquote style="font-size:14px;">mn1 127.0.0.1:9999 ...<br/>
			<strong>mn2</strong> 127.0.0.2:9999 ...<br/>
			mn3 127.0.0.3:9999 ...<br/></blockquote>
			
			Open DASH wallet, open console and start offline masternode.<br/>
			Теперь открываем кошелек, запускаем консоль и включаем мастерноду.<br/>
			<blockquote style="font-size:14px;">masternode start-alias <strong>mn2</strong></blockquote>
			
			If you have any questions - contact us: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => we will be glad to help you.<br/>
			Если у вас появились какие-либо вопросы - свяжитесь с нами: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => будем рады помочь.<br/>
			<table id="mn_table" class="table table-striped table-bordered" cellspacing="0" width="100%"><br/>
				<thead>
					<tr>
						<th><center>IP</center></th>
						<th><center>Masternode</center></th>
						<th><center>Последний раз видели</center></th>
					</tr>
				</thead>
				<tbody>
					<? echo $fail_mn; ?>
				</tbody>
			</table>
			<hr/>
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn.js"></script>
</body>
</html>
