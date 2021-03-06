<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Array Manipulation</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Demo: Array Manipulation</h1>

		<p>The following list is a representation of an array.</p>
		<ul id="list1">
			<li>one</li>
			<li>two</li>
			<li>three</li>
			<li>four</li>
			<li>five</li>
		</ul>

		<br/>
		<p>The next list is a representation of the previous array being transformed by the following code:</p>
		<pre class="brush:js">
arrayUtil.map(original, function(item, index){
	return {
		id: index * 100,
		text: item
	};
});
		</pre>
		
		<ul id="list2"></ul>

		<br/>
		<p>The final list is a representation of the mapped array being filtered by the following code:</p>
		<pre class="brush:js">
arrayUtil.filter(mapped, function(item, index){
	return item.id &gt; 50 &amp;&amp; item.id &lt; 350;
});
		</pre>
		<ul id="list3"></ul>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			
			require(["dojo/_base/array", "dojo/json", "dojo/dom-construct", "dojo/dom", "dojo/domReady!"]
			, function(arrayUtil, JSON, domConstruct, dom) {
				var original = ["one", "two", "three", "four", "five"],
					list2 = dom.byId("list2"),
					list3 = dom.byId("list3"),
					mapped, filtered;

				mapped = arrayUtil.map(original, function(item, index){
					return {
						id: index * 100,
						text: item
					};
				}); // [ { id: 0, text: "one" }, { id: 100, text: "two" }, ... ]

				filtered = arrayUtil.filter(mapped, function(item, index){
					return item.id > 50 && item.id < 350;
				}); // [ { id: 100, text: "two" }, { id: 200, text: "three" },
					//   { id: 300, text: "four" } ]

				arrayUtil.forEach(mapped, function(item){
					domConstruct.create("li", {
						innerHTML: "<code>" + JSON.stringify(item) + "</code>"
					}, list2);
				});

				arrayUtil.forEach(filtered, function(item){
					domConstruct.create("li", {
						innerHTML: "<code>" + JSON.stringify(item) + "</code>"
					}, list3);
				});
			});
			
		</script>
	</body>
</html>
