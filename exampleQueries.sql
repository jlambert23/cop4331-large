USE cop4331;

/* Get all teams a user is a member of.  "2" is the specific userID that you want to replace with a variable. */
select team_name from teams
	where teams.teamID = any(select teams_teamID from users_has_teams
    where users_has_teams.users_userID = 2 /* REPLACE 2 WITH VARIABLE */ );
    
/* Returns all events for a team.  "1" is the specific teamID that you want to replace with a variable. */
/* This will be used when the user is looking at a team page */
select * from events 
	where eventID = any(select eventID from events_has_teams
    where events_has_teams.teamID = 1);
 
 /* Returns all events made by the user. NO TEAM EVENTS. "7" is the specific userID that would be replaced with a variable. */
select * from events
	where eventID = any(select events_eventID from users_has_events
    where users_has_events.users_userID = 7);
    
/* Used for searching for users with names similar to entry. */
select fName, lName, email from users where
	users.fname LIKE '%el%' OR users.lName like '%el%'; 
    
/*select * from events 
	where eventID = any(select events_eventID from users_has_events
    where users_has_events.users_userID = 2) 
    OR any(select events_eventID*/

select password from users
	where userID = 2;
    
update users set fName = Lebron, lName = James where userID = 2;

/* Update email using userID */
update users set email = 'KingJames@gmail.com' where userID = 2;

