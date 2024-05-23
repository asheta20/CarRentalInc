<?php
//save button that appears when we click edit in userinformation.php, makes sure that the changes are saved in database
$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"])) {
    $userId = $_POST["id"];
    $newName = $_POST["name"];
    $newSurname = $_POST["surname"];
    $newUsername = $_POST["username"];
    $newEmail = $_POST["email"];

    // Update the user's information in the database
    $sql = "UPDATE user SET name = ?, surname = ?, username = ?, email = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $newName, $newSurname, $newUsername, $newEmail, $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User information updated successfully.";
    } else {
        echo "User not found or information could not be updated.";
    }
} else {
    echo "Invalid request.";
}
?>
