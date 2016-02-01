/*
	@ Harris Christiansen (Harris@HarrisChristiansen.com)
	2016-01-26
	For: Purdue Hackers - Battleship
	Battleship Game Viewer
*/

var gameServer = "ws://127.0.0.1:23346";

var ws = null;

var currentGame = -1;
var player1 = -1;
var player2 = -1;

$(document).ready(function() {
	if ("WebSocket" in window) {
		ws = new WebSocket(gameServer);
		window.setInterval(updateGamesList, 2000);
		
		ws.onopen = function() {
			console.log("Connected");
			updateGamesList();
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
				updateGameBoards(msg_pieces[1],msg_pieces[2],msg_pieces[3],msg_pieces[4]);
			} else if(msg_pieces[0] == "rejoin") {
				joinGame(currentGame);
			} else if(msg_pieces[0] == "closed") {
				currentGame = -1;
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
	for(var i=0; i<games.length; i++) {
		$("#gamesList").append('<li><a href="#" onclick="joinGame(\''+games[i]+'\');">'+games[i]+'</a></li>');
	}
	
	if(games.length==0) {
		$("#gamesList").append('<li><a href="#">No Active Games</a></li>');
	} else { // At least 1 game exists, join
		if(currentGame == -1) {
			joinGame(games[0]);
		}
	}
}

// Function onClick game -> join/load game
function joinGame(gameID) {
	currentGame = gameID
	sendMsgToServer("join "+gameID);
}
function setGameBoards(data) {
	var boards = JSON.parse(data);
	$(".gameID").text(currentGame);
	player1 = boards[0]; $(".player1ID").text(player1.split("-")[0]);
	player2 = boards[2]; $(".player2ID").text(player2.split("-")[0]);
	
	for(var x=0; x<boards[1].length; x++) {
		for(var y=0; y<boards[1][x].length; y++) {
			$("#player1 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").text(boards[1][x][y]);
		}
	}
	
	for(var x=0; x<boards[3].length; x++) {
		for(var y=0; y<boards[3][x].length; y++) {
			$("#player2 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").text(boards[3][x][y]);
		}
	}
	
	console.log("Setting Board");
}

// Function receive data from gameServer
function updateGameBoards(player,letter,number,moveResult) { // moveResult will be "Hit", "Sunk", or "Miss"
	letter = parseInt(letter);
	number = parseInt(number);
	
	if(player==player1) {
		var currentNum = $("#player1 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text();
		var newNum = 0 - Math.abs(parseInt(currentNum));
		$("#player1 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text(newNum);
	} else if(player==player2) {
		var currentNum = $("#player2 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text();
		var newNum = 0 - Math.abs(parseInt(currentNum));
		$("#player2 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text(newNum);
	} else {
		joinGame(currentGame);
	}
}

