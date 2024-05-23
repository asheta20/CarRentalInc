<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="icon" type="image/png" href="images/faviconnn.png">
    <link rel="stylesheet" href="navigationBar.css">
    <link rel="stylesheet" href="E-sports.css">
    <style>
        body {
            background-image: url('images/bck.jpeg'), url('images/bg2.jpg');
            background-repeat: no-repeat, no-repeat;
            background-size: 100% 21%, cover;
            background-position: top, center;
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

        .form-container {
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .form-container input[type="email"], .form-container select, .form-container textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            font-size: 16px;
            backdrop-filter: blur(5px);
        }

        .form-container input[type="email"]::placeholder, .form-container textarea::placeholder {
            color: white;
        }

        .form-container input[type="submit"] {
            background-color: rgb(224, 70, 75);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: rgb(224, 70, 75);
        }

        .form-container .form-buttons {
            text-align: left;
            margin-top: 10px;
        }

        .form-container .form-buttons input[type="file"] {
            display: flex;
            justify-content: space-between;
            margin-right: 10px;
            padding-bottom: 5px;
        }
        .form-container select {
    color: black;
}
    </style>
    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var inquiry = document.getElementById("inquiry").value;
            var attachment = document.getElementById("attachment").value;

            if (email === "") {
                alert("Email is required.");
                return false;
            }

            if (inquiry === "") {
                alert("Inquiry is required.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <ul>
        <li class="left"><a href="index"><img src="images/icoo.png" width="60px" height="20px"></a></li>
        <li class="center"><a href="index">Home</a></li>
        <li class="center"><a href="news">Our Cars</a></li>
        <li class="center"><a href="E-Sports">Reservations</a></li>
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

    <div style="padding-top: 10px; padding-left:100px; margin-right: 100px"> 
        <h1>Welcome to Car Rental Inc.</h1>
        <hr>
        <h2>Rent your dream car with just a click of a button!</h2>
        <h3>You can choose from luxury cars to sports cars to economical cars,</h3>
        <h3>with the leading car rental company in Albania!</h3>
        <h3>Reserve a car without an upfront payment.</h3>
        <br><br>
        <h3>Start your journey now</h3>
        <button type="button" style="
            background-color: #E0464B; /* Background color */
            color: #ffffff; /* White text */
            font-size: 1.1em; /* Increase font size */
            padding: 5px 10px; /* Increase padding for a larger button */
            border: none; /* Remove default border */
            border-radius: 25px; /* Rounded edges */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth transition for background color change */
        " onmouseover="this.style.backgroundColor='green';"
           onmouseout="this.style.backgroundColor='#E0464B';"
           onclick="window.location.href='E-Sports.php'">
    Reserve
</button>

        <br><br>
        <div>
            <h2>Here are some of our most picked brands.</h2>
            <div style="display: flex; justify-content: space-around;">
                <img src="images/logo2.png" width="200px" height="200px">
                <img src="images/logo5.png" width="170px" height="165px" style="padding-top: 10px">
                <img src="images/logo6.png" width="370px" height="205px" style="padding-top: 10px">
                <img src="images/logo1.png" width="160px" height="160px" style="padding-top: 20px">
                <img src="images/logo7.png" width="200px" height="170px" style="padding-top: 10px">    
            </div>
        </div>
        <hr>
        <div>
            <h2>Most selected cars</h2>
            <div style="display: flex;">
    <div style="padding-left: 100px; padding-right: 100px;">
      <div>
      <div class="image-container">
          <a href="news"><img src="images/BMWM3.jpg" width="100%" height="370"></a> 
          <div style="max-width:800px;" class="image-overlay">
            <h1>Bmw M3 145 EUR/Day</h1>
          </div>
        </div>
      </div>
      
      <div class="carousel-container" style="padding-top: 10px;">
        <div class="carousel-slide">
          <div class="carousel-item">
            <a href="news"><img src="images/AUDIA3.jpg" alt="Image 1"></a>
            <div class="carousel-text">Audi A3 95 EUR/Day</div>
          </div>
          <div class="carousel-item">
            <a href="news"><img src="images/Golf8.jpg"></a>
            <div class="carousel-text">Golf 8 125 EUR/Day</div>
          </div>
          <div class="carousel-item">
            <a href="news"><img src="images/Jaguar.jpg" alt="Image 3"></a>
            <div class="carousel-text">Jaguar 165 EUR/Day</div>
          </div>
        </div>
        <a class="carousel-arrow carousel-arrow-left">&#10094;</a>
        <a class="carousel-arrow carousel-arrow-right">&#10095;</a>
      </div>
    </div>

  </div>
  <br>
            <div style="display: flex; padding-bottom: 30px; ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1497.8036572073886!2d19.81157503874863!3d41.339151606665254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135031aa10b9ce21%3A0xadfa9ae086820fd7!2sRental%20Car%20Tena!5e0!3m2!1sen!2s!4v1716285395917!5m2!1sen!2s" width="550" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div style="padding-left: 30px; padding-top: 10px; color:black; font-weight:700; font-size:24px">
                    <p>  ⁍➡‣  Where to find us</p>
                    <p>Rruga Jordan Misja 73-39, Tirana, Albania</p>
                    <p>We are open Mon-Sun 9:00 AM - 6:00 PM </p>
                    <p>Contact number: 065 11 11 111</p>
                    
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h3>Having issues? Contact us</h3>
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data" action="submit_form.php" onsubmit="return validateForm()">
                    <input type="email" id="email" name="email" placeholder="Your email">
                    <br>
                    <select id="category" name="category">
                        <option value="Problem with account">Problem with account</option>
                        <option value="General Inquiry">General Inquiry</option>
                        <option value="Technical Support">Technical Support</option>
                        <option value="Other">Other</option>
                    </select>
                    <br>
                    <textarea id="inquiry" name="inquiry" rows="8" placeholder="Having issues or questions? Enter your inquiry here"></textarea>
                    <br>
                    <div class="form-buttons">
                        <input type="file" id="attachment" name="attachment" accept=".png">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="E-sports.js"></script>
</body>
</html>
