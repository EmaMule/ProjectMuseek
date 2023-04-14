<?php 
//DEVELOPMENT DI UPDATE LIKES è UFFICIALMENTE FINITO. NON
// SE L'UTENTE PREME IL LIKE BUTTON E HA GIA MESSO LIKE, LO TOGLIE.
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$type = $_POST['type'];
$autore = $_POST['autore'];
$utente = $_POST['utente'];

//query per capire se aumentare o decrementare like: QUA NON LA USO; MENO ROBUSTO SICURAMENTE!

if($type=='Following'){
    $query = "DELETE FROM follow WHERE segue=$1 and seguito=$2;";
    $result = pg_query_params($dbconn, $query, array($utente, $autore));
}
else{
    //controllo inutile, rimasuglio di un tutorial indiano :)
    $query = "INSERT INTO follow values ($1,$2);";
    $result = pg_query_params($dbconn, $query, array($utente,$autore));
}

pg_close($dbconn);

echo $type=='Following'? 'Follow': 'Following';
?>