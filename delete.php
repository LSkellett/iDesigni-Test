<?php
	$index = $_GET['index'];
	$events = json_decode(file_get_contents('events.json'), true);	
	$event = $events['events'][$index];

	unset($events['events'][$index]);
	file_put_contents('events.json',json_encode($events,JSON_PRETTY_PRINT));
	header('location: index.php');
?>