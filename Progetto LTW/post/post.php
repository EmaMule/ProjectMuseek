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
    session_start();
    $email = $_SESSION["email"];
    $titolo = $_POST["inputTitle"];
    $descrizione = $_POST["inputDescription"];
    $image = file_get_contents($_FILES['inputImage']['tmp_name']);
    $query = "INSERT INTO articolo VALUES ($1,$2,$3,$4,$5,$6,$7,$8)";
    $result = pg_query_params($dbconn, $query, array(1, $email, $titolo, $descrizione, $_FILES['inputImage']['name'], $_FILES['inputImage']['size'], base64_encode($image), "png"));
    if ($result) {
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