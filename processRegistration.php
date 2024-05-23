<?php
//server side verification for the registration form
if (empty($_POST["name"])) {
    die("Name is required");
}

if (empty($_POST["surname"])) {
    die("Surname is required");
}

if (empty($_POST["username"])) {
    die("Username is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $_POST["password"])) {
    die("Password must be 8-16 characters, contain at least 1 uppercase letter, 1 lowercase letter, and 1 number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, surname, username, email, password_hash)
VALUES (?,?,?,?,?)";

$stmt = $mysqli->stmt_init();

if( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                  $_POST["name"],
                  $_POST["surname"],
                  $_POST["username"],
                  $_POST["email"],
                  $password_hash);

 try {
  if ($stmt->execute()) {
        header("Location: index.php");
        exit;
 } else {
     die("An error occurred during registration");
         }
 } catch (mysqli_sql_exception $exception) {
if ($exception->getCode() === 1062) {
        die("This email is already used");
    } else {
 die($exception->getMessage());
     }
    }
                
?>