<?php
// Database connection
$mysqli = require __DIR__ . "/database.php";

// Search query
$search_query = $_GET["full_name"] ?? "";
$sql = "SELECT * FROM bookings WHERE full_name LIKE '%$search_query%'";
$result = $mysqli->query($sql);

$searchResults = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}

header("Content-Type: application/json");
echo json_encode($searchResults);
