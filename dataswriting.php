<?php
require_once 'inc/functions.php';	//inclusion de fichier

if(isset($_SERVER['HTTP_REFERER'])){
	$referrer = $_SERVER['HTTP_REFERER'];
	echo "Referrer: " . basename($referrer) . "<hr>";
}
else{
	echo "No referrer<hr>";
	//exit(0);
}
$lib= $comm = $num = $datec = $datem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(!empty($_POST['id'])){
		$id = test_input($_POST['id']);
	}
	if($id > 0){
		echo "Update<br>";
	}
	else{
		echo "Insert<br>";
	}
	
	if(!empty($_POST['libelle'])){
		$lib = test_input($_POST['libelle']);
	}
	if(!empty($_POST['commentaire'])){
		$comm = test_input($_POST['commentaire']);
	}
	if(!empty($_POST['numero'])){
		$num = test_input($_POST['numero']);
	}
	if(!empty($_POST['datecreation'])){
		$datec = test_input($_POST['datecreation']);
	}
	if(!empty($_POST['datemodification'])){
		$datem = test_input($_POST['datemodification']);
	}

	if($id==-1){	//CREATE
		dataWriting($id, $lib, $comm, $num, $datec, $datem);
		exit(0);
	}
	else{
		if(dataReading($id, $lib, $comm, $num, $datec, $datem)==false){	
			echo "Data not found with ".$id."<br>";
			exit(0);
		}
		dataWriting($id, $lib, $comm, $num, $datec, $datem);
	}
}
else{
	if(isset($_GET["delete"])){
		$id = test_input($_GET["delete"]);
		if(is_numeric($id) && $id > 0){
			echo "Delete<br>";
			dataDelete($id);
		}
		else{
			echo "id is empty or not valid number<br>";
		}
	}
	else{
		echo "Datas for writing need to be POSTED";
	}
}

function dataDelete($id){
	require 'db/config.php';	//inclusion de fichier
	$pdo = null;

	try {
		// Create a new PDO instance
		//$pdo = new PDO("mysql:host=$host;port=$dbport;dbname=$dbname", $username, $password);
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	
		// Set the error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		
		$stmt = $pdo->prepare("DELETE FROM info where id=:id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$stmt->closeCursor();
		$stmt = null;
		echo "Data deleted successfully<br>";
		echo "<a href='datasreading.php'>Datas reading</a><br>";
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	
	// Close the connection
	$pdo = null;
}

function dataWriting($id, $libelle, $commentaire, $numero, $datecreation, $datemodification){
	require 'db/config.php';	//inclusion de fichier
	$pdo = null;
	
	try {
		// Create a new PDO instance
		//$pdo = new PDO("mysql:host=$host;port=$dbport;dbname=$dbname", $username, $password);
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	
		// Set the error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		if($id==-1){
			// Data writing
			$stmt = $pdo->prepare("INSERT INTO info (libelle, commentaire, numero) VALUES (:libelle, :commentaire, :numero)");
		}
		else{
			// Data updating
			$stmt = $pdo->prepare("UPDATE info SET libelle = :libelle, commentaire = :commentaire, numero = :numero, datemodification = :datemodification WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$date = date("Y-m-d H:i:s");
			$stmt->bindParam(':datemodification', $date);
		}

		// Bind the parameters for db
		$lib=empty2null($libelle);
		$comm = empty2null($commentaire);
		$num = empty2null($numero);
	
		$stmt->bindParam(':libelle', $lib);
		$stmt->bindParam(':commentaire', $comm);
		$stmt->bindParam(':numero', $num);
		$stmt->execute();
		$stmt->closeCursor();
		$stmt = null;
		if($id==-1){
			echo "Data inserted successfully<br>";
		}
		else{
			echo "Data updated successfully<br>";
		}
		echo "<a href='datasreading.php'>Datas reading</a><br>";
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	
	// Close the connection
	$pdo = null;
}

function dataReading($id){
	if(empty($id) || is_numeric($id)==false || $id<=0){
		echo "id is empty or not valid number<br>";
		return false;
	}
	
	//global $lib, $comm, $num, $datec, $datem;

	require 'db/config.php';	//inclusion de fichier
	$pdo = null;
	
	try {
			// Create a new PDO instance
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
				$pdo = null;
				echo "Data not found<br>";
				return false;
			}
			// Fetch all rows as associative arrays
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$stmt = null;
			
			// Loop through the rows and display the data
			foreach ($rows as $row) {
					$lib=$row['libelle'];
					$comm=$row['commentaire'];
					$num=$row['numero'];
					$datec=$row['datecreation'];
					$datem=$row['datemodification'];
			}
	} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false;
	}
	
	// Close the connection
	$pdo = null;
	return true;
}
?>

