<?php
include "./connection.php";
$query = "SELECT * from articolo join media_articolo on id=id_articolo";
$result = pg_query($dbconn, $query);

if (!$result) {
    echo "An error has occurred whilst loading the articles!";
    exit;
}
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $titolo = $line["titolo"];
    $img=$line["contenuto"];
    $id=$line["id"];
    $articoli[] = array("id"=>$id,"titolo" => $titolo, "immagine" => pg_unescape_bytea($img));
}
// get the q parameter from URL
$q = $_REQUEST["q"];

$results = array();
// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($articoli as $element) {
        if (strpos(strtolower($element["titolo"]), $q) !== false) {
            if(count($results)<=7){
            $results[] =array("id"=>$element["id"],"titolo" => $element["titolo"], "immagine" => $element["immagine"]);
            }
            else{
                break;
            }

        }
    }
}

// Output the results in JSON format
echo json_encode($results);
?>