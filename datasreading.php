<?php
function dataRead(){
	require_once 'config/config.php';	//inclusion de fichier
	$pdo = null;
	
	try {
			// Create a new PDO instance
			//$pdo = new PDO("mysql:host=$host;port=$dbport;dbname=$dbname", $username, $password);
			$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	
			// Set the PDO error mode to exception
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			// Prepare the SQL query
			$query = "SELECT * FROM info";
	
			// Execute the query
			$stmt = $pdo->query($query);
	
			// Fetch all rows as associative arrays
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Loop through the rows and display the data
	var_dump($rows);
	echo "<br><hr>";
			foreach ($rows as $row) {
					echo "Id: " . $row['id'] . "<br>";
					echo "Libelle: " . $row['libelle'] . "<br>";
					echo "Commentaire: " . $row['commentaire'] . "<br>";
					echo "Numéro: " . $row['numero'] . "<br>";
					echo "Date Creation: " . $row['datecreation'] . "<br>";
					echo "Date Modification: " . $row['datemodification'] . "<br>";
					echo "<a href='datasreadingform.php?pid=".$row['id']."'>Lire via formulaire pour id=".$row['id']."</a>";
					echo "<hr>";
			}
			$stmt->closeCursor();
	} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
	}
	
	// Close the connection
	$pdo = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Datas Reading</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<a href='datasreadingform.php'>Creation via formulaire.</a>
	<hr>
	<?php
		dataRead();
	?>
</body>
</html>