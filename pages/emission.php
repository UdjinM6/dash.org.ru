<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/private/pages/menu.php');
$j = 5; $coins = 5300000; $em_table = '<tr><td>2014</td><td>0</td><td>5300000</td><td>100</td><td>25.2</td></tr>'; $em_data = "0,"; $em_data_new = "5300000, ";
for ($i=1; $i<50; $i++) {
	$j -= $j/14;
	$p = 210240*$j;
	$coins = $coins + $p;
	$em_table = $em_table."<tr><td>".(2014+$i)."</td><td>".round($coins)."</td><td>".round($p)."</td><td>".round($p*100/($coins-$p), 2)."</td><td>".round($j, 2)."</td></tr>";
	$em_data = $em_data.round($coins).",";
	$em_data_new = $em_data_new.round($p).",";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASH: эмиссия</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="//code.highcharts.com/highcharts.js"></script>
	<script src="//code.highcharts.com/modules/exporting.js"></script>
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
			<div id="container8" style="height: 300px;"></div>
				<table class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Year</th>
							<th>All</th>
							<th>This year</th>
							<th>Emission %</th>
							<th>Reward</th>
						</tr>
					</thead>
				<tbody>
					<? echo $em_table; ?>
				</tbody>
			</table>
			<hr>
		<div>
	</div>
</div>
</body>
<script>
$('#container8').highcharts({
		chart: { zoomType: 'x' },
		credits:	{ enabled: false },
		exporting:	{ enabled: false },
		title: { text: '' },
		xAxis: {  type: 'datetime' },
		legend:{ enabled: false },
		yAxis: {
			title: { text: 'All' },
			min: 0,
		},
		plotOptions: {
			area: {
				fillColor: {
					linearGradient: { 
						x1: 0, y1: 0, x2: 0, y2: 1},
						stops: [[0, Highcharts.getOptions().colors[0]],
								[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]]
					},
					marker: { radius: 2 },
					lineWidth: 1,
					states: {
						hover: { lineWidth: 1 }
					},
					threshold: null
				}
			},	
        tooltip: {
            xDateFormat: '<b>Year:</b> %Y',
            shared: true
        },
		series: [{
			type: 'area',
			name: 'Coins',
			pointInterval: 365.24 * 24 * 3600 * 1000,
            pointStart: Date.UTC(2014, 0, 1),
			data: [  <? echo $em_data; ?> ]
		},
		{
			type: 'area',
			name: 'Emission',
			fillColor: '#1F77BD',
			pointInterval: 365.24 * 24 * 3600 * 1000,
            pointStart: Date.UTC(2014, 0, 1),
			data: [  <? echo $em_data_new; ?> ]
		}]
	}); 
</script>
</html>
