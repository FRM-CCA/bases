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
	if (isset($_POST['param'])) {	//test si variable existe
		echo "Vous avez envoyé : " . $_POST['param'] . "<br>";	// echo pour ecrire du texte
	}
	if (isset($_POST['param2'])) {	//test si pas vide
		echo "Vous avez envoyé : " . $_POST['param2']. "<br>";	// echo pour ecrire du texte
	}
	if (!empty($_POST['param2'])) {	//test si pas vide
		echo "Vous avez envoyé : " . $_POST['param2']. "<br>";	// echo pour ecrire du texte
	}
	?>
	</p>
</body>
</html>
