<?php 
// Start the session
session_start();

// Check if the contractor is logged in
if (!isset($_SESSION['contractor_id'])) {
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

// Fetch available projects for bidding
$sql = "SELECT * FROM projects";
$result = mysqli_query($con, $sql);

// Handle bid submission
if (isset($_POST['submit_bid'])) {
    $project_id = mysqli_real_escape_string($con, $_POST['project_id']);
    $bid_amount = mysqli_real_escape_string($con, $_POST['bid_amount']);
    $estimated_time = mysqli_real_escape_string($con, $_POST['estimated_time']);
    $experience = mysqli_real_escape_string($con, $_POST['experience']);
    $material_cost = mysqli_real_escape_string($con, $_POST['material_cost']);
    $payment_terms = mysqli_real_escape_string($con, $_POST['payment_terms']);
    $additional_notes = mysqli_real_escape_string($con, $_POST['additional_notes']);
    $contractor_id = $_SESSION['contractor_id'];

    $sql = "INSERT INTO bids (project_id, contractor_id, bid_amount, estimated_time, experience, material_cost, payment_terms, additional_notes) 
            VALUES ('$project_id', '$contractor_id', '$bid_amount', '$estimated_time', '$experience', '$material_cost', '$payment_terms', '$additional_notes')";
    
    if (mysqli_query($con, $sql)) {
        echo "Bid submitted successfully!";
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
    <title>Contractor Dashboard</title>
    <style>
        /* Background animation */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('image 1.jpg') no-repeat center center fixed;
            background-size: cover;
            animation: backgroundZoom 20s infinite alternate;
            color: #fff;
        }

        @keyframes backgroundZoom {
            0% {
                background-size: 150%;
            }
            100% {
                background-size: 110%;
            }
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 3.5em; /* Larger font size for "Welcome, Contractor" */
            color: #ffcc00;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
            animation: pulseHighlight 27s infinite;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em; /* Smaller font size for "Available Projects" */
            color: #ffcc00;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
            animation: pulseHighlight 20s infinite;
        }

        @keyframes pulseHighlight {
            0%, 100% {
                color: #ffcc00;
                transform: scale(1);
            }
            50% {
                color: #ff6600;
                transform: scale(1.1);
            }
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

        form {
            margin: 20px auto;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: none;
            font-size: 1em;
        }

        button {
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
    <h1>Welcome, Contractor</h1>
    <h2>Available Projects</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Project Name</th>
                <th>Description</th>
                <th>Budget</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Skills Required</th>
                <th>Materials Provided</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['project_name']) ?></td>
                    <td><?= htmlspecialchars($row['project_description']) ?></td>
                    <td><?= htmlspecialchars($row['budget']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= htmlspecialchars($row['start_date'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['end_date'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['skills_required']) ?></td>
                    <td><?= htmlspecialchars($row['materials_provided']) ?></td>
                    <td>
                        <form action="contractor_page.php" method="POST">
                            <input type="hidden" name="project_id" value="<?= $row['id'] ?>">
                            <input type="number" name="bid_amount" placeholder="Bid Amount" required><br>
                            <input type="text" name="estimated_time" placeholder="Estimated Time (e.g., 2 weeks)" required><br>
                            <textarea name="experience" placeholder="Relevant Experience" required></textarea><br>
                            <input type="number" name="material_cost" placeholder="Material Cost (optional)" step="0.01"><br>
                            <input type="text" name="payment_terms" placeholder="Payment Terms" required><br>
                            <textarea name="additional_notes" placeholder="Additional Notes (optional)"></textarea><br>
                            <button type="submit" name="submit_bid">Submit Bid</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No projects available at the moment.</p>
    <?php endif; ?>
</body>
</html>
