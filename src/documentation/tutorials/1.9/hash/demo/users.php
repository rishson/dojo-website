<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="style.css">
		<?php Utils::printLinkStyleTags(array("dojo/resources/dojo.css", "dijit/themes/claro/claro.css")) ?>
		<?php Utils::printClaroGridCss("") ?>
		<style>
			table thead tr th {
				background-color: #ff3;
			}
		</style>
	</head>
	<body class="claro">
		<h3>User Information</h3>
		<br>
		<div id="grid"></div>
		<br>
		<h3>Change User</h3>
		<select id="users"></select>
		<br><br>
		<a href="./router.php">Back to user select</a>
		<br>
		<textarea id="loadTimeTextBox" style="width: 26em; height: 7em; margin-top: 5em;"></textarea>

		<?php Utils::printDojoScript("") ?>
		<script>
			require(["dojo/request", "dojo/router", "dojo/store/Memory", "dojox/grid/DataGrid", "dojo/data/ObjectStore", "dojo/_base/array", "dijit/form/Select", "dojo/hash"], function (request, router, Memory, DataGrid, ObjectStore, arrayUtil, Select, hash) {
				var store = new Memory(), userSelect, grid;
				
				// AJAX to our user JSON information
				request("./users.json", {
					handleAs: "json"
				}).then(function (data) {
					
					// change the id to be a string value
					// is this necessary?  it seems like the userSelect.set("value", 2) wouldn't work
					// without this being a string
					arrayUtil.forEach(data, function (user) {
						user.id = "" + user.id;
					});
					
					// Set the store data to the users
					store.setData(data);
					
					// Create the select
					userSelect = new Select({
						store: new ObjectStore({ objectStore: store, labelProperty: "fullName" })
					}, "users");
					
					// On user change, we should go to the new hash
					userSelect.on("change", function () {
						var id = hash().replace(/[^\d]/gi, ""),
							selected = this.get("value");
						
						// If it we're already looking at the selected user, exit
						// Otherwise, this will infinitely loop page loads
						if (id == selected) {
							return false;
						}
						
						// Go to the user
						router.go("/user/" + selected);
					});
					
					userSelect.startup();
					
					
					// Create the DataGrid
					grid = new DataGrid({
						autoHeight: true,
						autoWidth: true,
						structure: [{
							name: "First Name",
							field: "firstName",
							width: "200px"
						}, {
							name: "Last Name",
							field: "lastName",
							width: "200px"
						}, {
							name: "Email Address",
							field: "email",
							width: "200px"
						}],
						canSort: function () {
							return false;
						},
						selectionMode: "none"
					}, "grid");
					
					grid.startup();
					
					// Register the hash change for user select
					// Here `:id` will map to params.id on the event
					router.register("/user/:id", function (e) {
						var user = store.get(e.params.id),
						
							// Is there a better way to do this?
							userStore = new ObjectStore({ objectStore: new Memory({data: [user]}) });
						
						grid.setStore(userStore);
							
						// Change the value of the select to match the curently selected user
						userSelect.set("value", user.id);
					});
					
					router.startup();
				});
			});
		</script>

		<script>
			document.getElementById("loadTimeTextBox").value = "Page loaded at " + new Date() +
				"\nNotice that this doesn't change as you click links - content is being loaded dynamically without reloading the page";
		</script>
	</body>
</html>
