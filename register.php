<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Eems</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->

</head>

<body>
    <?php require 'utils/header.php'; ?>
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <?php $event_id = $_GET['event_id']; ?>
                <form method="POST" id="form">

                    <input type="hidden" name="event_id" value="' . $event_id . '">
                    <label>Student reg number:</label><br>
                    <input type="text" name="reg_no" id="reg_no" pattern="[A-Z]\d{2}/\d{5}/\d{2}" title="Please follow the required format: A13/09487/19" class="form-control" required><br><br>


                   
                    <button type="submit" name="update" required>Submit</button><br><br>
                    

                </form>
            </div>
        </div>
    </div>


    <?php require 'utils/footer.php'; ?>
</body>

</html>

<?php

// Check if the registration form is submitted
if (isset($_POST["update"])) {
    $reg_no = $_POST["reg_no"];
    $event_id = $_POST["event_id"]; 

    // Validate input (you can add more validation if needed)
    if (!empty($reg_no)) {

        include 'classes/db1.php';

        // Check if the registration number exists in the participant table
        $check_query = $conn->prepare("SELECT reg_no FROM participant WHERE reg_no = ?");
        $check_query->bind_param("s", $reg_no);
        $check_query->execute();
        $check_query->store_result();

        if ($check_query->num_rows > 0) {
            // Registration number exists, check if the student is already registered for the event
            $check_registration_query = $conn->prepare("SELECT * FROM registered WHERE reg_no = ? AND event_id = ?");
            $check_registration_query->bind_param("si", $reg_no, $event_id);
            $check_registration_query->execute();
            $check_registration_query->store_result();

            if ($check_registration_query->num_rows > 0) {
                // Student is already registered for the event
                echo "<script>
                        alert('You are already registered for this event.');
                        window.location.href='register.php';
                        </script>";
                exit; // Stop further execution
            } else {
                // Student is not registered for the event, insert a new registration record
                $INSERT = "INSERT INTO registered (reg_no, event_id) VALUES (?, ?)";
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("si", $reg_no, $event_id); // Use "si" for string and integer data types

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Registered for the event!');
                            window.location.href='RegisteredEvents.php'; // Redirect to homepage or any other page
                            </script>";
                    exit; // Stop further execution
                } else {
                    echo "<script>
                            alert('An error occurred while registering for the event.');
                            window.location.href='register.php';
                            </script>";
                    exit; // Stop further execution
                }
            }
        } else {
            // Registration number does not exist, redirect to register page
            echo "<script>
                    alert('Please register first before registering for the event.');
                    window.location.href='registerEvent.php';
                    </script>";
            exit; // Stop further execution
        }

        $stmt->close();
        $conn->close();
    } else {
        // If any field is empty
        echo "<script>
                alert('All fields are required');
                window.location.href='register.php';
                </script>";
        exit; // Stop further execution
    }
}
?>
