<?php

// METHOD #1
$myFirstJson = array(
						array('team' => 'Senior Design Team'),
						array('team' => 'cool People Club'),
						array('team' => 'Apical Sucks Group'),
						array('team' => '4331 Team 16') 
						);

json_encode($myFirstJson);

//Method #2
$associativeArray = array();

associativeArray['event1'] = 'team' => 'Senior Design Team';
associativeArray['event2'] = 'team' => 'cool People Club';
associativeArray['event3'] = 'team' => 'Apical Sucks Group';
associativeArray['event4'] = 'team' => '4331 Team 16';