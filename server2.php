<?php
	/*require_once('control/WebSiteClass.php');

	require_once('control/definitions.php');

	// Progress data requesting to server
	require_once('control/DefaultObjectsClass.php');

	$result = DefaultObjectsClass::GetTestWorld();

	var_dump($result);*/
?>


<!DOCTYPE html>
<html lang = "en" >
<head >
	<meta name = "keywords" content = "jQuery Gauge, Gauge, Radial Gauge, jqxGauge" />
	<meta name = "description"
	      content = "In the following demo you can see how you can cuztomize jqxGauge's ranges. You can set range's start and end width, start and end distance from the gauge's bundaries and custom style." />
	<title id = 'Description' >jqxGauge displays an indicator within a range of values. Gauges
	                           can be used in a table or matrix to show the relative value of a field in a range
	                           of values in the data region, for example, as a KPI</title >
	<link rel = "stylesheet" href = "scripts/jqwidgets/jqwidgets/styles/jqx.base.css" type = "text/css" />
	<script type = "text/javascript" src = "scripts/jqwidgets/scripts/jquery-1.11.1.min.js" ></script >
	<script type = "text/javascript" src = "scripts/jqwidgets/jqwidgets/jqxcore.js" ></script >
	<script type = "text/javascript" src = "scripts/jqwidgets/jqwidgets/jqxdraw.js" ></script >
	<script type = "text/javascript" src = "scripts/jqwidgets/jqwidgets/jqxgauge.js" ></script >
	<style type = "text/css" >
		#linearValue {
			background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #fafafa), color-stop(100%, #f3f3f3));
			background-image: -webkit-linear-gradient(#fafafa, #f3f3f3);
			background-image: -moz-linear-gradient(#fafafa, #f3f3f3);
			background-image: -o-linear-gradient(#fafafa, #f3f3f3);
			background-image: -ms-linear-gradient(#fafafa, #f3f3f3);
			background-image: linear-gradient(#fafafa, #f3f3f3);
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			-ms-border-radius: 3px;
			-o-border-radius: 3px;
			border-radius: 3px;
			-webkit-box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
			-moz-box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
			box-shadow: 0 0 50px rgba(0, 0, 0, 0.2);
			padding: 10px;
		}
	</style >
	<script type = "text/javascript" >
		$(document).ready(function () {
			$('#linearGauge').jqxLinearGauge({
				orientation: 'vertical',
				width: 100,
				height: 350,
				ticksMajor: {size: '10%', interval: 10},
				ticksMinor: {size: '5%', interval: 2.5, style: {'stroke-width': 1, stroke: '#aaaaaa'}},
				max: 60,
				pointer: {size: '5%'},
				colorScheme: 'scheme05',
				labels: {
					interval: 20, formatValue: function (value, position) {
						if (position === 'far') {
							value = (9 / 5) * value + 32;
							if (value === -76) {
								return '°F';
							}
							return value + '°';
						}
						if (value === -60) {
							return '°C';
						}
						return value + '°';
					}
				},
				ranges: [
					{startValue: -10, endValue: 10, style: {fill: '#FFF157', stroke: '#FFF157'}},
					{startValue: 10, endValue: 35, style: {fill: '#FFA200', stroke: '#FFA200'}},
					{startValue: 35, endValue: 60, style: {fill: '#FF4800', stroke: '#FF4800'}}],
				animationDuration: 1500
			});

			$('#linearGauge').on('valueChanging', function (e) {
				$('#linearValue').text(Math.round(e.args.value) + ' C');
			});

			$('#linearGauge').jqxLinearGauge('value', 40);
		});
	</script >
</head >
<body style = "background:white;" >
<div id = "demoWidget" style = "position: relative;" >
	<div style = "margin-left: 60px; float: left;" id = "linearGauge" >
	</div >
	<div id = "linearValue"
	     style = "position: absolute; top: 360px; left: 415px; font-family: Sans-Serif; text-align: center; font-size: 17px; width: 70px;" >
	</div >
</div >
</body >
</html >



