'''
	@ Harris Christiansen (Harris@HarrisChristiansen.com)
	2016-01-24
	For: Purdue Hackers - Battleship
	Python Server
'''

import socket
import time
from thread import start_new_thread
import threading
import random

port = 23345

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.bind(('', port))
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1) # Make Address Reusable - No Lockout
s.listen(20)

games = []

class BattleshipGame(threading.Thread):
	def __init__(self,p1,p2):
		super(self.__class__, self).__init__()
		self.p1 = p1
		self.p2 = p2
		self.p1Ships = [[0 for x in range(8)] for x in range(8)] 
		self.p2Ships = [[0 for x in range(8)] for x in range(8)] 
		self.p1Ready = 0
		self.p2Ready = 0
		self.playersConnected = True
		self.gamePlaying = True

	def sendMsg(self,msg):
		self.p1.sendall(msg+"\n")
		self.p2.sendall(msg+"\n")

	def sendMsgP(self,p,msg):
		p.sendall(msg+"\n")

	def setReady(self,p):
		if(p is self.p1):
			self.p1Ready = 1
		else:
			self.p2Ready = 1

	def setFail(self,p):
		if(p is self.p1):
			self.p1Ready = -1
		else:
			self.p2Ready = -1

	def getCord(self,p):
		data = p.recv(1024)
		if not data: # Client Closed Connection
			if(p is self.p1):
				self.p1Ready = -1
			else:
				self.p2Ready = -1
			self.gamePlaying = False
			self.playersConnected = False

			return False
		try:
			c = ord(data[0])-65
			r = int(data[1])

			if(c<0 or c>=8 or r<0 or r>=8):
				self.sendMsgP(p,"Invalid Input - Out Of Bounds")
				self.setFail(p)
				self.gamePlaying = False
				self.playersConnected = False
				return False

			return (c,r)
		except ValueError:
			self.sendMsgP(p,"Invalid Input - Parse Integer")
			self.setFail(p)
			self.gamePlaying = False
			self.playersConnected = False
			return False

	def placeShip(self,p,c1,c2,ship):
		if(c1[0]==c2[0]):
			for i in range(c1[1],c2[1]+1):
				if(p is self.p1):
					self.p1Ships[c1[0]][i] = ship
				else:
					self.p2Ships[c1[0]][i] = ship
		else:
			for i in range(c1[0],c2[0]+1):
				if(p is self.p1):
					self.p1Ships[i][c1[1]] = ship
				else:
					self.p2Ships[i][c1[1]] = ship

	def placeShips(self,p):
		#ships = [("Destoryer",2),("Submarine",3),("Cruiser",3),("Battleship",4),("Carrier",5)]
		ships = [("Destoryer",2)]

		for ship in ships:
			self.sendMsgP(p,ship[0]+"("+(str)(ship[1])+"):")
			c1 = self.getCord(p)
			c2 = self.getCord(p)

			if(c1 != False and c2 != False and (c1[0]==c2[0] or c1[1]==c2[1]) and (abs(c1[0]+c2[0])+abs(c1[1]+c2[1])+1)==ship[1]):
				self.placeShip(p,c1,c2,ships.index(ship)+1)
			else:
				self.sendMsgP(p,"Invalid Input - Ship Cords")
				self.setFail(p)
				self.gamePlaying = False
				self.playersConnected = False
				return False

		self.setReady(p)
		return True

	def placeMove(self,p):
		self.sendMsgP(p,"Enter Coordinates")
		c1 = self.getCord(p)
		if(p is self.p1):
			hit = self.p2Ships[c1[0]][c1[1]]
			if(hit > 0):
				self.p2Ships[c1[0]][c1[1]] = 0 - hit
				if any(hit in sublist for sublist in self.p2Ships):
					self.sendMsgP(p,"Hit")
				else:
					self.sendMsgP(p,"Sunk")
			else:
				self.sendMsgP(p,"Miss")
			
		else:
			hit = self.p1Ships[c1[0]][c1[1]]
			if(hit > 0):
				self.p1Ships[c1[0]][c1[1]] = 0 - hit
				if any(hit in sublist for sublist in self.p1Ships):
					self.sendMsgP(p,"Hit")
				else:
					self.sendMsgP(p,"Sunk")
			else:
				self.sendMsgP(p,"Miss")

		self.setReady(p)
		return True

	def run(self):
		global games
		games.append(self)

		while self.playersConnected:
			self.sendMsg("Welcome To Battleship! Place your ships!")
			self.p1Ready=self.p2Ready=0
			self.gamePlaying = True
			start_new_thread(self.placeShips, (self.p1,))
			start_new_thread(self.placeShips, (self.p2,))

			while(self.p1Ready==0 or self.p2Ready==0):
				continue

			if(self.p1Ready==-1 or self.p1Ready==-1):
				break

			while self.gamePlaying:
				self.p1Ready=self.p2Ready=0
				start_new_thread(self.placeMove, (self.p1,))
				start_new_thread(self.placeMove, (self.p2,))

				while(self.p1Ready==0 or self.p2Ready==0):
					continue

				if(self.p1Ready==-1 or self.p1Ready==-1):
					break


		games.remove(self)
		self.sendMsg("Closed")
		self.p1.close()
		self.p2.close()

while True:
	# blocking call, waits to accept a connection
	p1, addr = s.accept()
	print "Client Connected: " + addr[0] + ":" + str(addr[1])

	p2, addr = s.accept()
	print "Client Connected: " + addr[0] + ":" + str(addr[1])

	thread = BattleshipGame(p1,p2)
	thread.setDaemon(True) # Set as background thread
	thread.start()

s.close()