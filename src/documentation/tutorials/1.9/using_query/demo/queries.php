<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tutorial: Queries</title>

		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	</head>
	<body>
		<h1>Tutorial: Queries</h1>

		<p>Click the buttons below to see which nodes are selected by the corresponding queries.</p>

		<button class="queryButton">#list</button>
		<button class="queryButton">.odd</button>
		<button class="queryButton">#list .odd</button>
		<button class="queryButton">a.odd</button>
		<button class="queryButton">li a</button>
		<button class="queryButton">li &gt; a</button>
		<button class="queryButton">.italic &gt; a</button>

		<div class="add-borders">
			<ul id="list">
				<li class="odd">
					<div class="bold">
						<a class="odd">Odd</a>
					</div>
				</li>
				<li class="even">
					<div class="italic">
						<a class="even">Even</a>
					</div>
				</li>
				<li class="odd">
					<a class="odd">Odd</a>
				</li>
				<li class="even">
					<div class="bold">
						<a class="even">Even</a>
					</div>
				</li>
				<li class="odd">
					<div class="italic">
						<a class="odd">Odd</a>
					</div>
				</li>
				<li class="even">
					<a class="even">Even</a>
				</li>
			</ul>

			<ul id="list2">
				<li class="odd">Odd</li>
			</ul>
		</div>

		<p>These lists are rendered from the following markup:</p>
<pre class="brush: html;">&lt;ul id="list"&gt;
	&lt;li class="odd"&gt;
		&lt;div class="bold"&gt;
			&lt;a class="odd"&gt;Odd&lt;/a&gt;
		&lt;/div&gt;
	&lt;/li&gt;
	&lt;li class="even"&gt;
		&lt;div class="italic"&gt;
			&lt;a class="even"&gt;Even&lt;/a&gt;
		&lt;/div&gt;
	&lt;/li&gt;
	&lt;li class="odd"&gt;
		&lt;a class="odd"&gt;Odd&lt;/a&gt;
	&lt;/li&gt;
	&lt;li class="even"&gt;
		&lt;div class="bold"&gt;
			&lt;a class="even"&gt;Even&lt;/a&gt;
		&lt;/div&gt;
	&lt;/li&gt;
	&lt;li class="odd"&gt;
		&lt;div class="italic"&gt;
			&lt;a class="odd"&gt;Odd&lt;/a&gt;
		&lt;/div&gt;
	&lt;/li&gt;
	&lt;li class="even"&gt;
		&lt;a class="even"&gt;Even&lt;/a&gt;
	&lt;/li&gt;
&lt;/ul&gt;

&lt;ul id="list2"&gt;
	&lt;li class="odd"&gt;Odd&lt;/li&gt;
&lt;/ul&gt;</pre>


		<?php Utils::printDojoScript("async: true") ?>
		<script>
			require(["dojo/query", "dojo/NodeList-dom", "dojo/domReady!"], function(query) {
				function executeSelector(button){
					// Find and remove all highlight classes
					query(".highlight").removeClass("highlight");
					// Add the highlight class based on the selector inside of our button
					query(button.innerHTML.replace("&gt;", ">")).addClass("highlight");
				}

				query(".queryButton").on("click", function(e) {
					executeSelector(e.target);
				});
			});
		</script>
	</body>
</html>
