Purdue Hackers Battleship

========== Description ==========

Welcome to Battleship!

To get started, set your API_KEY in your chosen starter code.

There are two methods for you to fill in/edit:
	placeShips(opponentID): Called everytime a new match starts. Note: Save your opponentID if you plan on using it to make moves.
		placeDestroyer(A,B): Place your Destroyer (Length 2) from point A to point B
		placeSubmarine(A,B): Place your Submarine (Length 3) from point A to point B
		placeCruiser(A,B): Place your Cruiser (Length 3) from point A to point B
		placeBattleship(A,B): Place your Battleship (Length 4) from point A to point B
		placeCarrier(A,B): Place your Carrier (Length 5) from point A to point B
	makeMove(): Called everytime it is your turn to make a move.
		placeMove(A): Places your move at point A, and returns a string "Hit", "Sunk", or "Miss"

============ Usage ============

To run your program:
	Python: execute `python Battleship.py`
	Java: execute `javac Battleship.java` and `java Battleship`

To kill your program: Type control-c

If your forget to kill your program: Use the "Kill" button on the game viewer

============ Credits ============

©2016 Purdue Hackers and Harris Christiansen - All Rights Reserved

The Battleship Client, Server, Admin Controls, and Game Viewer were developed by: Harris Christiansen (Harris@purduecs.com)

Design by: Ben Alderfer

API by: Nicky Semenza

Client ported to Java by: Guocheng Wei