/**
  * @ AUTHOR NAME HERE
  * @ Starter Code By Austin Schwartz (http://www.austinschwartz.com/)
  *
  * Created: November, 2016
  * For: Purdue Hackers - Battleship
  * Battleship Client
  */

import java.io._
import java.net.Socket
import java.net.InetAddress
import java.lang.Thread

object Battleship {
  def main(args: Array[String]) {
    while (true) {
      this.connectToServer
      if (this.socket != null)
        gameMain
    }
  }

  var API_KEY: String = "API_KEY_HERE"
  var GAME_SERVER: String = "battleshipgs.purduehackers.com"

  var letters: Array[Char] = Array[Char]('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H')
  var grid: Array[Array[Int]] = Array.ofDim[Int](8,8)

  var destroyer = Array[String]("A0", "A0")
  var submarine = Array[String]("A0", "A0")
  var cruiser = Array[String]("A0", "A0")
  var battleship = Array[String]("A0", "A0")
  var carrier = Array[String]("A0", "A0")

  def placeShips(opponentID: String) {
    var i = 0
    for (i <- 0 until 8) {
      var j = 0
      for (j <- 0 until 8) {
        grid(i)(j) = -1
      }
    }

    placeDestroyer("A0", "A1")
    placeSubmarine("B0", "B2")
    placeCruiser("C0", "C2")
    placeBattleship("D0", "D3")
    placeCarrier("E0", "E4")
  }

  def makeMove {
    var i = 0
    for (i <- 0 until 8) {
      var j = 0
      for (j <- 0 until 8) {
        if (this.grid(i)(j) == -1) {
          val wasHitSunkOrMiss: String = placeMove(this.letters(i) + String.valueOf(j))
          if (wasHitSunkOrMiss == "Hit" || wasHitSunkOrMiss == "Sunk") {
            this.grid(i)(j) = 1
          }
          else {
            this.grid(i)(j) = 0
          }
          return
        }
      }
    }
  }

  var socket: Socket = null
  var dataPassthrough: String = null
  var data: String = null
  var br: BufferedReader = null
  var out: PrintWriter = null
  var moveMade: Boolean = false

  def connectToServer {
    try {
      val addr: InetAddress = InetAddress.getByName(this.GAME_SERVER)
      socket = new Socket(addr, 23345)
      br = new BufferedReader(new InputStreamReader(socket.getInputStream))
      out = new PrintWriter(socket.getOutputStream, true)
      out.print(this.API_KEY)
      out.flush
      data = br.readLine
    }
    catch {
      case e: Exception => {
        System.out.println("Error: when connecting to the server...")
        socket = null
      }
    }
    if (data == null || data.contains("False")) {
      socket = null
      System.out.println("Invalid API_KEY")
      System.exit(1)
    }
  }

  def gameMain {
    while (true) {
      {
        try {
          if (this.dataPassthrough == null) {
            this.data = this.br.readLine
          }
          else {
            this.data = this.dataPassthrough
            this.dataPassthrough = null
          }
        }
        catch {
          case ioe: IOException => {
            System.out.println("IOException: in gameMain")
            ioe.printStackTrace
          }
        }
        if (this.data == null) {
          try {
            this.socket.close
          }
          catch {
            case e: IOException => {
              System.out.println("Socket Close Error")
            }
          }
          return
        }
        if (data.contains("Welcome")) {
          val welcomeMsg: Array[String] = this.data.split(":")
          placeShips(welcomeMsg(1))
          if (data.contains("Destroyer")) {
            this.dataPassthrough = "Destroyer(2):"
          }
        }
        else if (data.contains("Destroyer")) {
          this.out.print(destroyer(0))
          this.out.print(destroyer(1))
          out.flush
        }
        else if (data.contains("Submarine")) {
          this.out.print(submarine(0))
          this.out.print(submarine(1))
          out.flush
        }
        else if (data.contains("Cruiser")) {
          this.out.print(cruiser(0))
          this.out.print(cruiser(1))
          out.flush
        }
        else if (data.contains("Battleship")) {
          this.out.print(battleship(0))
          this.out.print(battleship(1))
          out.flush
        }
        else if (data.contains("Carrier")) {
          this.out.print(carrier(0))
          this.out.print(carrier(1))
          out.flush
        }
        else if (data.contains("Enter")) {
          this.moveMade = false
          this.makeMove
        }
        else if (data.contains("Error")) {
          System.out.println("Error: " + data)
          System.exit(1)
        }
        else if (data.contains("Die")) {
          System.out.println("Error: Your client was disconnected using the Game Viewer.")
          System.exit(1)
        }
        else {
          System.out.println("Received Unknown Response:" + data)
          System.exit(1)
        }
      }
    }
  }

  def placeDestroyer(startPos: String, endPos: String) {
    destroyer = Array[String](startPos.toUpperCase, endPos.toUpperCase)
  }

  def placeSubmarine(startPos: String, endPos: String) {
    submarine = Array[String](startPos.toUpperCase, endPos.toUpperCase)
  }

  def placeCruiser(startPos: String, endPos: String) {
    cruiser = Array[String](startPos.toUpperCase, endPos.toUpperCase)
  }

  def placeBattleship(startPos: String, endPos: String) {
    battleship = Array[String](startPos.toUpperCase, endPos.toUpperCase)
  }

  def placeCarrier(startPos: String, endPos: String) {
    carrier = Array[String](startPos.toUpperCase, endPos.toUpperCase)
  }

  def placeMove(pos: String): String = {
    if (this.moveMade) {
      System.out.println("Error: Please Make Only 1 Move Per Turn.")
      System.exit(1)
    }
    this.moveMade = true
    this.out.print(pos)
    out.flush
    try {
      data = this.br.readLine
    }
    catch {
      case e: Exception => {
        System.out.println("No response after from the server after place the move")
      }
    }
    if (data.contains("Hit")) return "Hit"
    else if (data.contains("Sunk")) return "Sunk"
    else if (data.contains("Miss")) return "Miss"
    else {
      this.dataPassthrough = data
      return "Miss"
    }
  }
}
