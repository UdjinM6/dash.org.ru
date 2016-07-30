<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/mn_head.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: MasterNode online</title>
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
	<style>.tweaked-margin { margin-right: 30px; } </style>
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
					<h3>Online masternodes</h3>
				</div>
				<div class="pull-right" style=" padding-right: 75px; padding-top: 19px;">
					<div id="google_translate_element"></div>
				</div>
			</div>
			Online MN: <? echo $mn_online; ?> | Free slots: <? echo $mn_free; ?><br/><br/>
				If you have any questions - contact us: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => we will be glad to help you.<br/>
			Если у вас появились какие-либо вопросы - свяжитесь с нами: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => будем рады помочь.<br/><br/>
			
			Price: "<i>10 days = 0.33 DASH</i>".<br/>
			Стоимость: "<i>0.33 DASH = 10 дней хостинга</i>".<br/><br/>
			
			1. Find you masternode (this page).<br/>
			1. Найдите свою masternode на этой странице.<br/><br/>
			
			2. Copy payment address and send some DASH.<br/> 
			2. Скопируйте адрес (payment address) и произведите оплату.<br/><br/>
			
			3. Wait 10~20 min and check list => time should increase.<br/>
			3. Через некоторое время снова проверьте список и убедитесь что продление состоялось.<br/><br/>
			<table id="pay_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><center>IP</center></th>
						<th><center>MasterNode</center></th>
						<th><center>Payment address</center></th>
						<th><center>Time</center></th>
					</tr>
				</thead>
				<tbody>
					<? echo $pay_mn; ?>
				</tbody>
			</table>
			<hr/>
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn.js"></script>
</body>
</html>
