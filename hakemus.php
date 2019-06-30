<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!$_POST['viesti']) return;

	$DATABASE_HOST = '';
	$DATABASE_USER = '';
	$DATABASE_PASS = '';
	$DATABASE_NAME = '';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) {
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	$id = file_get_contents('./id.txt', true);

	$id = $id + 1;

	file_put_contents("./hakemukset/" . $id . ".txt", $_POST['viesti']);

	file_put_contents("./id.txt", $id);

	if ($stmt = $con->prepare('INSERT INTO hakemukset (id, mc, dc, age, role, posted) VALUES (?, ?, ?, ?, ?, ?)')) {
		$posted = "false";
		$stmt->bind_param('ssssss', $id, $_POST['minecraft'], $_POST['discord'], $_POST['ikä'], $_POST['rank'], $posted);
		$stmt->execute();
		die('Hakemus lähetetty!');
	} else {
		die("Something went wrong!");
	}

}

?>
<!DOCTYPE html>
<html>

	<head>
		<title>Hool | Contact</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		<div class="contact">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
				<input name="minecraft" type="text" placeholder="Minecraft nimi" required>
				<input class="right" name="discord" type="text" placeholder="Discord" required>
				<input name="ikä" type="text" placeholder="Ikä" required>
				<p>Mitä roolia haet?*</p>
				<label>
					<input type="radio" name="rank" value="Moderaattori" checked>
					<span class="radio-item">Apuri</span>
				</label>
				<label class="right">
					<input type="radio" name="rank" value="Rakentaja">
					<span class="radio-item">Rakentaja</span>
				</label>
				<p>Hakemus*</p>
				<textarea class="text" name="viesti" cols="40" rows="10" required></textarea>
				<input type="submit" value="Lähetä">
			</form>
		</div>
	</body>

</html>