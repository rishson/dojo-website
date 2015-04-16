<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Dijit ComboBox</title>
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php Utils::printClaroCss() ?>
	</head>
	<body class="claro">
		<div style="width:540px;">
			<h1 style="text-align: center;">Programmatic Example</h1>
			<div style="width:50%;float: left;">
				<h1>dijit/form/ComboBox</h1>
				<label for="stateSelect">State:</label>
				<div id="stateSelect"></div>
			</div>
			<div style="width:50%;float: right;"><h1>Submitted Value:</h1>
				<div id="value"></div>
				<h5>*Note how the submitted value will be the displayed value</h5>
			</div>
		</div>

		<?php Utils::printDojoScript("isDebug: true, async: true") ?>
		<script>
			require(["dijit/form/ComboBox", "dojo/data/ItemFileReadStore", "dojo/domReady!"], function(ComboBox, ItemFileReadStore) {
				// create store instance referencing data from states.json
				var stateStore = new ItemFileReadStore({
					url: "states.json"
				});
				
				// create ComboBox widget, populating its options from the store
				var select = new ComboBox({
					name: "stateSelect",
					placeHolder: "Select a State",
					store: stateStore,
					onChange: function(value){
						document.getElementById("value").innerHTML = value;
					}
				}, "stateSelect");
				select.startup();
			});
		</script>
	</body>
</html>
