<?php //ATTENZIONE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! C'E UNA COPIA DA GESTIRE ANCHE NELLA CARTELLA POST!!!
include "./connection.php";
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
// get the q parameter from URL
$q = $_REQUEST["q"];

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
}


// Output the results in JSON format
echo json_encode($results);
?>