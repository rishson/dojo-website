<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Chaining Promises</title>

		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">


	</head>
	<body>
		<h1>Demo: Chaining Promises</h1>

		<h2>Result from chaining from original deferred</h2>
		<ul id="userlist1"></ul>

		<h2>Result from chaining from resulting promise</h2>
		<ul id="userlist2"></ul>

		<h2>Result from chaining from original deferred after previous calls</h2>
		<ul id="userlist3"></ul>
		<?php Utils::printDojoScript("async: true") ?>
		<script>
			require([
				"dojo/_base/xhr",
				"dojo/_base/array",
				"dojo/dom",
				"dojo/dom-construct",
				"dojo/json",
				"dojo/domReady!"
			], function(xhr, arrayUtil, dom, domConstruct, JSON){
				var original = xhr.get({
					url: "users-mangled.json",
					handleAs: "json"
				});

				var result = original.then(function(response){
					var userlist = dom.byId("userlist1");

					return arrayUtil.map(response, function(user){
						domConstruct.create("li", {
							innerHTML: JSON.stringify(user)
						}, userlist);

						return {
							id: user[0],
							username: user[1],
							name: user[2]
						};
					});
				});

				result.then(function(objs){
					var userlist = dom.byId("userlist2");

					arrayUtil.forEach(objs, function(user){
						domConstruct.create("li", {
							innerHTML: JSON.stringify(user)
						}, userlist);
					});
				});

				original.then(function(res){
					var userlist = dom.byId("userlist3");

					arrayUtil.forEach(res, function(user){
						domConstruct.create("li", {
							innerHTML: JSON.stringify(user)
						}, userlist);
					});
				});
			});
		</script>
	</body>
</html>
