<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: dojox/grid/DataGrid Simple Structure</title>
		<?php Utils::printLinkStyleTags(array('dojo/resources/dojo.css',
			'dijit/themes/claro/claro.css',
			'dojox/grid/resources/Grid.css',
			'dojox/grid/resources/claroGrid.css')) ?>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">

	</head>
	<body class="claro">
		<h1>Demo: dojox/grid/DataGrid Simple Structure</h1>

		<br/>
		<div id="grid"></div>
		<?php Utils::printDojoScript("isDebug: true, async: true") ?>
		<script>


			require(["dojox/grid/DataGrid",
					"dojo/store/Memory",
					"dojo/data/ObjectStore",
					"dojo/_base/xhr",
					"dojox/math/round",
					"dojo/domReady!"
			], function(DataGrid, Memory, ObjectStore, xhr, mathRound) {
				var grid, dataStore;

				xhr.get({
					url: "hof-batting.json",
					handleAs: "json"
				}).then(function(data){
						dataStore =  new ObjectStore({ objectStore:new Memory({ data: data.items }) });

						grid = new DataGrid({
						store: dataStore,
						query: { id: "*" },
						structure: [
							{
								name: "Name", fields: ["first", "last"], width: "30%",
								formatter: function(fields, rowIndex, cell){
									var first = fields[0],
										last = fields[1];

									return last + ", " + first;
								}
							},
							{
								name: "G", field: "totalG", width: "10%",
								formatter: function(games, rowIndex, cell){
									return games + " <em>games</em>";
								}
							},
							{ name: "AB", field: "totalAB", width: "10%" },
							{ name: "R", field: "totalR", width: "10%" },
							{ name: "H", field: "totalH", width: "10%" },
							{ name: "RBI", field: "totalRBI", width: "10%" },
							{
								name: "Batting Average", field: "_item", width: "10%",
								formatter: function(item, rowIndex, cell){
									var store = cell.grid.store,
										ba = store.getValue(item, "totalH") / store.getValue(item, "totalAB");

									return mathRound(ba, 3);
								}
							},
							{
								name: "Slugging %", width: "10%",
								get: function(rowIndex, item){
									if(!item){
										return;
									}
									// |this| is the cell object
									var store = this.grid.store,
										hits = store.getValue(item, "totalH"),
										doubles = store.getValue(item, "total2B"),
										triples = store.getValue(item, "total3B"),
										homeruns = store.getValue(item, "totalHR"),
										total_bases = hits + doubles + (triples * 2) + (homeruns * 3),
										at_bats = store.getValue(item, "totalAB");

									return total_bases / at_bats;
								},
								formatter: function(slugging){
									return mathRound(slugging, 3);
								}
							}
						]
					}, "grid");

					grid.startup();
				});
			});
		</script>
	</body>
</html>
