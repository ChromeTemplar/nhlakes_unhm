# Selects the total of all surveys
select count(*) from Surveys;

# Selects the total of all surveys input in the current date
select count(*) from Surveys
where inputDate = curdate();

# Selects the total of all surveys input between the beginning of the year and the current date
select count(*) from Surveys where year(inputDate) >= '01/01/2014' and inputDate <= curdate();

# Selects the total of all surveys input this current month
select count(*) from Surveys where month(inputDate) = month(now());

# Selects the total of all surveys that were launched
select count(*) from Surveys
where LaunchStatus = 'Launched';

# Selects the total of all surveys that were retrieved
select count(*) from Surveys
where LaunchStatus = 'Retrieved';

# Selects the total of all surveys sent to DES
select count(SentToDES) from Surveys
where month(inputDate) = month(now());

# Selects the total of all surveys sent to DES this month
select count(SentToDES) from Surveys
where month(inputDate) = month(now());

# Selects the total of all surveys sent to DES this year
select count(SentToDES) from Surveys
where year(inputDate) >= '01/01/2014' and inputDate <= curdate();