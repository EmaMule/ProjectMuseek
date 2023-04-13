<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../php-pagine/login.php");
}
?>
<?php
session_start();
session_unset();
session_destroy();
echo json_encode(array("success"=>"SUCCESSO"));
?>