<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Moveable Group</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php Utils::printClaroCss() ?>
	</head>
	<body>
		<h1>Demo: Moveable Group</h1>
		<p>
			Click and drag any of the shapes to see the entire group move!
		</p>
		<div id="surfaceElement" style="border:1px solid #ccc;width:400px;height:400px;"></div>

		<?php Utils::printDojoScript("isDebug: true, async: true") ?>
		<script>

			require(["dojox/gfx", "dojox/gfx/Moveable", "dojo/domReady!"], function(gfx, Moveable) {
				// Create a GFX surface
				// Arguments:  node, width, height
				surface = gfx.createSurface("surfaceElement", 400, 400);

				// Create a group
				var group = surface.createGroup();

				// Create a square
				group.createRect({ x: 100, y: 50, width: 200, height: 100 }).setFill("yellow").setStroke("blue");

				// Add a circle
				group.createCircle({ cx: 100, cy: 300, r: 50 }).setFill("green").setStroke("pink");

				// Now an ellipse
				group.createEllipse({ cx: 300, cy: 200, rx: 50, r: 25 }).setFill("#fff").setStroke("#999");

				// And a line
				group.createLine({ x1: 10, y1: 50, x2: 400, y2: 400 }).setStroke("green");

				// How about a polyline?
				group.createPolyline([{ x: 250, y: 250 }, { x: 300, y: 300 }, { x: 250, y: 350 }, { x: 200, y: 300 }, { x: 110, y: 250 }]).setStroke("blue");

				// Add in an image
				group.createImage({ x: 100, y: 300, width: 123, height: 56, src: "../images/logo.png" });

				// With some text
				group.createText({ x: 64, y: 220, text: "Vector Graphics Rock!", align: "start"}).
				setFont({ family: "Arial", size: "20pt", weight: "bold" }). //set font
				setFill("blue");

				// And an advanced textpath
				group.createTextPath({ text: "TextPath!" }).moveTo(125, 70).lineTo(285, 20).setFont({family: "Verdana", size: "2em"}).setFill("black");

				// And a simple path
				group.createPath("m100 100 100 0 0 100c0 50-50 50-100 0s-50-100 0-100z").setStroke("black");

				// Make them moveable!
				new Moveable(group);
			});

		</script>
	</body>
</html>
