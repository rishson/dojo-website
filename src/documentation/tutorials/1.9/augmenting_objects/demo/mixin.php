<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Demo: lang.mixin
		</title>
		<link rel="stylesheet" href="style.css" media="screen" type="text/css">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen" type="text/css">
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript("async: true");
		?>
		<script>

			require(["dojo/_base/lang", "dojo/json"], function(lang, JSON){

				var defaultSettings = {
					useTheForce: true,
					isEvil: false,
					length: 75,
					color: 'blue'
				};

				function Lightsaber(settings){
					// `defaultSettings` is first mixed into the blank object,
					// then `settings` is mixed into the blank object, overriding
					// any properties from `defaultSettings` without altering
					// the `defaultSettings` object
					this.settings = lang.mixin({}, defaultSettings, settings);
				}

				var darthsaber = new Lightsaber({
					isEvil: true,
					color: 'red'
				});

				// { useTheForce: true, isEvil: true, length: 75, color: "red" }
				console.log("darthsaber:\n", JSON.stringify(darthsaber.settings, null, '\t'));
			});
		</script>
	</head>
	<body>
		<h1>Demo: lang.mixin</h1>
		<p>View source. The result is in the console.</p>
	</body>
</html>
