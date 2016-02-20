Purdue Hackers Battleship
=======

TODO
-----------

Anyone:  
Projector Page (Logo, Anvil Wifi Info, URL To Download Starter Code)  
Starter Code  
	C  
	Seperate Code into 2 files, one containing placeShips and makeMove methods, other containing everything else (makes less scary)  

Harris:  
Require Team Abb To Be Unique  
Manage Tournament Controls - Admin Side  
Fix websocket delay  

Dev Environment Setup Instructions
-----------

Download and Install MAMP  
Set MAMP Directory to Site/backend/Public  
Create MySQL Database (named Battleship) (use a GUI tool such as Sequel Pro)  
Copy Site/backend/.env.example to Site/backend/.env  
Fill in database information in .env (adding DB_PORT if necessary)  
Download and Install Composer  
Run `composer install` in the Site/backend directory (you might have to run `php composer.phar install` depending on how you installed composer)  
Run `php artisan migrate` in the Site/backend directory  
Run `php artisan key:generate` in the Site/backend directory  
Run `mkdir -p Site/backend/storage/framework/sessions` and `mkdir -p Site/backend/storage/framework/views`  
Run `chmod -R 777 Site/backend/storage`  
Install pip  
Run `pip install Autobahn --ignore-installed six`  
Run `pip install twisted`  

Dev Environment Run Instructions
-----------

Start MAMP Servers  
Start Battleship Server: `python server.py`  
Open localhost:8888/game (The Game Viewer must be opened after the python server is running)  
Open and run 2 instances of client code (found in StarterCode folder) (either leave API_KEY as `API_KEY_HERE` or create a team on localhost:8888/login and use it's API_KEY)  
