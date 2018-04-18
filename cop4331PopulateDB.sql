TeamsUSE cop4331;

INSERT INTO Users VALUES('1','Stringer', 'Bell','SBell','goFYaself@gmail.com','password','5555555555','Bla bla description');
INSERT INTO Users VALUES('2','Lebron', 'James','LBJ','LBJ@gmail.com','ImTheGreatest','5555555555','Bla bla description');
INSERT INTO Users VALUES('3','Tony', 'Soprano','TonyS','capicolaLover@gmail.com','PieOMy','5555555555','Bla bla description');
INSERT INTO Users VALUES('4','Christopher','Moltisanti','ChrisM','heroinAddict@gmail.com','Adrian','5555555555','Bla bla description');
INSERT INTO Users VALUES('5','Dwayne','Wade','DWade','MiamiStyle@gmail.com','WadeandLebron','5555555555','Bla bla description');
INSERT INTO Users VALUES('6','Carmello','Anthony','Mello','BigAppleBaller@gmail.com','1password','5555555555','Bla bla description');
INSERT INTO Users VALUES('7','Don','Draper','MarketingMan','alcoholic@aol.com','2password','5555555555','Bla bla description');


INSERT INTO Teams VALUES('1','New Jersey Crime Family');
INSERT INTO Teams VALUES('2','NBA Best Friends Club');

INSERT INTO Users_has_Teams VALUES('2','2',TRUE);
INSERT INTO Users_has_Teams VALUES('5','2',FALSE);
INSERT INTO Users_has_Teams VALUES('6','2',FALSE);
INSERT INTO Users_has_Teams VALUES('3','1',TRUE);
INSERT INTO Users_has_Teams VALUES('4','1',FALSE);

INSERT INTO Events VALUES('1','Best Friends Meeting','2018-7-4','2018-7-4','12:00:0','13:30:0','Cleveland, OH','Guys, let\'s all try to join the same team.','Unspecified');
INSERT INTO Events VALUES('2','Give Me My Money','2018-3-7','2018-3-9','1:00:0','13:30:0','Bada Bing Night Club','Money Money Money, gimme gimme gimme','Financial');
INSERT INTO Events VALUES('3','CEO Meeting','2018-5-4','2018-4-5','1:00:0','13:30:0','Baltimore, MD','Breaking down future marketing strategies','Financial');
INSERT INTO Events VALUES('4','Practice','2018-6-8','2018-6-8','8:30:0','17:00:0','Cleveland, OH','Practice makes perfect','Practice');


INSERT INTO Events_has_Teams VALUES('1','2');
INSERT INTO Events_has_teams VALUES('2','1');

INSERT INTO Users_has_Events VALUES('7','3');
INSERT INTO Users_has_Events VALUES('2','4');
