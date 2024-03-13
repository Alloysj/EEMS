
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Eems</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/header.php'; ?>
    <div class ="content"><!--body content holder-->
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
    <form method="POST">

   
        <label>Student reg number:</label><br>
        <input type="text" name="usn" class="form-control" required><br><br>

        <label>Student Name:</label><br>
        <input type="text" name="name" class="form-control" required><br><br>

        <label>Branch:</label><br>
        <input type="text" name="branch" class="form-control" required><br><br>

        <label>Semester:</label><br>
        <input type="text" name="sem" class="form-control" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email"  class="form-control" required ><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone"  class="form-control" required><br><br>

        <label>College:</label><br>
        <input type="text" name="college"  class="form-control" required><br><br>

        <button type="submit" name="update" required>Submit</button><br><br>
        <a href="usn.php" ><u>Already registered ?</u></a>

    </div>
    </div>
    </div>
    </form>
    

    <?php require 'utils/footer.php'; ?>
    </body>
</html>

<?php
// Assuming you have already established a database connection
// and selected the appropriate database.

// Check if the event_id is passed via GET request
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Display the registration form
    echo '<html>';
    echo '<head><title>Event Registration</title></head>';
    echo '<body>';
    echo '<h1>Event Registration</h1>';
    echo '<form action="registerEvent.php" method="post">';
    echo 'USN Number: <input type="text" name="usn"><br>';
    echo '<input type="hidden" name="event_id" value="' . $event_id . '">';
    echo '<input type="submit" value="Register">';
    echo '</form>';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usn = $_POST['usn'];

        // Check if the USN exists in the "registered" table
        $query = "SELECT * FROM registered WHERE usn = '$usn'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            // User is already registered
            echo '<p>Error: You are already registered for this event.</p>';
            echo '<a href="register.php">Go back to registration page</a>';
        } else {
            // Insert user information into the "participant" table
            $name = $_POST['name']; // Assuming you collect other user info
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $branch = $_POST['branch'];

            $insert_query = "INSERT INTO registered (usn)
                             VALUES ('$usn')";
            if (mysqli_query($connection, $insert_query)) {
                echo '<p>Registration successful!</p>';
            } else {
                echo '<p>Error: Registration failed. Please try again later.</p>';
            }
        }
    }

    echo '</body>';
    echo '</html>';
} else {
    // Redirect to the registration page if event_id is not provided
    header('Location: register.php');
    exit;
}
?>
