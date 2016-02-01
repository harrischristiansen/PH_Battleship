/**
 * @ AUTHOR NAME HERE
 * @ Starter Code By Guocheng
 *
 * 2016-01-30
 * For: Purdue Hackers - Battleship
 * Battleship Client
 */

import java.io.*;
import java.net.Socket;
import java.net.InetAddress;
import java.lang.Thread;

public class Battleship {
	public static String API_KEY = "API_KEY_HERE"; // TODO: PUT YOUT CODE HERE
	public static String GAME_SERVER = "127.0.0.1";

	/*
	 * TODO: PUT YOUR CODE HERE
	 */

	char[] letters;
	int[][] grid;
	Socket socket;
	String[] destroyer, submarine, cruiser, battleship, carrier;

	String dataPassthrough;
	String data;
	BufferedReader br;
	PrintWriter out;

	public Battleship() {
		this.grid = new int[8][8];
		for(int i = 0; i < grid.length; i++) { for(int j = 0; j < grid[i].length; j++) grid[i][j] = -1; }
		this.letters = new char[] {'A','B','C','D','E','F','G','H'};

		destroyer = new String[] {"A0", "A0"};
		submarine = new String[] {"A0", "A0"};
		cruiser = new String[] {"A0", "A0"};
		battleship = new String[] {"A0", "A0"};
		carrier = new String[] {"A0", "A0"};
	}

	void placeShips(String opponentID) {
		// Fill Grid With -s
		for(int i = 0; i < grid.length; i++) { for(int j = 0; j < grid[i].length; j++) grid[i][j] = -1; }
		System.out.println(grid[0][0]);
		// Place Ships
		placeDestroyer("A0", "A1");
		placeSubmarine("B0", "B2");
		placeCruiser("C0", "C2");
		placeBattleship("D0", "D3");
		placeCarrier("E0", "E4");
	}

	void makeMove() {
		for(int i = 0; i < 8; i++) {
			for(int j = 0; j < 8; j++) {
				if (this.grid[i][j] == -1) {
					String wasHitSunkOrMiss = placeMove(this.letters[i] + 
							String.valueOf(j));
					// placeMove(LetterNumber) Ex. placeMove(D5);
					if (wasHitSunkOrMiss.equals("Hits") || 
							wasHitSunkOrMiss.equals("Sunk")) {
						this.grid[i][j] = 1;
					} else {
						this.grid[i][j] = 0;			
					}
					return;
				}
			}
		}
	}

	/*
	 * TODO: PUT YOUR CODE ABOVE HERE
	 */

	void connectToServer() {
		try {
			InetAddress addr = InetAddress.getByName(GAME_SERVER);
			socket = new Socket(addr, 23345);
			br = new BufferedReader(new InputStreamReader(socket.getInputStream()));
			out = new PrintWriter(socket.getOutputStream(), true);

			out.print(API_KEY);
			out.flush();
			data = br.readLine();
		} catch (Exception e) {
			System.out.println("Error: when connecting to the server...");
			socket = null; 
		}

		if (data == null || data.contains("False")) {
			socket = null;
			System.out.println("Invalid API_KEY");
		}
	}



	public void gameMain() {
		while(true) {
			System.out.println("every round");
			try {
				System.out.println("Getting data...");
				if (this.dataPassthrough == null) {
					System.out.println("When dataPassThrough is null, getting data...");
					this.data = this.br.readLine();
				}
				else {
					System.out.println("dataPassThrough is passing data to data...");
					this.data = this.dataPassthrough;
					this.dataPassthrough = null;
				}
			} catch (IOException ioe) {
				System.out.println("IOException: in gameMain"); 
				ioe.printStackTrace();
			}
			if (this.data == null) {
				try { this.socket.close(); } 
				catch (IOException e) { System.out.println("Socket Close Error"); }
				return;
			}

			if (data.contains("Welcome")) {
				String[] welcomeMsg = this.data.split(":");
				placeShips(welcomeMsg[1]);
				System.out.println("Placed Ships");
			}
			else if (data.contains("Destroyer")) {
				this.out.print(destroyer[0]);
				this.out.print(destroyer[1]);
				out.flush();
				System.out.println("Send Destroyers");
			}
			else if (data.contains("Submarine")) {
				this.out.print(submarine[0]);
				this.out.print(submarine[1]);
				out.flush();
				System.out.println("Send Submarines");
			}
			else if (data.contains("Cruiser")) {
				this.out.print(cruiser[0]);
				this.out.print(cruiser[1]);
				out.flush();
				System.out.println("Send Cruisers");
			}
			else if (data.contains("Battleship")) {
				this.out.print(battleship[0]);
				this.out.print(battleship[1]);
				out.flush();
				System.out.println("Send Battlehsips");
			}
			else if (data.contains("Carrier")) {
				this.out.print(carrier[0]);
				this.out.print(carrier[1]);
				out.flush();
				System.out.println("Send Carriers");
			}
			else if (data.contains( "Enter")) {
				this.makeMove();
				System.out.println("Made Move");
			}
			else if (data.contains("Error" )) {
				out.print("Received Error");
				out.flush();
				System.out.println("Send Error");
				System.exit(1); // Exit sys when there is an error
			}
			else {
				out.print("Recieved Unknown Responce:" + data);
				out.flush();
				System.out.println("Send Destroyer");
				System.exit(1); // Exit sys when there is an unknown responce
			}
		}
	}

	void placeDestroyer(String startPos, String endPos) {
		destroyer = new String[] {startPos.toUpperCase(), endPos.toUpperCase()}; 
	}

	void placeSubmarine(String startPos, String endPos) {
		submarine = new String[] {startPos.toUpperCase(), endPos.toUpperCase()}; 
	}

	void placeCruiser(String startPos, String endPos) {
		cruiser = new String[] {startPos.toUpperCase(), endPos.toUpperCase()}; 
	}

	void placeBattleship(String startPos, String endPos) {
		battleship = new String[] {startPos.toUpperCase(), endPos.toUpperCase()}; 
	}

	void placeCarrier(String startPos, String endPos) {
		carrier = new String[] {startPos.toUpperCase(), endPos.toUpperCase()}; 
	}

	String placeMove(String pos) {
		this.out.print(pos);
		out.flush();
		try { data = this.br.readLine(); } 
		catch(Exception e) { System.out.println("No response after from the server after place the move"); }

		if (data.contains("Hit")) return "Hit";
		else if (data.contains("Sunk")) return "Sun";
		else if (data.contains("Miss")) return "Miss";
		else {
			this.dataPassthrough = data;
			return "Miss";
		}
	}

	public static void main(String[] args) {
		Battleship bs = new Battleship();
		while(true) {
			bs.connectToServer();
			if (bs.socket != null) bs.gameMain();
		}	
	}
}

