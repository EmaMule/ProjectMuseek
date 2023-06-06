<?php
//DEVELOPMENT DI UPDATE LIKES è UFFICIALMENTE FINITO.
// SE L'UTENTE PREME IL LIKE BUTTON E HA GIA MESSO LIKE, LO TOGLIE.
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$type = $_POST['type'];
$id = $_POST['id'];
$autore = $_POST['autore'];
$utente = $_POST['utente'];

$incdec = 1;
//query per capire se aumentare o decrementare like

$query = "SELECT * from likes where utente=$1 and articolo=$2 and autore=$3;";
$result = pg_query_params($dbconn, $query, array($utente, $id, $autore));

if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $query = "DELETE FROM likes WHERE utente=$1 and articolo=$2 and autore=$3;";
    $result = pg_query_params($dbconn, $query, array($utente, $id, $autore));
    //IL CONTANTORE LIKE SULLA PAGINA DEVE ESSERE -1 SE FACCIAMO UNA DELETE
    $incdec = -1;
} else {
    if ($type == 'like') {
        $query = "INSERT INTO likes (utente, articolo, autore) values ($1,$2,$3);";
        $result = pg_query_params($dbconn, $query, array($utente, $id, $autore));
    } else {
        echo "Unexpected error occurred!";
        exit;
    }
}

pg_close($dbconn);

echo json_encode($incdec);
?>