<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: 3D Charts</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php
    		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
    		Utils::printClaroCss();
    	?>
	</head>
	<body class="claro">
		<h1>3D Charts</h1>
		<div id="chartNode" style="width:800px;height:400px;"></div>

		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			
			// Require the 3d chart resources
			require(["dojox/charting/Chart3D", "dojox/charting/plot3d/Bars", "dojo/domReady!"], 
					function(Chart3D, Bars) {
				
				// Gain reference to GFX's 3D matrix
				var m = dojox.gfx3d.matrix;

				// Create the 3D chart
				var chart = new Chart3D("chartNode", {
					lights: [{
						direction: {
							x: 5,
							y: 5,
							z: -5
						},
						color: "white"
					}],
					ambient: {
						color: "white",
						intensity: 2
					},
					specular: "white"
				}, [m.cameraRotateXg(10), m.cameraRotateYg(-10), m.scale(0.8), m.cameraTranslate(-50, -50, 0)]);

				// Create bars for the chart
				var barSet1 = new Bars(800, 400, {
					gap: 10,
					material: "yellow"
				});
				// Set data for the chart
				barSet1.setData([2, 8, 10, 5, 5, 8, 0, 9]);
				// Add a new plot
				chart.addPlot(barSet1);

				// Create bars for the chart
				var barSet2 = new Bars(800, 400, {
					gap: 10,
					material: "red"
				});
				// Set data for the chart
				barSet2.setData([8, 4, 4, 8, 3, 2, 6, 9]);
				// Add a new plot
				chart.addPlot(barSet2);

				// Generate the chart and render it
				chart.generate().render();
				
			});
			
		</script>
	</body>
</html>
