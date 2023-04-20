<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";
$email = $_POST["inputEmail"];
$password = $_POST["inputPassword"];
$query = "SELECT * from utente where email=$1;"; //Lo si fa per motivi di sicurezza. Con query_params sostituiamo ad 1 il valore corretto.
$result = pg_query_params($dbconn, $query, array($email));

if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    if ($line["password"] != $password) {
        $message_error = "La password non è corretta.";
        echo json_encode(array("error" => $message_error));
        pg_close($dbconn);
        return;
    } else {
        session_start();
        $_SESSION["loggedinusers"] = true;
        $_SESSION["email"] = $email;
        $username = $line["username"];
        $_SESSION["username"] = $username;
        $message_success = "SUCCESS";
        $_SESSION["foto_profilo"] = pg_unescape_bytea($line["foto_profilo"]);
        echo json_encode(array("success" => $message_success));

    }

} else {
    $message_error = "L'indirizzo email non appartiene a nessun utente registrato.";
    echo json_encode(array("error" => $message_error));
    pg_close($dbconn);
    return;

}
pg_close($dbconn);
?>