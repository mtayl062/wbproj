# ALL TALK AND NO FRACTION

## Student name: Maxime Taylor
## Student number: 6917857
## Course: CSI3540

"ALL TALK AND NO FRACTION" is a web application which aims to improve its users' ability to add, subtract and simplify fractions via gamification. The user creates an avatar and his
or her progress is tracked and rewarded with experience points, awards and customization options. Questions are pulled from a database to ensure a constant level of difficulty 
throughout a given level, but the order is randomized so a level is a bit different when replayed.

For the tester's convenience, two users are created along with the database:
* (Username: testing, password: testing) has a non-zero score and, more importantly, immediately has access to all four levels
* (Username: newuser, password: newuser) has a score of 0 and initially has access only to level 1. This is the same level of access the tester will receive if he or she creates a new account.
Please feel free to create a new account if you prefer. Note that running the "create.sql" script while testing will erase all users except the two above, which it will reset instead.

All images were created by me using the web application https://make8bitart.com/ , except for background images for which I've been told no references are required.

## Technologies chosen (as of Thursday March 1st, 2018):
* HTML and CSS
* Javascript for client-side scripting
* PHP for server-side scripting
* Apache web server
* Postgresql database which holds questions and answers as well as user information (username, avatar choices, progress, etc.)
* No external APIs as of yet

Session management inspired by: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

## To install and use the web application, please refer to the instructions below (in French):

Pour visualiser le site web, veuillez télécharger ou cloner l’entièreté du répertoire Git pour le projet wbproj. Vous y trouverez le fichier README.md qui contient une description 
de l’application web ainsi que le choix des technologies, les 7 fichiers HTML et PHP listés ci-dessous et les répertoires «images», «scripts», «sql_scripts», «style» et «unlinked». 
Le répertoire «unlinked» n’est pas à évaluer.

Ensuite, l’application web nécessite une installation du serveur web Apache, préférablement d’une version 2.4.1 ou plus récente. L’installeur web peut être téléchargé à la page suivante : 
https://httpd.apache.org/download.cgi . Sélectionnez le lien qui correspond à votre système d’exploitation et procéder avec l’installation en notant le répertoire d’installation. Une fois 
que cela est complet, vérifier que le répertoire d’installation contient le sous-répertoire «htdocs».

L’application web nécessite également l’installation de PostgreSQL et de son logiciel d’administration,  pgAdmin : l’installeur web peut être téléchargé à la page suivante :
https://www.postgresql.org/download/ . Au cours de l’installation, prenez note du port auquel la base de donnée est installée ainsi que du nom de l’hôte, du nom de base de donnée, du nom 
d’utilisateur et du mot de passe que vous choisirez. Une fois l’installation complète, lancer le logiciel pgAdmin, puis faire connexion au serveur. Ensuite, choisissez l’outil «Query Tool» 
et ouvrez le fichier «create.sql» situé dans le répertoire «sql_scripts» du projet web. Exécutez le fichier, et vous aurez créé le schéma nécessaire au fonctionnement de l’application web.

Avant d’utiliser l’application web, ouvrir le fichier «config.php» à l’aide de votre éditeur de texte favori. Dans la chaîne de texte «conn_string», changez les informations pour celles que
vous avez notées à l’étape précédente.

Enfin, déplacer l’entièreté du répertoire du projet web dans le répertoire «htdocs» repéré précédemment. Assurez-vous de partir le serveur web Apache (vous pouvez utiliser la commande net
start pour faire ceci). Vous pouvez maintenant naviguer vers «localhost/index.html» pour commencer votre exploration de All Talk and No Fraction.

