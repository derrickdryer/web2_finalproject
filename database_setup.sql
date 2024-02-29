-- Purpose: Create the threadit database and tables
-- Author: Derrick Dryer
-- Date: 2024-02-29
-- Version: 1.0
-- License: MIT
-- Notes: This setup file is for phpMyAdmin using MariaDB, it may not work on other databases. Additonally it is set up for local use only, it is not secure for production use.

-- Create the database, drop and remake if it exists
DROP DATABASE IF EXISTS threadit;
CREATE DATABASE threadit;
-- MySQL Command, make sure to use the correct database
USE threadit;

-- Create threadit tables
CREATE TABLE USERS (
  userID INT PRIMARY KEY AUTO_INCREMENT,
  userName VARCHAR(18) NOT NULL,
  userPassword VARCHAR(24) NOT NULL,
  userEmail VARCHAR(255) NOT NULL,
  userCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  userBio TINYTEXT,
  userAvatar BLOB
);

CREATE TABLE COMMUNITY (
  communityID INT PRIMARY KEY AUTO_INCREMENT,
  communityName VARCHAR(24) NOT NULL,
  communityDesc MEDIUMTEXT,
  communityCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  communityAvatar BLOB,
  communityPrivacy BOOLEAN DEFAULT FALSE
);

CREATE TABLE USERS_TO_COMMUNITY (
  userID INT,
  communityID INT,
  role ENUM('admin', 'member') DEFAULT 'member',
  joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (userID, communityID),
  FOREIGN KEY (userID) REFERENCES USERS(userID),
  FOREIGN KEY (communityID) REFERENCES COMMUNITY(communityID)
);

CREATE TABLE THREADS (
  threadID INT PRIMARY KEY AUTO_INCREMENT,
  userID INT,
  communityID INT,
  threadTitle VARCHAR(255) NOT NULL,
  threadContent MEDIUMTEXT NOT NULL,
  threadCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (userID) REFERENCES USERS(userID),
  FOREIGN KEY (communityID) REFERENCES COMMUNITY(communityID)
);

CREATE TABLE COMMENTS (
  commentID INT PRIMARY KEY AUTO_INCREMENT,
  userID INT,
  threadID INT,
  commentContent TEXT NOT NULL,
  commentCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (userID) REFERENCES USERS(userID),
  FOREIGN KEY (threadID) REFERENCES THREADS(threadID)
);

-- Create threadit database users
CREATE USER threadit@localhost IDENTIFIED BY 'pa55word';
CREATE USER threadit_users@localhost IDENTIFIED BY 'pa55word';

-- 1Grant privileges to threadit database users
GRANT ALL PRIVILEGES
ON threadit.*
TO threadit@localhost;

GRANT INSERT, UPDATE ON
threadit.THREADS
TO threadit_users@localhost;

GRANT INSERT, UPDATE ON
threadit.COMMENTS
TO threadit_users@localhost;

GRANT SELECT ON
threadit.*
TO threadit_users@localhost;

--1 Insert some data into the tables
INSERT INTO USERS
(userName, userPassword, userEmail, userBio)
VALUES
('admin', 'admin', 'admin@threadit.com', 'I am the admin of threadit');

INSERT INTO USERS
(userName, userPassword, userEmail, userBio)
VALUES
('user', 'user', 'user@email.com', 'I am a user of threadit');

INSERT INTO COMMUNITY
(communityName, communityDesc, communityPrivacy)
VALUES
('General', 'General discussion', FALSE);

INSERT INTO COMMUNITY
(communityName, communityDesc, communityPrivacy)
VALUES
('Secret Squirrel', 'Super secret squirrel', TRUE);

INSERT INTO USERS_TO_COMMUNITY
(userID, communityID, role)
VALUES
(1, 1, 'admin');

INSERT INTO USERS_TO_COMMUNITY
(userID, communityID, role)
VALUES
(2, 1, 'member');

INSERT INTO USERS_TO_COMMUNITY
(userID, communityID, role)
VALUES
(2, 2, 'admin');

INSERT INTO USERS_TO_COMMUNITY
(userID, communityID, role)
VALUES
(1, 2, 'member');

INSERT INTO THREADS
(userID, communityID, threadTitle, threadContent)
VALUES
(1, 1, 'Welcome to threadit', 'Welcome to threadit, the best forum on the internet');

INSERT INTO THREADS
(userID, communityID, threadTitle, threadContent)
VALUES
(2, 1, 'I love threadit', 'I love threadit, it is the best forum on the internet');

INSERT INTO COMMENTS
(userID, threadID, commentContent)
VALUES
(1, 1, 'Welcome to threadit, I am the admin');

INSERT INTO COMMENTS
(userID, threadID, commentContent)
VALUES
(2, 1, 'I love threadit, I am a user');

INSERT INTO COMMENTS
(userID, threadID, commentContent)
VALUES
(1, 2, 'I love threadit, I am the admin, but only a user in this community');

INSERT INTO COMMENTS
(userID, threadID, commentContent)
VALUES
(2, 2, 'I love threadit, I am a user, but an admin in this community');
