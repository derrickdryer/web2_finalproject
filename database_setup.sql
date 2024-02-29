-- Create database

CREATE DATABASE 'threadit';

USE 'threadit';

-- Create t1he tables for the threadit database

CREATE TABLE USERS (
  'userID' INT PRIMARY KEY AUTO_INCREMENT,
  'userName' VARCHAR(18) NOT NULL,
  'userPassword' VARCHAR(24) NOT NULL,
  'userEmail' VARCHAT(255) NOT NULL,
  'userCreated' TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  'userBio' TEXT,
  'userAvatar' BLOB
);

CREATE TABLE COMMUNITY (
  'communityID' INT PRIMARY KEY AUTO_INCREMENT,
  'communityName' VARCHAR(24) NOT NULL,
  'communityDesc' TEXT,
  'communityCreated' TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  'communityAvatar' BLOB,
  'communityPrivacy' BOOLEAN DEFAULT FALSE
);

CREATE TABLE USERS_TO_COMMUNITY (
  'userID' INT,
  'communityID' INT,
  'role' ENUM('admin', 'member') DEFAULT 'member',
  'joined' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('userID', 'communityID'),
  FOREIGN KEY ('userID') REFERENCES USERS('userID'),
  FOREIGN KEY ('communityID') REFERENCES COMMUNITY('communityID')
);

CREATE TABLE THREADS (
  'threadID' INT PRIMARY KEY AUTO_INCREMENT,
  'userID' INT,
  'communityID' INT,
  'threadTitle' VARCHAR(255) NOT NULL,
  'threadContent' TEXT,
  'threadCreated' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY ('userID') REFERENCES USERS('userID'),
  FOREIGN KEY ('communityID') REFERENCES COMMUNITY('communityID')
);

CREATE TABLE COMMENTS (
  'commentID' INT PRIMARY KEY AUTO_INCREMENT,
  'userID' INT,
  'threadID' INT,
  'commentContent' TEXT,
  'commentCreated' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY ('userID') REFERENCES USERS('userID'),
  FOREIGN KEY ('threadID') REFERENCES THREADS('threadID')
);

-- Grant pri1vileges to the threadit admins and users

GRANT ALL PRIVILEGES
ON threadit.*
TO threadit@localhost
IDENTIFIED BY 'pa55word';

GRANT SELECT ON
COMMUNITY, THREADS, COMMENTS
TO threadit.users@localhost
IDENTIFIED BY 'pa55word';

GRANT INSERT, UPDATE ON
THREADS, COMMENTS
TO threadit.users@localhost
IDENTIFIED BY 'pa55word';

-- Insert dummy data into the tables

INSERT INTO USERS
('userName', 'userPassword', 'userEmail', 'userBio')
VALUES
('admin', 'admin', 'admin@threadit.com', 'I am the admin of threadit');

INSERT INTO USERS
('userName', 'userPassword', 'userEmail', 'userBio')
VALUES
('user', 'user', 'user@email.com', 'I am a user of threadit');

INSERT INTO COMMUNITY
('communityName', 'communityDesc', 'communityPrivacy')
VALUES
('General', 'General discussion', FALSE);

INSERT INTO COMMUNITY
('communityName', 'communityDesc', 'communityPrivacy')
VALUES
('Secret Squirrel', 'Super secret squirrel', TRUE);

INSERT INTO USERS_TO_COMMUNITY
('userID', 'communityID', 'role')
VALUES
(1, 1, 'admin');

INSERT INTO USERS_TO_COMMUNITY
('userID', 'communityID', 'role')
VALUES
(2, 1, 'member');

INSERT INTO USERS_TO_COMMUNITY
('userID', 'communityID', 'role')
VALUES
(2, 2, 'admin');

INSERT INTO USERS_TO_COMMUNITY
('userID', 'communityID', 'role')
VALUES
(1, 2, 'member');

INSERT INTO THREADS
('userID', 'communityID', 'threadTitle', 'threadContent')
VALUES
(1, 1, 'Welcome to threadit', 'Welcome to threadit, the best forum on the internet');

INSERT INTO THREADS
('userID', 'communityID', 'threadTitle', 'threadContent')
VALUES
(2, 1, 'I love threadit', 'I love threadit, it is the best forum on the internet');

INSERT INTO COMMENTS
('userID', 'threadID', 'commentContent')
VALUES
(1, 1, 'Welcome to threadit, I am the admin');

INSERT INTO COMMENTS
('userID', 'threadID', 'commentContent')
VALUES
(2, 1, 'I love threadit, I am a user');

INSERT INTO COMMENTS
('userID', 'threadID', 'commentContent')
VALUES
(1, 2, 'I love threadit, I am the admin, but only a user in this community');

INSERT INTO COMMENTS
('userID', 'threadID', 'commentContent')
VALUES
(2, 2, 'I love threadit, I am a user, but an admin in this community');

-- End of database file
