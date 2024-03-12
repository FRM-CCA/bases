<?php
$lib=$comm=$num=$datec=$datem="";
$id=-1;

function dataRead($id){
	if(empty($id)){
		echo "id is empty<br>";
		return;
	}

	global $lib, $comm, $num, $datec, $datem;

	require_once 'config/config.php';	//inclusion de fichier
	$pdo = null;
	
	try {
			// Create a new PDO instance
			//$pdo = new PDO("mysql:host=$host;port=$dbport;dbname=$dbname", $username, $password);
			$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	
			// Set the PDO error mode to exception
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			// Prepare the SQL query
			$query = "SELECT * FROM info where id= :id";

			// Execute the query
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			if($stmt->rowCount() <= 0){
				//echo $stmt->rowCount();
				$stmt->closeCursor();
				$pdo = $stmt = null;
				echo "Data not found<br>";
				exit(0);
			}
			// Fetch all rows as associative arrays
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$stmt=null;
//var_dump($rows);
			// Loop through the rows and display the data
			foreach ($rows as $row) {
//var_dump($row);
					$lib=$row['libelle'];
					$comm=$row['commentaire'];
					$num=$row['numero'];
					$datec=$row['datecreation'];
					$datem=$row['datemodification'];
			}
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
	<title>Datas Reading Form</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
	if(isset($_GET['pid'])){
		$id=$_GET['pid'];
		dataRead($id);
	}
	else{
		echo "Creation new data<br>";
	}
	?>
	<form action="dataswriting.php" method="post">
		<label for="id">Id:</label><br>
		<input type="text" id="id" name="id" value="<?= $id ?>" readonly><br>
		<label for="libelle">Libelle:</label><br>
		<input type="text" id="libelle" name="libelle" value="<?= $lib ?>" placeholder="Saisir Libelle" title="Libelle"><required>*</required><br>
		<label for="commentaire">Commentaire:</label><br>
		<input type="text" id="commentaire" name="commentaire" value="<?= $comm ?>"><br>
		<label for="numero">Numero:</label><br>
		<input type="text" id="numero" name="numero" value="<?= $num ?>"><br>
		<label for="datecreation">Date Creation:</label><br>
		<input type="text" id="datecreation" name="datecreation" value="<?= $datec ?>" readonly><br>
		<label for="datemodification">Date Modification:</label><br>
		<input type="text" id="datemodification" name="datemodification" value="<?= $datem ?>" readonly><br>
		<input type="submit" value="Submit">
	</form>
	<hr>
	<a href="dataswriting.php?delete=<?=$id?>">Effacer</a>
</body>
</html>