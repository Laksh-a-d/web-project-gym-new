<?php
session_start(); // Start the session to access session variables

// Database connection parameters
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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the username from the session
    $username = $_SESSION['username'];
    
    // Fetch other form data
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $plan = $_POST["plan"];
    $services = $_POST["services"];

    // Prepare and execute SQL statement to insert data into database
    $stmt = $conn->prepare("INSERT INTO membership (username, phone, gender, plan, services) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $phone, $gender, $plan, $services);

    if ($stmt->execute() === TRUE) {
        // Redirect user to services page
        header("Location: services.php");
        exit();
    } else {
        echo "<p style='text-align: center; color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('image_15.jpg'); /* Add the path to your background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent the image from repeating */
            max-width: 1600px;
            
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
   
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 600px;
           
         
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 15px;
            color: #666;
        }

        input[type="text"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            background-color: rgba(255, 255, 255, 0.8); /* Add transparency to the input background color */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: black;
            border: none;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Membership Form</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Display username field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label for="plan">Plan:</label>
        <select name="plan" id="plan" required>
            <option value="1">One Month</option>
            <option value="3">Three Months</option>
            <option value="6">Six Months</option>
            <option value="12">One Year</option>
        </select>

        <label for="services">Services:</label>
        <select name="services" id="services" required>
            <option value="Fitness">Fitness</option>
            <option value="Sauna">Sauna</option>
            <option value="Cardio">Cardio</option>
        </select>

        <input type="submit" value="Join Now">
    </form>
</div>

</body>
</html>







