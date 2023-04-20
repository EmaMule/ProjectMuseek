<?php 
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$type = $_POST['type'];
$autore = $_POST['autore'];
$utente = $_POST['utente'];



if($type=='Following'){
    $query = "DELETE FROM follow WHERE segue=$1 and seguito=$2;";
    $result = pg_query_params($dbconn, $query, array($utente, $autore));
}
else{

    $query = "INSERT INTO follow values ($1,$2);";
    $result = pg_query_params($dbconn, $query, array($utente,$autore));
}

pg_close($dbconn);

echo $type=='Following'? 'Follow': 'Following';
?>