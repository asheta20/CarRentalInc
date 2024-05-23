<?php
session_start();

$log = "";

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    $log = date("Y-m-d H:i:s") . " - User logged in/Home page: " . htmlspecialchars($user["name"]) . " (ID: {$_SESSION["user_id"]})\n";
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
    <title>Inquries List</title>
    <link rel="icon" type="image/png" href="images/faviconnn.png">
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
        <li class="left"><a href="admin"><img src="images/icoo.png" width="60px" height="20px"></a></li>
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
    <h1>Inquiries List</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Inquiry</th>
            <th>Inquiry</th>
            <th>Image</th>    
        </tr>
        <!--Displayes all inquiries in a table-->
        <?php
        $mysqli = require __DIR__ . "/database.php";
        $sql = "SELECT * FROM inquiries";
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
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["Inquiry"]; ?></td>
                    <td><?php echo $row["category"]; ?></td>

                    <td>
                        <?php if (!empty($row["File"])): ?>
                            <img src="data:image/png;base64,<?php echo base64_encode($row["File"]); ?>" alt="Image" width="350" height="200">
                        <?php else: ?>
                            No image attached
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "No users found.";
        }
        ?>

    </table>
</body>
</html>
