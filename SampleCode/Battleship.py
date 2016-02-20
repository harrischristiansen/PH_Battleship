'''
	@ AUTHOR NAME HERE
	@ Starter Code By Harris Christiansen (Harris@purduecs.com)
	2016-01-28
	For: Purdue Hackers - Battleship
	Battleship Client
'''

import sys
import socket

API_KEY = "API_KEY_HERE" ########## PUT YOUR API KEY HERE ##########

GAME_SERVER = "127.0.0.1"

##############################  PUT YOUR CODE HERE ##############################

letters = ['A','B','C','D','E','F','G','H']
grid = [[-1 for x in range(8)] for x in range(8)] # Fill Grid With -1s

def placeShips(opponentID):
	global grid
	# Fill Grid With -1s
	grid = [[-1 for x in range(8)] for x in range(8)]

	# Place Ships
	placeDestroyer("A0","A1")
	placeSubmarine("B0","B2")
	placeCruiser("C0","C2")
	placeBattleship("D0","D3")
	placeCarrier("E0","E4")

def makeMove():
	global grid
	for x in range(0,8):
		for y in range(0,8):
			if grid[x][y] == -1:
				wasHitSunkOrMiss = placeMove(letters[x]+str(y)) # placeMove(LetterNumber) - Example: placeMove(D5)

				if(wasHitSunkOrMiss == "Hit" or wasHitSunkOrMiss == "Sunk"):
					grid[x][y] = 1
				else:
					grid[x][y] = 0

				return

############################## ^^^^^ PUT YOUR CODE ABOVE HERE ^^^^^ ##############################

def connectToServer():
	global s
	try:
		s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		s.connect((GAME_SERVER, 23345))

		s.send(API_KEY)
		data = s.recv(1024)

		if("False" in data):
			s = None
			print "Invalid API_KEY"
			sys.exit()
	except:
		s = None


destroyer=submarine=cruiser=battleship=carrier=("A0","A0")
dataPassthrough = None

def gameMain():
	global s, dataPassthrough
	while True:
		if(dataPassthrough == None):
			data = s.recv(1024)
		else:
			data = dataPassthrough
			dataPassthrough = None

		if not data:
			s.close()
			return
		
		if "Welcome" in data: # "Welcome To Battleship! You Are Playing:xxxx"
			welcomeMsg = data.split(":")
			placeShips(welcomeMsg[1])
		elif "Destroyer" in data: # Destroyer(2)
			s.send(destroyer[0])
			s.send(destroyer[1])
		elif "Submarine" in data: # Submarine(3)
			s.send(submarine[0])
			s.send(submarine[1])
		elif "Cruiser" in data: # Cruiser(3)
			s.send(cruiser[0])
			s.send(cruiser[1])
		elif "Battleship" in data: # Battleship (4)
			s.send(battleship[0])
			s.send(battleship[1])
		elif "Carrier" in data: # Carrier(3)
			s.send(carrier[0])
			s.send(carrier[1])
		elif "Enter" in data: # Enter Coordinates
			makeMove()
		elif "Error" in data: # Error: xxx
			print("Received Error: "+data)
			sys.exit()
		else:
			print("Received Unknown Response: "+data)
			sys.exit()


def placeDestroyer(startPos, endPos):
	global destroyer
	destroyer = (startPos.upper(), endPos.upper())
def placeSubmarine(startPos, endPos):
	global submarine
	submarine = (startPos.upper(), endPos.upper())
def placeCruiser(startPos, endPos):
	global cruiser
	cruiser = (startPos.upper(), endPos.upper())
def placeBattleship(startPos, endPos):
	global battleship
	battleship = (startPos.upper(), endPos.upper())
def placeCarrier(startPos, endPos):
	global carrier
	carrier = (startPos.upper(), endPos.upper())

def placeMove(pos):
	global dataPassthrough
	s.send(pos)
	data = s.recv(1024)
	if "Hit" in data:
		return "Hit"
	elif "Sunk" in data:
		return "Sunk"
	elif "Miss" in data:
		return "Miss"
	else:
		dataPassthrough = data
		return "Miss"

while True:
	connectToServer()
	if s != None:
		gameMain()
