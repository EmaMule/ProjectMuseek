<?php //ATTENZIONE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! C'E UNA COPIA DA GESTIRE ANCHE NELLA CARTELLA POST!!!
include "./connection.php";

$q = $_REQUEST["q"];
$id_articolo=$_REQUEST["id_articolo"];

$query = "SELECT * from articolo join media_articolo on id=id_articolo";
$result = pg_query($dbconn, $query);

if (!$result) {
    echo "An error has occurred whilst loading the articles!";
    exit;
}
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $titolo = $line["titolo"];
    $img = $line["contenuto"];
    $id = $line["id"];
    $articoli[] = array("id" => $id, "titolo" => $titolo, "immagine" => pg_unescape_bytea($img));
}
$query2 = "SELECT * from utente";
$result = pg_query($dbconn, $query2);
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $username = $line["username"];
    $img = $line["foto_profilo"];
    $articoli_utenti[] = array("username" => $username, "immagine" => pg_unescape_bytea($img));
}
$query3="SELECT * from commento join utente on utente.email=commento.utente where id_articolo=$1";
$result = pg_query_params($dbconn, $query3,array($id_articolo));
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $username=$line["username"];
    $img = $line["foto_profilo"];
    $descrizione=$line["testo"];
    $commento_id=$line["id"];
    $commenti_utenti[] = array("commento_id"=>$commento_id,"username"=>$username,"descrizione" => $descrizione, "immagine" => pg_unescape_bytea($img));
}

$results = array();
if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($articoli as $element) {
        if (strpos(strtolower($element["titolo"]), $q) !== false) {
            $results[] = array("id" => $element["id"], "titolo" => $element["titolo"], "immagine" => $element["immagine"]);
        }
    }
    foreach ($articoli_utenti as $element) {
        if (strpos(strtolower($element["username"]), $q) !== false) {
            $results[] = array("username" => $element["username"], "immagine" => $element["immagine"]);
        }
    }
    foreach ($commenti_utenti as $element) {
        if (strpos(strtolower($element["descrizione"]), $q) !== false) {
            $results[] = array("commento_id"=>$element["commento_id"],"user"=>$element["username"],"descrizione"=>$element["descrizione"],"immagine" => $element["immagine"]);
        }
    }
}


// Output the results in JSON format
echo json_encode($results);
?>