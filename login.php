<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eems";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $reg_no = $_POST["reg_no"];
    $password = $_POST["password"];

    // Check if the user with the given registration number and password exists
    $selectQuery = $conn->prepare("SELECT * FROM participant WHERE reg_no = ? AND password = ?");
    $selectQuery->bind_param("ss", $reg_no, $password);
    $selectQuery->execute();
    $result = $selectQuery->get_result();

    if ($result->num_rows > 0) {
        // User exists, set session variable and redirect to home page
        $_SESSION["reg_no"] = $reg_no;
        header("Location: home.php");
        exit(); // Ensure script stops executing after redirection
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid credentials!');</script>";
    }
}

$conn->close(); // Close the database connection
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eems - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #28a745;
            margin-bottom: 20px;
            text-align: center;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #28a745;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        .error-msg {
            color: #dc3545;
            margin-top: 10px;
            text-align: center;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #28a745;
            text-decoration: underline;
        }

        .signup-link a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <label for="reg_no">Registration Number:</label>
            <input type="text" id="reg_no" name="reg_no" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]) && $result->num_rows == 0) {
            echo '<p class="error-msg">Invalid credentials!</p>';
        }
        ?>
        <div class="signup-link">
            <a href="registerEvent.php">Don't have an account? Sign Up</a>
        </div>
    </div>
</body>

</html>
