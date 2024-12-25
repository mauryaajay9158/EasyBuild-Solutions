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

// Fetch the projects posted by the logged-in builder
$builder_id = $_SESSION['builder_id'];
$sql = "SELECT * FROM projects WHERE builder_id = '$builder_id'";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
    <style>
        /* Background animation */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('image 8.jpg') no-repeat center center fixed;
            background-size: cover;
            animation: backgroundZoom 20s infinite alternate;
            color: #fff;
        }

        @keyframes backgroundZoom {
            0% {
                background-size: 100%;
            }
            100% {
                background-size: 110%;
            }
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em;
            color: #ffcc00;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.6);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            color: #ffcc00;
        }

        th {
            background-color: #333;
            font-size: 1.2em;
        }

        td {
            font-size: 1em;
        }

        a {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 15px;
            background-color: #ffcc00;
            color: #333;
            font-size: 1.2em;
            text-decoration: none;
            width: 200px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #ff9900;
            transition: 0.3s;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ffcc00;
            color: #333;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff9900;
            transition: 0.3s;
        }

        p {
            text-align: center;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <h1>My Posted Projects</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Project Name</th>
                <th>Project ID</th>
                <th>Budget</th>
                <th>Description</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Skills Required</th>
                <th>Materials Provided</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['project_name']) ?></td>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['budget']) ?></td>
                    <td><?= htmlspecialchars($row['project_description']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= htmlspecialchars($row['start_date'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['end_date'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['skills_required']) ?></td>
                    <td><?= htmlspecialchars($row['materials_provided']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You haven't posted any projects yet.</p>
    <?php endif; ?>

    <a href="builder_page.php">Back to Dashboard</a>
    
    <form action="contractors_response.php" method="GET">
        <button type="submit" name="view_responses">Contractors Response for the Project</button>
    </form>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
