<?php
//server credentials
$servername = "192.168.200.3";
$username = "web";
$password = "dj39dn6j2";
$dbname = "website";

$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['search'])) {
	$search = $_POST['search'];
	$sql = "SELECT * FROM  Artikel WHERE ArtikelNR = $search";
	//$statement = $conn->prepare($sql);
	//$statement->bind_param('sss', $search, $search, $search);
	$result = $conn->query($sql);

	//print_r($result);

	//print_r($result->num_rows);

	//output results with while loop
	if ($result->num_rows > 0) {
		foreach($result as $row) {
                //if ($_POST['search'] == $row["ArtikelNR"]) {
                echo $row["ArtikelNR"];
		echo "   ";
		echo $row["Artikelname"];
                echo "<br>";
        //}
        }
	}
	exit();
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="de">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search</title>
</head>

<body>
<h2>Artikel Suche</h2>
<form method="POST" action="">
<input type="text" name="search" placeholder="ArtikelNr, Artikelname, Marke">
<button type="submit">Suche</button>
</form>
</html>
