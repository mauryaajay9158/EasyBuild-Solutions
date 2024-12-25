<?php 
// Start the session
session_start();

// Check if the builder is logged in
if (!isset($_SESSION['builder_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login_signup.php");
    exit();
}

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "easybuild_solutions";
$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle project posting
if (isset($_POST['post_project'])) {
    $project_name = mysqli_real_escape_string($con, $_POST['project_name']);
    $project_description = mysqli_real_escape_string($con, $_POST['project_description']);
    $budget = mysqli_real_escape_string($con, $_POST['budget']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
    $skills_required = mysqli_real_escape_string($con, $_POST['skills_required']);
    $materials_provided = mysqli_real_escape_string($con, $_POST['materials_provided']);
    $builder_id = $_SESSION['builder_id'];

    $sql = "INSERT INTO projects (builder_id, project_name, project_description, budget, location, start_date, end_date, skills_required, materials_provided) 
            VALUES ('$builder_id', '$project_name', '$project_description', '$budget', '$location', '$start_date', '$end_date', '$skills_required', '$materials_provided')";
    
    if (mysqli_query($con, $sql)) {
        echo "Project posted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builder Dashboard</title>
    <style>
        /* Adding background image and styling */
        body {
            font-family: 'Poppins', sans-serif; /* Custom font */
            background-image: url('image 8.jpg'); /* Use your background image */
            background-size: cover;
            background-position: center;
            color: #fff; /* Text color for readability on dark background */
            margin: 0;
            padding: 0;
        }

        /* Container for form and heading */
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            margin: 50px auto;
            padding: 20px;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.5);
        }

        h1, h2 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Form styles */
        form {
            margin: 20px 0;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1.1em;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }
        button {
            padding: 12px 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        button:hover {
            background-color: #45a049;
        }

        /* Button styles for navigation */
        .view-projects {
            background-color: #007BFF;
        }

        .view-projects:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- Add link to Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Welcome, Builder</h1>
        <h2>Post a New Project</h2>

        <form action="builder_page.php" method="POST">
            <label for="project_name">Project Name:</label>
            <input type="text" id="project_name" name="project_name" required>
            
            <label for="project_description">Project Description:</label>
            <textarea id="project_description" name="project_description" required></textarea>
            
            <label for="budget">Budget (in INR):</label>
            <input type="number" id="budget" name="budget" required>
            
            <label for="location">Project Location:</label>
            <input type="text" id="location" name="location" required>
            
            <label for="start_date">Expected Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
            
            <label for="end_date">Expected End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
            
            <label for="skills_required">Required Skills (comma-separated):</label>
            <input type="text" id="skills_required" name="skills_required" required>
            
            <label for="materials_provided">Will materials be provided? (Yes/No):</label>
            <input type="text" id="materials_provided" name="materials_provided" required>
            
            <button type="submit" name="post_project">Post Project</button>
        </form>

        <!-- Add a button to redirect to builder_project.php -->
        <form action="builder_project.php" method="GET">
            <button type="submit" class="view-projects">View My Projects</button>
        </form>
    </div>
</body>
</html>
