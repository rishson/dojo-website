<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Form Traversal</title>

		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<style>
			input {
				display: block;
			}

			#console {
				margin-top: 2em;
				border-top: 1px solid #333;
			}
			
			#console div {
				background: #eee; 
				padding:5px 10px;
				margin-top: 2px;
			}
		</style>

	</head>
	<body>
		<h1>Press Up/Down Arrow Or Enter Keys to traverse form.</h1>
		<h2>Home/End will go to the beginning or end.</h2>
		<form id="traverseForm">
			First Name: <input type="text" id="firstName">
			Last Name: <input type="text" id="lastName">
			Email Address: <input type="text" id="email">
			Phone Number: <input type="text" id="phone">
			<input type="submit" id="send" value="send">
		</form>
		<?php Utils::printDojoScript("async: true") ?>
		<script>
			require(["dojo/dom", "dojo/dom-construct", "dojo/on", "dojo/query", "dojo/keys", "dojo/NodeList-traverse", "dojo/domReady!"],
			function(dom, domConstruct, on, query, keys) {
				var inputs = query("input");

				function log(msg){
					var c = document.getElementById("console");
					if(!c){
						c = domConstruct.create("div", {
							id: "console"
						}, document.body);
					}
					c.innerHTML += "<div>" + msg + "</div>";
				}

				on(dom.byId("traverseForm"), "keydown", function(event) {
					var node = query.NodeList([event.target]);
					var nextNode;

					//on listens for the keydown events inside of the div node, on all form elements
					switch(event.keyCode) {
						case keys.UP_ARROW:
							nextNode = node.prev("input");
							if(nextNode[0]){
								//if not first element
								nextNode[0].focus();
								//moving the focus from the current element to the previous
							}
						break;
						case keys.DOWN_ARROW:
							nextNode = node.next("input");
							if(nextNode[0]){
								//if not last element
								nextNode[0].focus();
								//moving the focus from the current element to the next
							}
							break;
						case keys.HOME:
							inputs[0].focus();
							break;
						case keys.END:
							inputs[inputs.length - 2].focus();
							break;
						case keys.ENTER:
							event.preventDefault();
							//prevent default keeps the form from submitting when the enter button is pressed
							//on the submit button
							if(event.target.type !== "submit"){
								nextNode = node.next("input");
								if(nextNode[0]){
									//if not last element
									nextNode[0].focus();
									//moving the focus from the current element to the next
								}
							}else {
								// submit the form
								log("form submitted!");
							}
							break;
						default:
							log("some other key: " + event.keyCode);
					}
				});
			});
		</script>
</body>
</html>
