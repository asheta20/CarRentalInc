<?php
// When the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the email and inquiry fields are provided
    if (isset($_POST["email"]) && isset($_POST["inquiry"])) {
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "erisat123";
        $dbname = "carrental_db";

        // Create a new connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO inquiries (email, category, inquiry, File) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $category, $inquiry, $fileData);

        // Assign the values from the form inputs
        $email = $_POST["email"];
        $inquiry = $_POST["inquiry"];
        $category = $_POST["category"];

        $fileData = null; // Default value for file data

        // Check if a file is uploaded
        if (isset($_FILES["attachment"]) && $_FILES["attachment"]["error"] === UPLOAD_ERR_OK) {
            $fileData = file_get_contents($_FILES["attachment"]["tmp_name"]);
        }

        // Execute the statement
        $stmt->execute();

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        header("Location: index.php");
    } else {
        echo "Email and inquiry fields are required.";
    }
}
?>
