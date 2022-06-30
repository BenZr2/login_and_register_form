<?php
//Anmeldedaten für die Verbindung zum MySQL Server
$servername = "192.168.200.3";
$username = "web";
$password = "dj39dn6j2";
$dbname = "website";
//Verbindungsaufbau zur Datebank
$conn = new mysqli($servername, $username, $password, $dbname);

//Überprüfung der Verbindung zur Datenbank und ggf. Error Handling
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//String aus dem Eingabe Feld wird in SQL Befehl eingefügt und auf die Datenbank angewendet
if(isset($_POST['search'])) {
	$search = $_POST['search'];
	$sql = "SELECT * FROM  Artikel WHERE ArtikelNR = $search";
	$result = $conn->query($sql);

	//Wenn mindestens eine Zeile als Output zurückkommt, werden alle über eine for-Schleife nacheinander ausgegeben
	if ($result->num_rows > 0) {
		foreach($result as $row) {
                echo $row["ArtikelNR"];
		echo "   ";
		echo $row["Artikelname"];
                echo "<br>";
        }
	}
	exit();	
}
$conn->close(); //Schließt die Verbindung zur Datenbank
?>




<!DOCTYPE html>
	<html lang="de">
	<!-- Metadaten der HTML Datei -->
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Artikel Suche</title>
	</head>

	<body>
		<h2>Artikel Suche</h2>

		<!-- HTML Form zur Eingabe der Artikelnummer die gesucht werden soll -->
		<form method="POST" action="">
		<input type="text" name="search" placeholder="ArtikelNr, Artikelname, Marke">
		<button type="submit">Suche</button>
		</form>
	</body>
</html>
