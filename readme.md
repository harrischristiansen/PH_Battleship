Purdue Hackers Battleship
=======

TODO
-----------

Anyone:  
Front-end Design  
Sample Code  
	Java (Almost Complete - Goucheng)  
	Python (Almost Complete - Harris)  
	C  

Harris:  
Require Team Abb To Be Unique  
Add Game/Tournament Controls  
Game AI for participants to play against   
Make WebSockets refresh more often that once every 2 seconds  

Questions:  
Allow browser to see hidden ships? / Obfuscate boards for game viewer?  

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
Run `mkdir Site/backend/storage/framework/sessions` and `mkdir Site/backend/storage/framework/views`  
Run `chmod -R 777 Site/backend/storage`  
Install pip  
Run `pip install Autobahn`  
Run `pip install twisted`  

Dev Environment Run Instructions
-----------

Start MAMP Servers  
Start Battleship Server: `python server.py`  
Open localhost:8888/game (The Game Viewer must be opened after the python server is running)  
Open and run 2 instances of client code (found in StarterCode folder) (either leave API_KEY as `API_KEY_HERE` or create a team on localhost:8888/login and use it's API_KEY)  
