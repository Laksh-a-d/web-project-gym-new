<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
          
            background-image: url('image_15.jpg'); 
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        .timetable {
    background-color: rgba(255, 255, 255, 0); /* Fully transparent */
    
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
}


        table {
            width: 100%;
            border-collapse: collapse;
    
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #04AA6D;
            color: #fff;
            font-weight: normal;
            text-transform: uppercase;
        }

        .day {
            font-weight: bold;
            text-transform: uppercase;
        }

        .join-button {
            background-color: #04AA6D;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .join-button:hover {
            background-color: #048C5D;
        }

        .teacher-contact {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .teacher-column {
            width: 48%;
        }

        .teacher-info {
            background-color: rgba(255, 255, 255, 0.1); /* Transparent background */
            border-radius: 10px;
            padding: 15px; /* Adjusted padding */
            margin-bottom: 15px; /* Adjusted margin */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Shadow effect */
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: Arial, sans-serif;
        
        }

        .teacher-info:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Highlight effect on hover */
            transform: scale(1.05); /* Increase size on hover */
        }

        .teacher-info p {
            margin: 5px 0;
            color: black; /* Lighter text color */
        }

        .teacher-contact-heading {
            text-align: center;
            margin-bottom: 20px; /* Add some margin below the heading */
        }
        footer {
              color: #fff; /* Title color */
              background-color: rgba(50, 50, 50, 0.9);
            color: #fff;
            text-align: center;
            font-size: 20px;
            padding: 10px 0;
            margin-top: 20px;
            
        }
        #trainers .trainer-item {
            background-color: rgba(255, 255, 255, 0); /* Fully transparent */
    

    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 5px;

    padding: 40px;
    margin-bottom: 30px;
    display: flex;
    align-items: center; /* Align items vertically */
    justify-content: space-between; /* Space items evenly */
}

#trainers .trainer-item .image-thumb img {
    width: 150px; /* Increase the image size */
    border-radius: 5px;
    margin-right: 20px; /* Add some spacing between image and content */
}

#trainers .trainer-item .down-content {
    flex-grow: 1; /* Allow content to expand to fill available space */
}

#trainers .trainer-item span {
    font-size: 13px;
    font-weight: 500;
    color: #ed563b;
    display: block;
    margin-bottom: 10px;
}

#trainers .trainer-item h4 {
    font-size: 19px;
    font-weight: 600;
    color: #232d39;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
}

#trainers .trainer-item p {
    margin-bottom: 20px;
}

#trainers .trainer-item ul.social-icons {
    padding-left: 0;
    margin-bottom: 0;
}

#trainers .trainer-item ul.social-icons li {
    display: inline-block;
    margin-right: 12px;
}

#trainers .trainer-item ul.social-icons li:last-child {
    margin-right: 0px;
}

#trainers .trainer-item ul.social-icons li a {
    color: #232d39;
    transition: all .3s;
}

#trainers .trainer-item ul.social-icons li a:hover {
    color: #ed563b;
}

.section-heading {
    text-align: center;
    margin-bottom: 50px;
}

.section-heading h2 {
    font-size: 28px;
    font-weight: 800;
    color: #232d39;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0;
    margin-bottom: 10px;
}

.section-heading em {
    font-style: normal;
    color: #ed563b;
}


    </style>
</head>
<body>

<div class="container">
<div class="section-heading">
    <h1><em>Daily </em>Classes</h1>
    <p>This is the Classes page content. Below is the timetable of different classes available at our gym:</p>

    <!-- Timetable of Classes -->
    <div class="timetable">
        <table>
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Class</th>
                <th>Instructor</th>
                <th>Available Seats</th>
                <th>Action</th>
            </tr>
            <tr>
                <td class="day">Monday</td>
                <td>10:00 AM - 11:00 AM</td>
                <td>Cardio Blast</td>
                <td>John Doe</td>
                <td>10</td>
                <td><button class="join-button" onclick="redirectToRegister()">Join</button></td>
            </tr>
            <tr>
                <td class="day">Tuesday</td>
                <td>10:00 AM - 11:00 AM</td>
                <td>Cardio Blast</td>
                <td>John Doe</td>
                <td>10</td>
                <td><button class="join-button" onclick="redirectToRegister()">Join</button></td>
            </tr>
            <tr>
                <td class="day">Wednesday</td>
                <td>5:00 PM - 6:00 PM</td>
                <td>Yoga Flow</td>
                <td>Jane Smith</td>
                <td>8</td>
                <td><button class="join-button" onclick="redirectToRegister()">Join</button></td>
            </tr>
            <tr>
                <td class="day">Thursday</td>
                <td>7:00 AM - 8:00 AM</td>
                <td>Strength Training</td>
                <td>Mike Johnson</td>
                <td>12</td>
                <td><button class="join-button" onclick="redirectToRegister()">Join</button></td>
            </tr>
            <!-- Add more rows for additional classes -->
            <tr>
                <td class="day">Friday</td>
                <td>6:00 PM - 7:00 PM</td>
                <td>Zumba</td>
                <td>Emily Smith</td>
                <td>15</td>
                <td><button class="join-button" onclick="redirectToRegister()">Join</button></td>
            </tr>
        </table>

    </div>

   <!-- ***** Testimonials Starts ***** -->
   <section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Expert <em>Trainers</em></h2>
                        <img src="images/line-dec.png" alt="">
                        <p>Nunc urna sem, laoreet ut metus id, aliquet consequat magna. Sed viverra ipsum dolor, ultricies fermentum massa consequat eu.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="images/first-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Strength Trainer</span>
                            <h4>Bret D. Bowers</h4>
                            <p>Bitters cliche tattooed 8-bit distillery mustache. Keytar succulents gluten-free vegan church-key pour-over seitan flannel.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="images/second-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Muscle Trainer</span>
                            <h4>Hector T. Daigl</h4>
                            <p>Bitters cliche tattooed 8-bit distillery mustache. Keytar succulents gluten-free vegan church-key pour-over seitan flannel.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="images/third-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Power Trainer</span>
                            <h4>Paul D. Newman</h4>
                            <p>Bitters cliche tattooed 8-bit distillery mustache. Keytar succulents gluten-free vegan church-key pour-over seitan flannel.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Ends ***** -->
    
<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> Ulitimate Gym All rights reserved.</p>
    <p>We are conveniently located at:</p>
        <address>
            123 Gym Street<br>
            Cityville, State 12345<br>
            Country
        </address>
</footer>



<script>
    function redirectToRegister() {
        window.location.href = 'registration.php';
    }

    function highlight(element) {
        element.classList.toggle('highlight');
    }
</script>

</body>
</html>
