<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Columns - Monthly Sales</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Demo: Columns - Monthly Sales</h1>
		
		<div id="chartNode" style="width:800px;height:400px;"></div>

		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
		require([
			 // Require the basic chart class
			"dojox/charting/Chart",

			// Require the theme of our choosing
			"dojox/charting/themes/MiamiNice",
			
			// Charting plugins: 

			// 	We want to plot Columns 
			"dojox/charting/plot2d/Columns",
			
			//	We want to use Markers
			"dojox/charting/plot2d/Markers",

			//	We'll use default x/y axes
			"dojox/charting/axis2d/Default",

			// Wait until the DOM is ready
			"dojo/domReady!"
		], function(Chart, theme) {

			// Define the data
			var chartData = [10000,9200,11811,12000,7662,13887,14200,12222,12000,10009,11288,12099];
			
			// Create the chart within it's "holding" node
			var chart = new Chart("chartNode");

			// Set the theme
			chart.setTheme(theme);

			// Add the only/default plot 
			chart.addPlot("default", {
				type: "Columns",
				markers: true,
				gap: 5
			});
			
			// Add axes
			chart.addAxis("x");
			chart.addAxis("y", { vertical: true, fixLower: "major", fixUpper: "major" });

			// Add the series of data
			chart.addSeries("Monthly Sales",chartData);

			// Render the chart!
			chart.render();
			
		});
			
		</script>
	</body>
</html>
