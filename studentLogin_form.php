<?php
include_once 'classes/db1.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eems</title>
    <style>
        span.error {
            color: red;
        }
    </style>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
<?php require 'utils/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <form method="POST">
                <label>Registration Number:</label><br>
                <input type="text" name="reg_no" class="form-control" required><br>
                <label>Password:</label><br>
                <input type="password" name="password" class="form-control" required><br>
                <button type="submit" name="login" class="btn btn-default">Login</button>
            </form>
        </div>
    </div>
</div>
<?php require 'utils/footer.php'; ?>
<script src="validate.js"></script>
</body>
</html>

<?php
if (isset($_POST["login"])) {
    $reg_no = $_POST['reg_no'];
    $password = $_POST['password'];

    // Fetch user details from the database based on reg number
    $query = "SELECT * FROM participant WHERE reg_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $reg_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, redirect to student dashboard or homepage
            echo "<script>
                    alert('Login Successful');
                    window.location.href='RegisteredEvents.php';
                    </script>";
        } else {
            // Invalid password
            echo "<script>
                    alert('Invalid credentials');
                    window.location.href='studentLogin_form.php';
                    </script>";
        }
    } else {
        // Student with given registration number does not exist
        echo "<script>
                alert('Student not found');
                window.location.href='studentLogin.php';
                </script>";
    }
}
?>
