drop database if exists nhvbsr;
create database nhvbsr;
use nhvbsr;

drop table if exists lakeHost;
drop table if exists accessSite;
drop table if exists boaterSurvey;

create table lakeHost (
	lakeHostID int auto_increment,
	firstName varchar(10),
	lastName varchar(10),
	lakeHostGroupName varchar(20),
	lakeHostStatus varchar(10),
	constraint pk_lakeHost primary key (lakeHostID)
);

create table accessSite (
	siteID int auto_increment,
	siteName varchar(20),
	constraint pk_accessSite primary key (siteID)
	);

create table boaterSurvey (
	surveyID int auto_increment,
	lakeHostID int,
	siteID int,
	inputDate date,
	inputTime time,
	launchStatus varchar(20),
	regristrationState char(2),
	boatType varchar(30),
	previousInteraction char(1),
	lastSiteVisited varchar(20),
	lastTownVisited varchar(20),
	lastStateVisited char(2),
	drained char(1),
	rinsed char(1),
	dryForFiveDays char(1),
	boaterAwareness varchar(10),
	sentToDES char(1),
	bowNumber varchar(20),
	constraint pk_boaterSurvey primary key (surveyID),
	foreign key (lakeHostID) REFERENCES lakeHost (lakeHostID),
	foreign key (siteID) REFERENCES accessSite (siteID)
);

INSERT INTO lakeHost
VALUES (default,'Dakota','Heyman','BacteriaBusters','Inactive');

INSERT INTO lakeHost
VALUES (default,'Sam','Sweet','BoaterSurveys','Active');

INSERT INTO lakeHost
VALUES (default,'Mohamed','Fadlalla','BacteriaBusters','Active');

INSERT INTO accessSite
VALUES (default,'SiteOne');

INSERT INTO accessSite
VALUES (default,'SiteTwo');

INSERT INTO accessSite
VALUES (default,'SiteThree');


INSERT INTO boaterSurvey
VALUES (default,(select l.lakeHostID from lakeHost l where l.firstName = 'Dakota'),
(select a.siteID from accessSite a where a.siteName = 'SiteOne'),curdate(),'11:00:00','Launched','NH',
'canoe/kayak','Y','SiteOne','Concord','NH','Y','Y','Y','High','N','098NKS88');

INSERT INTO boaterSurvey
VALUES (default,(select l.lakeHostID from lakeHost l where l.firstName = 'Sam'),
(select a.siteID from accessSite a where a.siteName = 'SiteTwo'),'2014-01-04','10:30:00','Retrieved','MA',
'PWC/jet ski/jet boat','Y','SiteTwo','Burlington','VT','N','N','N','Low','Y','KNN788');

INSERT INTO boaterSurvey
VALUES (default,(select l.lakeHostID from lakeHost l where l.firstName = 'Mohamed'),
(select a.siteID from accessSite a where a.siteName = 'SiteOne'),'2014-02-13','8:45:00','Launched','ME',
'sail','N',null,null,null,'Y','N','Y','Medium','N','QWE33');

INSERT INTO boaterSurvey
VALUES (default,(select l.lakeHostID from lakeHost l where l.firstName = 'Sam'),
(select a.siteID from accessSite a where a.siteName = 'SiteThree'),'2014-04-15','14:20:00','Retrieved','CT',
'inboard/outboard','Y','SiteThree','Providence','RI','N','Y','N','High','Y','KKK0992');

INSERT INTO boaterSurvey
VALUES (default,(select l.lakeHostID from lakeHost l where l.firstName = 'Mohamed'),
(select a.siteID from accessSite a where a.siteName = 'SiteTwo'),curdate(),'12:00:00','Launched','NY',
'other','N','SiteFour','Manchester','NH','N','N','Y','Low','N','KEE334');

# Selects all boater surveys that were inputted today 
# (View/Edit)
select * from boaterSurvey where inputDate = curdate();

# Selects all boater surveys that were inputted today from a specific Lake Host 
# (change 3 to desired number/variable) 
# (View/Edit)
select * from boaterSurvey b
join lakeHost l on b.lakeHostID = l.lakeHostID
where b.inputDate = curdate() and l.lakeHostID = 3;

# Selects all boater surveys that were inputted today from a specific Access Site 
# (change 2 to desired number/variable) 
# (View/Edit)
select * from boaterSurvey where siteID = 2;

# Selects all boater surveys that were inputted today from a specific Group 
# (change BacteriaBusters to desired name/variable) 
# (View/Edit)
select * from boaterSurvey b
join lakeHost l on b.lakeHostID = l.lakeHostID
where lakeHostGroupName = 'BacteriaBusters';

# Changes the data in a column based on the survey ID
# (change regristationState to desired column,surveyID to desired number/variable) 
# (View/Edit)
update boaterSurvey
set regristrationState = 'ME' where surveyID = 1;
select * from boaterSurvey;

