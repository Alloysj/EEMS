<?php
session_start();

require 'utils/header.php';
require 'utils/styles.php';

if (isset($_SESSION['reg_no'])) {
    $reg_no = $_SESSION['reg_no'];
} else {
    // Redirect or display an error if reg_no is not set in the session
    header('Location: login.php');
    exit(); // Stop further execution
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eems</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->

</head>

<body>
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <?php $event_id = $_GET['event_id']; ?>
                <form method="POST" id="form">
                    <input type="hidden" name="event_id" value="<?= $event_id ?>">
                    <label>Student reg number:</label><br>
                    <input type="text" value="<?= $reg_no ?>" readonly class="form-control"><br><br>

                    <button type="submit" name="update" required>Submit</button><br><br>
                </form>
            </div>
        </div>
    </div>

    <?php require 'utils/footer.php'; ?>
</body>

</html>

<?php
if (isset($_POST["update"])) {
    $reg_no = $reg_no; // Using session attribute instead of $_POST["reg_no"]
    $event_id = $_POST["event_id"];

    include 'classes/db1.php';

    // Check if the given reg_no is available in the participant table
    $SELECT = "SELECT COUNT(*) FROM participant WHERE reg_no = '$reg_no'";
    $result = $conn->query($SELECT);
    $row = $result->fetch_assoc();
    $count = $row["COUNT(*)"];

    if ($count > 0) {
        // Reg_no is available, check if the user is already registered for this event
        $SELECT_REGISTERED = "SELECT COUNT(*) FROM registered WHERE reg_no = '$reg_no' AND event_id = '$event_id'";
        $result_registered = $conn->query($SELECT_REGISTERED);
        $row_registered = $result_registered->fetch_assoc();
        $count_registered = $row_registered["COUNT(*)"];

        if ($count_registered > 0) {
            // User is already registered for this event
            echo "<script>
                    alert('You are already registered for this event.');
                    window.location.href='home.php';
                  </script>";
        } else {
            // User is not registered for this event, proceed with registration
            $INSERT = "INSERT INTO registered (rid, reg_no, event_id) VALUES ('$rid', '$reg_no', '$event_id')";
            if ($conn->query($INSERT) === true) {
                echo "<script>
                        alert('Registered Successfully!');
                        window.location.href='RegisteredEvents.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Already registered this registration number');
                        window.location.href='regNo.php';
                      </script>";
            }
        }
    } else {
        // Reg_no not found, alert the user to register first
        echo "<script>
                alert('Registration number not found. Please register first.');
                window.location.href='register.php';
              </script>";
    }

    $conn->close();
}
?>
