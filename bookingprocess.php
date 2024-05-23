<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = require __DIR__ . "/database.php";

    $full_name = $mysqli->real_escape_string($_POST["full_name"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $car_option = $mysqli->real_escape_string($_POST["car_option"]);
    $start_date = $mysqli->real_escape_string($_POST["start_date"]);
    $end_date = $mysqli->real_escape_string($_POST["end_date"]);
    $additional_info = $mysqli->real_escape_string($_POST["additional_info"]);
    
    $attachment = null;
    if (!empty($_FILES["attachment"]["tmp_name"])) {
        $attachment = file_get_contents($_FILES["attachment"]["tmp_name"]);
    }

    // Check availability
    $availability_sql = "SELECT * FROM bookings WHERE car_option = ? AND (start_date <= ? AND end_date >= ?)";
    $stmt = $mysqli->prepare($availability_sql);
    $stmt->bind_param("sss", $car_option, $end_date, $start_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "The selected car is not available for the requested date range.";
    } else {
        $sql = "INSERT INTO bookings (full_name, email, car_option, start_date, end_date, additional_info, attachment) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssss", $full_name, $email, $car_option, $start_date, $end_date, $additional_info, $attachment);
        
        if ($stmt->execute()) {
            // Output a JavaScript script to redirect to the "news.php" page
            echo "<script>window.location.href = 'news.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $mysqli->close();
}
?>
