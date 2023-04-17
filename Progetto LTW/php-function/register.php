<?php
include "./connection.php";
$email = $_POST["inputEmail"];
$query = "SELECT * from utente where email=$1;"; //Lo si fa per motivi di sicurezza. Con query_params sostituiamo ad 1 il valore corretto.
$result = pg_query_params($dbconn, $query, array($email));
if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $message_error = "L'indirizzo email è già stato utilizzato.";
    echo json_encode(array("error" => $message_error));
    pg_close($dbconn);
    return;
} else {
    $query2 = "INSERT INTO utente(nome,cognome,username,email,password,foto_profilo) VALUES($1,$2,$3,$4,$5,$6);";
    $nome = $_POST["inputName"];
    $cognome = $_POST["inputCognome"];
    $password = $_POST["inputPassword"];
    $username = $_POST["inputUsername"];
    $result = @pg_query_params($dbconn, $query2, array($nome, $cognome, $username, $email, $password, base64_encode(file_get_contents("../images/icona-utente.jpg"))));
    if ($result) {
        session_start();
        $_SESSION["loggedinusers"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $username;
        $_SESSION["foto_profilo"] = base64_encode(file_get_contents("../images/icona-utente.jpg"));
        $message_success = "SUCCESS";
        echo json_encode(array("success" => $message_success));
        pg_close($dbconn);
        return;
    } else {
        $message_error = "Username già esistente";
        echo json_encode(array("error" => $message_error));
    }
}
pg_close($dbconn);

?>