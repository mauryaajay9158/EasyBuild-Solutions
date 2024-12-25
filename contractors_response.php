<?php 
// Start the session
session_start();

// Check if the builder is logged in
if (!isset($_SESSION['builder_id'])) {
    // Redirect to login if not logged in
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

// Fetch contractor bids for projects posted by the logged-in builder
$builder_id = $_SESSION['builder_id']; // Assuming builder_id is stored in the session

// Modify the query to show bids only for the builder's projects
$sql = "SELECT bids.project_id, bids.contractor_id, bids.bid_amount, bids.estimated_time, bids.experience, bids.material_cost, bids.payment_terms, bids.additional_notes, users.username, users.email
        FROM bids
        JOIN projects ON bids.project_id = projects.id
        JOIN users ON bids.contractor_id = users.id
        WHERE projects.builder_id = '$builder_id'";

$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contractor Responses</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('image 2.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 4em;
            font-family: 'Lobster', cursive; /* Stylish font */
            color: #ff6347; /* Tomato color */
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(255, 99, 71, 0.2), rgba(255, 165, 0, 0.2));
            border: 2px solid #ff6347;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
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
        }

        th {
            background-color: #333;
            font-size: 1.2em;
            color: #fff; /* White text for header */
        }

        td {
            font-size: 1em;
            color: #fff; /* White text for table rows */
        }

        button {
            padding: 10px 20px;
            background-color: #ff6347; /* Button background color */
            color: #fff;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ffa500; /* Hover color */
            transition: 0.3s;
        }

        p {
            text-align: center;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <h1>Contractor Responses for Your Projects</h1>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <tr>
                <th>Project ID</th>
                <th>Contractor Username</th>
                <th>Contractor Email</th>
                <th>Bid Amount</th>
                <th>Estimated Time</th>
                <th>Experience</th>
                <th>Material Cost</th>
                <th>Payment Terms</th>
                <th>Additional Notes</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['project_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['bid_amount']; ?></td>
                    <td><?php echo $row['estimated_time']; ?></td>
                    <td><?php echo $row['experience']; ?></td>
                    <td><?php echo $row['material_cost']; ?></td>
                    <td><?php echo $row['payment_terms']; ?></td>
                    <td><?php echo $row['additional_notes']; ?></td>
                    <td>
                        <!-- Button to contact contractor -->
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row['email']; ?>" target="_blank">
                            <button type="button">Contact Contractor</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No contractor responses found for your projects.</p>
    <?php } ?>

    <?php mysqli_close($con); ?>
</body>
</html>
