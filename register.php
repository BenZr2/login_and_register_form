<?php
        #Anmeldedaten für die MySQL Datenbank
        $servername = "192.168.200.3";
        $username = "web";
        $password = "dj39dn6j2";
        $dbname = "website";
        #Verbindungsaufbau zur MySQL Datenbank
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        #Mit dieser If-Abfrage wird gecheckt ob die Verbindung zur   Datenbank fehlgeschlagen ist. Trifft dies zu wird eine Fehlermeldung ausgegeben.
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        #Diese If-Abfrage überprüft ob auf der Website Daten über das Feld mit dem Namen "username" gesendet wurden, wenn dies so ist, wird der eingerückte Code ausgeführt.
        if (isset($_POST['username'])) {
            #Hier wird ein SQL Insert Befehl aufgebaut, jedoch fehlen noch die Werte, die eingetragen werden sollen
            $sql_insert = $conn->prepare("INSERT INTO user (username, passwort) VALUES (?,?)");
			#In dieser Variable wird das Passwort noch mal extra gespeichert und gehasht
			$passwort=hash('sha256',$_POST['passwort'] ) ;
			#Hier werden nun die Variablen (vom Benutzer eingegebenen Registrierungsdaten) an den oberen SQL-Insert Befehl übergeben.
            $sql_insert->bind_param("ss", $_POST['username'],$passwort);
            #Hier wird überprüft, ob sich der Benutzer bereits registriert hat, wenn ja kommt eine Meldung die mitteilt, dass man schon registriert ist.
            $sql_select = "SELECT username, passwort FROM user";
            $result = $conn->query($sql_select);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($_POST['username'] == $row["username"]) {
                        echo "Sie sind bereits registriert";
                        sleep(1);
                        return;
                    }
                }
                #Hier wird der "SQL-Insert Befehl ausgeführt, wenn die Daten erfolgreich in die Datenbank übertragen wurden, kommt eine Meldung, die dies bestätigt.
            if ($sql_insert->execute() === TRUE) {
                sleep(1);
                header("Location: index.php");
                return;
                #Bei einem Fehler der Datenübertragung kommt eine Fehlermeldung
            } else {
                echo "Fehler bei der Registrierung: " . $sql_insert . "<br>" . $conn->error;
            }
        } 
            
            $conn->close();
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <!--Einbindung des Hintergrundbildes der Website-->
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
		        padding-bottom: 2%;
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
    <!--Erstellen der Navigationsleiste-->
    <ul>
        <li><a href="index.php">Login</a></li>
        <li><a href="register.php">Registrierung</a></li>
    </ul>
    <!--Erstellen des Containers für die Überschrift-->
    <div id="div_ueberschrift">
            <h1>Registrierung</h1>
    </div>
    <!--Erstellen des Hauptfensters mit den Eingabefeldern für Benutzername und Passwort-->
    <form method="POST" action="">
        <div id="div_hauptfenster">

            <input type="text" name="username" placeholder="Benutzername" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 70px; width: 70%; height: 30px; background-color: white; color: #6E7B8B">

            <input type="password" name="passwort" placeholder="Passwort" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 70px; width: 70%; height: 30px; background-color: white; color: #6E7B8B">

            <input type="password" name="passwort" placeholder="Passwort wiederholen" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 70px; width: 70%; height: 30px; background-color: white; color: #6E7B8B">

        </div>
        <!--Erstellen des Buttons der die Daten überträgt-->
        <button type="submit" style="border: 1px solid white;">Registrieren</button>

    </form>

</body>
</html>
