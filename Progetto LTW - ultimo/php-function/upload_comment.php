<?php 
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$testo = $_POST['testo'];
$id = $_POST['id'];
$utente = $_POST['utente'];

$query = 'INSERT INTO commento (testo, utente, id_articolo) values ($1, $2, $3);';
$result = pg_query_params($dbconn, $query, array($testo,$utente,$id));



$q = 'SELECT * FROM commento_con_foto_utente where testo=$1 and utente=$2 and id_articolo=$3;';
$res = pg_query_params($dbconn, $q, array($testo,$utente,$id));

if($line = pg_fetch_array($res,null,PGSQL_ASSOC)){
    $data = $line["data"];
    $ora = $line["ora"];
    $foto_utente = $line["foto_profilo"];
    $foto_utente = (pg_unescape_bytea($foto_utente));
    $username = $line["username"];
    $id_com = $line["id"];
}
else{
    echo "ERROR RETRIEVING YOUR COMMENT";
    exit;
}

pg_close($dbconn);



print json_encode(array($testo,$username,$data,$ora,$foto_utente,$id_com));

?>