<?php 
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
include "./connection.php";

$id_com = $_POST['id_com'];

$query = 'DELETE FROM commento where id=$1;';

$result = pg_query_params($dbconn, $query, array($id_com));

pg_close($dbconn);

echo "OK";


?>