<?
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/mn_head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: MasterNode hosting</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
				<li><a href="/pages/news.php">Новости</a></li>
				<li><a href="/pages/download.php">Скачать кошелек</a></li>
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
			Technical support: ICQ 450420625<br/>
			Payments are doing automatically by Masternode donation system.<br/>
			You determine the amount (%) of payment by yourself. This parameter is setting up in masternode.conf file.<br/><br/>
			<blockquote style="font-size:14px;">XkB8ySpiqyVHeAXHsNhU83mUJ7Jd3CJaqW:10</blockquote>
	
			It means you are sending to our service 10% of your total Masternode earnings. We are constantly monitoring this setting.<br/>
			If your percentage is less than minimal donate limit - your Masternode will be switched off without notice.<br><br>
			
			Number of active MNs: <? echo $mn_online; ?> | Number of available MNs: <? echo $mn_free; ?> | Minimal donation limit: 10%<br/><br/>
			
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
		</div>
	</div>
</div>
<script src="//dash.org.ru/js/mn-en.js"></script>
</body>
</html>
