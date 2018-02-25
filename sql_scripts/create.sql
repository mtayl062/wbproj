DROP SCHEMA IF EXISTS wbproj;

CREATE SCHEMA webproj;

SET search_path TO webproj;

CREATE TABLE user_avatar (
	userid int,
    spriteid int,
    bgid int,
    petid int
);