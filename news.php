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
<script>
        function validateForm() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);

            if (endDate <= startDate) {
                alert("End date must be later than start date.");
                return false;
            }
            return true;
        }
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="icon" type="image/png" href="images/faviconnn.png">
    <link rel="stylesheet" href="navigationBar.css">

    <style>
        body {
            background-image: url('images/bg3.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: rgb(172, 164, 164);
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

        .green-arrow {
            color: green;
            padding-right: 5px;
        }

        .red-arrow {
            color: brown;
            padding-right: 5px;
        }

      
    </style>
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
                <a href="logout.php" class="logout-link">Log out</a>
              </div>
            </div>
          <?php else: ?>
            <a href="login">Log in</a>
          <?php endif; ?>
        </li>
      </ul>
     <div class="text-selection">
      <div style="padding-left: 120px; padding-right: 120px;">
        <h1 style="text-align: center;">We offer premium top of the line cars with insurance and also customer assurance for the quality of the parts! </h1>
        <hr>
        <!--Images and text which is displayed in screen, iframes for the video-->
        <div>
        <h2>Mercedes Benz A180 2018</h2>
    <span style="display: flex; flex-direction:row;">
    <p style="padding-right: 30px;">The 2018 Mercedes Benz A180 represents a fine blend of luxury and performance, setting new standards in the compact car segment. With its sleek design, cutting-edge technology, and impressive fuel efficiency, the A180 is a top choice for urban drivers seeking a premium experience.
   <br><br>
    <em>The A180 comes equipped with a 1.6-liter turbocharged engine, delivering a smooth and responsive driving experience. The interior is outfitted with high-quality materials and features such as the advanced infotainment system with a user-friendly interface and a range of connectivity options.</em>
    <br><br>
    Safety is a key focus for Mercedes, and the A180 includes a suite of advanced safety features like active brake assist, attention assist, and multiple airbags. The spacious cabin and comfortable seating ensure that every journey is enjoyable, whether it’s a daily commute or a weekend getaway.
    The 2018 Mercedes Benz A180 combines style, innovation, and practicality, making it a standout choice in its class.
    To read more <a href="https://www.mbusa.com/en/vehicles/class/a-class/sedan">click here.</a></p>
    <img src="images/MBA180.jpg" width="300px" height="200px">

            </span>
        </div>
        <hr>
        <!--Images and text which is displayed in screen, iframes for the video-->
        <div>
    <h2>Audi A3 2.0L 2020</h2>
    <span style="display: flex; flex-direction:row-reverse;">
    <p style="padding-left: 30px;">The 2020 Audi A3 2.0L is a standout in the compact luxury segment, combining performance, elegance, and advanced technology. This model features a turbocharged 2.0-liter four-cylinder engine that delivers robust power and a smooth driving experience.
       <br><br>
        <em>Inside, the A3 offers a refined and comfortable cabin, complete with premium materials and state-of-the-art technology. The MMI® infotainment system, intuitive controls, and available virtual cockpit provide a seamless and enjoyable user experience.</em>
        <br><br>
        Safety and driver assistance features are plentiful, including Audi pre sense® basic and front, adaptive cruise control, and a range of parking sensors. The A3's agile handling and responsive steering make it a joy to drive, whether navigating city streets or cruising on the highway.
        The 2020 Audi A3 2.0L encapsulates the best of Audi’s engineering prowess, making it a top choice for those seeking a compact car with luxury and performance.
        To read more <a href="https://www.audiusa.com/us/web/en/models/a3/a3-sedan/2020/overview.html">click here.</a></p>
        <img src="images/AudiA3.jpg" width="300px" height="200px">
    </span>
    </div>
        <hr>
        <div>
    <h2>BMW M3 Competition 3.0L 2015</h2>
    <span style="display: flex; flex-direction:row;">
    <p style="padding-right: 20px;">The 2015 BMW M3 Competition 3.0L is a benchmark in the world of high-performance sports sedans, combining exhilarating power with precision handling. At the heart of this beast is a 3.0-liter inline-six engine, featuring twin-turbocharging to produce an impressive 425 horsepower and 406 lb-ft of torque.
       <br><br>
        <em>The M3’s interior is equally impressive, blending luxury with a driver-focused design. Premium materials, advanced technology, and supportive sports seats create an environment that is both comfortable and ready for spirited driving.</em>
        <br><br>
        Advanced features include a high-resolution infotainment system, adaptive M suspension, and an array of safety technologies such as dynamic stability control and multiple airbags. The M3’s aggressive stance, aerodynamic enhancements, and iconic kidney grille make it a standout on the road.
        The 2015 BMW M3 Competition offers a thrilling driving experience, making it a top choice for enthusiasts who demand performance and luxury in one package.
        To read more <a href="https://www.bmwusa.com/vehicles/m-models/m3-sedan/2015/overview.html">click here.</a></p>
        <img src="images/BMWM3.jpg" width="300px" height="200px">
    </span>
    </div>
        <hr>
        <!--Images and text which is displayed in screen, iframes for the video-->
        <div>
    <h2>Volkswagen Golf 8 1.8L 2018</h2>
    <span style="display: flex; flex-direction:row-reverse;">
    <p style="padding-left: 30px;">The 2018 Volkswagen Golf 8 1.8L is a prime example of German engineering in a compact package, offering a blend of performance, practicality, and advanced features. Under the hood lies a 1.8-liter turbocharged engine that delivers a smooth and efficient driving experience with ample power for everyday use.
       <br><br>
        <em>Inside, the Golf 8 showcases a high-quality interior with a clean, modern design. The infotainment system is intuitive and packed with features, including smartphone integration and a crisp touchscreen display. The spacious cabin and versatile cargo space make it a practical choice for various needs.</em>
        <br><br>
        Safety is a priority, with features like adaptive cruise control, lane-keeping assist, and automatic emergency braking. The Golf 8’s responsive handling and comfortable ride quality make it enjoyable to drive in both city and highway settings.
        The 2018 Volkswagen Golf 8 1.8L combines reliability, advanced technology, and a fun driving experience, making it a standout choice in the compact car segment.
        To read more <a href="https://www.vw.com/en/models/golf.html">click here.</a></p>
        <img src="images/Golf8.jpg" width="300px" height="200px">
    </span>
    </div>
        <hr>
        <div>
    <div>
        <h2>Toyota Yaris 1.6 Turbo 2021</h2>
        <span style="display: flex; flex-direction:row;">
        <p style="padding-right: 20px;">The 2021 Toyota Yaris 1.6 Turbo is a standout in the subcompact car segment, offering a spirited performance combined with Toyota's renowned reliability. This model is powered by a 1.6-liter turbocharged engine, providing a lively and efficient driving experience perfect for both city commuting and highway cruising.
           <br><br>
            <em>Inside, the Yaris boasts a modern and functional interior, featuring high-quality materials and a user-friendly layout. The infotainment system is equipped with the latest technology, including smartphone integration and a responsive touchscreen interface.</em>
            <br><br>
            Safety is paramount in the Yaris, with features such as Toyota Safety Sense, adaptive cruise control, lane departure alert, and pre-collision system. The car’s compact size makes it easy to maneuver in tight spaces, while its well-tuned suspension ensures a smooth and comfortable ride.
            The 2021 Toyota Yaris 1.6 Turbo combines sporty performance, advanced features, and top-tier safety, making it an excellent choice for those seeking a reliable and enjoyable subcompact car.
            To read more <a href="https://www.toyota.com/yaris/">click here.</a></p>
            <img src="images/ToyotaYaris.jpg" width="300px" height="200px">
        </span>
    </div>
</div>
        <hr>
        <div>
    <h2>Jaguar XF 3.0 AWD 2015</h2>
    <span style="display: flex; flex-direction:row-reverse;">
    <p style="padding-left: 30px;">The 2015 Jaguar XF 3.0 AWD combines British luxury with dynamic performance, making it a standout in the midsize luxury sedan segment. Under the hood, this model is powered by a supercharged 3.0-liter V6 engine, delivering 340 horsepower and ensuring a smooth yet exhilarating drive with its all-wheel-drive system.
       <br><br>
        <em>Inside, the XF offers a luxurious and sophisticated cabin, featuring high-quality materials, elegant design, and advanced technology. The infotainment system is user-friendly, providing seamless connectivity and a premium audio experience.</em>
        <br><br>
        Safety and comfort are prioritized, with features such as adaptive cruise control, blind-spot monitoring, and a suite of airbags. The XF's refined suspension system and precise steering make for a composed and enjoyable ride, whether on city streets or the open road.
        The 2015 Jaguar XF 3.0 AWD is a perfect blend of style, performance, and luxury, appealing to those who seek a distinguished and capable sedan.
        To read more <a href="https://www.jaguarusa.com/about-jaguar/news/jaguar-xf.html">click here.</a></p>
        <img src="images/Jaguar.jpg" width="300px" height="200px">
    </span>
</div>  
        <hr>

 
</body>
</html>
