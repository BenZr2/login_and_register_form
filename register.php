<?php
        $servername = "192.168.200.3";
        $username = "web";
        $password = "dj39dn6j2";
        $dbname = "website";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['username'])) {
            $sql_insert = $conn->prepare("INSERT INTO user (username, passwort) VALUES (?,?)");
			
			$passwort=hash('sha256',$_POST['passwort'] ) ;
			
			
			
            $sql_insert->bind_param("ss", $_POST['username'],$passwort);
            
            $sql_select = "SELECT username, passwort FROM user";
            $result = $conn->query($sql_select);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    #echo "Username: " . $row["username"]. "| Passwort: " . $row["passwort"]. "<br>";
                    if ($_POST['username'] == $row["username"]) {
                        echo "Sie sind bereits registriert";
                        sleep(1);
                        return;
                    }
                }

            if ($sql_insert->execute() === TRUE) {
                echo "Erfolgreich registriert" . "<br>";
		sleep(1);
                return;

            } else {
                echo "Fehler bei der Registrierung: " . $sql_insert . "<br>" . $conn->error;
            }
        } 
            
            
            $sql_select = "SELECT username, passwort FROM user";
            $result = $conn->query($sql_select);
            
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<br>" . "Username: " . $row["username"]. " | Passwort: " . $row["passwort"]. "<br>";
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
    <title>Document</title>

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

    <ul>
        <li><a href="index.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>

    <div id="div_ueberschrift">
            <h1>Register</h1>
    </div>

    <form method="POST" action="">
        <div id="div_hauptfenster">

            <input type="text" name="username" placeholder="Benutzername" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 70px; width: 400px; height: 30px; background-color: white; color: #6E7B8B">

            <input type="password" name="passwort" placeholder="Passwort" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 70px; width: 400px; height: 30px; background-color: white; color: #6E7B8B">

            <input type="password" name="passwort" placeholder="Passwort wiederholen" style="border-radius: 2px; border: 1px solid black; text-align: center; margin-top: 70px; width: 400px; height: 30px; background-color: white; color: #6E7B8B">

        </div>

        <button type="submit" style="border: 1px solid white;">Registrieren</button>

    </form>

</body>
</html>
