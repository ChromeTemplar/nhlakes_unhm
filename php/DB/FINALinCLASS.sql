DROP DATABASE IF EXISTS NHVBSR;


CREATE DATABASE NHVBSR;


USE NHVBSR;


CREATE TABLE Waterbody(
ID int NOT NULL AUTO_INCREMENT,
name varchar (50)NOT NULL,
waterType varchar (50)NOT NULL,
PRIMARY KEY (ID)
);


CREATE TABLE Town (
ID int NOT NULL AUTO_INCREMENT,
name varchar (50) NOT NULL,
PRIMARY KEY (ID)
);


CREATE TABLE  LakeHostGroup (
ID int(11) NOT NULL AUTO_INCREMENT,
lakeHostGroupName varchar(25) NOT NULL,
notes varchar(100),
PRIMARY KEY (ID)
);


CREATE TABLE Role (
  roleDescription varchar(15),
  ID int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (ID)
  );
 








CREATE TABLE User (
  ID int NOT NULL AUTO_INCREMENT,
  roleID int NOT NULL,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  phoneNumber varbinary(50),
  userName varchar(50) NOT NULL,
  email varbinary(50) NOT NULL,
  password varbinary(40) NOT NULL,
  over18 tinyint(1) NOT NULL,
  verified tinyint(1) NOT NULL,
  activeUser boolean NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (roleID) REFERENCES Role(ID)
);


CREATE TABLE BoatRamp(
ID int(11) NOT NULL AUTO_INCREMENT,
state varchar(20) NOT NULL,
lakeHostGroupID int (11) NOT NULL,
name varchar (50) NOT NULL,
waterbodyID int NOT NULL,
townID int NOT NULL,
latitude float,
longitude float,
notes varchar(265),
PRIMARY KEY (ID),
FOREIGN KEY (townID) REFERENCES Town(ID),
FOREIGN KEY (waterbodyID) REFERENCES Waterbody(ID),
FOREIGN KEY (lakeHostGroupID) REFERENCES LakeHostGroup(ID)
);












CREATE TABLE LakeHostMember (
userID int(11) NOT NULL,
lakeHostGroupID int(11) NOT NULL,
PRIMARY KEY (userID, lakeHostGroupID),
FOREIGN KEY (userID) REFERENCES User(ID),
FOREIGN KEY (lakeHostGroupID) REFERENCES LakeHostGroup(ID)
);
























































CREATE TABLE Summary (
ID int(11) NOT NULL AUTO_INCREMENT,
NH int(4),
ME int(4),
MA int(4),
VT int(4),
NY int(4),
CT int(4),
RI int(4),
other int(4),
inboardOutboard int (4),
pwc int (4),
canoeKayak int (4),
previous int(4),
notPrevious int(4),
sail int (4),
otherBoatType int (4),
drained int(4),
notDrained int(4),
rinsed int(4),
notRinsed int (4),
dry5 int(4),
notDry5 int (4),
awarenessHigh int (4),
awarenessLow int(4),
awarenessMedium int (4),
speciesFoundYes int (4),
speciesFoundNo int (4),
sentDesYes int (4),
sentDesNo int (4),
summaryDate date NOT NULL,
boatRampID int(11) NOT NULL,
userID int(11) NOT NULL,
totalInspections int (4),
startShiftTime datetime,
endShiftTime datetime,




FOREIGN KEY (boatRampID) REFERENCES BoatRamp(ID),
FOREIGN KEY (userID) REFERENCES User(ID),
PRIMARY KEY (ID)
);




CREATE TABLE InvasiveSurvey (
ID int(11) NOT NULL AUTO_INCREMENT,
userID int(11),
boatRampID int(11),
summaryID int(11),
name varchar(50),
surveyDate date,
dateCreated timestamp,
launchStatus tinyint(1),
registrationState char(2),
boatType varchar(30),
previousInteraction tinyint(1),
lastSiteVisited varchar(20),
lastTownVisited varchar(20),
lastStateVisited char(2),
drained tinyint(1),
rinsed tinyint(1),
dryForFiveDays tinyint(1),
boaterAwareness varchar(10),
bowNumber varbinary(50),
licensePlateNumber varbinary(50),
sentToDES tinyint(1),
notes varchar(1000),
active tinyint(1),
desResult varchar(50),
desNotes varchar(1000),
desSave tinyint,
PRIMARY KEY (ID),
FOREIGN KEY (boatRampID) REFERENCES BoatRamp(ID),
FOREIGN KEY (userID) REFERENCES User(ID),
FOREIGN KEY (summaryID) REFERENCES Summary(ID)
);


CREATE table sessionDetail (
sessionId VARCHAR(30) NOT NULL,
sessionKeyVal VARCHAR(30) NOT NULL,
sessionStatus CHAR(1) NOT NULL);