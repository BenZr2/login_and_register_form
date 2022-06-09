<?php
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
	  $sql = "SELECT * FROM Artikel";
          $result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {
          if ($_POST['search'] == $row["ArtikelNR"]) {
        	echo $row["ArtikelNR"];
        	exit();
           }
         }
            $conn->close();
        }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>

<body>
    <form method="POST" action="">
        <input type="text" name="search" placeholder="ArtikelNr">
        <button type="submit">Suche</button>
    </form>
</html>