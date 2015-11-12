<?
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
					<h3>MasterNode хостинг</h3>
				</div>
				<div class="pull-right" style=" padding-right: 75px; padding-top: 23px;"><img src="/img/16/us.png"> <a href="/pages/mn-en.php">English</a></div>
			</div>
			MasterNode (мастернода) – узел в сети Dash, который поддерживает проведение анонимных и моментальных транзакций, а также отвечает за раздачу blockchain.<br/><br/>
			Разместить мастерноду можно на операционной системе Windows, Linux и MacOS. Опытные пользователи могут <a href="https://forum.bits.media/index.php?/blog/191/entry-333-podnimaem-dash-masternode/" target="_blank">самостоятельно сделать это</a>.<br/>
			А для тех, кто хочет простое и надежное решение - мы сделали сервис «MasterNode хостинг». С его помощью вы сможете поднять свою ноду и управлять ей.<br/>
			<hr>
			
			<h3>Информация</h3>
			<div class="alert alert-danger" role="alert">
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <b>Неоплаченные мастерноды будут автоматически выключены 10 сентября</b>.<br/><br/>
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <a href="https://github.com/poiuty/dashpay.org.ru/blob/master/private/cron/pay.php" target="_blank">Сделал прием платежей</a>. Читайте полный анонс <a href="https://forum.bits.media/index.php?/topic/15144-dashorgru-masternode-khosting" target="_blank">в этой теме</a>.<br/><br/>
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  Проверяйте статус работы мастерноды <a href="http://dashninja.pl" target="_blank">на сайте dashninja.pl</a> => на нашем сайте (сейчас) этот список не обновляется.
			</div>
			
			Количество размещенных MN: <? echo $mn_online; ?> | Количество свободных мест: <? echo $mn_free; ?> | Минимальный donate лимит: 10%<br/><br/>
			Техническая поддержка пользователей осуществляется <a href="https://forum.bits.media/index.php?/topic/15144-dashorgru-masternode-khosting/" target="_blank">на форуме bits.media</a><br/>
			На выбор - два способа оплаты. <i>Оплата через систему пожертвований.</i><br/>
			Сервис автоматически получает от вас оплату через систему пожертвований.<br/>
			Вы сами определяете процент оплаты. Этот параметр задается в файле masternode.conf. Например:<br/><br/>
			<blockquote style="font-size:14px;">XkB8ySpiqyVHeAXHsNhU83mUJ7Jd3CJaqW:10</blockquote>
	
			Такая запись означает, что мы получаем 10% от дохода вашей мастерноды. Мы постоянно следим за этой настройкой.<br/>
			Если она окажется меньше установленного лимита, тогда ваша мастернода без предупреждения отключается.<br/>
			<i><u>После релиза v12 - система пожертвований перестала работать</u>. <u>На данный момент, мы не знаем когда она снова заработает</u>.</i><br/><br/>
			
			
			<i>Второй способ - оплата прямым переводом.</i><br/>
			
			Продление срока будет произведено на основе фактически присланной вами суммы, из расчёта "<i>1 DASH за каждые 10 дней хостинга</i>".<br/>
			1. Введите в поле поиска адрес вашей мастерноды.<br/>
			2. Скопируйте соответствующий ей адрес для оплаты хостинга и произведите оплату.<br/>
			3. Через некоторое время снова проверьте список и убедитесь что продление состоялось.<br/><br/>
			
			<table id="pay_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><center>IP</center></th>
						<th><center>Кошелек</center></th>
						<th><center>Куда оплачивать</center></th>
						<th><center>Оплачено до</center></th>
					</tr>
				</thead>
				<tbody>
					<? echo $pay_mn; ?>
				</tbody>
			</table>
			
			<hr>
			
			<h3>Установка</h3>
			Запустите ваш DASH кошелек и откройте консоль. Далее создайте новый DASH адрес:<br/><br/>
			<blockquote style="font-size:14px;">getaccountaddress 0</blockquote>
			После того, как вы выполните эту команду вы увидите свой новый адрес. Это адрес вашей мастерноды. Отправьте на него 1000 DASH с помощью команды:<br/><br/>
			<blockquote style="font-size:14px;">sendtoaddress ваш_новый_адрес 1000</blockquote>
			После этого вы увидите номер вашей транзакции, через 50 минут напишите этот номер и нажмите кнопку  "<u>получить masternode.conf</u>"<br/>
			Если ваш кошелек зашифрован (установлен пароль), терминал выдаст ошибку, тогда вам надо будет <a href="http://www.youtube.com/watch?feature=player_detailpage&v=VEaRjVwxlxw#t=245" target="_blank">разблокировать кошелек</a> и повторить отправку 1000 DASH.<br/><br/>
			
			<input id="txid" class="form-control" placeholder="Номер вашей транзакции" type="text"><br/>
			<button id="setup" type="submit" class="form-control btn btn-default">Получить masternode.conf</button>
			
			<br/><br/>
			Если все прошло успешно, и вы скачали файл <u>masternode.conf</u>, то положите его в папку <i>%appdata%/Roaming/Dash/</i><br/>
			Перезагрузите ваш DASH кошелек. Откройте консоль и запустите мастерноду командой:<br/><br/>
			<blockquote style="font-size:14px;">masternode start-many</blockquote>
			
			Если вы увидели "<u>Successfully started 1 masternodes</u>" - то все отлично.<br/>
			Не выключайте кошелек минут 10-20. Откройте через текстовый редактор файл <u>masternode.conf</u> - файл имеет следующую структуру:<br/><br/>
			<blockquote style="font-size:14px;">mn1 IP_REMOTE_NODE:9999 ВАШ_MASTERNODE_KEY txid 0</blockquote>
			
			Скопируйте ваш masternode ключ. Прокрутите страницу вниз и найдите "<u>Управление</u>".<br/>
			Введите ваш ключ и нажмите "<u>Скачать debug.log</u>" - как только вы скачаете файл откройте его через текстовый редактор.<br/>
			В файле будет много текста, воспользуйтесь поиском и найдите "<u>Enabled! You may shut down the cold daemon.</u>"<br/>
			Обнаружив запись, вы можете выключить локальный кошелек. Теперь ваша мастернода работает. Поздравляем!<br/><br/>
			
			Также вы можете проверять статус работы вашей ноды на нашем сайте <a href="http://dash.org.ru/pages/stats.php#masternode" target="_blank">dash.org.ru</a>.<br/>
			Для этого в поиске укажите IP вашей мастерноды или адрес вашего кошелька (1000DASH).<br/>
			Альтернативный ресурс для проверки вашей мастерноды, общего количества узлов в сети и объема вознаграждения  dashninja.pl.<br/>
			<br/>
			<hr>
			
			<h3>Управление и использование</h3>
			Для управления своей нодой - введите ключ мастерноды, далее выполните нужное вам действие.<br/><br/>
			
			<input id="private_key" class="form-control" placeholder="masternode key" type="text"><br/>
			
			<center>
				<button id="restart" type="submit" class="form-control btn btn-default" style="width: 225px;">Перезагрузить</button>
				<button id="info" type="submit" class="form-control btn btn-default" style="width: 225px;">Информация</button>
				<button id="status" type="submit" class="form-control btn btn-default" style="width: 225px;">Статус</button>
				<button id="log" type="submit" class="form-control btn btn-default" style="width: 225px;">Скачать debug.log</button>
			</center>
			<br/>
			
			Примерно раз в 5 дней на адрес вашей мастерноды будет поступать выплата. Ее можно использовать для ваших нужд.<br/>
			Будьте внимательны! Если вы вместе с вознаграждением снимете часть монет, которые нужны для работы мастерноды, то она выключится.<br/>
			Чтобы этого не произошло, с помощью функции <a href="http://www.youtube.com/watch?v=Z12GNiBJqjQ" target="_blank">контроль монет</a>, заблокируйте 1000 DASH мастерноды.<br/>
			Теперь всё, что выше 1000 можете переводить на свой основной адрес.<br/><br/>
			Периодически проверяете работоспособность своей Мастерноды. Если вдруг её нет в списке, пишите в поддержку.<br/><br/>
			В случае выхода новой версии DASH - Мастернод-хостинг сервис обновляет у себя серверную часть.<br/>
			Затем Вы устанавливаете у себя новую версию кошелька. После этого надо снова запустить Мастерноду.<br/><br/>
			Напоминание №1. При использовании нашего Мастернод-хостинг сервиса, вы не передаёте и не сообщаете никакой информации, кроме адреса вашей Мастерноды.<br/>
			А значит ваши 1000 DASH всё время находятся в безопасности, под вашим единоличным контролем.<br/><br/>
			Напоминание №2. При запуска Мастерноды - 1000 DASH никуда не тратятся и не блокируются.<br/>
			Вы можете ими в любой момент воспользоваться. Однако, это повлечёт за собой выключение вашей Мастерноды.<br/><br/>
			
			<hr>
			
			<h3>"Выключенные" мастерноды</h3>
			Стараемся не допустить выключения мастернод с помощью мониторинга и скриптов.<br/>
			В случае если мастернода упала (crash) или зависла (freeze) - она <a href="https://github.com/poiuty/dashpay.org.ru/blob/master/remote/check.php" target="_blank">будет автоматически перезагружена</a>.<br/>
			Чаще всего crash и freeze происходят из-за ошибок в кошельке. Разработчики DASH достаточно быстро исправляют подобные ошибки.<br/>
			Если вы увидели свою мастерноду в этом списке. Вам необходимо, открыть файл <u>masternode.conf</u>, найти название вашей мастерноды.<br/>
			Например упала мастернода IP => 127.0.0.2, <u>masternode.conf</u> содержит записи.<br/><br/>
			<blockquote style="font-size:14px;">mn1 127.0.0.1:9999 ...<br/>
			mn2 127.0.0.2:9999 ...<br/>
			mn3 127.0.0.3:9999 ...<br/></blockquote>
			
			Теперь открываем холодный кошелек, запускаем консоль и включаем мастерноду.<br/><br/>
			
			<blockquote style="font-size:14px;">masternode start-alias mn2</blockquote>
			Если у вас появились какие-либо вопросы или проблемы - свяжитесь с нами <a href="https://forum.bits.media/index.php?/topic/15144-dashorgru-masternode-khosting/" target="_blank">на форуме</a> или в ICQ 450420625 => будем рады помочь.<br/><br/>
			<table id="mn_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><center>IP</center></th>
						<th><center>Кошелек</center></th>
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
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter31626488 = new Ya.Metrika({id:31626488,
                    clickmap:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/31626488" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</html>
