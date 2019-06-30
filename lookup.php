<?php

if (isset($_GET['id'])) {

	$DATABASE_HOST = '';
	$DATABASE_USER = '';
	$DATABASE_PASS = '';
	$DATABASE_NAME = '';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) {
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	$stmt = $con->prepare('SELECT mc, dc, age, role FROM hakemukset WHERE id = ?');
	$stmt->bind_param('s',  $_GET['id']);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_array(MYSQLI_NUM)) {
		$minecraft = $row[0];
		$dc = $row[1];
		$age = $row[2];
		$role = $row[3];
	}
	$stmt->close();

} else {
	die("---_-/_-/--_-/_--_---_/_-/");
}
?>
<pre>,--.         ,---.        
|  |,--,--, /  .-' ,---.  
|  ||      \|  `-,| .-. | 
|  ||  ||  ||  .-'' '-' ' 
`--'`--''--'`--'   `---'

Minecraft: <?php echo $minecraft; ?>

Discord: <?php echo $dc; ?>

Rooli: <?php echo $role; ?>

Ikä: <?php echo $age; ?>






,--.             ,--.                                    
|  ,---.  ,--,--.|  |,-. ,---. ,--,--,--.,--.,--. ,---.  
|  .-.  |' ,-.  ||     /| .-. :|        ||  ||  |(  .-'  
|  | |  |\ '-'  ||  \  \\   --.|  |  |  |'  ''  '.-'  `) 
`--' `--' `--`--'`--'`--'`----'`--`--`--' `----' `----'  



<?php

echo file_get_contents('./hakemukset/'.$_GET['id'].'.txt', true);

?></pre>