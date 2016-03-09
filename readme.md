# Purdue Hackers Battleship

## Synopsis

Battleship was an event put on by Purdue Hackers (http://www.purduehackers.com) in the Spring of 2016. Teams coded "bots" in the span of 3 hours, and then ran their code to compete against other bots. At the end, the top 8 teams faced off elimination style to compete for victory.  

## Code Example

Sample/Starter clients are located in the "StarterCode" directory.

## Installation  

- [ ] Download and Install MAMP  
- [ ] Set MAMP Directory to Site/backend/Public  
- [ ] Create MySQL Database (named Battleship) (use a GUI tool such as Sequel Pro)  
- [ ] Copy Site/backend/.env.example to Site/backend/.env  
- [ ] Fill in database information in .env (adding DB_PORT if necessary)  
- [ ] Download and Install Composer  
- [ ] Run `composer install` in the Site/backend directory (you might have to run `php composer.phar install` depending on how you installed composer)  
- [ ] Run `php artisan migrate` in the Site/backend directory  
- [ ] Run `php artisan key:generate` in the Site/backend directory  
- [ ] Run `mkdir -p Site/backend/storage/framework/sessions` and `mkdir -p Site/backend/storage/framework/views`  
- [ ] Run `chmod -R 777 Site/backend/storage`  
Install pip  
- [ ] Run `pip install Autobahn --ignore-installed six`  
- [ ] Run `pip install twisted`  

## Starting Servers

- [ ] Start MAMP Servers  
- [ ] Start Battleship Server: `python server.py`  

## Starting/Viewing Game

- [ ] Open localhost:8888/game (The Game Viewer must be opened after the python server is running)  
- [ ] Open and run 2 instances of client code (found in StarterCode folder) (either leave API_KEY as `API_KEY_HERE` or create a team on localhost:8888/login and use it's API_KEY)  

## Contributors

@harrischristiansen (http://www.harrischristiansen.com): Developed Server, Client, Web Interface/Game Manager, and Web Viewer  
@balderfer (Ben Alderfer): Design  
@nickysemenza (Nicky Semenza): Web Interface API  
@wei170 (Guocheng Wei): Ported Python starter code to Java  

## License

Copyright 2016 Purdue Hackers and Harris Christiansen - All Rights Reserved  


