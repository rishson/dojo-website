<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Monthly Sales Pie Chart with MoveSlice</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
    	<?php
    		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
    		Utils::printClaroCss();
    	?>
	</head>
	<body class="claro">
		<h1>Monthly Sales Pie Chart with MoveSlice</h1>
		
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
			"dojox/charting/themes/Claro",
			
			// Charting plugins: 

			// 	We want to plot a Pie chart
			"dojox/charting/plot2d/Pie",

			// Retrieve the Legend, Tooltip, and MoveSlice classes
			"dojox/charting/action2d/Tooltip",
			"dojox/charting/action2d/MoveSlice",
			
			//	We want to use Markers
			"dojox/charting/plot2d/Markers",

			//	We'll use default x/y axes
			"dojox/charting/axis2d/Default",

			// Wait until the DOM is ready
			"dojo/domReady!"
		], function(Chart, theme, Pie, Tooltip, MoveSlice) {

			// Define the data
			var chartData = [10000,9200,11811,12000,7662,13887,14200,12222,12000,10009,11288,12099];
			
			// Create the chart within it's "holding" node
			var chart = new Chart("chartNode");

			// Set the theme
			chart.setTheme(theme);

			// Add the only/default plot 
			chart.addPlot("default", {
				type: Pie,
				markers: true,
				radius:170
			});
			
			// Add axes
			chart.addAxis("x");
			chart.addAxis("y", { min: 5000, max: 30000, vertical: true, fixLower: "major", fixUpper: "major" });

			// Add the series of data
			chart.addSeries("Monthly Sales - 2010",chartData);
			
			// Create the tooltip
			var tip = new Tooltip(chart,"default");
			
			// Create the slice mover
			var mag = new MoveSlice(chart,"default");
			
			// Render the chart!
			chart.render();

		});
		</script>
	</body>
</html>
