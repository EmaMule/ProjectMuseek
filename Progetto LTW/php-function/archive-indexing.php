<?php
session_start();
include './connection.php';

$order = $_POST['direttiva'];

//A SECONDA DELLA DIRETTIVA SPECIFICATA SI CAMBIA L'INDEX

if($order == 'forward'){
    //PASSIAMO ALLA PROSSIMA PAGINA
    $_SESSION['indice-paginazione'] += 1;

    //CONTROLLIAMO SE SIAMO ARRIVATI TROPPO LONTANO CON L'INDICE
    $query_index = "SELECT count(*) as numArticoli from articolo;";
    $res_index = pg_query($dbconn, $query_index);
    $line = pg_fetch_array($res_index,null,PGSQL_ASSOC);

    //NON DOVREBBE MAI SUCCEDERE
    if(!$line){
        echo json_encode("UNEXPECTED ERROR!");
        pg_close($dbconn);
        return;
    }

    $end_index = round(intval($line['numarticoli'])/10, 0, PHP_ROUND_HALF_DOWN);

    if($_SESSION['indice-paginazione'] > $end_index){
        $_SESSION['indice-paginazione'] -= 1;
    }
    
}
else if($order == 'backward'){
    //TORNIAMO ALLA PAGINA PRECEDENTE
    $_SESSION['indice-paginazione'] -= 1;

    //SE SIAMO TORNATI ALLA PAGINA INIZIALE NON TORNIAMO PIÙ INDIETRO
    if($_SESSION['indice-paginazione'] == -1){
        $_SESSION['indice-paginazione'] = 0;
    }
}
else if($order == 'backward-backward'){
    //TORNIAMO ALLA PAGINA INIZIALE
    $_SESSION['indice-paginazione'] = 0;
}
else if($order == 'forward-forward'){
    //CALCOLIAMO L'ULTIMO INDICE DISPONIBILE
    $query_index = "SELECT count(*) as numArticoli from articolo;";
    $res_index = pg_query($dbconn, $query_index);

    $line = pg_fetch_array($res_index,null,PGSQL_ASSOC);

    //NON DOVREBBE MAI SUCCEDERE
    if(!$line){
        echo json_encode("UNEXPECTED ERROR!");
        pg_close($dbconn);
        return;
    }

    $index = round(intval($line['numarticoli'])/10, 0, PHP_ROUND_HALF_DOWN);
    $_SESSION['indice-paginazione'] = $index;



}
else{
    //NON DOVREBBE SUCCEDERE MAI
    echo json_encode("ERROR, INVALID DIRECTIVE!");
    pg_close($dbconn);
    return;
}

echo json_encode("SUCCESS");

pg_close($dbconn);
?>