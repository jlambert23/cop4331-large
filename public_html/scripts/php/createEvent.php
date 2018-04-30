<?php

if (isset($_POST['event-team'])) {
    $team = $_POST['event-team'];

    if ($team == "") {
        include_once 'userCreateEvent.php';
        userCreateEvent();
    }
    else {
        include_once 'teamsCreateEvent.php';
        teamsCreateEvent();
    }
}