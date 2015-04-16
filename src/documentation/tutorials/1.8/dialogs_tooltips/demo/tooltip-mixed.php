<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Mixed Tooltip Usages</title>
		<style>
			.rodTip	{ background:lightblue; border-bottom:1px dotted blue; cursor:help; padding:2px; display:inline-block; }
			.customTip	{ background:pink; }
		</style>
		<?php
    		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
    		Utils::printClaroCss();
    	?>
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body class="claro">
		<h1>Demo: Mixed Tooltip Usages</h1>

		<h2>Tooltip on a dijit/form/Button (Declarative)</h2>
		<button id="tooltipButton" onmouseover="dijit.Tooltip.defaultPosition=['above', 'below']">Tooltip Above</button>
		<div class="dijitHidden"><span data-dojo-type="dijit/Tooltip" data-dojo-props="connectId:'tooltipButton'">I am <strong>above</strong> the button</span></div>

		<button id="tooltipButton2" onmouseover="dijit.Tooltip.defaultPosition=['below','above']">Tooltip Below</button>
		<div class="dijitHidden"><span data-dojo-type="dijit/Tooltip" data-dojo-props="connectId:'tooltipButton2'">I am <strong>below</strong> the button</span></div>

		<button id="tooltipButton3" onmouseover="dijit.Tooltip.defaultPosition=['after-centered','before-centered']">Tooltip After</button>
		<div class="dijitHidden"><span data-dojo-type="dijit/Tooltip" data-dojo-props="connectId:'tooltipButton3'">I am <strong>after</strong> the button</span></div>

		<button id="tooltipButton4" onmouseover="dijit.Tooltip.defaultPosition=['before-centered','after-centered']">Tooltip Before</button>
		<div class="dijitHidden"><span data-dojo-type="dijit/Tooltip" data-dojo-props="connectId:'tooltipButton4'">I am <strong>before</strong> the button</span></div>

		<br /><br />
		<h2>Tooltip on Text in Paragraph (Programmatic)</h2>
		<p>
			<span id="nameTip" class="rodTip">Roderick David "Rod" Stewart</span>, CBE (born 10 January 1945) is a British singer-songwriter and musician, born and raised in <span id="londonTip" class="rodTip">North London, England</span> and currently residing in Epping. He is of Scottish and English lineage.
		</p>
		<p>
			With his career in its fifth decade, Stewart has sold <span id="recordsTip" class="rodTip">over 100 million records worldwide</span>, making him one of the best selling artists of all time. In the UK, he has garnered six consecutive number one albums, and his tally of 62 hit singles include 31 that reached the top 10, six of which gained the number one position. He has had 16 top ten singles in the U.S, with four of these reaching number one on the Billboard Hot 100. In 2008, Billboard magazine ranked him the 17th most successful artist on the "The Billboard Hot 100 Top All-Time Artists". He was voted at #33 in Q Magazine's list of the top 100 Greatest Singers of all time. In 1994, Stewart was inducted into the Rock and Roll Hall of Fame.
		</p>

		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>

			// Require the Tooltip class
			require(["dijit/Tooltip", "dojo/parser", "dojo/ready"], function(Tooltip, parser, ready){
				// When the DOM and resources are ready....
				ready(function(){
					parser.parse();
					// Add tooltip of his picture
					new Tooltip({
						connectId: ["nameTip"],
						label: "<img src='../images/rod-stewart.jpg' alt='Rod Stewart' width='300' height='404' />"
					});
					// Add tooltip of North London
					new Tooltip({
						connectId: ["londonTip"],
						label: "<img src='../images/emirates-stadium.jpg' alt='The Emirates in London' width='400' height='267' />"
					});
					//Add tooltip of record
					new Tooltip({
						connectId: ["recordsTip"],
						label: "<img src='../images/every-picture.jpg' alt='Every Picture Tells a Story' width='200' height='197' />"
					});
					// Add custom tooltip
					var myTip = new Tooltip({
						connectId: ["hoverLink"],
						label: "Don't I look funky?",
						"class": "customTip"
					});
				});
			});
		</script>
	</body>
</html>
