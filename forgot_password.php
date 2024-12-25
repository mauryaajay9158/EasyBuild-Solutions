<?php 
$server = "localhost";
$username = "root";
$password = "";
$dbname = "easybuild_solutions";
$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle password reset
if (isset($_POST['reset_password'])) {
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];
    $new_password = $_POST['new_password'];

    // Verify the security answer
    $sql = "SELECT * FROM users WHERE username='$username' AND security_answer='$security_answer'";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // If the security answer is correct, update the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password='$hashed_password' WHERE username='$username'";

        if (mysqli_query($con, $update_sql)) {
            echo "Password reset successful!";
        } else {
            echo "Error updating password: " . mysqli_error($con);
        }
    } else {
        echo "Incorrect username or security answer!";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image 4.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            width: 350px;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff5722;
            border: none;
            color: white;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e64a19;
        }

        /* Animation for fade-in effect */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>
    <form action="forgot_password.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="security_answer" placeholder="Security Answer" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <button type="submit" name="reset_password">Reset Password</button>
    </form>
</div>

</body>
</html>
