<? require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: торговля на бирже</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/css/default.css">
	<script src="/js/highlight.pack.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
	<style>.tweaked-margin { margin-right: 30px; } </style>
</head>
<body>
<? echo $navi; ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<h3>Прием платежей</h3>
			Вы можете автоматизировать прием платежей DASH на вашем сайте. Для этого вам нужно установить и запустить полную версию кошелька.<br/>
			Каждому клиенту сгенерируйте уникальный адрес для пополнения счета. Периодически, скриптом проверяйте входящие транзакции на ваш кошелек.<br/>
			Когда вы видите новую входящую транзакцию, проверьте на какой адрес поступили деньги. Узнайте кому из клиентов принадлежит адрес и увеличьте его баланс.<br/>
			После этого поменяйте в базе статус транзакции, чтобы не зачислить ее повторно. Как видите алгоритм достаточно простой. Ниже пример на PHP.<br/><br/>
			
<pre><code class="PHP">require_once('easydarkcoin.php'); // https://github.com/elbereth/EasyDash-PHP
$dash = new Darkcoin('xxx','xxx','localhost','9998');

/* $dash->getnewaddress("NAME"); => так можно сгенерировать новый адрес клиенту */
// Получаем массив и делаем цикл
$a = $dash->listtransactions("*", 100000));

for($i=0; count($a) > $i; $i++){
// Проверяем тип транзакции, количество подтверждений + сумму
if($a["$i"]["category"] != "receive" || $a["$i"]["confirmations"] < 6 || $a["$i"]["amount"] < 0.001) continue;

// Есть ли в базе эта транзакция?
$select = $db->prepare("SELECT * FROM `bills` WHERE `pid` =:id");
$select->bindParam(':id', $a["$i"]["txid"], PDO::PARAM_STR);
$select->execute();
if($select->rowCount() > 0) continue;

// Кто оплачивает?
$select = $db->prepare("SELECT * FROM `users` WHERE `dash` =:address");
$select->bindParam(':address', $a["$i"]["address"], PDO::PARAM_STR);
$select->execute();
if($select_query->rowCount() != 1) continue;
$row = $select->fetch();
$user_id = $row['user_id'];

// Узнаем курс
$usd = json_decode(file_get_contents("http://pubapi.cryptsy.com/api.php?method=singlemarketdata&marketid=213"), true);
if(empty($usd["return"]["markets"]["DRK"]["lasttradeprice"])) die('cant get usd value');

// Увеличим баланс
$money = round($a["$i"]["amount"]*$usd["return"]["markets"]["DRK"]["lasttradeprice"]);
$update = $db->prepare("UPDATE `users` SET `money` = `money`+:money WHERE `user_id` = :user_id");
$update->bindParam(':money', $money, PDO::PARAM_STR);
$update->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$update->execute();

// Запишем лог
$insert = $db->prepare("INSERT INTO `bills`(`pid`, `amount`, `date`, `system`, `user_id`) VALUES ( :id, :money, :time, 'DASH', :user_id)");
$insert->bindParam(':id', $a["$i"]["txid"], PDO::PARAM_STR);
$insert->bindParam(':money', $money, PDO::PARAM_STR);
$insert->bindParam(':time', time(), PDO::PARAM_STR);
$insert->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$insert->execute();
}</code></pre><br/>
		</div>
	</div>
</div>
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
