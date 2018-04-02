# ALL TALK AND NO FRACTION

## Student name: Maxime Taylor
## Student number: 6917857
## Course: CSI3540

Web application live at: http://www.wbproj-csi3540.appspot.com/

"ALL TALK AND NO FRACTION" is a web application which aims to improve its users' ability to add, subtract and simplify fractions via gamification. The user creates an avatar and his
or her progress is tracked and rewarded with experience points, awards and customization options. Questions are pulled from a database to ensure a constant level of difficulty 
throughout a given level, but the order is randomized so a level is a bit different when replayed.

For the tester's convenience, two users are created along with the database:
* (Username: testing, password: testing) has a non-zero score and, more importantly, immediately has access to all four levels
* (Username: newuser, password: newuser) has a score of 0 and initially has access only to level 1. This is the same level of access the tester will receive if he or she creates a new account.
Please feel free to create a new account if you prefer. Note that running the "create.sql" script while testing will erase all users except the two above, which it will reset instead.

All images were created by me using the web application https://make8bitart.com/ , except for background images for which I've been told no references are required.

## Technologies chosen (as of Sunday April 1st, 2018):
* HTML and CSS
* Javascript for client-side scripting
* PHP for server-side scripting
* Apache web server
* Postgresql database which holds questions and answers as well as user information (username, avatar choices, progress, etc.)
* No external APIs as of yet
* Deployed to Google Cloud App Engine (and a Google Cloud SQL instance)

Session management inspired by: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

To view the web application, please navigate to this website: http://www.wbproj-csi3540.appspot.com/

To deploy from DEV, I use the deploy.bat file. It reinitializes the SQL instance and pushes all files to the Google Cloud App Engine instance.




