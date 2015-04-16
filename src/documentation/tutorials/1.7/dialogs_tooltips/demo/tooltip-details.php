<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Product Details</title>
		<style>
			p { padding:0; margin:0; }
		</style>
		<?php
    		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
    		Utils::printClaroCss();
    	?>
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body class="claro">
		<h1>Demo: Product Details</h1>

		<h2>My Favorite Movies</h2>
		<ul>
			<li><a href="http://www.imdb.com/title/tt0112573/" id="movieBraveheart">Braveheart</a></li>
			<li><a href="http://www.imdb.com/title/tt0237534/" id="movieBrotherhood">Brotherhood of the Wolf</a></li>
			<li><a href="http://www.imdb.com/title/tt0245844/" id="movieCristo">The Count of Monte Cristo</a></li>
		</ul>
		<div class="dijitHidden">
			<div data-dojo-type="dijit.Tooltip" data-dojo-props="connectId:'movieBraveheart'">
				<img style="width:100px; height:133px; display:block; float:left; margin-right:10px;" src="../images/braveheart.jpg" />
				<p style="width:400px;"><strong>Braveheart</strong><br />Braveheart is the partly historical, partly mythological, story of William Wallace, a Scottish common man who fights for his country's freedom from English rule around the end of the 13th century...</p>
				<br style="clear:both;">
			</div>
		</div>
		<div class="dijitHidden">
			<div data-dojo-type="dijit.Tooltip" data-dojo-props="connectId:'movieBrotherhood'">
				<img style="width:100px; height:133px; display:block; float:left; margin-right:10px;" src="../images/brotherhood.jpg" />
				<p style="width:400px;"><strong>Brotherhood of the Wolf</strong><br />In 1765 something was stalking the mountains of central France. A 'beast' that pounced on humans and animals with terrible ferocity...</p>
				<br style="clear:both;">
			</div>
		</div>
		<div class="dijitHidden">
			<div data-dojo-type="dijit.Tooltip" data-dojo-props="connectId:'movieCristo'">
				<img style="width:100px; height:133px; display:block; float:left; margin-right:10px;" src="../images/count.jpg" />
				<p style="width:400px;"><strong>The Count of Monte Cristo</strong><br />'The Count of Monte Cristo' is a remake of the Alexander Dumas tale by the same name. Dantes, a sailor who is falsely accused of treason by his best friend Fernand, who wants Dantes' girlfriend Mercedes for himself...</p>
				<br style="clear:both;">
			</div>
		</div>

		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			// Require the Tooltip Class
			require(["dijit/Tooltip", "dojo/parser","dojo/domReady!"], function(Tooltip, parser){
				// When the DOM is ready...
				// Change the tooltip positions
				Tooltip.defaultPosition = ["after","below"];
				parser.parse();
			});
		</script>
	</body>
</html>
