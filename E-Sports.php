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
  <title>Car Rental</title>
  <link rel="icon" type="image/png" href="images/faviconnn.png">
  <link rel="stylesheet" href="navigationBar.css">
  <link rel="stylesheet" href="E-sports.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-**********" crossorigin="anonymous" />

  <style>
    body {
      background-image: url('images/bg2.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      color: white;
      font-family: 'Roboto Condensed', sans-serif;
    }

    label {
  display: inline-block;
  width: 100px;
  text-align: right;
  margin-right: 10px;
}

input[type="text"] {
  width: 300px;
  padding: 5px;
  font-size: 16px;
}

button[type="submit"] {
  padding: 5px 10px;
  font-size: 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

    .event-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .event-container img {
      width: 500px;
      height: auto;
    }

    .countdown-container {
      font-size: 36px;
      margin-top: 20px;
    }

    .countdown-title {
      font-size: 24px;
      margin-top: 10px;
    }

    .event-description {
      width: 500px;
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
.form-container, .table-container {
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            text-align: center;
        }


        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(0, 0, 0, 0.2);
            color: black;
            font-size: 16px;
            backdrop-filter: blur(5px);
        }

        .form-container input[type="submit"] {
            background-color: rgb(224, 70, 75);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"], .form-container .pay-btn {
            width: calc(50% - 5px); 
            margin-right: 5px; 
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); /
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
        }
        .modal-content {
    background-color: rgba(255, 255, 255, 0.2);
    padding: 20px;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    text-align: center;
}

.modal-content input[type="text"],
.modal-content input[type="submit"],
.modal-content button {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: none;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: rgba(0, 0, 0, 0.2);
    color: black;
    font-size: 16px;
    backdrop-filter: blur(5px);
}

.modal-content input[type="submit"],
.modal-content button {
    background-color: rgb(224, 70, 75);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.modal-content input[type="submit"]:hover,
.modal-content button:hover {
    background-color: rgb(224, 70, 75);
}


        .form-container input[type="submit"]:hover {
            background-color: rgb(224, 70, 75);
        }

        table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #E0464B;
    }

    #searchFullName {
      border-radius: 20px;
      background-color: rgba(255, 255, 255, 0.7);
      border: none;
      padding: 10px 20px;
      width: 300px;
      font-size: 16px;
    }

    #searchForm button {
      background-color: rgb(224, 70, 75);
      color: white;
      border: none;
      border-radius: 20px;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 16px;
    }

    #searchForm button:hover {
      background-color: black;
    }
  </style>
</head>
<body>
  <div>
    <ul>
      <li class="left"><a href="index"><img src="images/icoo.png" width="60px" height="20px"></a></li>
      <li class="center"><a href="index">Home</a></li>
      <li class="center"><a href="news">Our Cars</a></li>
      <li class="center"><a href="E-Sports ">Reservations</a></li>
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
  </div>
  <div style="padding-left: 100px; padding-right: 100px;">
    <h2>Book Your Future Ride!</h2>
    <hr>
  <div style="display: flex;">
    <div style="padding-left: 100px; padding-right: 100px;">
    <div class="form-container">
        <form action="bookingprocess.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="text" id="full_name" name="full_name" placeholder="Your Full Name" required>
            <input type="email" id="email" name="email" placeholder="Your Email" required>
            <select id="car_option" name="car_option" required>
                <option value="" disabled selected>Select a car</option>
                <option value="Mercedes Benz A180 2018">Mercedes Benz A180 2018 - 75EUR</option>
                <option value="Audi A3 2.0L 2020">Audi A3 2.0L 2020 - 95EUR</option>
                <option value="BMW M3 Competition 3.0L 2015">BMW M3 Competition 3.0L 2015 - 145EUR</option>
                <option value="Volkswagen Golf 8 1.8L 2018">Volkswagen Golf 8 1.8L 2018 - 125EUR</option>
                <option value="Toyota Yaris 1.6 Turbo 2021">Toyota Yaris 1.6 Turbo 2021 - 95EUR</option>
                <option value="Jaguar XF 3.0 AWD 2015">Jaguar XF 3.0 AWD 2015 - 165EUR</option>
            </select>
            <input type="datetime-local" id="start_date" name="start_date" required>
            <input type="datetime-local" id="end_date" name="end_date" required>
            <textarea id="additional_info" name="additional_info" rows="4" placeholder="Additional Info"></textarea>
            <input type="file" id="attachment" name="attachment" accept=".png">
            <button style="max: width 200px" type="button" class="pay-btn" onclick="openModal()"><i class="fa fa-credit-card" aria-hidden="true"></i></button>

            <input type="submit" value="Finalize Order" >

        </form>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content form-container">
        <!-- Credit Card Form -->
        <form>
            <!-- Credit Card inputs -->
            <input type="text" id="card_holder_name" name="card_holder_name" placeholder="Cardholder Name" required>
            <input type="text" id="card_number" name="card_number" placeholder="Card Number" required>
            <input type="text" id="expiration_date" name="expiration_date" placeholder="Expiration Date" required>
            <input type="text" id="cvv" name="cvv" placeholder="CVV" required>

            <!-- Finalize button (for visual appearance) -->
            <button type="button" onclick="closeModal()">Submit Card Details</button>
        </form>
    </div>
</div>

    <script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Close the modal when clicked outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

        </div>
    </div>
    <div style="padding-left: 100px; margin-top: 120px; padding-right: 100px;">
    <h2>Search Your Bookings By Name.</h2>
  <hr>
      <form id="searchForm">
        <div style="margin-left:265px">
        <label for="full_name">Full Name:</label>
        <input type="text" id="searchFullName" name="full_name" required>
        <button type="submit">Search</button>
        </div>
      </form>
      <div style="padding-top:40px">
      <h3>Search Results</h3>
      <table id="searchTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Car Option</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Additional Info</th>
          </tr>
        </thead>
        <tbody id="searchResults">
          <!-- Table rows will be dynamically populated here -->
        </tbody>
      </table>
    </div>
    </div>
  </div>
  <script>
  document.getElementById("searchForm").addEventListener("submit", function(event) {
  event.preventDefault();
  var fullName = document.getElementById("searchFullName").value;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var searchResults = JSON.parse(xhr.responseText);
      var tableBody = document.getElementById("searchResults");
      tableBody.innerHTML = ""; // Clear previous results
      if (searchResults.length > 0) {
        searchResults.forEach(function(result) {
          var row = document.createElement("tr");
          row.innerHTML = `
            <td>${result.id}</td>
            <td>${result.full_name}</td>
            <td>${result.email}</td>
            <td>${result.car_option}</td>
            <td>${result.start_date}</td>
            <td>${result.end_date}</td>
            <td>${result.additional_info}</td>
          `;
          tableBody.appendChild(row);
        });
      } else {
        var noResultsRow = document.createElement("tr");
        noResultsRow.innerHTML = `<td colspan="7">No results found.</td>`;
        tableBody.appendChild(noResultsRow);
      }
    }
  };
  xhr.open("GET", "search.php?full_name=" + fullName, true);
  xhr.send();
});

  </script>
  <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "erisat123";
    $dbname = "carrental_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Search query
    $search_query = "";
    if (isset($_GET["full_name"]) && !empty($_GET["full_name"])) {
      $search_query = $_GET["full_name"];
      $sql = "SELECT * FROM bookings WHERE full_name LIKE '%$search_query%'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["full_name"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "<td>" . $row["car_option"] . "</td>";
          echo "<td>" . $row["start_date"] . "</td>";
          echo "<td>" . $row["end_date"] . "</td>";
          echo "<td>" . $row["additional_info"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No results found.</td></tr>";
      }
    }

    $conn->close();
  ?>
</body>
</html>