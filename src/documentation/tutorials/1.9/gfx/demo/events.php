<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: GFX Events</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php Utils::printClaroCss() ?>
	</head>
	<body>
		<h1>Demo: GFX Events</h1>

		<p>Click any element of the group to see its event object in the Javascript console.</p>

		<div id="surfaceElement" style="border:1px solid #ccc;width:400px;height:400px;"></div>

		<?php Utils::printDojoScript("isDebug: true, async: true, parseOnLoad: true") ?>
		<script>

			require(["dojox/gfx", "dojo/on", "dojo/domReady!"], function(gfx, on) {
				// Create a GFX surface
				// Arguments:  node, width, height
				surface = gfx.createSurface("surfaceElement", 400, 400);

				// Create a group
				var group = surface.createGroup();

				// Create a square
				group.createRect({ x: 100, y: 50, width: 200, height: 100 }).setFill("yellow").setStroke("blue");

				// Add a circle
				var circle = group.createCircle({ cx: 100, cy: 300, r: 50 }).setFill("green").setStroke("pink");
				circle.on("click",function(e) {
					circle.setFill("red");
					console.log("Circle click!",e);
				});

				// Now an ellipse
				group.createEllipse({ cx: 300, cy: 200, rx: 50, r: 25 }).setFill("#fff").setStroke("#999");

				// Add a click event to the group
				group.on("click", function(e) {
				    // Log the event the console
					console.log("Group click!",e);
				}, true);
			});

		</script>
	</body>
</html>
