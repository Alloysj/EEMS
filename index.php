<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eems</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->

    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #28a745; /* Green background */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Modal styles */
        .modal-container {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #28a745; /* Green modal background */
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #218838; /* Darker border color */
            width: 80%;
            max-width: 400px;
            position: relative;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #fff; /* White close icon */
            cursor: pointer;
        }

        .close:hover {
            color: #ccc; /* Lighter color on hover */
        }

        /* Form styles */
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff; /* White label text */
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #28a745; /* Green button */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .signup-link {
            margin-top: 10px;
            text-align: center;
            color: #fff; /* White signup link text */
        }

        .signup-link a {
            color: #fff; /* White link color */
            text-decoration: underline;
        }

        .signup-link a:hover {
            color: #ccc; /* Lighter color on hover */
        }

        /* Updated CSS for the navbar */
        .navbar {
            background-color: #008000;
            border: none;
            border-radius: 0;
            padding-bottom: 30px;
        }

        .navbar-brand {
            color: #ffffff; /* White text */
            background-color: #008000; /* Green background */
            padding: 10px; /* Add padding for spacing */
            border-radius: 5px; /* Add border-radius for rounded corners */
        }

        .navbar-brand:hover,
        .navbar-brand:focus {
            color: #ffd700; /* Yellow text on hover/focus */
            background-color: #006400; /* Darker green on hover/focus */
        }

    </style>
    <header class="bgImage">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header"><!--website title-->

                <a class="navbar-brand">
                    <h2>Egerton Event Management System</h2>
                </a>
            </div>
    </header>
</head>

<body>
    <div class="container">
        <h2>Welcome to Eems</h2>
        <p>Please select your role:</p>
        <a href="login.php?action=student" class="button" onclick="showModal('login.php?action=student')">Student</a>
        <a href="#" class="button" onclick="showModal('adminModal')">Admin</a>
    </div>

    <script>
        function showModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "block";
        }

        function hideModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        function validateAdminPassword() {
            var adminPassword = document.getElementById("admin_password").value;
            if (adminPassword !== "admin") {
                alert("Invalid admin password!");
                return false;
            }
            return true;
        }
    </script>

    <!-- Student Login Modal -->
    <div id="studentModal" class="modal-container">
        <div class="modal-content">
            <span class="close" onclick="hideModal('studentModal')">&times;</span>
            <h3>Student Login</h3>
            <form method="POST" action="home.php" id="studentLoginForm">
                <label for="reg_no">Registration Number:</label>
                <input type="text" id="reg_no" name="reg_no" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <button type="submit">Login</button>
            </form>
            <div class="signup-link">
                <p>Don't have an account? <a href="registerEvent.php">Sign Up</a></p>
            </div>
        </div>
    </div>

    <!-- Admin Login Modal -->
    <div id="adminModal" class="modal-container">
        <div class="modal-content">
            <span class="close" onclick="hideModal('adminModal')">&times;</span>
            <h3>Admin Login</h3>
            <form method="POST" action="adminpage.php" id="adminLoginForm" onsubmit="return validateAdminPassword()">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" name="admin_password" required><br>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
