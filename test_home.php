<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyBuild Solutions</title>
    <link rel="icon" href="easybuildlogo.jpg" type="image/jpg">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        /* Header */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo-container img {
            height: 60px;
            margin-right: 15px;
        }
        header h1 {
            font-size: 2.5em;
        }
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: #fff;
            font-size: 1.2em;
            padding: 10px 20px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        nav ul li a:hover {
            border: 2px solid #fff;
        }
        /* Hero Section */
       /* Hero Section */
.hero {
    background: url('image 2.jpg') no-repeat center center/cover;
    height: 90vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-align: center;
    animation: zoomInBackground 10s infinite alternate; /* Apply the zoom-in animation */
}

@keyframes zoomInBackground {
    0% {
        transform: scale(1); /* Start at normal size */
    }
    50% {
        transform: scale(1.05); /* Slightly zoom in */
    }
    100% {
        transform: scale(1); /* Return to normal size */
    }
}


        .hero h2 {
            font-size: 3em;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.5em;
            margin-bottom: 30px;
        }
        .hero button {
            padding: 15px 30px;
            background-color: #ff9900;
            border: none;
            color: #fff;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .hero button:hover {
            background-color: #cc7a00;
        }
        /* Services Section */
        .services {
            padding: 50px 0;
            text-align: center;
        }
        .services h3 {
            font-size: 2.2em;
            margin-bottom: 40px;
        }
        .service-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .service {
            background: #f4f4f4;
            padding: 30px;
            margin: 15px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .service:hover {
            transform: scale(1.05);
        }
        .service img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .service h4 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .service p {
            font-size: 1em;
        }
        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        footer p {
            font-size: 0.9em;
        }

        /* Header with background and logo */
        header {
            background-image: url('nightview.jpg'); /* Your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            color: white;
            font-family: 'Arial', sans-serif;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-container img {
            height: 60px;
            margin-right: 15px;
        }

        /* Remove animation from header */
        h1 {
            font-size: 3em;
        }

        /* Navigation menu */
        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            transition: transform 0.3s ease, color 0.3s ease; /* Transition for hover */
            position: relative;
            padding-bottom: 5px;
        }

        nav ul li a::after {
            content: '';
            width: 0;
            height: 2px;
            background-color: white;
            position: absolute;
            left: 0;
            bottom: 0;
            transition: width 0.3s ease;
        }

        nav ul li a:hover {
            color: #FFD700; /* Gold color on hover */
            transform: scale(1.1); /* Slight zoom-in effect on hover */
        }

        nav ul li a:hover::after {
            width: 100%; /* Underline effect on hover */
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo-container">
            <img src="easybuildlogo.jpg" alt="EasyBuild Logo">
            <h1>EasyBuild Solutions</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h2>Your Construction Partner</h2>
            <p>Connecting Builders and Contractors</p>
            <button onclick="window.location.href='login_signup.php'">Get Started</button>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <h3>Our Services</h3>
        <div class="service-container">
            <div class="service">
                <img src="Image 1.jpg" alt="Service 1">
                <h4>Project Planning</h4>
                <p>We help you plan your construction project with ease and efficiency.</p>
            </div>
            <div class="service">
                <img src="bid image.jpeg" alt="Service 2">
                <h4>Efficient Bidding</h4>
                <p>Contractors can place bids and builders can select the best offers.</p>
            </div>
            <div class="service">
                <img src="workforce.avif" alt="Service 3">
                <h4>Professional Workforce</h4>
                <p>Find qualified contractors and workers for your project.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 EasyBuild Solutions. All rights reserved.</p>
    </footer>

</body>
</html>
