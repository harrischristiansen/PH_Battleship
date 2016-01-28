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
				ws = new WebSocket("ws://127.0.0.1:23346");
				
				ws.onopen = function() {
					console.log("Connected");
				};
				
				ws.onmessage = function (evt) { 
					var received_msg = evt.data;
					console.log("Received: "+received_msg);
				};
				
				ws.onclose = function() { 
					console.log("Disconnected");
					ws = null;
				};
			}
	        
			else { // WebSocket not supported
				alert("WebSocket NOT supported by your Browser!");
			}
		});
		
		function sendMsg(msg) {
			if(ws != null) {
				ws.send(msg);
			}
		}
		
	</script>
</head><body>
	
<button onclick="sendMsg('games')">Send</button>
	
</body></html>