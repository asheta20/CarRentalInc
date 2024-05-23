<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    $log = date("Y-m-d H:i:s") . " - User logged out: {$user["name"]} (ID: {$_SESSION["user_id"]})\n";
    file_put_contents("logs.txt", $log, FILE_APPEND);
}

// Clear the session data
$_SESSION = [];
session_destroy();

// Redirect to the login page
header("Location: index");
exit;
?>
