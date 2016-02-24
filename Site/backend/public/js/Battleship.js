/*
	@ Harris Christiansen (Harris@HarrisChristiansen.com)
	2016-01-26
	For: Purdue Hackers - Battleship
	Battleship Game Viewer
*/

var GAME_SERVER = "ws://127.0.0.1:23346";

var ws = null;

var currentGame = -1;
var player1 = -1;
var player2 = -1;

$(document).ready(function() {
	if ("WebSocket" in window) {
		ws = new WebSocket(GAME_SERVER);
		window.setInterval(updateGamesList, 3000);
		window.setInterval(sendMsgToGetMessages, 200); // TODO: Fix this shitty solution to fix message receive rate
		
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
			} else if(msg_pieces[0] == "B") { // Receiving Board (B|JSON_boards)
				setGameBoards(msg_pieces[1]);
			} else if(msg_pieces[0] == "M") { // Receiving Move (M|PlayerID|Letter|Number|MoveResult)
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

// TODO: Fix this shitty solution to fix message receive rate
function sendMsgToGetMessages() {
	sendMsgToServer("hi");
}

// Request updated games list
function updateGamesList() {
	sendMsgToServer("games");
}

// Update Games List after response
function updateGamesListFromData(data) {
	var games = JSON.parse(data);
	$("#gamesList").html("");
	for(var i=0; i<games.length; i++) {
		$("#gamesList").append('<li><a href="#" onclick="joinGameFromClick(\''+games[i][0]+'\');">'+games[i][1]+' vs '+games[i][2]+'</a></li>');
	}
	
	if(games.length==0) {
		$("#gamesList").append('<li><a href="#">No Active Games</a></li>');
	} else { // At least 1 game exists, join
		if(currentGame == -1) {
			joinGame(games[0][0]);
		}
	}
}

// Function onClick Delay Picker -> Set Game Move Delay
function setDelay(selectedDelay) {
	sendMsgToServer("delay "+selectedDelay);
}

// Function onClick game -> join/load game
function joinGameFromClick(gameID) {
	joinGame(gameID);
	$('#delayPickerSelect :nth-child(1)').prop('selected', true); // Reset Move Delay Dropdown
}

function joinGame(gameID) {
	currentGame = gameID;
	sendMsgToServer("join "+gameID);
}

// Sets Game Boards in their entirety
function setGameBoards(data) { // data = [player1ID,player1Wins,player1Board,player2ID,player2Wins,player2Board]
	var boards = JSON.parse(data);
	
	$(".gameID").text(currentGame);
	player1 = boards[0]; $(".player1ID").text(player1.split("-")[0]);
	$(".player1Wins").text("Wins: " + boards[1]);
	player2 = boards[3]; $(".player2ID").text(player2.split("-")[0]);
	$(".player2Wins").text("Wins: " + boards[4]);
	
	for(var x=0; x<boards[2].length; x++) {
		for(var y=0; y<boards[2][x].length; y++) {
			$("#player1Raw tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").text(boards[2][x][y]);
			if (boards[2][x][y] == -10) {
				$("#player1 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").attr('class', 'status-miss');
			} else if (boards[2][x][y] < 0) {
				$("#player1 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").attr('class', 'status-hit');
			} else {
				$("#player1 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").attr('class', 'status-none');
			}
		}
	}
	
	for(var x=0; x<boards[5].length; x++) {
		for(var y=0; y<boards[5][x].length; y++) {
			$("#player2Raw tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").text(boards[5][x][y]);
			if (boards[5][x][y] == -10) {
				$("#player2 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").attr('class', 'status-miss');
			} else if (boards[5][x][y] < 0) {
				$("#player2 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").attr('class', 'status-hit');
			} else {
				$("#player2 tr:nth-child("+(x+1)+") td:nth-child("+(y+2)+")").attr('class', 'status-none');
			}
		}
	}
	
	console.log("Setting Board");
}

// Updates Boards After Each Move
function updateGameBoards(player,letter,number,moveResult) { // moveResult will be "Hit", "Sunk", or "Miss"
	letter = parseInt(letter);
	number = parseInt(number);
	
	if(player==player1) {
		var currentNum = $("#player1Raw tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text();
		var newNum = 0 - Math.abs(parseInt(currentNum));
		$("#player1Raw tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text(newNum);
		if(moveResult == "Hit" || moveResult == "Sunk") {
			$("#player1 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").attr('class', 'status-hit');
		} else if(moveResult == "Miss") {
			$("#player1 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").attr('class', 'status-miss');
		}
	} else if(player==player2) {
		var currentNum = $("#player2Raw tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text();
		var newNum = 0 - Math.abs(parseInt(currentNum));
		$("#player2Raw tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").text(newNum);
		if(moveResult == "Hit" || moveResult == "Sunk") {
			$("#player2 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").attr('class', 'status-hit');
		} else if(moveResult == "Miss") {
			$("#player2 tr:nth-child("+(letter+1)+") td:nth-child("+(number+2)+")").attr('class', 'status-miss');
		}
	} else {
		joinGame(currentGame);
	}
}

