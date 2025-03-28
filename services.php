<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('image_16.jpg'); /* Add the path to your background image */
    background-color: rgba(200, 200, 200, 0.8); /* Faint color with opacity */
    background-attachment: fixed; /* Fix the background image */
    background-size: cover; /* Cover the entire viewport */
    background-position: center; /* Center the background image */
    color: #333;
}


        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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

        .services-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .service-item:hover {
            transform: translateY(-5px);
        }

        .service-title {
            font-size: 20px;
            font-weight: bold;
            color: #04AA6D;
            margin-bottom: 10px;
        }

        .service-description {
            line-height: 1.6;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Services</h1>
    <p>Below are the various services offered by our gym:</p>

    <!-- List of Services -->
    <ul class="services-list">
        <li class="service-item">
            <div class="service-title">Personal Training</div>
            <div class="service-description">Receive personalized workout plans and one-on-one coaching from our certified trainers.</div>
        </li>
        <li class="service-item">
            <div class="service-title">Group Fitness Classes</div>
            <div class="service-description">Join our group fitness classes led by experienced instructors, including yoga, Zumba, and more.</div>
        </li>
        <li class="service-item">
            <div class="service-title">Nutrition Counseling</div>
            <div class="service-description">Get expert guidance on nutrition and meal planning to support your fitness goals.</div>
        </li>
        <li class="service-item">
            <div class="service-title">Cardio Equipment</div>
            <div class="service-description">Access our wide range of cardio machines, including treadmills, ellipticals, and stationary bikes.</div>
        </li>
        <li class="service-item">
            <div class="service-title">Strength Training</div>
            <div class="service-description">Utilize our strength training equipment and free weights to build muscle and increase strength.</div>
        </li>
        <!-- Additional Services -->
        <li class="service-item">
            <div class="service-title">Sauna & Steam Room</div>
            <div class="service-description">Relax and rejuvenate in our sauna and steam room facilities after a rigorous workout session.</div>
        </li>
        <li class="service-item">
            <div class="service-title">Indoor Swimming Pool</div>
            <div class="service-description">Enjoy swimming laps or water aerobics in our indoor pool for a full-body workout.</div>
        </li>
        <li class="service-item">
            <div class="service-title">Massage Therapy</div>
            <div class="service-description">Pamper yourself with therapeutic massage sessions to relieve muscle tension and promote recovery.</div>
        </li>
    </ul>
</div>

<script>
    // Add event listener to window for scroll event
    window.addEventListener('scroll', function() {
        // Check if the user has scrolled to the bottom of the page
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            // Redirect to the index page when scrolling to the bottom
            window.location.href = 'index.php'; // Replace 'index.php' with your actual index page URL
        }
    });
</script>

</body>
</html>
