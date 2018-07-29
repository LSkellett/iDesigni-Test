<!DOCTYPE html>
<html>
<head>
	<meta charset="utf=8">
	<title>Testing</title>
</head>
<body>
	<form method="POST">
		<p>
			<label>Event Name: </label>
			<input type="text" id="title" name="title" required>
		</p>
		<p>
			<label>Description: </label>
			<input type="text" id="description" name="description" required>
		</p>
		<p>
			<label>Date: </label>
			<input type="date" id="date" name="date" required>
		</p>
		<p>
			<label>Time: </label>
			<input type="time" id="time" name="time" required>
		</p>
		<input type="submit" name="save" value="save">
	</form>
	<hr>
	<a href="index.php"><button>Return to events List</button></a>
	<?php
		$events = json_decode(file_get_contents('events.json'), true);	
	
		if(isset($_POST['save'])){
			$index = 0;
			$same = FALSE;
			foreach($events['events'] as $row){
				if($_POST['date']==$row['date']){
					$same = TRUE;
				}
				$index = $row['id'];
			}
			if($same){
				echo"<p>The Date Matches a different event</p>";
			}else{
				$index++;
				$input = array(
					'id' => $index++,
					'title' => $_POST['title'],
					'description' => $_POST['description'],
					'date' => $_POST['date'],
					'time' => $_POST['time'],
					"attendees" => []
				);
			
				array_push($events['events'],$input);
				file_put_contents('events.json',json_encode($events,JSON_PRETTY_PRINT));
				
				header('location: index.php');
			}
		};
	?>