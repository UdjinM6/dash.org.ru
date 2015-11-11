<?
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/mn_head.php');
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
<div id="myModal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<center> <h4 class="modal-title">Please, wait.</h4> </center>
			</div>
			<div id="modal_info" class="modal-body"></div>
		</div>
	</div>
</div>
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="/" >
				<img alt="Brand" src="/img/logo.png" style="max-width: 150px;">
			</a>
			<ul class="nav navbar-nav">
				<li><a href="/">Главная</a></li>
				<li><a href="/pages/community.php">Сообщество</a></li>
				<li><a href="/pages/mining.php">Майнинг</a></li>
				<li><a href="/pages/trade.php">Биржа</a></li>
				<li><a href="/pages/merchant.php">Прием платежей</a></li>
				<li><a href="/pages/stats.php">Статистика</a></li>
				<li class="active"><a href="/pages/mn-en.php">Hosting</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<div style="width: 100%; padding-bottom:65px;">
				<div style="float: left;">
					<h3>MasterNode hosting</h3>
				</div>
				<div class="pull-right" style=" padding-right: 75px; padding-top: 23px;"><img src="/img/16/ru.png"> <a href="/pages/mn.php">Russian</a></div>
			</div>
			Dash is utilizing an innovative decentralized network of servers called Masternodes.<br/><br/>
			Masternodes primary function is to carry out the anonymization phase of the Darksend protocol and to validate transactions almost instantly.<br/>
			In return for providing this services, one Masternode is selected by the network to receive a part of the reward of each mined block.<br/>
			<br/>
			
			In order to run a Masternode, a user must put up 1000 DASH as something akin to collateral, though unlike traditional collateral, the Dash never leaves the user’s possession.<br/>
			It can be moved or spent at any time by the user – doing so simply removes the Masternode from service and makes it ineligible to receive rewards.<br/>
			Experienced users can setup Masternode themselves: <a href="https://dashtalk.org/forums/masternode-guides.66/" tarhet="_blank">dashtalk masternode guides</a>.<br/><br/>
			
			For people who don't want to mess around with technical stuff - we created this automatic MasterNode Hosting service.<br/>
			Now you can quickly setup your Masternode and manage it. Support Dash network and get your reward!<br/>
			<hr>
			
			<h3>Information</h3>
			<div class="alert alert-danger" role="alert">
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <b>Unpaid masternodes will be automatically switched off September 10</b>.<br/><br/>
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <a href="https://github.com/poiuty/dashpay.org.ru/blob/master/private/cron/pay.php" target="_blank">Direct Payments are accepting now</a>. Please read the full announcement.<br/><br/>
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  Check masternode status <a href="http://dashninja.pl" target="_blank">on this site dashninja.pl</a> => our site masternode list dont update now.
			</div>
			
			Number of active MNs: <? echo $mn_online; ?> | Number of available MNs: <? echo $mn_free; ?> | Minimal donation limit: 10%<br/><br/>
			
			Technical support ICQ 450420625 and <a href="https://dashtalk.org/threads/dash-org-ru-masternode-hosting.5723/" target="_blank">dashtalk</a><br/>
			Two way of payment. <i>First - payments are doing automatically by Masternode donation system</i>.<br/>
			You determine the amount (%) of payment by yourself. This parameter is setting up in masternode.conf file.<br/><br/>
			<blockquote style="font-size:14px;">XkB8ySpiqyVHeAXHsNhU83mUJ7Jd3CJaqW:10</blockquote>
	
			It means you are sending to our service 10% of your total Masternode earnings. We are constantly monitoring this setting.<br/>
			If your percentage is less than minimal donate limit - your Masternode will be switched off without notice.<br>
			<i><u>After release v12 - donation system has been switched off</u>. <u>At this point, we do not know when it will work again</u>.</i><br/><br/>
			
			
			<i>Second way - Direct Payment.</i><br/>
			Hosting period will be prolonged accordingly the sum you send us, based on price "<i>1 DASH for every 10 days of hosting service</i>".<br/>
			1. Input your Masternode address into search form.<br/>
			2. Copy the corresponding Direct payment address and send payment to it.<br/>
			3. Later check the list of Masternodes to make sure that your hosting period was prolonged properly.<br/><br/>
			
			<table id="pay_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><center>IP</center></th>
						<th><center>MN Adress</center></th>
						<th><center>Pay address</center></th>
						<th><center>Paid to</center></th>
					</tr>
				</thead>
				<tbody>
					<? echo $pay_mn; ?>
				</tbody>
			</table>
			
			<hr>
			
			<h3>Setup</h3>
			Open you Dash wallet and go to menu Tools => Debug console. Create new DASH address for your Masternode with command:<br/><br/>
			<blockquote style="font-size:14px;">getaccountaddress 0</blockquote>
			Press ENTER key. You will see new address of your Masternode. Send 1000 DASH to this address with command:<br/><br/>
			<blockquote style="font-size:14px;">sendtoaddress your_new_address 1000</blockquote>
			Press ENTER key. You will see the number of transaction. After 50 minutes please insert this number into the input form below and press button "<u>get masternode.conf</u>"<br/>
			If you Wallet is locked with passphrase, Debug console will return you an error. You have to <a href="http://www.youtube.com/watch?v=WJdai-e_W3U" target="_blank">unblock your wallet</a> and repeat sending 1000 DASH again.<br/><br/>
			
			<input id="txid" class="form-control" placeholder="your transaction number ID" type="text"><br/>
			<button id="setup" type="submit" class="form-control btn btn-default">Get masternode.conf</button>
			
			<br/><br/>
			If everything is done correct and you dowloaded <u>masternode.conf</u>, please put it in folder <i>%appdata%/Roaming/Dash/</i><br/>
			Restart your Dash wallet. Open Debug console and start your Masternode with command:<br/><br/>
			<blockquote style="font-size:14px;">masternode start-many</blockquote>

			If you get: "<u>Successfully started 1 masternodes</u>" - everything is OK.<br/>
			Don’t close your wallet for 10-20 minutes. Open your <u>masternode.conf</u> file with text editor. It has this structure:<br/><br/>
			<blockquote style="font-size:14px;">mn1 IP_REMOTE_NODE:9999 YOUR_MASTERNODE_KEY txid 0</blockquote>

			Copy your_masternode_key. Go to the bottom of this page and find "<u>Managing</u>" section.<br/>
			Insert your_masternode_key and press "<u>Download debug.log</u>". Open downloaded log-file with text editor.<br/>
			It’ll be lots of text there - search for phrase "<u>Enabled! You may shut down the cold daemon.</u>"<br/>
			Now you can close your local Dash wallet. Congratulations, your Masternode is working now!<br/><br/>
			
			You can also check your Masternode status on our site <a href="http://dash.org.ru/pages/stats.php#masternode" target="_blank">dash.org.ru</a>.<br/>
			Place your Masternode IP or your Masternode address (with 1000 DASH) in search form there.<br/>
			Alternative site to monitor your Masternode, all MN-network and statistics - dashninja.pl<br/>
			<br/>
			<hr>
			
			<h3>Managing</h3>
			To manage your Masternode - please insert your_masternode_key and press the button you need.<br/><br/>
			
			<input id="private_key" class="form-control" placeholder="masternode key" type="text"><br/>
			
			<center>
				<button id="restart" type="submit" class="form-control btn btn-default" style="width: 225px;">Restart</button>
				<button id="info" type="submit" class="form-control btn btn-default" style="width: 225px;">Information</button>
				<button id="status" type="submit" class="form-control btn btn-default" style="width: 225px;">Status</button>
				<button id="log" type="submit" class="form-control btn btn-default" style="width: 225px;">Download debug.log</button>
			</center>
			<br/>
			
			Approximately every 5 days your Masternode will get payment.<br/>
			You can use it as you want, but please take care - if you spend some on 1000 DASH which are using as a collateral - your Masternode will be switched off.<br/>
			To exclude this - please block your 1000 DASH with <a href="http://www.youtube.com/watch?v=RwcxOphwAok" target="_blank">Coin Control Feature</a>.<br/><br/>
			If you experience any problems - please call our support.<br/><br/>
			
			<hr>
			
			<h3>"Off" masternodes</h3>
			
			Our system is constantly monitoring all Masternodes and trying to keep them active.<br/>
			In case of your Masternode was crashed or frozen - <a href="https://github.com/poiuty/dashpay.org.ru/blob/master/remote/check.php" target="_blank">it will be restarted again automatically</a>.<br/>
			As usual "crash" and "freeze" problems are caused by wallet errors. Dash developers ussualy fix such a problems very quickly.<br/>
			If you see your Masternode in this list - you should open your local wallet and restart your masternode with command.<br/><br/>
			<blockquote style="font-size:14px;">masternode start-many</blockquote>
			
			If you need any assistance - please contact our support <a href="https://dashtalk.org/threads/dash-org-ru-masternode-hosting.5723/" target="_blank">on forum</a> => we will be happy to help you.<br/><br/>
			<table id="mn_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><center>IP</center></th>
						<th><center>MN Adress</center></th>
						<th><center>Last time seen</center></th>
					</tr>
				</thead>
				<tbody>
					<? echo $fail_mn; ?>
				</tbody>
			</table>
			<br/><br/>
				
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn-en.js"></script>
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
