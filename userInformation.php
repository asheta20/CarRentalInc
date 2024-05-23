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
    <title>User Info</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="navigationBar.css">
    <style>
        body {
            background-image: url('images/background2.0.png');
            /* Additional CSS properties for the background */
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
    </style>
</head>
<body>
    <ul>
        <li class="left"><a href="admin"><img src="images/icon3.0.png" width="70px" height="15px"></a></li>
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
    <h1>User Information</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
        $mysqli = require __DIR__ . "/database.php";
        $sql = "SELECT * FROM user";
        $result = $mysqli->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Skip displaying the admin user
                if ($row["email"] === "admin@gmail.com") {
                    continue;
                }
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["surname"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><button class="edit-button" data-id="<?php echo $row["id"]; ?>">Edit</button></td>
                    <td><button class="delete-button" data-id="<?php echo $row["id"]; ?>">Delete</button></td>
                </tr>
                <?php
            }
        } else {
            echo "No users found.";
        }
        ?>

    </table>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Edit button click event (using event delegation)
       // Edit button click event (using event delegation)
$("table").on("click", ".edit-button", function() {
    var userId = $(this).data("id");

    // Find the table row containing the user information
    var $row = $(this).closest("tr");

    // Find the table cells within the row
    var $nameCell = $row.find("td:nth-child(2)");
    var $surnameCell = $row.find("td:nth-child(3)");
    var $usernameCell = $row.find("td:nth-child(4)");
    var $emailCell = $row.find("td:nth-child(5)");

    // Get the current values from the table cells
    var name = $nameCell.text();
    var surname = $surnameCell.text();
    var username = $usernameCell.text();
    var email = $emailCell.text();

    // Replace the table cells with input fields
    $nameCell.html('<input type="text" value="' + name + '">');
    $surnameCell.html('<input type="text" value="' + surname + '">');
    $usernameCell.html('<input type="text" value="' + username + '">');
    $emailCell.html('<input type="text" value="' + email + '">');

    // Create a Save button
    var $saveButton = $('<button class="save-button" data-id="' + userId + '">Save</button>');

    // Find the Delete button within the row
    var $deleteButton = $row.find(".delete-button");

    // Replace the Edit button with the Save button
    $(this).replaceWith($saveButton);

    // Save button click event
    $saveButton.click(function() {
        // Get the edited values from the input fields
        var editedName = $nameCell.find("input").val();
        var editedSurname = $surnameCell.find("input").val();
        var editedUsername = $usernameCell.find("input").val();
        var editedEmail = $emailCell.find("input").val();

        // Make AJAX request to edit.php with the edited user information
        $.ajax({
            url: "edit.php",
            method: "POST",
            data: {
                id: userId,
                name: editedName,
                surname: editedSurname,
                username: editedUsername,
                email: editedEmail
            },
            success: function(response) {
                // Replace the input fields with the edited values
                $nameCell.text(editedName);
                $surnameCell.text(editedSurname);
                $usernameCell.text(editedUsername);
                $emailCell.text(editedEmail);

                // Replace the Save button with the Edit button
                $saveButton.replaceWith('<button class="edit-button" data-id="' + userId + '">Edit</button>');

                // Add the Delete button back
                $row.find("td:last-child").append('<button class="delete-button" data-id="' + userId + '">Delete</button>');
            },
            error: function() {
                alert("Failed to save changes.");
            }
        });
    });

    // Remove the Delete button
    $deleteButton.remove();
});


        // Delete button click event (using event delegation)
        $("table").on("click", ".delete-button", function() {
            var userId = $(this).data("id");

            // Find the table row containing the user information
            var $row = $(this).closest("tr");

            // Confirm the deletion
            if (confirm("Are you sure you want to delete this user?")) {
                // Make AJAX request to delete.php with the user ID
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: { id: userId },
                    success: function(response) {
                        // Remove the table row
                        $row.remove();
                    },
                    error: function() {
                        alert("Failed to delete user.");
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
