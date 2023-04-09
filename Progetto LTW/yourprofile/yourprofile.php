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
    if (!($line = pg_fetch_array($result, null, PGSQL_ASSOC))) {
        echo "L'indirizzo email non esiste. Clicca <a href=\"../login.html\">qui</a> per loggarti, altrimenti usa un altro indirizzo.";
    } else {
        $vecchiousername = $line["username"];
        $query2 = "UPDATE utente SET nome=$1, cognome=$2, citta=$3, nazione=$4, username=$5, foto_profilo=$6 WHERE email=$7;";
        $nome = $_POST["inputName"];
        $cognome = $_POST["inputCognome"];
        $citta = $_POST["inputCitta"];
        $nazione = $_POST["inputNazione"];
        $username = $_POST["inputUsername"];
        if (isset($_FILES['inputImage']['tmp_name']) && is_uploaded_file($_FILES['inputImage']['tmp_name'])) {
            $image = file_get_contents($_FILES['inputImage']['tmp_name']);
        } else {
            $image = base64_decode(pg_unescape_bytea($line["foto_profilo"])); //qua ho fatto una scelta per cui faccio update di foto anche quando l'utente non la cambia, possibilmente costoso inoltre riferimento per immagini
        }
        if ($vecchiousername == $username) {
            $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $citta, $nazione, $username, base64_encode($image), $email));
        } else {
            $query3 = "SELECT * from utente where username=$1;";
            $result_1 = pg_query_params($dbconn, $query3, array($username));
            if (($linea = pg_fetch_array($result_1, null, PGSQL_ASSOC))) {
                echo "Username già usato Clicca <a href=\"../YourProfile.php\">qui </a> per riprovare";
                return;
            } else {
                $result = pg_query_params($dbconn, $query2, array($nome, $cognome, $citta, $nazione, $username, $email, base64_encode($image)));
            }
        }
        header("Location:../YourProfile.php");
    }
    pg_close($dbconn);

    ?>
</body>

</html>