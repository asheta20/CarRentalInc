<?php
// deleteBooking.php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $mysqli->real_escape_string($_POST["id"]);

        $sql = "DELETE FROM bookings WHERE id = ?";

        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            http_response_code(500);
            echo "Failed to prepare statement.";
            exit;
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Booking deleted successfully.";
        } else {
            http_response_code(500);
            echo "Failed to delete booking.";
        }

        $stmt->close();
    }
} else {
    http_response_code(403);
    echo "Unauthorized access.";
}
?>
