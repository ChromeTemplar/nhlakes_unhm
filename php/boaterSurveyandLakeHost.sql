drop database if exists nhvbsr;
create database nhvbsr;
use nhvbsr;

drop table if exists lakeHost;
drop table if exists boaterSurvey;

create table lakeHost (
	lakeHostID int auto_increment,
	firstName varchar(10),
	lastName varchar(10),
	lakeHostGroupName varchar(20),
	lakeHostStatus varchar(10),
	constraint pk_lakeHost primary key (lakeHostID)
);

create table boaterSurvey (
	surveyID int auto_increment,
	lakeHostID int,
	inputDate date,
	inputTime time,
	launchStatus varchar(20),
	registrationState char(2),
	boatType varchar(30),
	previousInteraction char(1),
	lastSiteVisited varchar(20),
	lastTownVisited varchar(20),
	lastStateVisited char(2),
	drained char(1),
	rinsed char(1),
	dryForFiveDays char(1),
	boaterAwareness varchar(10),
	specimenFound char(1),
	sentToDES char(1),
	bowNumber varchar(20),
	constraint pk_boaterSurvey primary key (surveyID),
	foreign key (lakeHostID) REFERENCES lakeHost (lakeHostID)
);

INSERT INTO lakeHost
VALUES (default,'Dakota','Heyman','BacteriaBusters','Inactive');

INSERT INTO lakeHost
VALUES (default,'Sam','Sweet','BoaterSurveys','Active');

INSERT INTO lakeHost
VALUES (default,'Mohamed','Fadlalla','BacteriaBusters','Active');


INSERT INTO boaterSurvey
VALUES (default,1,'2013-01-03','11:00:00','Launched','NH','canoe/kayak','Y','SiteOne','Concord','NH','Y','Y','Y','High','Y','N','098NKS88');

INSERT INTO boaterSurvey
VALUES (default,2,'2014-01-04','10:30:00','Retrieved','MA','PWC/jet ski/jet boat','Y','SiteTwo','Burlington','VT','N','N','N','Low','Y','Y','KNN788');

INSERT INTO boaterSurvey
VALUES (default,3,'2014-02-13','8:45:00','Launched','ME','sail','N',null,null,null,'Y','N','Y','Medium','N',null,null);

INSERT INTO boaterSurvey
VALUES (default,2,'2014-04-15','14:20:00','Retrieved','CT','inboard/outboard','Y','SiteThree','Providence','RI','N','Y','N','High','N',null,null);

INSERT INTO boaterSurvey
VALUES (default,3,'2014-04-19','12:00:00','Launched','NY','other','N','SiteFour','Manchester','NH','N','N','Y','Low','Y','N','KEE334');

select * from lakeHost;
select * from boaterSurvey;