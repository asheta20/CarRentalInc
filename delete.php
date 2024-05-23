<?php
//delte function on admin page
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $userId = $_POST["id"];

    // Delete the user from the database based on the provided ID
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User deleted successfully.";
    } else {
        echo "User not found or could not be deleted.";
    }
} else {
    echo "Invalid request.";
}
?>
