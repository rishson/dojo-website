<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Deferred.when</title>

		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">


	</head>
	<body>
		<h1>Demo: Deferred.when</h1>

		<ul id="userlist1"></ul>
		<ul id="userlist2"></ul>
		<?php Utils::printDojoScript("async: true") ?>
		<script>
			require([
				"dojo/_base/Deferred",
				"dojo/_base/xhr",
				"dojo/_base/array",
				"dojo/dom",
				"dojo/dom-construct",
				"dojo/json",
				"dojo/domReady"
			], function(Deferred, xhr, arrayUtil, dom, domConstruct, JSON, domReady){
				var getUserList = (function(){
					var users;
					return function(){
						if(!users){
							return xhr.get({
								url: "users-mangled.json",
								handleAs: "json"
							}).then(function(response){
								// Save the resulting array into the users variable
								users = arrayUtil.map(response, function(user){
									return {
										id: user[0],
										username: user[1],
										name: user[2]
									};
								});

								// Make sure to return users here,
								// for valid chaining
								return users;
							});
						}
						return users;
					};
				})();

				domReady(function(){
					Deferred.when(getUserList(), function(users){
						// This callback will be run after the request completes

						var userlist = dom.byId("userlist1");
						arrayUtil.forEach(users, function(user){
							domConstruct.create("li", {
								innerHTML: JSON.stringify(user)
							}, userlist);
						});

						Deferred.when(getUserList(), function(user){
							// This callback will be run right away since it's already in the cache

							var userlist = dom.byId("userlist2");
							arrayUtil.forEach(users, function(user){
								domConstruct.create("li", {
									innerHTML: JSON.stringify(user)
								}, userlist);
							});
						});
					});
				});
			});
		</script>
	</body>
</html>
