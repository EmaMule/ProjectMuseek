<?php
$dbconn = pg_connect("host=localhost password=postgres user=postgres port=5432 dbname=db_museek") or
    die("Errore di connessione" . pg_last_error());
?>