<?php 
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$id = $_POST['id'];

$query = 'DELETE FROM articolo where id=$1;';

$result = pg_query_params($dbconn, $query, array($id));

if(!$result){
    echo 'There was an error during elimination of article!';
}

pg_close($dbconn);

echo "SUCCESS";


?>