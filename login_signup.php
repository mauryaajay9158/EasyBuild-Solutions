<?php
session_start();

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "easybuild_solutions";
$con = mysqli_connect($server, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Signup logic
if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $security_question = mysqli_real_escape_string($con, $_POST['security_question']);
    $security_answer = mysqli_real_escape_string($con, $_POST['security_answer']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password, user_type, security_question, security_answer) 
            VALUES ('$username', '$email', '$hashed_password', '$user_type', '$security_question', '$security_answer')";

    if (mysqli_query($con, $sql)) {
        echo "Signup successful! You can now log in.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Login logic
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);

    $sql = "SELECT * FROM users WHERE username='$username' AND user_type='$user_type'";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $user_type;

            if ($user_type == 'builder') {
                $_SESSION['builder_id'] = $row['id'];
                header("Location: builder_page.php");
            } elseif ($user_type == 'contractor') {
                $_SESSION['contractor_id'] = $row['id'];
                header("Location: contractor_page.php");
            }
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that username and type!";
    }
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyBuild Solutions - Login & Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image 7.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            animation: slideIn 1.5s ease-out;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 2em;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, select, button {
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }

        input, select {
            background: #f0f0f0;
        }

        button {
            background: #ff9900;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #cc7a00;
        }

        .link {
            margin-top: 10px;
        }

        .form-toggle {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Toggle Form Styling */
        #signupContainer {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Login Form -->
    <div class="container" id="loginContainer">
        <h2>Login - Builder or Contractor</h2>
        <form method="POST" action="login_signup.php">
            <select name="user_type" required>
                <option value="builder">Builder</option>
                <option value="contractor">Contractor</option>
            </select>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="link">
            <p>Don't have an account? <span class="form-toggle" onclick="toggleForm()">Signup here</span></p>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </div>
    </div>

    <!-- Signup Form -->
    <div class="container" id="signupContainer">
        <h2>Signup - Builder or Contractor</h2>
        <form method="POST" action="login_signup.php">
            <select name="user_type" required>
                <option value="builder">Builder</option>
                <option value="contractor">Contractor</option>
            </select>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="security_question" required>
                <option value="Who was your first teacher?">Who was your first teacher?</option>
                <option value="What is your pet's name?">What is your pet's name?</option>
                <option value="Which is your favorite actor?">Which is your favorite actor?</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What was the name of your first school?">What was the name of your first school?</option>
            </select>
            <input type="text" name="security_answer" placeholder="Security Answer" required>
            <button type="submit" name="signup">Signup</button>
        </form>
        <div class="link">
            <p>Already have an account? <span class="form-toggle" onclick="toggleForm()">Login here</span></p>
        </div>
    </div>

    <script>
        function toggleForm() {
            var loginForm = document.getElementById('loginContainer');
            var signupForm = document.getElementById('signupContainer');
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
            }
        }
    </script>
</body>
</html>
