DROP SCHEMA IF EXISTS wbproj;

CREATE SCHEMA wbproj;

DROP TABLE IF EXISTS wbproj.users;

CREATE TABLE wbproj.users (
	userid SERIAL PRIMARY KEY,
	username VARCHAR(20) UNIQUE,
	email VARCHAR(40) UNIQUE,
	pwd TEXT,
	spriteid INT DEFAULT 1,
	bgid INT DEFAULT 1,
	petid INT DEFAULT 1,
	score INT DEFAULT 0,
	unlock INT DEFAULT 1
);

INSERT INTO wbproj.users(username, email, pwd, score, unlock) VALUES ('testing','testing@gmail.com','$2y$10$KGoGhPIzaod5OfLIFXzbJeY0sVDXT3sWEgrO0ttww8OYXN4L/C17a',40,4);
INSERT INTO wbproj.users(username, email, pwd) VALUES ('newuser','newuser@gmail.com','$2y$10$dgT0EPXD97wVfGbbipY0fOEkDosZ7Ar7USBNG3EE/zxI3WGIfLLUW');

DROP TABLE IF EXISTS wbproj.questions;

CREATE TABLE wbproj.questions (
	lid VARCHAR(1),
	qid VARCHAR(1),
	n1 INT,
	d1 INT,
	op VARCHAR(1),
	n2 INT,
	d2 INT,
	a VARCHAR(5),
	b VARCHAR(5),
	c VARCHAR(5),
	d VARCHAR(5),
	answer VARCHAR(1),
	PRIMARY KEY (lid, qid)
);

INSERT INTO wbproj.questions VALUES(1,1,1,4,'+',2,4,'2/4','2/3','3/4','2/8','C');
INSERT INTO wbproj.questions VALUES(1,2,7,7,'-',4,7,'3/7','4/7','3/4','3/3','A');
INSERT INTO wbproj.questions VALUES(1,3,1,3,'+',2,3,'2/6','3/3','4/6','2/3','B');
INSERT INTO wbproj.questions VALUES(1,4,2,5,'-',2,5,'1/5','1/25','1/1','0/5','D');

INSERT INTO wbproj.questions VALUES(2,1,1,3,'+',1,2,'2/5','5/6','4/5','4/6','B');
INSERT INTO wbproj.questions VALUES(2,2,1,2,'+',2,5,'9/10','3/7','3/10','7/9','A');
INSERT INTO wbproj.questions VALUES(2,3,1,4,'+',1,6,'4/10','6/10','4/12','5/12','D');
INSERT INTO wbproj.questions VALUES(2,4,5,12,'+',1,3,'6/15','2/3','3/4','7/12','C');

INSERT INTO wbproj.questions VALUES(3,1,4,5,'-',1,2,'3/3','3/7','3/5','3/10','D');
INSERT INTO wbproj.questions VALUES(3,2,1,2,'-',1,6,'2/5','1/5','1/3','1/4','C');
INSERT INTO wbproj.questions VALUES(3,3,3,3,'-',3,7,'5/7','2/3','4/7','6/7','A');
INSERT INTO wbproj.questions VALUES(3,4,3,4,'-',2,3,'1/7','1/12','2/11','1/9','B');

INSERT INTO wbproj.questions VALUES(4,1,3,9,'+',4,8,'2/5','5/6','4/5','4/6','B');
INSERT INTO wbproj.questions VALUES(4,2,2,4,'+',4,10,'9/10','3/7','3/10','7/9','A');
INSERT INTO wbproj.questions VALUES(4,3,12,15,'-',3,6,'3/3','3/7','3/5','3/10','D');
INSERT INTO wbproj.questions VALUES(4,4,5,10,'-',3,18,'2/5','1/5','1/3','1/4','C');

