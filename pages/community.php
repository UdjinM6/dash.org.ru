<? require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: сообщество</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.min.css" />
	<style>.tweaked-margin { margin-right: 30px; }</style>
</head>
<body>
<div class="github-fork-ribbon-wrapper right">
	<div class="github-fork-ribbon">
		<a href="https://github.com/poiuty/dashpay.org.ru">Fork me on GitHub</a>
	</div>
</div>
<? echo $navi; ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<h3>Добро пожаловать!</h3>
			Над развитием и продвижением Digital Cash работают волонтеры из разных стран мира. Найдите интересных людей, группы и сообщества относящиеся к DASH.<br/>
			Регистрируйтесь на форумах, вступайте в социальные группы. Общайтесь, обменивайтесь опытом. <a href="https://dashtalk.org/threads/core-developer-contest-and-sponsor-program.4358/" target="_blank">Участвуйте в разработке</a>. И будьте в курсе последних новостей.
			<hr/>
			<h3>Форумы и социальные сети</h3>
			<div class="row">
				<div class="col-md-3">
					<a href="https://dashtalk.org/forums/russkij-russian.27/" target="_blank"><img src="//dash.org.ru/img/dashtalk_logo.png"></a>
				</div>
				<div class="col-md-3">
					<a href="https://forum.bits.media/index.php?/topic/5740-dash-darkcoin/" target="_blank"><img src="//dash.org.ru/img/bitcoin_security.png"></a>
				</div>
				<div class="col-md-3">
					<a href="https://www.reddit.com/r/dashpay" target="_blank"><img src="//www.dashpay.io/wp-content/uploads/2014/09/reddit_logo.png"></a>
				</div>
				<div class="col-md-3">
					<a href="https://bitcointalk.org/index.php?topic=421615.0" target="_blank"><img src="//dash.org.ru/img/bitcointalk_logo.png"></a>
				</div>
			</div>
			<hr/>
			<h3>Волонтеры</h3>
			<div class="row">
				<div class="col-md-3">
					<a href="https://github.com/dashpay/dash" target="_blank"><img src="https://www.dashpay.io/wp-content/uploads/2014/09/github_logo.png"></a>
				</div>
				<div class="col-md-3">
					<a href="https://www.dashpay.io/community/dash-ambassador-group/" target="_blank"><img src="https://www.dashpay.io/wp-content/uploads/2015/01/hands_together.jpg" style="width: 197px;"></a>  
				</div>
				<div class="col-md-3">
					<a href="http://jira.darkcoin.qa/" target="_blank"><img src="https://www.dashpay.io/wp-content/uploads/2014/09/jira_logo.png"></a>
				</div>
				<div class="col-md-3">
					<a href="https://www.transifex.com/projects/p/dash/" target="_blank"><img src="https://www.dashpay.io/wp-content/uploads/2014/08/transifex_logo.png" style="width: 197px;"></a>
				</div>
			</div>
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
