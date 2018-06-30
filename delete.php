<?php
	$index = $_GET['index'];
	$id = $_GET['id'];
	
	$events = json_decode(file_get_contents('events.json'), true);	

	unset($events['events'][$index]['attendees'][$id]);

	file_put_contents('events.json', json_encode($events, JSON_PRETTY_PRINT));

	header('location: index.php');
?>