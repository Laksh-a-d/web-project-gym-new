<?php
// Database connection parameters
$servername = "localhost"; // Or your database host
$username = "root"; // Your database username
$password = "2005"; // Your database password
$database = "gym_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Perform a query to check if the user exists with the provided credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    // Check if a row is returned (i.e., user exists with the provided credentials)
    if ($result->num_rows > 0) {
        // Redirect the user to the index.php page
        header("Location: index.php");
        exit(); // Ensure that script execution stops after redirection
    } else {
        // If no user is found, display an error message
        echo "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
</head>
<body>
    <!-- Login form -->
    <div class="login-box">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
        <div>
            <p>Don't have an account? <a href="#" id="registerLink">Register</a></p>
        </div>
    </div>

    <!-- Modal for Registration -->
    <!-- Modal content -->
    
    <script>
        // JavaScript code
    </script>
</body>
</html>
