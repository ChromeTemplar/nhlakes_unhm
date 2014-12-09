DROP DATABASE IF EXISTS NHVBSR;

CREATE DATABASE NHVBSR;

USE NHVBSR;

CREATE TABLE Waterbody(
waterbodyID int NOT NULL AUTO_INCREMENT,
Name varchar (50)NOT NULL,
Watertype varchar (50)NOT NULL,
PRIMARY KEY (waterbodyID)
);


CREATE TABLE Town (
townID int NOT NULL AUTO_INCREMENT,
Name varchar (50) NOT NULL,
PRIMARY KEY (townID)
);


CREATE TABLE  LakeHostGroup (
lakehostgroupID int(11) NOT NULL AUTO_INCREMENT,
LakeHostGroupName varchar(25) NOT NULL,
Notes varchar(100),
PRIMARY KEY (lakehostgroupID)
);


CREATE TABLE Roles (
  RoleDescription varchar(15),
  roleID int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (roleID)
  );
 








CREATE TABLE User (
  userID int NOT NULL AUTO_INCREMENT,
  lakehostgroupID int(11),
  roleID int NOT NULL,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  phoneNumber varbinary(50),
  Username varchar(50) NOT NULL,
  Email varbinary(50) NOT NULL,
  Password varbinary(40) NOT NULL,
  Over18 tinyint NOT NULL,
  Varified tinyint NOT NULL,
  PRIMARY KEY (userID),
  FOREIGN KEY (roleID) REFERENCES Roles(roleID)
);

CREATE TABLE BoatRamp(
boatrampID int(11) NOT NULL AUTO_INCREMENT,
State varchar(20) NOT NULL,
lakehostgroupID int (11) NOT NULL,
Name varchar (50) NOT NULL,
waterbodyID int NOT NULL,
townID int NOT NULL,
Latitude float,
Longitude float,
Notes varchar(265),
PRIMARY KEY (boatrampID),
FOREIGN KEY (townID) REFERENCES Town(townID),
FOREIGN KEY (waterbodyID) REFERENCES Waterbody(waterbodyID),
FOREIGN KEY (lakehostgroupID) REFERENCES LakeHostGroup(lakehostgroupID)
);


CREATE TABLE LakeHostMember (
userID int(11) NOT NULL,
lakehostgroupID int(11) NOT NULL,
PRIMARY KEY (userID, lakehostgroupID),
FOREIGN KEY (userID) REFERENCES User(userID),
FOREIGN KEY (lakehostgroupID) REFERENCES LakeHostGroup(lakehostgroupID)
);





CREATE TABLE Summary (
summaryID int(11) NOT NULL AUTO_INCREMENT,
NH int(4),
ME int(4),
MA int(4),
VT int(4),
NY int(4),
CT int(4),
RI int(4),
Other int(4),
InboardOutboard int (4),
PWC int (4),
CanoeKayak int (4),
Previous int(4),
Sail int (4),
OtherBoatType int (4),
Drained  int(4),
Rinsed int(4),
Dry5 int(4),
AwarenessHigh int (4),
AwarenessLow int(4),
AwarenessMedium int (4),
SpeciesFoundYes int (4),
SpeciesFoundNo int (4),
SentDesYes int (4),
SentDesNo int (4),
SummaryDate date NOT NULL,
boatrampID int(11) NOT NULL,
userID int(11) NOT NULL,
TotalInspections int (4),
FOREIGN KEY (boatrampID) REFERENCES BoatRamp(boatrampID),
FOREIGN KEY (userID) REFERENCES User(userID),
PRIMARY KEY (summaryID)
);









CREATE TABLE InvasiveSurvey (
surveyID int(11) NOT NULL AUTO_INCREMENT,
userID int(11) NOT NULL,
boatrampID int(11) NOT NULL,
summaryID int(11) NOT NULL,
SurveyDate date NOT NULL,
LaunchStatus BOOLEAN NOT NULL,
RegistrationState char(2) NOT NULL,
BoatType varchar(30) NOT NULL,
PreviousInteraction tinyint(1) NOT NULL,
LastSiteVisited varchar(20) NOT NULL,
LastTownVisited varchar(20) NOT NULL,
LastStateVisited char(2) NOT NULL,
Drained tinyint(1) NOT NULL,
Rinsed tinyint(1) NOT NULL,
DryForFiveDays tinyint(1) NOT NULL,
BoaterAwareness varchar(10) NOT NULL,
SpecimenFound tinyint(1) NOT NULL,
BowNumber varbinary(50),
LicensePlateNumber varbinary(50),
SentToDES tinyint(1) NOT NULL,
Notes varchar(1000) NOT NULL,
Active tinyint(1) NOT NULL,
DESResult varchar(50),
DESNotes varchar(1000),
BoaterPhone varbinary(50),
BoaterName varbinary(75),
DESSave tinyint,
PRIMARY KEY (surveyID),
FOREIGN KEY (boatrampID) REFERENCES boatramp(boatrampID),
FOREIGN KEY (userID) REFERENCES User(userID),
FOREIGN KEY (summaryID) REFERENCES Summary(summaryID)
);
