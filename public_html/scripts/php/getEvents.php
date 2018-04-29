<?php

require dirname(__FILE__) . '/../../lib/fullcalendar/utils.php';

// Read and parse our events JSON file into an array of event data arrays.
// echo $_POST['json'];

$json = file_get_contents(dirname(__FILE__) . '../js/tmp/events.json');
$input_arrays = json_decode($json, true);

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

  // Convert the input array into a useful Event object
  $event = new Event($array);

  // If the event is in-bounds, add it to the output
  $output_arrays[] = $event->toArray();
}

// Send JSON to the client.
echo json_encode($output_arrays);