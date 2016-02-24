/*
	@ Harris Christiansen (Harris@HarrisChristiansen.com)
	2016-02-20
	For: Purdue Hackers - Battleship
	Battleship: Manage Tournament Client
*/

var GAME_SERVER = "ws://127.0.0.1:23346";

var ws = null;

$(document).ready(function() {
	if ("WebSocket" in window) {
		ws = new WebSocket(GAME_SERVER);
		window.setInterval(updatePairs, 3000);
		
		ws.onopen = function() {
			console.log("Connected");
		};
		
		ws.onmessage = function (evt) { 
			var received_msg = evt.data;
			var msg_pieces = received_msg.split("|");
			
			if(msg_pieces[0] == "P") {
				updatePairsFromData(msg_pieces[1]);
			} else {
				console.log("Received: "+received_msg);
			}
		};
		
		ws.onclose = function() { 
			console.log("Disconnected");
			ws = null;
		};
	} else { // WebSocket not supported
		alert("WebSocket NOT supported by your Browser!");
	}
});
		
function sendMsgToServer(msg) {
	if(ws != null) {
		ws.send(msg);
	}
}

function updatePairs() {
	sendMsgToServer("listPairs");
}

function updatePairsFromData(data) {
	var pairs = JSON.parse(data);
	$("#pairsList").html("");
	for(var i=0; i<pairs.length; i++) {
		$("#pairsList").append('<tr><td>'+pairs[i][0]+'</td><td>'+pairs[i][1]+'</td></tr>');
	}
	if(pairs.length==0) {
		$("#pairsList").append('<tr><td>-</td><td>-</td></tr>');
	}
}

function setTournamentMode(selectedMode) {
	if(selectedMode == "N") { // Normal Mode
		setMasterDelay("0.2");
		sendMsgToServer("mode 0");
	} else if(selectedMode == "R") { // Random Mode
		setMasterDelay("0.002");
		sendMsgToServer("mode 1");
		sendMsgToServer("reset"); // End all current games
	} else if(selectedMode == "T") { // Tournament Mode
		setMasterDelay("1.0");
		sendMsgToServer("mode 2");
		sendMsgToServer("reset"); // End all current games
	}
}

function setMasterDelay(selectedDelay) {
	sendMsgToServer("masterDelay "+selectedDelay);
}

function setPair() { // Pair two players by abbreviation
	players = $("#makePair").val();
	console.log(players);
	if(players == null || players.length != 2) {
		$("#pairError").text("Please select only 2 teams");
	} else {
		$("#pairError").text("");
	}
	sendMsgToServer("pair "+players[0]+" "+players[1]);
	updatePairs();
}

function resetAll() { // Reset/Delete all Game History
	sendMsgToServer("reset"); // End all current games
	$.get("/api/reset");
}