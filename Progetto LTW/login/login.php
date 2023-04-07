<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../login.html");
}
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
        $query2 = "SELECT * from utente where email=$1 and pass=$2;";
        $password = $_POST["inputPassword"];
        $result = pg_query_params($dbconn, $query2, array($email, $password));
        if ($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            session_start();
            $_SESSION["loggedinusers"] = true;
            $nome = $tuple["nome"];
            $_SESSION["name"] = $nome;
            $cognome = $tuple["cognome"];
            $_SESSION["cognome"] = $cognome;
            $_SESSION["email"] = $email;
            $citta = $tuple["citta"];
            $_SESSION["citta"] = $citta;
            $username = $tuple["username"];
            $_SESSION["username"] = $username;
            $nazione = $tuple["nazione"];
            $_SESSION["nazione"] = $nazione;
            $eta = $tuple["eta"];
            $_SESSION["eta"] = $eta;
            $follower = $tuple["follower"];
            $_SESSION["follower"] = $follower;
            $likes = $tuple["likes"];
            $_SESSION["likes"] = $likes;
            $articles = $tuple["articles"];
            $_SESSION["articles"] = $articles;
            header("Location:../YourProfile.php");
        } else {
            echo $password . "La password non è corretta. Clicca <a href=\"../login.html\">qui </a> per riprovare";
        }
    } else {
        echo $email . "L'indirizzo email non appartiene a nessun utente registrato. Clicca <a href=\"../login.html\">qui </a> per registrarti";
    }
    pg_close($dbconn);
    ?>
</body>

</html>