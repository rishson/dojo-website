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
	<style>
		.tasks {
			width: 23em;
			list-style-type: none;
			margin: 0;
			padding: 0;
		}
		
		.task {
			margin: 2px;
			padding: 6px;
			border: 1px solid #ccc;
		}
		
		.tasks .selected {
			border-color: #000;
		}
		
		.task:hover {
			border-color: #99f;
		}
		
		.begin {
			background-color: #cfc;
		}
		.complete {
			background-color: #393;
			color: #fff;
		}
		.cancel {
			background-color: #fcc;
		}
	</style>
</head>
<body class="claro">
	<h3>Menu Demo</h3>
	<h4>Tasks</h4>
	<ul id="taskList" class="tasks">
		<li id="task_0" class="task">Code review</li>
		<li id="task_1" class="task">Build tests</li>
		<li id="task_2" class="task">Prototype UI</li>
	</ul>

	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printDojoScript("isDebug:1, async:1");
	?>
	<script>
        require([
            "dijit/Menu",
            "dijit/MenuItem", 
            "dijit/PopupMenuItem", 
            "dijit/registry",
            "dojo/query",
            "dojo/mouse",
            "dojo/on",
            "dojo/dom-class",
            "dojo/_base/lang",
            "dojo/ready"
        ], function(Menu, MenuItem, PopupMenuItem, registry, query, mouse, on, domClass, lang, ready){

        	ready(function(){

				var demo = {
					taskNodes: null, // used to store task DOM nodes for reuse later

					hoveredTaskNode: null, // last task node hovered (for onTaskItemClick)

					currentTaskNode: null, // currently "selected" task

					classStates: ["begin", "cancel", "complete"], // state classes for tasks

					// handler for clicks on task context menu items
					onTaskItemClick: function(evt){
						// retrieve the widget representing the item clicked
						var item = registry.getEnclosingWidget(evt.target);
						// pass the info we have along to update state
						this.setTaskState(item.id);
					},

					setTaskState: function(state){
						// remove any previous state classes and apply new one
						if(this.hoveredTaskNode){
							domClass.remove(this.hoveredTaskNode, this.classStates);
							domClass.add(this.hoveredTaskNode, state);
						}
					},

					// called when one of the task nodes is clicked
					updateCurrentTask: function(node){
						if (this.currentTaskNode){
							// remove selected class from previously-selected task node
							domClass.remove(this.currentTaskNode, "selected");
						}
						// add selected class to newly-selected task node
						domClass.add(node, "selected");
						// now that a task is selected, we can enable our task sub-menu
						registry.byId("task").set("disabled", false);
						// update currentTaskNode for future use
						this.currentTaskNode = node;
					},

					// called when one of the task nodes is hovered over
					updateHoveredTask: function(node){
						this.hoveredTaskNode = node;
					}
				}

				// query task nodes, saving NodeList for future use
				demo.taskNodes = query(".task");

				demo.taskNodes.on("click", function(evt){
					demo.updateCurrentTask(evt.target);
				});

				// WebKit doesn't support native mouseenter event, so use emulated version
				demo.taskNodes.on(mouse.enter, function(evt){
					demo.updateHoveredTask(evt.target);
				});

				// create main menu as general context menu for entire document
				var mainMenu = new Menu({
					id: "mainMenu",
					contextMenuForWindow: true
				});

				// create task menu as context menu for task nodes.
				var taskMenu = new Menu({
					id: "taskMenu",
					targetNodeIds: ["taskList"],
					selector: ".task"
				});

				// define the task menu items
				taskMenu.addChild( new MenuItem({
					id: "begin",
					label: "Begin",
					onClick: lang.hitch(demo, "onTaskItemClick")
				}) );

				taskMenu.addChild( new MenuItem({
					id: "complete",
					label: "Mark as Complete",
					onClick: lang.hitch(demo, "onTaskItemClick")
				}) );

				taskMenu.addChild( new MenuItem({
					id: "cancel",
					label: "Cancel",
					onClick: lang.hitch(demo, "onTaskItemClick")
				}) );

				// create main menu items
				mainMenu.addChild( new MenuItem({
					id: "about",
					label: "About"
				}) );

				// To demonstrate dynamically disabling/enabling an item,
				// this item is initially disabled until we select a task.
				mainMenu.addChild( new PopupMenuItem({
					id: "task",
					label: "Task",
					disabled: true,
					// notice we reuse the same Menu as the task context menu
					popup: taskMenu
				}) );

				mainMenu.startup();
				taskMenu.startup();
			});
		});
	</script>
</body>
</html>
