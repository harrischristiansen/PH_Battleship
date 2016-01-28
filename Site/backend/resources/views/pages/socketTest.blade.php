<!DOCTYPE HTML>
<html><head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<title>Battleship - Socket Test</title>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript">
		
		var ws = null;
		
		$(document).ready(function() {
			if ("WebSocket" in window) {
				ws = new WebSocket("ws://echo.websocket.org");
				
				ws.onopen = function() {
					console.log("Connected");
				};
				
				ws.onmessage = function (evt) { 
					var received_msg = evt.data;
					console.log("Received: "+received_msg);
				};
				
				ws.onclose = function() { 
					console.log("Disconnected");
				};
			}
	        
			else { // WebSocket not supported
				alert("WebSocket NOT supported by your Browser!");
			}
		});
		
		function sendMsg() {
			ws.send("The Message");
		}
		
	</script>
</head><body>
	
<button onclick="sendMsg()">Send</button>
	
</body></html>