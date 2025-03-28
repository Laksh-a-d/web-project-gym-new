<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

            background-image: url('image_3.jpg'); 
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Transparent background */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #04AA6D;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 20px;
        }

        form {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        input[type="submit"],
        .back-button {
            background-color: #04AA6D;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        .back-button:hover {
            background-color: #0e8059;
        }

        .back-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Contact Us</h1>
    <p>Feel free to reach out to us with any questions or inquiries. </p>
    <p>Please fill out the form below, and we'll get back to you as soon as possible.</p>

    <?php
    // Database connection
    $servername = "localhost"; // Change this
    $username = "root"; // Change this
    $password = "2005"; // Change this
    $dbname = "gym"; // Change this

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>Thank you for your feedback!</p>";
            echo "<a href='index.php' class='back-button'>Go Back</a>"; // Add a button to go back
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>

    <!-- Contact Form -->
    <form action="#" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
