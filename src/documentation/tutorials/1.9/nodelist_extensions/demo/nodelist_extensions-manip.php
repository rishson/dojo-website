<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: NodeList Extensions: Manipulate</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Demo: NodeList Extensions: Manipulate</h1>
		
		<h3>Likes</h3>
		<ul id="likes"></ul>

		<h3>Don't Likes</h3>
		<ul id="dontLikes"></ul>

	<h3>All Fruit</h3>
		<ul>
			<li>Alkaline Fruits
				<ul>
					<li class="alkaline yum">Apples</li>
					<li class="alkaline">Persimmons</li>
					<li class="alkaline">Thompson Grapes (Seedless)</li>
					<li class="alkaline">Muscat Grapes</li>
					<li class="alkaline">All Sweet Grapes</li>
					<li class="alkaline">Fresh Figs</li>
					<li class="alkaline">Dates</li>
					<li class="alkaline">Figs</li>
					<li class="alkaline yum">Raisins</li>
					<li class="alkaline yuck">Prunes</li>
					<li class="alkaline">Apricots</li>
					<li class="alkaline">Peaches</li>
					<li class="alkaline yum">Bananas</li>
					<li class="alkaline">Cherries</li>
					<li class="alkaline">Bananas</li>
					<li class="alkaline">Lychees</li>
					<li class="alkaline">Carob</li>

				</ul>
			</li>
			<li>Subacidic Fruits
				<ul>
					<li class="subacidic">Sweet Apples (Delicious)</li>
					<li class="subacidic">Sweet Peaches</li>
					<li class="subacidic">Sweet Nectarines</li>
					<li class="subacidic">Pears</li>
					<li class="subacidic">Sweet Cherries</li>
					<li class="subacidic">Some Grapes (Neither sweet nor sour)</li>
					<li class="subacidic">Papayas</li>
					<li class="subacidic">Mangos</li>
					<li class="subacidic">Apricots</li>
					<li class="subacidic yum">Fresh Lychees</li>
					<li class="subacidic">Sweet Plums</li>
					<li class="subacidic">Blueberries</li>
					<li class="subacidic">Raspberries</li>
					<li class="subacidic">Blackberries</li>
					<li class="subacidic">Mulberries</li>
					<li class="subacidic">Huckleberries</li>
					<li class="subacidic">Cherimoyas</li>
				</ul>
			</li>
			<li>Acid Fruits
				<ul>
					<li class="acid">Oranges</li>
					<li class="acid">Grapefruit</li>
					<li class="acid">Pineapples</li>
					<li class="acid">Strawberries</li>
					<li class="acid">Pomegranates</li>
					<li class="acid yuck">Lemons</li>
					<li class="acid">Kiwi Fruit</li>
					<li class="acid">Kumquats</li>
					<li class="acid">Loquats</li>
					<li class="acid">Carambolas</li>
					<li class="acid yuck">Loganberries</li>
					<li class="acid">Gooseberries</li>
					<li class="acid">Cranberries </li>
					<li class="acid">Limes</li>
					<li class="acid">Sour Apples</li>
					<li class="acid">Sour Grapes</li>
					<li class="acid">Sour Peaches</li>
					<li class="acid">Sour Nectarines</li>
					<li class="acid">Sour Plums</li>
					<li class="acid yuck">Sour Cherries</li>
				</ul>
			</li>
			<li>Melons
				<ul>
					<li class="melon">Watermelon</li>
					<li class="melon yum">Honeydew Melon</li>
					<li class="melon">Honey Balls</li>
					<li class="melon yum">Cantaloupe</li>
					<li class="melon yuck">Muskmelon</li>
					<li class="melon">Casaba Melon</li>
					<li class="melon">Crenshaw Melon</li>
					<li class="melon">Pie Melon</li>
					<li class="melon">Banana Melon</li>
					<li class="melon">Persian Melon</li>
					<li class="melon">Christmas Melon</li>
					<li class="melon">Nutmeg Melon</li>
				</ul>
			</li>
		</ul>		
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript("async: true");
		?>
		<script>
			require(["dojo/query", "dojo/NodeList-manipulate", "dojo/domReady!"], function(query){
				query(".yum") // get elements with the class 'yum'
					.clone() // create a new NodeList containing cloned copies of each element
					.prepend('<span class="emoticon happy"></span>') // inject a span inside each of the cloned elements
					.appendTo("#likes"); // insert the clones into the element with id 'likes'

				query(".yuck")
					.clone()
					.append('<span class="emoticon sad"></span>')
					.appendTo("#dontLikes");

			});
		</script>
	</body>
</html>
