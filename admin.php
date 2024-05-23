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
    <title>Admin Page</title>
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
    </style>
</head>
<body>
    <!--Main page for admin, to navigate to the other pages-->
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

    <div style="text-align: center">
        <h1>Welcome to the admin page</h1>
        <h2>Navigate to the other pages through the nav bar</h2>
    </div>

</body>
</html>
