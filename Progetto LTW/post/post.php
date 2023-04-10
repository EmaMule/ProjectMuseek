<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../login.html");
}
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
</head>

<body>
    <?php
    function is_valid_url($url) {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
    session_start();
    $fonti = array();
    $has_error = false;
    
    foreach ($_POST as $name => $value) {
        if (strpos($name, 'input-Fonte') !== false) {
            if(!is_valid_url($value)){
                $has_error = true;
                break;
            }
            else{
                array_push($fonti,$value);
            }
        }
    }

    if ($has_error) {
        ob_start(); // attiva l'output buffering
        header("Location: ./post_error.php"); // reindirizza l'utente alla pagina di errore
        ob_end_flush(); // invia l'output al browser e disattiva l'output buffering
        exit(); // interrompi l'esecuzione dello script
    }
    
    $email = $_SESSION["email"];
    $titolo = $_POST["inputTitle"];
    $descrizione = $_POST["inputDescription"];
    $image = file_get_contents($_FILES['inputImage']['tmp_name']);
    $query = "INSERT INTO articolo (utente,titolo,descrizione) VALUES ($1,$2,$3) RETURNING id";
    $result = pg_query_params($dbconn, $query, array($email, $titolo, $descrizione));
    $inserted_row = pg_fetch_assoc($result);
    $query2= "INSERT INTO media_articolo VALUES($1,$2,$3,$4,$5)";
    $result2=pg_query_params($dbconn,$query2,array($inserted_row["id"],$_FILES["inputImage"]["name"],$_FILES["inputImage"]["size"],$_FILES["inputImage"]["type"],base64_encode($image)));
    $query3="INSERT INTO fonte VALUES($1,$2)";
    foreach($fonti as $fonte){
        pg_query_params($dbconn, $query3, array($inserted_row["id"],$fonte));
    }
    if ($result2) {
        echo "Inserimento Corretto";
        /*$base64_image = base64_encode($image);
        ?>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo $base64_image; ?>" />
        <?php */
    } else {
        echo "Inserimento sbagliato";
    }
    pg_close($dbconn);
    ?>
</body>

</html>