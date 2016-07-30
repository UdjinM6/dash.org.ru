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
			<a href="https://www.youtube.com/watch?v=Ao9_HbBukvw" target="_blank">Video guide: install MasterNode dash.org.ru hosting</a><br/>
			<a href="https://www.youtube.com/watch?v=Ao9_HbBukvw" target="_blank">Видео гайд: установка MasterNode на хостинге dash.org.ru</a><br/><br/>
			
			Start DASH wallet and open console. Create new DASH address.<br/>
			Запустите DASH кошелек и откройте консоль. Создайте новый DASH адрес.<br/>
			<blockquote style="font-size:14px;">getnewaddress</blockquote>
			You get DASH address. Send 1000 DASH to this address.<br/>
			Вы увидите адрес. Отправьте на него 1000 DASH с помощью команды.<br/>
			<blockquote style="font-size:14px;">sendtoaddress your_address 1000</blockquote>
			You get txid, wait 40~50 minutes (<a href="https://chainz.cryptoid.info/dash/" target="_blank">15 confirmations</a>) and use txid and press "<u>get masternode.conf</u>"<br/>
			Вы увидите номер транзакции (TXID), через 50 минут (<a href="https://chainz.cryptoid.info/dash/" target="_blank">15 confirmations</a>) напишите этот номер и нажмите кнопку  "<u>get masternode.conf</u>"<br/><br/>
			
			Dont foget backup your wallet.dat<br/>
			Не забудьте сделать бекап кошелька.<br/><br/>
			
			<input id="txid" class="form-control" placeholder="TXID" type="text">
			<button id="setup" type="submit" class="form-control btn btn-default">get masternode.conf</button>
			
			<br/><br/>
			If all fine => you download <u>masternode.conf</u>. Then put this file in folder.<br/>
			Если все прошло успешно, и вы скачали файл <u>masternode.conf</u>, то положите его в папку.
			<blockquote style="font-size:14px;"><i>~/.dash/</i>  (Linux)<br/>
			<i>%appdata%/Dash/</i> => (Windows)<br/>
			<i>~/Library/Application Support/Dash/</i> => (MAC)</blockquote>
			Restart DASH wallet. Open console and start masternode.<br/>
			Перезагрузите ваш DASH кошелек. Откройте консоль и запустите мастерноду командой:<br/>
			<blockquote style="font-size:14px;">masternode start-alias <strong>mn1</strong></blockquote>
			
			If you see "<u>Successfully started 1 masternodes</u>" - all fine. Dont shutdown wallet. And after 10~15 minutes open site <a href="https://dashninja.pl" target="_blank">dashninja.pl</a>.<br/>
			Если вы увидели "<u>Successfully started 1 masternodes</u>" - то все отлично. Не выключайте кошелек. Через 10~15 минут зайдите на сайт <a href="https://dashninja.pl" target="_blank">dashninja.pl</a>.<br/><br/>
			
			Find table (list of masternodes). Enter your address (where you send 1000 DASH). If you find your masternode - you can shutdown DASH wallet.<br/>
			Найдите таблицу (список мастернод). В поле поиск напишите адрес (туда вы отправили 1000 DASH). Если нашли свою masternode - можно выключить DASH кошелек.<br/><br/>
			
			
			Repeat the steps to start another MN. But when you get masternode.conf => you need to combine two files into one.<br/>
			Чтобы добавить еще MN - повторите действия. Когда вы получите новый файл masternode.conf => его нужно совместить со старым.<br/><br/>
			
			Open both files in a text editor. Copy the contents of the new file to the old. For example, a new file.<br/>
			С помощью текст-редактора откройте оба файла. Скопируйте содержимое нового файла в старый. Например, новый файл.
			<blockquote style="font-size:14px;"><strong>mn1</strong> z.z.z.z:9999 ...</blockquote>
			
			Old file.<br/>
			Старый файл.<br/>
			<blockquote style="font-size:14px;">mn1 x.x.x.x:9999 ...</blockquote>
			
			Copy from the new to the old.<br/>
			Копируем из нового в старый, в итоге получается.
			<blockquote style="font-size:14px;">mn1 x.x.x.x:9999 ...<br/>
			<strong>mn2</strong> z.z.z.z:9999 ...</blockquote>
			<hr>
			If you have any questions - contact us: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => we will be glad to help you.<br/>
			Если у вас появились какие-либо вопросы - свяжитесь с нами: @poiuty (<a href="https://telegram.org/" target="_blank">telegram</a>) => будем рады помочь.			
			<hr>
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn.js"></script>
</body>
</html>
