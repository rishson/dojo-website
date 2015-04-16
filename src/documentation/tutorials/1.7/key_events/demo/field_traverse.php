<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: dojo/keys</title>

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
		<h1>Press Up or Down Arrow Keys</h1>
		<input type="text" id="input1" value="up">
		<input type="text" id="input2" value="down">
		<input type="submit" id="send" value="send">
		<?php Utils::printDojoScript("async: true") ?>
		</script>
		<script>
			require(["dojo/dom-construct", "dojo/on", "dojo/query", "dojo/keys", "dojo/domReady!"],
			function(domConstruct, on, query, keys) {
				function log(msg){
					var c = document.getElementById("console");
					if(!c){
						c = domConstruct.create("div", {
							id: "console"
						}, document.body);
					}
					c.innerHTML += "<div>" + msg + "</div>";
				}
	
				query("input[type='text']").on("keydown", function(event) {
					//query returns a nodelist, which has an on() function available that will listen
					//to all keydown events for each node in the list
					switch(event.keyCode) {
						case keys.UP_ARROW:
							event.preventDefault();
							//preventing the default behavior in case your browser
							// uses autosuggest when you hit the down or up arrow.
							log("up arrow has been pressed");
							break;
						case keys.DOWN_ARROW:
							event.preventDefault();
							//preventing the default behavior in case your browser
							// uses autosuggest when you hit the down or up arrow.
							log("down arrow has been pressed");
							break;
						case keys.ENTER:
							log("enter has been pressed");
							break;
						default:
							log("some other key: " + event.keyCode);
					}
				});
			});
		</script>
	</body>
</html>
