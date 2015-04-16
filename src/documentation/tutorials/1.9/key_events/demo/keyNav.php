<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html>
	<head>
<?php Utils::printLinkStyleTags(array("dojo/resources/dojo.css", "dijit/themes/claro/claro.css")) ?>
		<style type="text/css">
			table {
				width: 20em;
				margin: 3em 0 0 3em;
			}
			table, td {
				border: 1px solid gray;
			}
			td {
				padding: 0.5em;
			}
			td:focus {
				background-color: yellow;
			}
		</style>
	</head>

	<body class="claro">
		<p><h1>Click on a cell below, then try navigating:</h1>
			<ul>
				<li>up, down, left, right</li>
				<li>home, end</li>
				<li>Letters - "a" for "apple", "b" for "banana", etc</li>
			</ul>
		</p>
		<table data-dojo-type="MyGrid" id="grid">
			<tr>
				<td data-dojo-type="MyCell">apple</td>
				<td data-dojo-type="MyCell">banana</td>
				<td data-dojo-type="MyCell">orange</td>
			</tr>
			<tr>
				<td data-dojo-type="MyCell">pear</td>
				<td data-dojo-type="MyCell">grapes</td>
				<td data-dojo-type="MyCell">strawberry</td>
			</tr>
		</table>

		<?php Utils::printDojoScript("parseOnLoad: false") ?>
		<script>
		require([
			"dojo/_base/declare",
			"dojo/_base/array",
			"dojo/_base/lang",
			"dojo/on",
			"dojo/parser",
			"dojo/query",
			"dijit/registry",
			"dijit/_WidgetBase",
			"dijit/_KeyNavMixin",
			"dojo/domReady!"
		], function(declare, arrayUtil, lang, on, parser, query, registry, _WidgetBase, _KeyNavMixin){
			MyGrid = declare([_WidgetBase, _KeyNavMixin], {
				buildRendering: function(){
					// This is a behavioral widget so we'll just use the existing DOM.
					// Alternately we could have a template.
					this.inherited(arguments);

					// Set containerNode.   Usually this is set in the template.
					this.containerNode = this.domNode;
				},

				postCreate: function(){
					// Don't forget the this.inherited() call
					this.inherited(arguments);

					// Set tabIndex on the container <table> node, since by default it's not tab navigable
					this.domNode.setAttribute("tabIndex", "0");
				},

				// Specifies which DOMNode children can be focused
				childSelector: "td",

				_focusedChildIndex: function(children){
					// summary:
					//      Helper method to return the index of the currently focused child in the array
					return arrayUtil.indexOf(children, this.focusedChild);
				},

				// Home/End key support
				_getFirst: function(){
					return this.getChildren()[0];
				},
				_getLast: function(){
					var children = this.getChildren();
					return children[children.length - 1];
				},

				// Simple arrow key support.   Up/down logic assumes that evey row has the same number of cells.
				_onLeftArrow: function(){
					var children = this.getChildren();
					this.focusChild(children[(this._focusedChildIndex(children) - 1 + children.length) % children.length]);
				},
				_onRightArrow: function(){
					var children = this.getChildren();
					this.focusChild(children[(this._focusedChildIndex(children) + 1) % children.length]);
				},
				_numCols: function(){
					// summary:
					//      Helper method to return the number of columns in the table
					return query("tr:first-child > td", this.domNode).length;
				},
				_onDownArrow: function(){
					var children = this.getChildren();
					this.focusChild(children[(this._focusedChildIndex(children) + this._numCols()) % children.length]);
				},
				_onUpArrow: function(){
					var children = this.getChildren();
					this.focusChild(children[(this._focusedChildIndex(children) - this._numCols() + children.length) % children.length]);
				},

				// Letter key navigation support
				_getNext: function(child){
					var children = this.getChildren();
					return children[(arrayUtil.indexOf(children, child) + 1) % children.length];
				}
			});

			MyCell = declare(_WidgetBase, {
				postCreate: function(){
					this.domNode.setAttribute("tabIndex", "-1");
				},
				focus: function(){
					this.domNode.focus();
				}
			});

			parser.parse();
		});
		</script>
	</body>
</html>