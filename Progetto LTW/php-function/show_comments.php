<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$indice = $_SESSION['indice-commenti'];
$id = $_POST['id'];

$indice = ($indice-1) * 10 + 3; //calcolo offset, primi 3 commenti già scritti

$query = 'SELECT * from commento_con_foto_utente where id_articolo = $1
    order by id DESC
    offset $2 
    fetch first 10 row only;';



$result = pg_query_params($dbconn, $query, array($id,$indice));

$array_comments = array();
while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
    $data = $line["data"];
    $ora = $line["ora"];
    $foto_utente = $line["foto_profilo"];
    $foto_utente = (pg_unescape_bytea($foto_utente));
    $username = $line["username"];
    $testo = $line["testo"];
    $id_com = $line["id"];

    $commento = array(  "username" => $username, 
                        "foto_utente"=>$foto_utente, 
                        "testo"=>$testo, 
                        "data"=>$data, 
                        "ora"=>$ora,
                        "id_com"=>$id_com);
    array_push($array_comments, $commento);

}

pg_close($dbconn);

$_SESSION['indice-commenti'] += 1;

print json_encode($array_comments);



?>