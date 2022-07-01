<?php
        #Anmeldedaten für die MySQL Datenbank
        $servername = "192.168.200.3";
        $username = "web";
        $password = "dj39dn6j2";
        $dbname = "website";
        #Verbindungsaufbau zur MySQL Datenbank
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        //Falls die Verbindung scheitert gibt es eine Fehlermeldung
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        //Wenn der Username mit der Eingabe übereinstimmt wird man eingeloggt
        if (isset($_POST['username'])) {
            $sql = "SELECT username, passwort FROM user";
            $result = $conn->query($sql);
            //Passwort wird gehasht, damit es mit dem Eintrag in der DB abgeglichen werden kann
			$passwort = hash('sha256',$_POST['passwort']);


            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    //Überprüfung der eingegebenen Daten mit denen aus der Datenbank
                    if ($_POST['username'] == $row["username"] && $passwort == $row["passwort"]) {
                        //Weiterleitung auf nächste Seite nach erfolgreicher Authentifizierung
                        header("Location: artikel_suche.php");
                        exit();
                    }
                }
            } 
            //Meldung wegen falscher Anmeldedaten
            echo "Falscher Benutzername oder falsches Passwort";
            $conn->close();
        }
?>

<!DOCTYPE html>
<html lang="en">
<!--Beschreibung des Headers mit den Metadaten-->
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--Hintergrundbild für unsere Seite-->
    <body background="RAID-5-Datenrettung-Rechenzentrum-ServerRaum-modified.jpg">

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
            }
    </style>
</head>

<body>
    <!--Verlinkung zu der  Seite index und register-->
    <ul>
        <li><a href="index.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>

    <div id="div_ueberschrift">
            <h1>Login</h1>
    </div>

    <form method="POST" action="">
        <div id="div_hauptfenster">
            <!--Hier sind die Felder wo man sich anmelden muss-->
            <input type="text" name="username" placeholder="Benutzername" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 100px; width: 70%; height: 30px; background-color: white; color: #6E7B8B">

            <input type="password" name="passwort" placeholder="Passwort" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 100px; width: 70%; height: 30px; background-color: white; color: #6E7B8B">

        </div>
        <!--das ist der Button um die Daten zu senden die man in die Textfelder geschrieben hat-->
        <button type="submit" style="border: 1px solid white;">Anmelden</button>
    </form>
</html>
