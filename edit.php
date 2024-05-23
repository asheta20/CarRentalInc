<?php
// Check if the request has an ID parameter and other required fields
if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"])) {
    $userId = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $email = $_POST["email"];


    $mysqli = new mysqli("localhost", "root", "erisat123", "carrental_db");

    // Check for any database connection errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare an UPDATE query to update the user information
    $query = "UPDATE user SET name = '$name', surname = '$surname', username = '$username', email = '$email' WHERE id = $userId";
    
    // Execute the query
    if ($mysqli->query($query) === TRUE) {
        // Return a success message
        echo "User information updated successfully.";
    } else {
        // Return an error message
        echo "Error updating user information: " . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
} else {
    // Invalid request
    echo "Invalid request.";
}
?>