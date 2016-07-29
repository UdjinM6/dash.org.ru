<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/mn_head.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: MasterNode хостинг</title>
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
			Стараемся не допустить выключения мастернод с помощью <a href="https://github.com/poiuty/dashpay.org.ru/blob/master/remote/check.php">мониторинга</a>.<br/>
			Если вы увидели свою мастерноду в этом списке. Вам необходимо, открыть файл <u>masternode.conf</u>, найти название вашей мастерноды.<br/>
			Например упала мастернода IP => 127.0.0.2, <u>masternode.conf</u> содержит записи.<br/><br/>
			<blockquote style="font-size:14px;">mn1 127.0.0.1:9999 ...<br/>
			mn2 127.0.0.2:9999 ...<br/>
			mn3 127.0.0.3:9999 ...<br/></blockquote>
			
			Теперь открываем холодный кошелек, запускаем консоль и включаем мастерноду.<br/><br/>
			
			<blockquote style="font-size:14px;">masternode start-alias mn2</blockquote>
			Если у вас появились какие-либо вопросы или проблемы - свяжитесь с нами: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => будем рады помочь.<br/><br/>
			<table id="mn_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
			<br/>
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn.js"></script>
</body>
</html>
