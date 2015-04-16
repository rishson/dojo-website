<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: dojox/grid/DataGrid</title>
		<?php Utils::printClaroCss() ?>
		<?php Utils::printLinkStyleTags(array('dojo/resources/dojo.css','dojox/grid/resources/claroGrid.css')) ?>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body class="claro">
		<h1>Demo: dojox/grid/DataGrid</h1>

		<br/>
		<div id="grid"></div>

		<?php
			Utils::printDojoScript();
		?>
		<script>
			var grid, store, dataStore;
			require([
				"dojox/grid/DataGrid",
				"dojo/store/Memory",
				"dojo/data/ObjectStore",
				"dojo/_base/xhr",
				"dojo/domReady!"
			], function(DataGrid, Memory, ObjectStore, xhr){
				xhr.get({
					url: "all-batting.json",
					handleAs: "json"
				}).then(function(data){
					store = new Memory({ data: data.items });
					dataStore = new ObjectStore({ objectStore: store });

					grid = new DataGrid({
						store: dataStore,
						query: { id: "*" },
						structure: [
							{
								noscroll: true,
								defaultCell: { width: "84px" },
								cells: [
									{ name: "First Name", field: "first" },
									{ name: "Last Name", field: "last" }
								]
							},{
								defaultCell: { width: "60px" },
								cells: [
									[
										{ name: "Bats", field: "bats", width: "70px", rowSpan: 2 },
										{ name: "Throws", field: "throws", width: "70px", rowSpan: 2 },
										{ name: "G", field: "totalG" },
										{ name: "AB", field: "totalAB" },
										{ name: "R", field: "totalR" },
										{ name: "RBI", field: "totalRBI" },
										{ name: "BB", field: "totalBB" },
										{ name: "K", field: "totalK" }
									],[
										{ name: "Games as Batter", field: "totalGAB", colSpan: 2 },
										{ name: "H", field: "totalH" },
										{ name: "2B", field: "total2B" },
										{ name: "3B", field: "total3B" },
										{ name: "HR", field: "totalHR" }
									]
								]
							}
						]
					}, "grid");
					
					// since we created this grid programmatically, call startup to render it
					grid.startup();
				});
			});
		</script>
	</body>
</html>
