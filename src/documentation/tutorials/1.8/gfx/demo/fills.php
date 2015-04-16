<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: GFX Fills</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php Utils::printClaroCss() ?>
	</head>
	<body>
		<h1>Demo: GFX Fills</h1>

		<div id="surfaceElement" style="border:1px solid #ccc;width:400px;height:400px;"></div>

		<?php Utils::printDojoScript("isDebug: true, async: true,  parseOnLoad: true") ?>
		<script>

			require(["dojox/gfx", "dojo/domReady"], function(gfx) {

				gfx.renderer = "canvas";

				// Create a GFX surface
				// Arguments:  node, width, height
				surface = gfx.createSurface("surfaceElement", 400, 400);

				// Create a circle with a set "blue" color
				surface.createCircle({ cx: 50, cy: 50, rx: 50, r: 25 }).setFill("blue");

				// Crate a circle with a set hex color
				surface.createCircle({ cx: 300, cy: 300, rx: 50, r: 25 }).setFill("#f00");

				// Create a circle with a linear gradient
				surface.createRect({x: 180, y: 40, width: 200, height: 100 }).
				setFill({ type:"linear",
					x1: 0,
					y1: 0,   //x: 0=>0, consistent gradient horizontally
					x2: 0,   //y: 0=>420, changing gradient vertically
					y2: 420,
					colors: [
						{ offset: 0,   color: "#003b80" },
						{ offset: 0.5, color: "#0072e5" },
						{ offset: 1,   color: "#4ea1fc" }
					]
				});

				// Create a circle with a radial gradient
				surface.createEllipse({
					cx: 120,
					cy: 260,
					rx: 100,
					ry: 100
				}).setFill({
					type: "radial",
					cx: 150,
					cy: 200,
					colors: [
						{ offset: 0,   color: "#4ea1fc" },
						{ offset: 0.5, color: "#0072e5" },
						{ offset: 1,   color: "#003b80" }
					]
				});

			});

		</script>
	</body>
</html>
