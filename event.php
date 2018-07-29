<!DOCTYPE html>
<html>
<head>
	<meta charset="utf=8">
	<title>Testing</title>
</head>
<body>
	<?php
		$index = $_GET['index'];
		$events = json_decode(file_get_contents('events.json'), true);	
		
		$event = $events['events'][$index];
		$number = 0;
	?>
	<h1><?php echo $event['title'];?></h1>
	<p><?php echo $event['description'];?></h1>
	<hr>
	<h3>Date: <?php echo $event['date'];?></h3>
	<h3>Time: <?php echo $event['time'];?></h3>
	<hr>
	<h4>Registered Attendees</h4>
	
	<?php
		if (array_key_exists('attendees', $event)){
			echo "
				<table border='1'>
					<thead>
						<th>ID</th>
						<th>Name</th>
						<th>E-mail</th>
					</thead>
					<tbody>";
			foreach($event['attendees'] as $attendee){
				echo "
					<tr>
						<td>".$attendee['id']."</td>
						<td>".$attendee['name']."</td>
						<td>".$attendee['email']."</td>
						<td> <a href='delete.php?index=".$index."&id=".$attendee['id']."'><button>Remove</button></a></td>
					</tr>";
				$number++;
			};
			echo" </tbody></table>";
		}else{
			echo "<p>No attendees</p>";
		};	
	?>
	<hr>
	<h3>Enter details here if you wish to join this event</h3>
	<form method="POST">
		<p> <label for="Name">Name:</label><input type="text" name="name" placeholder="Joe Bloggs" required></p>
		<p> <label for="email">E-mail:</label><input type="email" name="email" placeholder="J.Bloggs@email.org" required></p>
		<input type="submit" name="save" value="Save">
	</form>
	<hr>
	<a href="index.php"><button>Return to events List</button></a>
	<?php
		if(isset($_POST['save'])){
			
			$input = array(
				'id' => $number,
				'name' => $_POST['name'],
				'email' => $_POST['email']
			);
			
			array_push($events['events'][$index]['attendees'],$input);
			file_put_contents('events.json',json_encode($events,JSON_PRETTY_PRINT));
			
			header('location: index.php');
		}
	?>	
</body>
</html>