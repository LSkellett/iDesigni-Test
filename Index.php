<!DOCTYPE html>
<html>
<head>
		<meta charset="utf=8">
		<title>Testing</title>
</head>
<body>
	<h2>Events be here</h2>
	
	<hr>
	
	<a href="add.php"><button>Add Event</button></a>
	<a href="search.php"><button>Search Events</button></a>
	
	<hr>
	<table border="1">
		<thead>
			<th>ID</th>
			<th>date</th>
			<th>time</th>
			<th>title</th>
			<th>description</th>
			<th>attendees</th>
		</thead>
		<tbody>
			<?php
				$json = file_get_contents('events.json');

				$events = json_decode($json, true);
				foreach($events['events'] as $row){
					echo " <tr>
						<td>".$row['id']."</td>
						<td>".$row['date']."</td>
						<td>".$row['time']."</td>
						<td>".$row['title']."</td>
						<td>".$row['description']."</td>
						<td>";
							if (empty($row['attendees'])){
								echo"No attendees";
							}else{
								foreach($row['attendees'] as $attendee){
									echo $attendee['name']."<br>";
								};
							};
					echo "</td>
						<td><a href='event.php?index=".$row['id']."'>See event</a>
						<td><a href='edit.php?index=".$row['id']."'>Edit event</a>
						<td><a href='delete.php?index=".$row['id']."'>Delete event</a>
					</tr>";
				};
			?>
		</tbody>
	</table>
	<hr>
	

	
</body>
</html>