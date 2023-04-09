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
    $password = $_POST["inputPassword"];
    $query = "SELECT * from utente where email=$1;"; //Lo si fa per motivi di sicurezza. Con query_params sostituiamo ad 1 il valore corretto.
    $result = pg_query_params($dbconn, $query, array($email));

    if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        if ($line["password"] != $password) {
            $messaggio_errore = "Credenziali di accesso non valide. Riprova.";
            header("Location: ../Login.php?errore=" . urlencode($messaggio_errore));
            exit();
        } else {
            session_start();
            $_SESSION["loggedinusers"] = true;
            $_SESSION["email"] = $email;
            $username = $line["username"];
            $_SESSION["username"] = $username;
            header("Location:../YourProfile.php");
        }

    } else {
        $messaggio_errore = "Credenziali di accesso non valide. Riprova.";
        header("Location: ../Login.php?errore=" . urlencode($messaggio_errore));
        exit();
    }
    pg_close($dbconn);
    ?>
</body>

</html>