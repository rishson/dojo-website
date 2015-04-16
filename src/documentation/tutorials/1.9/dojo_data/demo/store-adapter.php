<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Store Adapter</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printClaroGridCss();
		?>
		<style>
			#grid {
				width: 400px;
			}
		</style>
	</head>
	<body class="claro">
		<h1>Demo: Store Adapter</h1>
		<div id="grid">
		</div>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			var data, grid;
			require([
				"dojo/store/Memory",
				"dojo/data/ObjectStore",
				"dojox/grid/DataGrid",
				"dojo/domReady!"
			], function(Memory, ObjectStore, DataGrid){
				data = [
					{ abbr:'ec', name:'Ecuador',           capital:'Quito' },
					{ abbr:'eg', name:'Egypt',             capital:'Cairo' },
					{ abbr:'sv', name:'El Salvador',       capital:'San Salvador' },
					{ abbr:'gq', name:'Equatorial Guinea', capital:'Malabo' },
					{ abbr:'er', name:'Eritrea',           capital:'Asmara' },
					{ abbr:'ee', name:'Estonia',           capital:'Tallinn' },
					{ abbr:'et', name:'Ethiopia',          capital:'Addis Ababa' }
				];
				var objectStore = new Memory({
					data: data
				});
				grid = new DataGrid({
					store: ObjectStore({objectStore: objectStore}),
					structure: [
						{name:"Country", field:"name", width: "150px"},
						{name:"Abbreviation", field:"abbr", width: "120px"},
						{name:"Capital", field:"capital",width:"100%"}
					]
				}, "grid");
				grid.startup();
			});
		</script>
	</body>
</html>
