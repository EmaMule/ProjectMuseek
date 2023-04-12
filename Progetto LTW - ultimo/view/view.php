<?php

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
    $query = "SELECT * FROM articolo";
    $result = pg_query($dbconn, $query);
    if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "SONO DENTRO";
        $img = pg_unescape_bytea($line["foto"]);
        ?>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo ($img); ?>" />
        <?php
    }
    pg_close($dbconn);
    ?>
</body>

</html>