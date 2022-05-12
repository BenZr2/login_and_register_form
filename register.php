<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="passwort" placeholder="Passwort">
        <input type="password" name="passwort" placeholder="Repeat Passwort">
        <button type="submit">Anmelden</button>

        <div>
            <p><a href="login.php">Login</a></p>
        </div>
    </form>


    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "website";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['username'])) {
            $sql_insert = $conn->prepare("INSERT INTO user (username, passwort) VALUES (?,?)");
            $sql_insert->bind_param("ss", $_POST['username'], $_POST['passwort']);
            
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
    
    
</body>
</html>