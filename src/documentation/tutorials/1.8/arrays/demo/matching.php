<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Array Matching</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Demo: Array Matching</h1>

		<p>The following are results from running <code>every</code> and <code>some</code> on the lists represented. A result of <code>true</code> is represented by the function name being highlighted.</p>
		<br />

		<h3 class="condition">Condition:</h3>
		<pre>
function(item){ return item == 1; }
		</pre>
		<h3>Array:</h3>
		<ul id="list1">
			<li>1</li>
			<li>2</li>
			<li>3</li>
			<li>4</li>
			<li>5</li>
		</ul>
		<h3>Results:</h3>
		<p><span id="every1">every</span> <span id="some1">some</span></p>
		<br/>

		<h3 class="condition">Condition:</h3>
		<pre>
function(item){ return item == 1; }
		</pre>
		<h3>Array:</h3>
		<ul id="list2">
			<li>1</li>
			<li>1</li>
			<li>1</li>
			<li>1</li>
			<li>1</li>
		</ul>
		<h3>Results:</h3>
		<p><span id="every2">every</span> <span id="some2">some</span></p>
		<br/>

		<h3 class="condition">Condition:</h3>
		<pre>
function(item){ return item == 2; }
		</pre>
		<h3>Array:</h3>
		<ul id="list3">
			<li>1</li>
			<li>1</li>
			<li>1</li>
			<li>1</li>
			<li>1</li>
		</ul>
		<h3>Results:</h3>
		<p><span id="every3">every</span> <span id="some3">some</span></p>
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			
			require(["dojo/_base/array", "dojo/dom-class", "dojo/domReady!"], function(arrayUtil, domClass) {
				
				var arr1 = [1,2,3,4,5],
					arr2 = [1,1,1,1,1],
					every1res = arrayUtil.every(arr1, function(item){ return item == 1; }),
					every2res = arrayUtil.every(arr2, function(item){ return item == 1; }),
					every3res = arrayUtil.every(arr2, function(item){ return item == 2; }),
					some1res = arrayUtil.some(arr1, function(item){ return item == 1; }),
					some2res = arrayUtil.some(arr2, function(item){ return item == 1; }),
					some3res = arrayUtil.some(arr2, function(item){ return item == 2; });

				domClass.toggle("every1", "highlight", every1res);
				domClass.toggle("every2", "highlight", every2res);
				domClass.toggle("every3", "highlight", every3res);
				domClass.toggle("some1", "highlight", some1res);
				domClass.toggle("some2", "highlight", some2res);
				domClass.toggle("some3", "highlight", some3res);
			});
		</script>
	</body>
</html>
