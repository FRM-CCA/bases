<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>GET</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<p>
	<?php
	if (isset($_GET['param'])) {	//test si variable existe
		echo "Vous avez envoyé : " . $_GET['param']."<br>";	// echo pour ecrire du texte
	}
	if (isset($_GET['param2'])) {	//test si variable existe
		echo "Vous avez envoyé : " . $_GET['param2']. "<br>"; // echo pour ecrire du texte
	}
	if (isset($_GET['param3'])) {	//test si variable existe
		echo "Vous avez envoyé : " . $_GET['param3']. "<br>"; // echo pour ecrire du texte
	}
	?>
	</p>
</body>
</html>