<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
</head>

<body>
    <?php
    $email = $_POST["inputEmail"];
    $query = "SELECT * from utente where email=$1;"; //Lo si fa per motivi di sicurezza. Con query_params sostituiamo ad 1 il valore corretto.
    $result = pg_query_params($dbconn, $query, array($email));
    if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "L'indirizzo email è già stato utilizzato. Clicca <a href=\"../login.html\">qui</a> per loggarti, altrimenti usa un altro indirizzo.";
    } else {
        $query2 = "INSERT INTO utente(nome,cognome,username,email,password,foto_profilo) VALUES($1,$2,$3,$4,$5,$6);";
        $nome = $_POST["inputName"];
        $cognome = $_POST["inputCognome"];
        $password = $_POST["inputPassword"];
        $username = $_POST["inputUsername"];
        $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $username, $email, $password,base64_encode(file_get_contents("../images/icona-utente.jpg"))));
        if ($result) {
            session_start();
            $_SESSION["loggedinusers"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $username;
            header("Location:../YourProfile.php");
        } else {
            die("La registrazione non è andata a buon fine.");
        }
    }
    pg_close($dbconn);

    ?>
</body>

</html>