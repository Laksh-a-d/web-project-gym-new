<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "2005";
$dbname = "gym";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values
$username = $password = "";
$error = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username and password
    $username = $_POST["loginUsername"];
    $password = $_POST["loginPassword"];

    // Prepare a select statement for admin table
    $sql_admin = "SELECT id FROM admin WHERE username = ? AND password = ?";
    
    if ($stmt_admin = $conn->prepare($sql_admin)) {
        // Bind variables to the prepared statement as parameters
        $stmt_admin->bind_param("ss", $param_username, $param_password);

        // Set parameters
        $param_username = $username;
        $param_password = $password;  // Note: In a real-world scenario, you should hash the password before comparing.

        // Attempt to execute the prepared statement
        if ($stmt_admin->execute()) {
            // Store result
            $stmt_admin->store_result();

            // If username and password match in admin table
            if ($stmt_admin->num_rows == 1) {
                // Start a new session for admin
                session_start();

                // Redirect admin to admin page
                header("location: admin.php");
            } else {
                // Display an error message if username and password don't match in admin table
                $error = "Invalid username or password.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt_admin->close();
    }
    
    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('image_10.jpg'); /* Replace 'background-image.jpg' with the path to your image */
            background-size: cover;
            background-position: center;
        }

        .login-box {
            width: 350px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .login-box input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
            text-align: center;
        }

        .register-link {
            text-align: center;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login Form</h2>
            <?php if(isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="loginUsername" required>
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
                <input type="submit" value="Login" name="login">
            </form>
            <div class="register-link">
                <p>Don't have an account? <a href="registration.php" id="registerLink">Register</a></p>
            </div>
             <div class="download-button">
        <form action="download.php" method="post">
            <input type="submit" value="Download Excel" name="download">
        </form>
    </div>
        </div>
    </div>
</body>
</html>
