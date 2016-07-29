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
					<h3>Install masternode</h3>
				</div>
				<div class="pull-right" style=" padding-right: 75px; padding-top: 19px;">
					<div id="google_translate_element"></div>
				</div>
			</div>
			Запустите DASH кошелек и откройте консоль. Создайте новый DASH адрес.<br/><br/>
			<blockquote style="font-size:14px;">getnewaddress</blockquote>
			Вы увидите адрес. Отправьте на него 1000 DASH с помощью команды.<br/><br/>
			<blockquote style="font-size:14px;">sendtoaddress ваш_новый_адрес 1000</blockquote>
			Вы увидите номер транзакции, через 50 минут напишите этот номер и нажмите кнопку  "<u>получить masternode.conf</u>"<br/>
			Если ваш кошелек зашифрован (установлен пароль), терминал выдаст ошибку, тогда вам надо будет <a href="http://www.youtube.com/watch?feature=player_detailpage&v=VEaRjVwxlxw#t=245" target="_blank">разблокировать кошелек</a> и повторить отправку 1000 DASH.<br/><br/>
			
			<input id="txid" class="form-control" placeholder="Номер вашей транзакции" type="text"><br/>
			<button id="setup" type="submit" class="form-control btn btn-default">Получить masternode.conf</button>
			
			<br/><br/>
			Если все прошло успешно, и вы скачали файл <u>masternode.conf</u>, то положите его в папку <i>%appdata%/Roaming/Dash/</i><br/>
			Перезагрузите ваш DASH кошелек. Откройте консоль и запустите мастерноду командой:<br/><br/>
			<blockquote style="font-size:14px;">masternode start-alias mn1</blockquote>
			
			Если вы увидели "<u>Successfully started 1 masternodes</u>" - то все отлично. Не выключайте кошелек. Через 10~15 минут зайдите на сайт <a href="https://dashninja.pl" target="_blank">dashninja.pl</a>.<br/>
			Найдите таблицу (список мастернод). В поле поиск напишите адрес (туда вы отправили 1000 DASH). Если нашли свою masternode - можно выключить DASH кошелек.<br/><br/>
			
			Чтобы добавить еще MN - повторите действия. Когда вы получите новый файл masternode.conf => его нужно совместить со старым.<br/>
			С помощью текст-редактора откройте оба файла. Скопируйте содержимое нового файла в старый. Например, новый файл.
			<blockquote style="font-size:14px;"><strong>mn1</strong> z.z.z.z:9999 ...</blockquote>
			
			Старый файл.<br/>
			<blockquote style="font-size:14px;">mn1 x.x.x.x:9999 ...</blockquote>
			
			Копируем из нового в старый (<i>%appdata%/Roaming/Dash/masternode.conf</i>), в итоге получается.
			<blockquote style="font-size:14px;">mn1 x.x.x.x:9999 ...<br/>
			<strong>mn2</strong> z.z.z.z:9999 ...</blockquote>
			<hr>
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn.js"></script>
</body>
</html>
