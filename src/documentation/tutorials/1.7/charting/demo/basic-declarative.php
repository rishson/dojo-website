<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Basic Declarative Chart</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Demo: Basic Declarative Chart</h1>

		<!-- create the chart -->
		<div
			data-dojo-type="dojox.charting.widget.Chart"
			data-dojo-props="theme:dojox.charting.themes.Claro" id="viewsChart" style="width: 550px; height: 550px;">

			<!-- Pie Chart: add the plot -->
			<div class="plot" name="default" type="Pie" radius="200" fontColor="#000" labelOffset="-20"></div>

			<!-- pieData is the data source -->
			<div class="series" name="Last Week's Visits" array="chartData"></div>
		</div>

		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript('');
		?>
		<script>

			// x and y coordinates used for easy understanding of where they should display
			// Data represents website visits over a week period
			chartData = [
				{ x: 1, y: 19021 },
				{ x: 1, y: 12837 },
				{ x: 1, y: 12378 },
				{ x: 1, y: 21882 },
				{ x: 1, y: 17654 },
				{ x: 1, y: 15833 },
				{ x: 1, y: 16122 }
			];

			require([
				// Require the widget parser
				"dojo/parser",

				 // Require the basic 2d chart resource
				"dojox/charting/widget/Chart",

				// Require the theme of our choosing
			    "dojox/charting/themes/Claro",

				// Charting plugins:

				// 	Require the Pie type of Plot
				"dojox/charting/plot2d/Pie"

			]);

		</script>
	</body>
</html>
