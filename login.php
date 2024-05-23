<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
        session_start();
        session_regenerate_id();
        $_SESSION["user_id"] = $user["id"];

        if ($user["email"] === "admin@gmail.com" || $user["email"] === "TechSupport@yahoo.com") {
          header("Location: admin.php");
          exit;
      } else {
          header("Location: index.php");
          exit;
      }
      
    }

    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="icon" type="image/png" href="images/faviconnn.png">
    <link rel="stylesheet" href="navigationBar.css">
    <style>
        body {
          background-image: url('images/bg3.jpg');
          background-repeat: no-repeat;
          background-size: cover;
          color: white;
          font-family: 'Roboto Condensed', sans-serif;
        }

        .form-container {
          display: flex;
          justify-content: center;
          margin-top: 50px;
        }

        .form-wrapper {
          backdrop-filter: blur(1px);
          background-color: rgba(255, 255, 255, 0.036);
          padding: 20px;
        }

        form {
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        form input {
          background: transparent;
          border: none;
          border-bottom: 2px solid white;
          color: white;
          margin-bottom: 20px;
          padding: 10px;
          width: 300px;
        }

        .remember-me {
          display: flex;
          align-items: center;
          justify-content: flex-start;
        }

        .remember-me input[type="checkbox"] {
          margin-right: 5px;
        }

        .sign{
            display: flex;
            justify-content: center;
            padding-bottom: 20px;
        }

        .signin {
            width: 300px;
  border-radius: 20px; 
  padding: 10px 20px; 
  background-color: #007bff; 
  color: #fff; 
  font-size: 16px; 
  border: none; 
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <ul>
        <li class="left"><a href="index"><img src="images/icoo.png" width="60px" height="20px"></a></li>
        <li class="center"><a href="index">Home</a></li>
        <li class="center"><a href="news">News</a></li>
        <li class="center"><a href="E-Sports">E-sports</a></li>
        <li class="right">
          <a href="login">Log in</a>
        </li>
    </ul>
    
  
    <div class="form-container">
        <div class="form-wrapper">
            <h2 style="text-align: center;">Log in</h2>
             
        <?php if ($is_invalid): ?>
        <em>Invalid login</em>
        <?php endif; ?>
            <form method="post">
                <div>
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" id="email" name="email" placeholder="Email"   value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>
                <div>
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" id="password" name="password" placeholder="Password" >
                </div>
                <div style="display: flex; justify-content: space-between;">
                  <div>
                  <input type="checkbox" style="width: 16px; height: 16px; ">
                  <label for="checkbox" style="padding-right: 100px;">Remember me</label>
              </div>
              <div>
                  <label><a href="#">Forgot password?</a></label>
                </div>
              </div>
                <div class="sign">
                  <button class="signin">Sign in</button>
               </div>
            </form>
           
        
        <div style="display: flex; justify-content: center; padding-top: 20px;">
            <label>Don't have an account? <a href="signup">Sign up</a></label>
        </div>
        </div>
    </div>
      
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>