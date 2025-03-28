

<div class="hero-wrap js-fullheight" style="background-image: url('images/image_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <!-- <h2 class="subheading">Welcome to Vacation Rental</h2>
                <h1 class="mb-4">Rent an appartment for your vacation</h1>
                <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#" class="btn btn-white">Contact us</a></p> -->
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row justify-content-middle" style="margin-left: 397px;">
            <div class="col-md-6 mt-5">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="appointment-form" style="margin-top: -568px;">
                    <h3 class="mb-3">Login</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email" name="email">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="Login" class="btn btn-primary py-3 px-4">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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
    $username = $_POST["email"];
    $password = $_POST["password"];
    
    // Perform a query to check if the user exists with the provided credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    // Check if a row is returned (i.e., user exists with the provided credentials)
    if ($result->num_rows > 0) {
        // Update the created_at field with the current timestamp
        $login_time = date("Y-m-d H:i:s");
        $update_sql = "UPDATE users SET created_at = '$login_time' WHERE username = '$username'";
        $update_result = $conn->query($update_sql);
        
        // Check if the update was successful
        if ($update_result === TRUE) {
            // Redirect the user to the index.php page
            header("Location: index.php");
            exit(); // Ensure that script execution stops after redirection
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // If no user is found, display an error message
        echo "Invalid username or password. Please try again.";
    }
}
?>