DROP DATABASE IF EXISTS NHVBSR;

CREATE DATABASE NHVBSR;

USE NHVBSR;

CREATE TABLE Waterbody(
WaterbodyID int NOT NULL AUTO_INCREMENT,
State varchar(20) NOT NULL,
Name varchar (50)NOT NULL,
Watertype varchar (50)NOT NULL,
PRIMARY KEY (WaterbodyID)
);

CREATE TABLE Town (
TownID int NOT NULL AUTO_INCREMENT,
Name varchar (50) NOT NULL,
PRIMARY KEY (TownID) 
);


CREATE TABLE  LakeHostGroup (
LakeHostGroupID int(11) NOT NULL AUTO_INCREMENT,
LakeHostGroupName varchar(25) NOT NULL,
Notes varchar(100) NOT NULL,
PRIMARY KEY (LakeHostGroupID)
);

CREATE TABLE Roles (
  RoleDescription varchar(15),
  RoleID int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (RoleID)
  );
  
CREATE TABLE User (
  UserID int NOT NULL AUTO_INCREMENT,
  LakeHostGroupID int(11),
  RoleID int NOT NULL,
  Username varchar(40) NOT NULL,
  Email varchar(50) NOT NULL,
  Password varchar(20) NOT NULL,
  PRIMARY KEY (UserID),
  FOREIGN KEY (RoleID) REFERENCES Roles(RoleID)
);



CREATE TABLE BoatRamp(
BoatRampID int(11) NOT NULL AUTO_INCREMENT,
LakeHostGroupID int (11) NOT NULL,
Name varchar (50) NOT NULL,
WaterbodyID int NOT NULL,
TownID int NOT NULL,
Latitude float,
Longitude float,
Notes varchar(265),
PRIMARY KEY (BoatRampID),
FOREIGN KEY (TownID) REFERENCES Town(TownID),
FOREIGN KEY (WaterbodyID) REFERENCES Waterbody(WaterbodyID),
FOREIGN KEY (LakeHostGroupID) REFERENCES LakeHostGroup(LakeHostGroupID)
);

CREATE TABLE LakeHostMember (
UserID int(11) NOT NULL,
LakeHostGroupID int(11) NOT NULL,
PRIMARY KEY (UserID, LakeHostGroupID),
FOREIGN KEY (UserID) REFERENCES User(UserID),
FOREIGN KEY (LakeHostGroupID) REFERENCES LakeHostGroup(LakeHostGroupID)
);

CREATE TABLE InvasiveSurvey (
UserID int(11) NOT NULL,
BoatRampID int(11) NOT NULL,
SurveyID int(11) NOT NULL AUTO_INCREMENT,
SurveyDate date NOT NULL,
SurveyTime time NOT NULL,
LaunchStatus varchar(10) NOT NULL,
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
BowNumber int(11) NOT NULL,
SentToDES tinyint(1) NOT NULL,
Notes varchar(1000) NOT NULL,
Active tinyint(1) NOT NULL,
PRIMARY KEY (SurveyID),
FOREIGN KEY (BoatRampID) REFERENCES BoatRamp(BoatrampID),
FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Summary (
SummaryID int(11) NOT NULL AUTO_INCREMENT,
BoatState char(2),
BoatType varchar(25),
Previous int(4),
Drained  int(4),
Rinsed int(4),
Dry5 int(4),
Awareness varchar(4),
SpeciesFound char(3),
SummaryDate date NOT NULL,
BoatRampID int(11) NOT NULL,
UserID int(11) NOT NULL,
FOREIGN KEY (BoatRampID) REFERENCES BoatRamp(BoatrampID),
FOREIGN KEY (UserID) REFERENCES User(UserID),
PRIMARY KEY (SummaryID)
);





