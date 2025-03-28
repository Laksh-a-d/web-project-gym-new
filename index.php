
<?php
session_start(); // Start session if not already started

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are set
    if(isset($_POST["loginUsername"]) && isset($_POST["loginPassword"])) {
        // Assuming you have a database connection
        // Perform your database query to check username and password
        // If credentials match, redirect to profile page
        $username = $_POST["loginUsername"];
        $password = $_POST["loginPassword"];
        
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM login_users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password); // 'ss' indicates two string parameters
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows are returned
        if($result->num_rows == 1) {
            // Valid credentials
            $_SESSION["username"] = $username; // Store username in session
            header("location: profile.php"); // Redirect to profile page
            exit();
        } else {
            // Invalid credentials
            $error = "Invalid username or password"; // Error message
        }
    } else {
        // Missing username or password
        $error = "Please enter both username and password"; // Error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        /* Basic CSS for navigation bar */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
           /* Specify the path to your image */
            background-size: cover; /* Cover the entire background */
            background-repeat: no-repeat; /* Prevent the image from repeating */
           background-color:whitesmoke;
            
            padding-bottom: 60px; /* Adjusted padding for footer */
       
            
        }
        
        .navbar {
            background-color: rgba(50, 50, 50, 0.4);
    overflow: hidden;
    width: 100%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 30px;
    
}


        .navbar a {
            
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s;
            padding: 10px 20px;
            border-radius: 5px;
        }
        
        .navbar a:hover {
            background-color: #555;
        }
        
        .navbar a.active {
            background-color: #04AA6D;
        }
        
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }
        
        .navbar .menu-icon {
            display: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
        
/* Additional CSS for content section */
.content {
    padding: 20px;
    text-align: center;

    color: #000000;



    background-color:#A3C1AD ; /* Fully transparent background */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
    margin: 20px; /* Add some margin for spacing */
}

.content h2 {
    font-size: 28px; /* Larger font size for heading */
    background: linear-gradient(to bottom, whitesmoke, #A3C1AD);
    color: #007bff; /* Blue font color */
    margin-bottom: 20px; /* Add spacing below heading */
}

.content p {
    font-size: 18px; /* Font size for paragraphs */
    line-height: 1.6; /* Improved readability with increased line height */
    margin-bottom: 15px; /* Add spacing between paragraphs */
}

        

.login-box {
    background-color: black; /* Semi-transparent background */
    border-radius: 10px;
    padding: 40px; /* Increased padding for better spacing */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Increased shadow for depth */
    width: 90%; /* Set width to 90% of the viewport */
    max-width: 800px; /* Max width for better readability */
    margin: auto; /* Center the login box horizontally */
    box-sizing: border-box; /* Include padding and border in the width */
    position: relative; /* Position the login box relative to the container */
    top: 20px; /* Adjust vertical position to place below the content */
    color: white; /* Text color */
    border: 2px solid black; /* White border */
}



.login-box h2 {
    text-align: center; /* Center the heading */
    margin-bottom: 30px; /* Increased margin for better separation */
    color: #777777;
    font-size: 24px; /* Increased font size for better emphasis */
}

.login-box label {
    display: block;
    margin-bottom: 15px; /* Increased margin for better spacing */
    color: #555; /* Adjusted label color for contrast */
}

.login-box input[type="text"],
.login-box input[type="password"],
.login-box input[type="submit"] {
    width: 100%; /* Full width for input fields */
    padding: 15px; /* Increased padding for better input field size */
    margin-bottom: 20px; /* Increased margin for better spacing */
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.login-box input[type="submit"] {
    background-color: #04AA6D;
    color: white;
    border: none;
    cursor: pointer;
 
}

.login-box input[type="submit"]:hover {
    background-color: #45a049;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.about-us,
.location {
    background-color: rgba(255, 255, 255, 0.9);
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    width: calc(50% - 20px); /* Adjust width to fit in the container */
    cursor: pointer;
    transition: background-color 0.3s;
}

.about-us:hover,
.location:hover {
    background-color: rgba(255, 255, 255, 1);
}

.about-us.active,
.location.active {
    background-color: #f0f0f0;
    border-color: #04AA6D;
}

.about-us h2,
.location h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

.about-us p,
.location p {
    color: #666;
    font-size: 16px;
    line-height: 1.5;
}

.about-us address,
.location address {
    font-style: normal;
    color: #777;
}

.login-box {
    background-color: #f2f2f2;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: calc(50% - 20px); /* Adjust width to fit in the container */
    max-width: 800px;
    box-sizing: border-box;
}

.login-box h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #777777;
}

.login-box label {
    display: block;
    margin-bottom: 10px;
}

.login-box input[type="text"],
.login-box input[type="password"],
.login-box input[type="submit"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.login-box input[type="submit"] {
    background-color: #04AA6D;
    color: white;
    border: none;
    cursor: pointer;
}

.login-box input[type="submit"]:hover {
    background-color: #45a049;
}
      
        /* CSS for text overlay */
        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1;
            color: white;
        }
       
.text-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
}

.text-overlay h1 {
    font-size: 48px; /* Increase the font size */
    margin-bottom: 20px;
}

.text-overlay p a {
    display: inline-block;
    padding: 15px 30px; /* Increase the padding */
    background-color: #04AA6D; /* Change the background color */
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.text-overlay p a:hover {
    background-color: #45a049; /* Change the hover background color */
}

        
        /* CSS for smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        .container {
    display: flex;
    justify-content: space-between;
    
    align-items: flex-start;
    padding: 0 20px; /* Add padding to the container */
}


.login-box {
    background-color: #f2f2f2;
    border-radius: 10px;
    padding: 20px; /* Adjust padding */
    background-color: rgba(50, 50, 50, 0); /* Fully transparent background */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: calc(50% - 40px); /* Adjust width to fit in the container and add extra spacing */
    max-width: 800px;
    box-sizing: border-box;
    margin-bottom: 20px; /* Add margin bottom to create space */
}

.login-box h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #777777;
}

.login-box label {
    display: block;
    margin-bottom: 10px;
}

.login-box input[type="text"],
.login-box input[type="password"],
.login-box input[type="submit"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.login-box input[type="submit"] {
    background-color: #04AA6D;
    color: white;
    border: none;
    cursor: pointer;
}

.login-box input[type="submit"]:hover {
    background-color: #45a049;
}

body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        footer {
            background-color: rgba(50, 50, 50, 0.4);
        color: #fff;
        padding: 20px;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 20px;
    }

    .location-info {
        flex-grow: 1;
    }

    .creator-info {
        text-align: right;
    }
        header {
              color: #fff; /* Title color */
              background-color: rgba(50, 50, 50, 0.4); /* Adjusted alpha value to make the background more faint */

            color: #fff;
            text-align: center;
            font-size: 10px;
            padding: 10px 0;
            margin-top: 65px
            
        }
        .achievement:hover {
            transform: translateY(-5px);
        }


        main {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 20px;
        }

        .achievement {
            background-color:#A3C1AD;
            
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
            margin-bottom: 20px;
            width: 30%;
            height: 150px;
            transition: transform 0.3s ease;
        }

        .achievement h2 {
            margin-top: 0;
            font-size: 24px;
            background: linear-gradient(to bottom, whitesmoke, #A3C1AD);
        }

        .achievement p {
            margin-bottom: 5px;
        }
       
        .image-section {
        position: relative;
        margin-top: 10px; /* No margin from the top */
        overflow: hidden; /* Hide overflow to prevent horizontal scrolling */
        max-width: 1500px; /* Limit the maximum width to create distance from left and right */
        margin-left: 20px; /* Center the image horizontally */
        margin-right: 20px; /* Center the image horizontally */
    }

    .image-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
    }

    .image-overlay h1 {
        font-size: 36px;
    }

    .learn-more-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 20px;
        display: inline-block;
    }

    .learn-more-btn:hover {
        background-color: #45a049;
    } 
    /* 
---------------------------------------------
banner
--------------------------------------------- 
*/

.main-banner {
  position: relative;
}

#bg-video {
    min-width: 100%;
    min-height: 100vh;
    max-width: 100%;
    max-height: 100vh;
    object-fit: cover;
    z-index: -1;
}

#bg-video::-webkit-media-controls {
    display: none !important;
}

.video-overlay {
    position: absolute;
    background-color: rgba(35,45,57,0.8);
    top: 0;
    left: 0;
    bottom: 7px;
    width: 100%;
}

.main-banner .caption {
  text-align: center;
  position: absolute;
  width: 80%;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
}

.main-banner .caption h6 {
  margin-top: 0px;
  font-size: 18px;
  text-transform: uppercase;
  font-weight: 800;
  color: #fff;
  letter-spacing: 0.5px;
}

.main-banner .caption h2 {
  margin-top: 30px;
  margin-bottom: 25px;
  font-size: 84px;
  text-transform: uppercase;
  font-weight: 800;
  color: #fff;
  letter-spacing: 1px;
}

.main-banner .caption h2 em {
  font-style: normal;
  color: #ed563b;
  font-weight: 900;
}
.logo {
    margin-left: 30px;
    color: #1e1e1e;
  }


</style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar" id="myNavbar">
<a href="index.html" class="logo">Ulitimate <em> GYM</em></a>
  
    <a href="index.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">Home</a>
    <a href="registration.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'active'; ?>">Profile</a>
    <a href="services.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'services.php') echo 'active'; ?>">Services</a>
    <a href="classes.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'classes.php') echo 'active'; ?>">Classes</a>
    <a href="contact.php" class="<?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active'; ?>">Contact Us</a>
    <a href="javascript:void(0);" class="menu-icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>work harder, get stronger</h6>
                <h2>easy with our <em>gym</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="#features">Become a member</a>
                </div>
            </div>
        </div>
    </div>

<!-- Content Section -->
<div class="content" id="learn-more">
    <p>Welcome to our state-of-the-art gym management system. We are dedicated to providing you with the best fitness experience possible. Our facilities are equipped with top-of-the-line equipment, expert trainers, and a supportive community to help you achieve your fitness goals.</p>
    <p>Whether you're looking to build muscle, lose weight, or improve your overall health and wellness, we have everything you need to succeed. From personalized workout plans to nutrition guidance, we're here to support you every step of the way.</p>
    <p>Explore our website to learn more about our services, classes, membership options, and contact information. Feel free to reach out to us if you have any questions or would like to schedule a tour of our facilities. We look forward to helping you on your fitness journey!</p>
</div>
<!--login-->
<div class="login-box">
    <h2>Login Form</h2>
    <?php if(isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="loginUsername">Username:</label><br>
        <input type="text" id="loginUsername" name="loginUsername" required><br>
        <label for="loginPassword">Password:</label><br>
        <input type="password" id="loginPassword" name="loginPassword" required><br><br>
        <input type="submit" value="Login" name="login">
    </form>
    <div>
        <p>Don't have an account? <a href="registration.php" id="registerLink">Register</a></p>
        <p>Admin Login: <a href="administration.php" id="adminLoginLink">Admin Login</a></p>
    </div>
</div>



<header>
        <h1>Gym Achievements</h1>
    </header>
    <main>
        <section class="achievement">
            <h2>Weightlifting Champ</h2>
            <p>Deadlift: 500 lbs</p>
            <p>Squat: 450 lbs</p>
            <p>Bench Press: 400 lbs</p>
        </section>
        <section class="achievement">
            <h2>Marathon Runner</h2>
            <p>Completed 5 marathons</p>
            <p>Fastest time: 3:30:00</p>
        </section>
        <section class="achievement">
            <h2>Bodybuilding Pro</h2>
            <p>Won Mr./Ms. Gym competition</p>
            <p>Body fat percentage: 5%</p>
        </section>
    </main>


<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="location-info">
            <p>&copy; <?php echo date("Y"); ?> Ulitimate Gym All rights reserved.</p>

            <p>We are conveniently located at:</p>
            <address>
                Gym Street<br>

                Civil lines, Nagpur<br>

                India
            </address> 
        </div>
        <div class="creator-info">
            <p>BY</p>
            <p> ANUP WAITKAR </p>
            <p>2113067 {CM 3RD YEAR}</p>
        </div>
    </div>
</footer>

<script>
    // Function to toggle responsive navigation
    function myFunction() {
        var x = document.getElementById("myNavbar");
        if (x.className === "navbar") {
            x.className += " responsive";
        } else {
            x.className = "navbar";
        }
    }

    

    // Smooth scrolling to content section
    document.querySelector('a[href="#learn-more"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('.content').scrollIntoView({ behavior: 'smooth' });
    });
  



// Function to handle user login
function loginUser() {
    // Get form input values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define what happens on successful data submission
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Login successful
            alert(xhr.responseText); // You can handle the response here
            // Optionally, you can redirect the user to another page
        }
    };

    // Define what happens in case of error
    xhr.onerror = function() {
        console.error("Error occurred while logging in user.");
    };

    // Send the request with the form data
    xhr.send("username=" + username + "&password=" + password);
}

function highlightSection(section) {
    // Remove 'active' class from all sections
    document.querySelectorAll('.about-us, .location').forEach(section => {
        section.classList.remove('active');
    });

    // Add 'active' class to the clicked section
    section.classList.add('active');
}

<?php
// Close the database connection
$conn->close();
?>
  
</script>

</body>
</html>
