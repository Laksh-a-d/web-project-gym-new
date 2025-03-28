<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-image: url('image_9.jpg'); /* Specify the background image URL */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the background image */
            height: 100vh; /* Set the body height to 100% of the viewport height */
            margin: 0; /* Remove default margin */
            display: flex; /* Use flexbox for layout */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
        }

        /* Container styles */
        .container {
            max-width: 800px;
            height: 400px;
            width: 100%; /* Full width */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Profile info styles */
        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        /* Navigation bar styles */
        .navbar {
            overflow: hidden;
            background-color: #333;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Footer styles */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="membership.php">Membership</a>
            <a href="classes.php">Classes</a>
            <a href="registration.php">Registration</a>
            <a href="index.php" style="float:right;">Logout</a>
        </div>
        <h1>Welcome to Your Profile</h1>
        <div class="profile-info">
            <label>Username:</label>
            <?php
            session_start(); // Start session if not already started

            // Check if the username is stored in the session
            if(isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                echo "<p>$username</p>"; // Display the username
            } else {
                // Redirect to login page if the user is not logged in
                header("Location: login.php");
                exit();
            }
            ?>
        </div>
        <div class="profile-info">
            <label>Registration Details:</label>
            <?php
            // Include your database connection file
            $servername = "localhost"; // Change this if your database is hosted elsewhere
            $username = "root"; // Change this to your database username
            $password = "2005"; // Change this to your database password
            $dbname = "gym"; // Change this to your database name
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch registration details from the database
            $username = $_SESSION["username"];
            $sql = "SELECT fullname, email FROM registration WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<p>Full Name: " . $row["fullname"] . "</p>";
                    echo "<p>Email: " . $row["email"] . "</p>";
                }
            } else {
                echo "No registration details found.";
            }
            // Close database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2022 Ultimate fitness. All Rights Reserved.
    </footer>
</body>
</html>
