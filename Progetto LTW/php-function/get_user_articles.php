<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$email = $_POST['email'];
$index = $_SESSION['indice-articoli'];

$index = $index * 9;

//USO UNA VIEW SQL
$query = 'SELECT * FROM articolo_con_username_e_media
WHERE email=$1 
order by id DESC 
offset $2
fetch first 9 rows only;';

$result = pg_query_params($dbconn, $query, array($email,$index));

$array_articles = array();

while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
    //SELEZIONIAMO GLI ELEMENTI INTERESSANO DEGLI ARTICOLI

    $article = array(
        "id" => $line['id'],
        "titolo" => $line['titolo'],
        "descrizione" => $line['descrizione'],
        "data" => $line['data'],
        "media" => pg_unescape_bytea($line['contenuto'])
    );

    array_push($array_articles,$article);

}

pg_close($dbconn);

$_SESSION['indice-articoli'] += 1;

print json_encode($array_articles);

 ?>
