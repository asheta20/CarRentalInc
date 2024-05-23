<?php
session_start();

$log = "";

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    $log = date("Y-m-d H:i:s") . " - User logged in/Home page : {$user["name"]} (ID: {$_SESSION["user_id"]})\n";
}

if (!empty($log)) {
    file_put_contents("logs.txt", $log, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="icon" type="image/png" href="images/faviconnn.png">
    <link rel="stylesheet" href="navigationBar.css">
    <style>
        body {
            background-image: url('images/background2.0.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-family: 'Roboto Condensed', sans-serif;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        h1 {
            text-align: center;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #af5b4c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #5e5b5b;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            background-color: #af5b4c;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #af3b2c;
        }
    </style>
</head>
<body>
    <ul>
        <li class="left"><a href="admin"><img src="images/icon3.0.png" width="60px" height="20px"></a></li>
        <li class="center"><a href="userInformation">User Info</a></li>
        <li class="center"><a href="inquiries">Inquiries</a></li>
        <li class="center"><a href="bookings">Bookings</a></li>

        <li class="dropdown right">
            <?php if (isset($user)): ?>
                <div class="dropdown-container">
                    <a class="dropbtn" href="#">
                        <?= htmlspecialchars($user["name"]) ?>
                    </a>
                    <div class="dropdown-content">
                        <a href="logout" class="logout-link">Log out</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login">Log in</a>
            <?php endif; ?>
        </li>
    </ul>
    <h1>Booking List</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Car Option</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Additional Info</th>
            <th>Image</th>
            <?php if (isset($user) && $user["email"] === "TechSupport@yahoo.com"): ?>
                <th>Edit</th>
                <th>Delete</th>
            <?php endif; ?>
        </tr>
        <!-- Display bookings from the database -->
        <?php
        $mysqli = require __DIR__ . "/database.php";
        $sql = "SELECT * FROM bookings";
        $result = $mysqli->query($sql);

        if (!$result) {
            die("Query error: " . $mysqli->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr data-id="<?php echo $row["id"]; ?>">
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["full_name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["car_option"]; ?></td>
                    <td><?php echo $row["start_date"]; ?></td>
                    <td><?php echo $row["end_date"]; ?></td>
                    <td><?php echo $row["additional_info"]; ?></td>
                    <td>
                        <?php if (!empty($row["attachment"])): ?>
                            <img src="data:image/png;base64,<?php echo base64_encode($row["attachment"]); ?>" alt="Image" width="350" height="200">
                        <?php else: ?>
                            No image attached
                        <?php endif; ?>
                    </td>
                    <?php if (isset($user) && $user["email"] === "TechSupport@yahoo.com"): ?>
                        <td>
                            <button class="edit-button btn" data-id="<?php echo $row["id"]; ?>">Edit</button>
                        </td>
                        <td>
                            <button class="delete-button btn" data-id="<?php echo $row["id"]; ?>">Delete</button>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php
            }
        } else {
            echo "No bookings found.";
        }
        ?>
    </table>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Edit button click event
        $("table").on("click", ".edit-button", function() {
            var bookingId = $(this).data("id");

            // Find the table row containing the booking information
            var $row = $(this).closest("tr");

            // Find the table cells within the row
            var $nameCell = $row.find("td:nth-child(2)");
            var $emailCell = $row.find("td:nth-child(3)");
            var $carOptionCell = $row.find("td:nth-child(4)");
            var $startDateCell = $row.find("td:nth-child(5)");
            var $endDateCell = $row.find("td:nth-child(6)");
            var $additionalInfoCell = $row.find("td:nth-child(7)");

            // Get the current values from the table cells
            var name = $nameCell.text();
            var email = $emailCell.text();
            var carOption = $carOptionCell.text();
            var startDate = $startDateCell.text();
            var endDate = $endDateCell.text();
            var additionalInfo = $additionalInfoCell.text();

            // Replace the table cells with input fields
            $nameCell.html('<input type="text" value="' + name + '">');
            $emailCell.html('<input type="text" value="' + email + '">');
            $carOptionCell.html('<input type="text" value="' + carOption + '">');
            $startDateCell.html('<input type="text" value="' + startDate + '">');
            $endDateCell.html('<input type="text" value="' + endDate + '">');
            $additionalInfoCell.html('<input type="text" value="' + additionalInfo + '">');

            // Create a Save button
            var $saveButton = $('<button class="save-button btn" data-id="' + bookingId + '">Save</button>');

            // Find the Delete button within the row
            var $deleteButton = $row.find(".delete-button");

            // Replace the Edit button with the Save button
            $(this).replaceWith($saveButton);

            // Remove the Delete button
            $deleteButton.remove();

            // Save button click event
            $saveButton.click(function() {
                // Get the edited values from the input fields
                var editedName = $nameCell.find("input").val();
                var editedEmail = $emailCell.find("input").val();
                var editedCarOption = $carOptionCell.find("input").val();
                var editedStartDate = $startDateCell.find("input").val();
                var editedEndDate = $endDateCell.find("input").val();
                var editedAdditionalInfo = $additionalInfoCell.find("input").val();

                // Make AJAX request to editBooking.php with the edited booking information
                $.ajax({
                    url: "editBooking.php",
                    method: "POST",
                    data: {
                        id: bookingId,
                        name: editedName,
                        email: editedEmail,
                        car_option: editedCarOption,
                        start_date: editedStartDate,
                        end_date: editedEndDate,
                        additional_info: editedAdditionalInfo
                    },
                    success: function(response) {
                        // Replace the input fields with the edited values
                        $nameCell.text(editedName);
                        $emailCell.text(editedEmail);
                        $carOptionCell.text(editedCarOption);
                        $startDateCell.text(editedStartDate);
                        $endDateCell.text(editedEndDate);
                        $additionalInfoCell.text(editedAdditionalInfo);

                        // Replace the Save button with the Edit button
                        $saveButton.replaceWith('<button class="edit-button btn" data-id="' + bookingId + '">Edit</button>');

                        // Add the Delete button back
                        $row.find("td:last-child").append('<button class="delete-button btn" data-id="' + bookingId + '">Delete</button>');
                    },
                    error: function() {
                        alert("Failed to save changes.");
                    }
                });
            });
        });

        // Delete button click event (using event delegation)
        $("table").on("click", ".delete-button", function() {
            var bookingId = $(this).data("id");

            // Find the table row containing the booking information
            var $row = $(this).closest("tr");

            // Confirm the deletion
            if (confirm("Are you sure you want to delete this booking?")) {
                // Make AJAX request to deleteBooking.php with the booking ID
                $.ajax({
                    url: "deleteBooking.php",
                    method: "POST",
                    data: { id: bookingId },
                    success: function(response) {
                        // Remove the table row
                        $row.remove();
                    },
                    error: function() {
                        alert("Failed to delete booking.");
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
