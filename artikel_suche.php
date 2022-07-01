<?php
//Anmeldedaten für die Verbindung zum MySQL Server
$servername = "192.168.200.3";
$username = "web";
$password = "dj39dn6j2";
$dbname = "website";
//Verbindungsaufbau zur Datenbank
$conn = new mysqli($servername, $username, $password, $dbname);

//Überprüfung der Verbindung zur Datenbank und ggf. Error Handling
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

//String aus dem Eingabefeld wird in SQL Befehl eingefügt und auf die Datenbank angewendet
if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM  Artikel WHERE ArtikelNR LIKE '%$search%'";
        $result = $conn->query($sql);

        //Wenn mindestens eine Zeile als Output zurückkommt, werden alle über eine for-Schleife nacheinander ausgegeben
        if ($result->num_rows > 0) {
                foreach($result as $row) {
                echo '<p>Artikel</p>';
                echo $row["ArtikelNR"];
                echo '   ';
                echo $row["Artikelname"];
                echo '<br>';
        }
        }
        exit();  //Terminierung des PHP Skripts
}
$conn->close(); //Schließt die Verbindung zur Datenbank

?>

<!DOCTYPE html>
<html lang="de">
<!-- Metadaten der HTML Datei -->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artikelsuche</title>

<style>
            html, body {margin:0; padding:0;}

            ul {
                position: fixed;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                width: 100%;
                background-color: black;
            }
            li {
                border-right: 1px solid white;
                float: left;
            }
            li a {
                font-family: 'Trebuchet MS', sans-serif;
                display: block;

			text-align: center;
                padding: 14px 16px;
                color: white;
                text-decoration: none;
            }
            li a:hover {
                background-color: #53868b;
            }
            #div_ueberschrift {
                padding: 5;
                margin: 0;
                width: 30%;
                height: 13%;
                margin-left: 34%;
                text-align: center;
                background-color: black;
                color: white;
                font-size: 30px;
                font-family: 'Trebuchet MS', sans-serif;
                border-radius: 5px;
            }
            #div_hauptfenster {
                width: 30.5%;
                height: 40%;
                margin-left: 34%;
                text-align: center;
                background-color: #F0FFFF40;
                border-radius: 5px;
                margin-top: 7%;
                padding-bottom: 5%;
		padding-top: 1%;
            }
            button {
                margin-top: 1%;
                margin-left: 44.3%;
                font-family: 'Trebuchet MS', sans-serif;
                font-size: 16px;
                width: 10%;
                height: 3%;
                border-radius: 3px;
                color: white;
                background-color: black;
		display: center;
            }
    </style>
</head>

<body background="RAID-5-Datenrettung-Rechenzentrum-ServerRaum-modified.jpg">

    <ul>
        <li><a href="index.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>

    <div id="div_ueberschrift">
            <h1>Artikelsuche</h1>
    </div>
    <!-- HTML Form zur Eingabe der Artikelnummer die gesucht werden soll -->
    <form method="POST" action="">
        <div id="div_hauptfenster">
		<form method="POST" action="">
		<input type="text" name="search" placeholder="ArtikelNr, Artikelname, Marke" style="border: 1px solid black">
	  </div>
		 <button type="submit" style="border: 1px solid white;">Suche</button>
	</form>
</html>
