drop database if exists nhvbsr;
create database nhvbsr;
use nhvbsr;

drop table if exists AccessSites;
drop table if exists LakeHosts;
drop table if exists LakeHostGroups;
drop table if exists LakeHostMembers;
drop table if exists Users;
drop table if exists Surveys;


create table AccessSites (
	SiteID int auto_increment,
	SiteName varchar(50),
	constraint pk_AccessSites primary key (SiteID)
);


create table LakeHosts (
	LakeHostID int auto_increment,
	FirstName varchar(20),
	constraint pk_LakeHosts primary key (LakeHostID)
);

create table LakeHostGroups (
	LakeHostGroupID int auto_increment,
	LakeHostGroupName varchar(25),
	constraint pk_LakeHostGroups primary key (LakeHostGroupID)
);

create table LakeHostMembers (
	LakeHostID int ,
	LakeHostGroupID int,
	constraint pk_LakeHostMembers primary key (LakeHostID,LakeHostGroupID),
	constraint fk_LakeHostMembers foreign key (LakeHostID)
	references LakeHosts(LakeHostID),
	constraint fk2_LakeHostMembers foreign key (LakeHostGroupID)
	references LakeHostGroups(LakeHostGroupID)
);

create table Users (
	UserID int auto_increment,
	LakeHostID int,
	GroupID int,
	Role varchar(20),
	UserName varchar(10),
	Email varchar(50) NOT NULL,
	Password varchar(20) NOT NULL,
	constraint pk_Users primary key(UserID),
	constraint fk_Users foreign key(LakeHostID)
	references LakeHosts(LakeHostID),
	constraint fk2_Users foreign key(GroupID)
	references LakeHostGroups(LakeHostGroupID)
);

create table Surveys (
	SurveyID int auto_increment,
	LakeHostID int,
	InputDate date,
	InspectionTime time,
	SiteID int,
	LaunchStatus varchar(10),
	RegistrationState char(2),
	BoatType varchar(30),
	previousInteraction tinyint,
	LastSiteVisited varchar(20),
	LastTownVisited varchar(20),
	LastStateVisited char(2),
	Drained tinyint,
	Rinsed tinyint,
	DryForFiveDays tinyint,
	BoaterAwareness varchar(10),
	SpecimenFound tinyint,
	BowNumber varchar(20),
	SentToDES tinyint,
	Notes varchar(1000),
	Active tinyint,
	constraint pk_Surveys primary key (SurveyID),
	foreign key (LakeHostID) REFERENCES LakeHosts (LakeHostID),
	constraint fk_Surveys foreign key (SiteID)
	references AccessSites(SiteID)
);

desc AccessSites;
desc LakeHosts;
desc LakeHostGroups;
desc LakeHostMembers;
desc Users;
desc Surveys;

insert into AccessSites(SiteName)
values ('Conway Lake');
insert into AccessSites(SiteName)
values ('Manchester Water Works ramp 1');
insert into AccessSites(SiteName)
values ('Manchester Water Works ramp 2');

insert into LakeHosts (LakeHostID, FirstName)
values (default,'Mitchell');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Nick');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Vallery');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Colby');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Sam');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Mohamed');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Dakota');
insert into LakeHosts (LakeHostID, FirstName)
values (default,'Stephen');

insert into LakeHostGroups (lakehostgroupID, LakeHostGroupName)
values (default,'GroupA');
insert into LakeHostGroups (lakehostgroupID, LakeHostGroupName)
values (default,'GroupB');

insert into LakeHostMembers
values (1,1);
insert into LakeHostMembers
values (2,1);
insert into LakeHostMembers
values (8,1);
insert into LakeHostMembers
values (3,2);
insert into LakeHostMembers
values (4,2);
insert into LakeHostMembers
values (5,2);
insert into LakeHostMembers
values (6,2);
insert into LakeHostMembers
values (7,2);

insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,null,1,'GroupLeader','Edward', 'Edward', 'Edward');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,null,2,'GroupLeader','Melissa', 'Melissa', 'Melissa');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,null,null,'StaffMember','Andrea', 'Andrea', 'Andrea');
insert into Users (userID, LakehostID,GroupID, Role, UserName, Email, Password)
values (default,1,null,'LakeHost','Mitchell', 'Mitchell', 'Mitchell');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,2,null,'LakeHost','Nick','Nick','Nick');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,3,null,'LakeHost','Vallery','Vallery','Vallery');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,4,null,'LakeHost','Colby','Colby','Colby');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,5,null,'LakeHost','Sam','Sam','Sam');
insert into Users (userID, LakehostID, GroupID, Role, UserName, Email, Password)
values (default,6,null,'LakeHost','Mohamed','Mohamed','Mohamed');
insert into Users (userID, LakehostID,  GroupID, Role, UserName, Email, Password)
values (default,7,null,'LakeHost','Dakota','Dakota','Dakota');
insert into Users (userID, LakehostID,  GroupID, Role, UserName, Email, Password)
values (default,8,null,'LakeHost','Stephen','Stephen','Stephen');

INSERT INTO Surveys
VALUES (default,1,'2013-01-01','11:05:00',1,'Launched','NH','canoe/kayak',1,'SiteOne','Concord','NH',0,0,0,'High',1,'098NKS88',null,null,1);
INSERT INTO Surveys
VALUES (default,1,'2013-01-02','10:10:00',1,'Retrieved','MA','PWC/jet ski/jet boat',0,'SiteTwo','Manchester','NH',0,0,1,'Medium',1,'098NOSK',null,null,1);
INSERT INTO Surveys
VALUES (default,1,'2013-01-03','11:15:00',1,'Retrieved','ME','sail',1,'SiteThree','Burlington','VT',0,1,1,'Low',1,'098NDLFP',null,null,1);

INSERT INTO Surveys
VALUES (default,2,'2013-01-02','11:20:00',1,'Launched','CT','inboard/outboard(I/O)',0,'SiteFour','Providence','RI',1,0,0,'High',1,'09ALJ',null,null,1);
INSERT INTO Surveys
VALUES (default,2,'2013-01-03','11:25:00',1,'Launched','NY','other',1,null,null,null,null,null,null,'Medium',0,null,null,null,1);
INSERT INTO Surveys
VALUES (default,2,'2013-01-03','11:30:00',1,'Launched','NH','canoe/kayak',1,'SiteOne','Concord','NH',0,0,0,'High',1,'098NKS88',null,null,1);

INSERT INTO Surveys
VALUES (default,3,'2013-01-02','10:35:00',2,'Retrieved','MA','PWC/jet ski/jet boat',0,'SiteTwo','Manchester','NH',0,0,1,'Medium',1,'098NOSK',null,null,1);
INSERT INTO Surveys
VALUES (default,3,'2013-01-03','11:40:00',2,'Retrieved','ME','sail',1,'SiteThree','Burlington','VT',0,1,1,'Low',1,'098NDLFP',null,null,1);
INSERT INTO Surveys
VALUES (default,3,'2013-01-03','11:45:00',2,'Launched','CT','inboard/outboard(I/O)',0,'SiteFour','Providence','RI',1,0,0,'High',1,'09ALJ',null,null,1);

INSERT INTO Surveys
VALUES (default,4,'2013-01-03','11:50:00',2,'Launched','NY','other',1,null,null,null,null,null,null,'Medium',0,null,null,null,1);
INSERT INTO Surveys
VALUES (default,4,'2013-01-03','11:55:00',2,'Launched','NH','canoe/kayak',1,'SiteOne','Concord','NH',0,0,0,'High',1,'098NKS88',null,null,1);

INSERT INTO Surveys
VALUES (default,5,'2013-01-03','10:00:00',3,'Retrieved','MA','PWC/jet ski/jet boat',0,'SiteTwo','Manchester','NH',0,0,1,'Medium',1,'098NOSK',null,null,1);
INSERT INTO Surveys
VALUES (default,5,'2013-01-02','12:00:00',3,'Retrieved','ME','sail',1,'SiteThree','Burlington','VT',0,1,1,'Low',1,'098NDLFP',null,null,1);
INSERT INTO Surveys
VALUES (default,5,'2013-01-03','12:05:00',3,'Launched','CT','inboard/outboard(I/O)',0,'SiteFour','Providence','RI',1,0,0,'High',1,'09ALJ',null,null,1);

INSERT INTO Surveys
VALUES (default,6,'2013-01-02','12:10:00',3,'Launched','NY','other',1,null,null,null,null,null,null,'Medium',0,null,null,null,1);
INSERT INTO Surveys
VALUES (default,6,'2013-01-03','12:15:00',3,'Launched','NH','canoe/kayak',1,'SiteOne','Concord','NH',0,0,0,'High',1,'098NKS88',null,null,1);

INSERT INTO Surveys
VALUES (default,7,'2013-01-03','10:20:00',3,'Retrieved','MA','PWC/jet ski/jet boat',0,'SiteTwo','Manchester','NH',0,0,1,'Medium',1,'098NOSK',null,null,1);
INSERT INTO Surveys
VALUES (default,7,'2013-01-03','12:20:00',3,'Retrieved','ME','sail',1,'SiteThree','Burlington','VT',0,1,1,'Low',1,'098NDLFP',null,null,1);

INSERT INTO Surveys
VALUES (default,8,'2013-01-03','12:25:00',1,'Launched','CT','inboard/outboard(I/O)',0,'SiteFour','Providence','RI',1,0,0,'High',1,'09ALJ',null,null,1);
INSERT INTO Surveys
VALUES (default,8,'2013-01-03','12:30:00',1,'Launched','NY','other',1,null,null,null,null,null,null,'Medium',0,null,null,null,1);


select * from AccessSites;
select * from LakeHosts;
select * from LakeHostGroups;
select * from LakeHostMembers;
select * from Users;
select * from Surveys;