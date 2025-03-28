
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration and Login</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('image_15.jpg'); 
      

        }
        .container {
            max-width: 400px;
            height: 700px;
            margin: 50px auto;
            margin-top: 100px;
   
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 6px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registration Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="newUsername">Username:</label>
        <input type="text" id="newUsername" name="newUsername" required>
        <label for="newPassword">Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <input type="submit" value="Register" name="register">
    </form>

    <div class="login-link">
       <p>Go for the  <a href="index.php" onclick="openLoginPopup()">Login</a> </p><!-- Corrected href to index.php -->
    </div>
</div>

</body>
</html>

<?php
// Database connection parameters
$servername = "localhost"; // Or your database host
$username = "root"; // Your database username
$password = "2005"; // Your database password
$database = "gym"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    global $conn; // Access the global connection variable
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data); // Use real_escape_string to prevent SQL injection
}

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Get and sanitize form data
    $fullname = sanitize_input($_POST["fullname"]);
    $email = sanitize_input($_POST["email"]);
    $newUsername = sanitize_input($_POST["newUsername"]);
    // No need to hash the password if storing in plain text
    $newPassword = sanitize_input($_POST["newPassword"]);

    // Insert data into users table
    $user_sql = "INSERT INTO registration (fullname, email, username, password) VALUES ('$fullname', '$email', '$newUsername', '$newPassword')";
    // Insert data into login_users table
    $login_sql = "INSERT INTO login_users (username, password) VALUES ('$newUsername', '$newPassword')";

    if ($conn->query($user_sql) === TRUE && $conn->query($login_sql) === TRUE) {
        // Redirect to profile page after successful registration
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Get and sanitize form data
    $loginUsername = sanitize_input($_POST["loginUsername"]);
    $loginPassword = sanitize_input($_POST["loginPassword"]);

    // Query the database to get the user's password
    $query = "SELECT password FROM login_users WHERE username = '$loginUsername'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        // Verify password
        if ($loginPassword == $storedPassword) {
            // Redirect to profile page after successful login
            header("Location: profile.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
}

// Close database connection
$conn->close();
?>
