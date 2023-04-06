<?php
$dbconn = pg_connect("host=localhost password=new_password user=postgres port=5432 dbname=EsempioConnessionePHP") or
    die("Errore di connessione" . pg_last_error());
?>