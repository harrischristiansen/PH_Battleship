/*
	@ Harris Christiansen (Harris@HarrisChristiansen.com)
	2016-01-26
	For: Purdue Hackers - Battleship
	Battleship Game Viewer
*/

var API_KEY = "";

var gameServer = "ws://127.0.0.1:23346";

var ws = null

var currentGame = -1;

$(document).ready(function() {
	if ("WebSocket" in window) {
		ws = new WebSocket(gameServer);
		window.setInterval(updateGamesList, 2000);
		
		ws.onopen = function() {
			console.log("Connected");
		};
		
		ws.onmessage = function (evt) { 
			var received_msg = evt.data;
			//console.log("Received: "+received_msg);
			
			var msg_pieces = received_msg.split("|");
			
			if(msg_pieces[0] == "G") { // Receiving Games (G|JSON_games)
				updateGamesListFromData(msg_pieces[1]);
			} else if(msg_pieces[0] == "B") { // Receiving Board (B|JSON_board)
				setGameBoards(msg_pieces[1]);
			} else if(msg_pieces[0] == "M") { // Receiving Move (M|PlayerID|Letter|Number)
				updateGameBoards(msg_pieces[1],msg_pieces[2],msg_pieces[3]);
			} else if(msg_pieces[0] == "rejoin") {
				joinGame(currentGame);
			} else {
				console.log("Received Invalid Message");
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

// Function to get games from gameServer
function updateGamesList() {
	sendMsgToServer("games");
}

function updateGamesListFromData(data) {
	var games = JSON.parse(data);
	$("#gamesList").html("");
	for (var i=0; i<games.length; i++) {
		$("#gamesList").append('<li><a href="#" onclick="joinGame(\''+games[i]+'\');">'+games[i]+'</a></li>');
	}
	if(games.length==0) {
		$("#gamesList").append('<li><a href="#">No Active Games</a></li>');
	}
}

// Function onClick game -> join/load game
function joinGame(gameID) {
	currentGame = gameID
	sendMsgToServer("join "+gameID);
}
function setGameBoards(data) {
	var boards = JSON.parse(data);
	console.log("Setting Board");
}

// Function receive data from gameServer
function updateGameBoards(player,letter,number) {
	console.log("Updating Board");
}

