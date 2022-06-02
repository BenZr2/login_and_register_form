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

        if (isset($_POST['username'])) {
            $sql = "SELECT username, passwort FROM user";
            $result = $conn->query($sql);

                        $passwort = hash('sha256',$_POST['passwort']);


            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    #echo "Username: " . $row["username"]. "| Passwort: " . $row["passwort"]. "<br>";



                    if ($_POST['username'] == $row["username"] && $passwort == $row["passwort"]) {
                        #echo "Erfolgreich angemeldet";
                        header("Location: index.php");
                        exit();
                    }
                }
            }
            echo "Falscher Benutzername oder falsches Passwort";
            $conn->close();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="passwort" placeholder="Passwort">
        <button type="submit">Anmelden</button>
    </form>

<p><a href="register.php">Register</a></p>
</html>
