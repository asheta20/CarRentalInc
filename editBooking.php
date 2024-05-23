<?php
// editBooking.php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $mysqli->real_escape_string($_POST["id"]);
        $name = $mysqli->real_escape_string($_POST["name"]);
        $email = $mysqli->real_escape_string($_POST["email"]);
        $car_option = $mysqli->real_escape_string($_POST["car_option"]);
        $start_date = $mysqli->real_escape_string($_POST["start_date"]);
        $end_date = $mysqli->real_escape_string($_POST["end_date"]);
        $additional_info = $mysqli->real_escape_string($_POST["additional_info"]);

        $sql = "UPDATE bookings SET full_name = ?, email = ?, car_option = ?, start_date = ?, end_date = ?, additional_info = ? WHERE id = ?";

        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            http_response_code(500);
            echo "Failed to prepare statement.";
            exit;
        }

        $stmt->bind_param("ssssssi", $name, $email, $car_option, $start_date, $end_date, $additional_info, $id);

        if ($stmt->execute()) {
            echo "Booking updated successfully.";
        } else {
            http_response_code(500);
            echo "Failed to update booking.";
        }

        $stmt->close();
    }
} else {
    http_response_code(403);
    echo "Unauthorized access.";
}
?>
