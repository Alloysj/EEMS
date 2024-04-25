<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $reg_no = $_POST["reg_no"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $faculty = $_POST["faculty"];
    $password = $_POST["password"];

    // Check if any of the required fields are empty
    if (!empty($reg_no) && !empty($name) && !empty($email) && !empty($faculty) && !empty($password)) {

        // Check if the registration number already exists
        $check_query = $conn->prepare("SELECT reg_no FROM participant WHERE reg_no = ?");
        $check_query->bind_param("s", $reg_no);
        $check_query->execute();
        $check_result = $check_query->get_result();

        if ($check_result->num_rows > 0) {
            // Registration number already exists
            echo "<script>
                    alert('Registration number already exists!');
                    window.location.href='registerEvent.php';
                    </script>";
            exit; // Stop further execution
        }

        // Proceed with insertion if the registration number is unique
        $INSERT = "INSERT INTO participant (reg_no, name, email, faculty, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssss", $reg_no, $name, $email, $faculty, $password);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Registered Successfully!');
                    window.location.href='login.php?action=student';
                    </script>";
        } else {
            echo "<script>
                    alert('An error occurred while registering.');
                    window.location.href='registerEvent.php';
                    </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
            alert('All fields are required');
            window.location.href='registerEvent.php';
                    </script>";
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eems - Register Event</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" id="form" onsubmit="autofillFaculty()">
                    <label>Student Name:</label><br>
                    <input type="text" name="name" id="name" pattern="[A-Za-z ]+" title="Please enter letters only" class="form-control" required><br><br>
                    <label>Registration Number:</label><br>
                    <input type="text" name="reg_no" id="reg_no" pattern="[A-Z]\d{2}/\d{5}/\d{2}" title="Please follow the required format: A13/09487/19" class="form-control" required oninput="autofillFaculty()"><br><br>
                    <label>Faculty:</label><br>
                    <input type="text" id="faculty" name="faculty" class="form-control" required><br><br>
                    <label>Email:</label><br>
                    <input type="email" name="email" class="form-control" required><br><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required><br><br>
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" oninput="checkPasswords()" required><br>
                    <p id="passwordMatchMessage"></p><br><br>
                    <button type="submit" name="update" id="submit" required>Submit</button><br><br>
                </form>
            </div>
        </div>
    </div>
    <script>
        function autofillFaculty() {
            const regNoInput = document.getElementById("reg_no");
            const facultyInput = document.getElementById("faculty");
            const regNoValue = regNoInput.value.toUpperCase();

            if (regNoValue.startsWith('A')) {
                facultyInput.value = 'FASS'
            } else if (regNoValue.startsWith('S')) {
                facultyInput.value = 'FOS'
            } else if (regNoValue.startsWith('K')) {
                facultyInput.value = 'FOA'
            } else if (regNoValue.startsWith('P')) {
                facultyInput.value = 'ENGINEERING'
            } else {
                facultyInput.value = "";
            }
        }

        function checkPasswords() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            const passwordMatchMessage = document.getElementById("passwordMatchMessage");
            const submit = document.getElementById("submit");

            // Password strength criteria
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecialChar = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password);

            if (password.length >= 8 && hasUpperCase && hasLowerCase && hasNumber && hasSpecialChar) {
                if (password === confirmPassword) {
                    passwordMatchMessage.textContent = "Passwords match and are strong!";
                    passwordMatchMessage.style.color = "green";
                    submit.disabled = false;
                } else {
                    passwordMatchMessage.textContent = "Passwords do not match!";
                    passwordMatchMessage.style.color = "red";
                    submit.disabled = true;
                }
            } else {
                passwordMatchMessage.textContent = "Password must contain at least 8 characters, including uppercase, lowercase, number, and special character";
                passwordMatchMessage.style.color = "red";
                submit.disabled = true;
            }
        }
    </script>
    <?php require 'utils/footer.php'; ?>
</body>
</html>
