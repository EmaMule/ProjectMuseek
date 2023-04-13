<?php //ATTENZIONE C'è unA COPIA ESATTA NELLA CARTELLA POST
$dbconn = pg_connect("host=localhost password=new_password user=postgres port=5432 dbname=MusicNews") or
    die("Errore di connessione" . pg_last_error());
?>