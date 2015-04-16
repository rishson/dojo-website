<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo: Dijit Menus</title>
	<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printClaroCss();
	?>
</head>
<body class="claro">
	<h3>Declarative Menu using iconClass</h3>
	<div id="mainMenu" data-dojo-type="dijit/Menu">
		<div data-dojo-type="dijit/MenuItem" id="edit"
			 data-dojo-props="iconClass: 'dijitIconEdit'">
			Edit
		</div>
		<div data-dojo-type="dijit/MenuItem" id="view"
			 data-dojo-props="iconClass: 'dijitIconApplication'">
			View
		</div>
		<div data-dojo-type="dijit/MenuItem" id="task"
			 data-dojo-props="iconClass: 'dijitIconTask'">
			Task
		</div>
	</div>
	<h3>Programmatic Menu using iconClass</h3>
	<div id="progMenu"></div>
	<p>Last selected: <span id="lastSelected">none</span></p>
	
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printDojoScript("isDebug:1, async:1");
	?>
	<script>
        require([
            "dojo/dom",
            "dojo/parser",
            "dijit/Menu",
            "dijit/MenuItem", 
            "dijit/registry",
            "dijit/WidgetSet", // for registry.byClass
            "dojo/domReady!"
        ], function(dom, parser, Menu, MenuItem, registry){
			// a menu item selection handler
			var onItemSelect = function(event){
				dom.byId("lastSelected").innerHTML = this.get("label");
			};

			// create equivalent programmatic example
			var menu = new Menu({}, "progMenu");

			menu.addChild(new MenuItem({
				id: "p_edit",
				label: "Edit",
				iconClass: "dijitIconEdit"
			}) );

			menu.addChild(new MenuItem({
				id: "p_view",
				label: "View",
				iconClass: "dijitIconApplication"
			}) );

			menu.addChild(new MenuItem({
				id: "p_task",
				label: "Task",
				iconClass: "dijitIconTask"
			}) );

			menu.startup();
			parser.parse();

			registry.byClass("dijit.MenuItem").forEach(function(item){
				item.on("click", onItemSelect);
			});
		});
	</script>
</body>
</html>
