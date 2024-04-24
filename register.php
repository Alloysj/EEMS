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
                <?php 
                // Get event details from URL parameters
                $event_id = $_GET['event_id'];
                $event_title = $_GET['event_title'];
                $event_date = $_GET['event_date'];
                $event_time = $_GET['event_time'];
                $venue_name = $_GET['venue_name'];
                ?>
                <form method="POST" id="form">
                    <!-- Add hidden input fields to submit event details -->
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <input type="hidden" name="event_title" value="<?php echo $event_title; ?>">
                    <input type="hidden" name="event_date" value="<?php echo $event_date; ?>">
                    <input type="hidden" name="event_time" value="<?php echo $event_time; ?>">
                    <input type="hidden" name="venue_name" value="<?php echo $venue_name; ?>">
                    
                    
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
if (isset($_POST["update"])) {
    $reg_no = $_POST["reg_no"];
    $event_id = $_POST["event_id"];
    $event_title = $_POST["event_title"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $venue_name = $_POST["venue_name"];

    if (!empty($reg_no)) {
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
                        window.location.href='index.php';
                      </script>";
            } else {
                // User is not registered for this event, proceed with registration
                $INSERT = "INSERT INTO registered (rid, reg_no, event_id) VALUES ('$rid', '$reg_no', '$event_id')";
                if ($conn->query($INSERT) === true) {
                    // Registration successful, retrieve email and name from participant table
                    $participant_query = "SELECT email, name FROM participant WHERE reg_no = '$reg_no'";
                    $participant_result = $conn->query($participant_query);
                    $participant_row = $participant_result->fetch_assoc();
                    $to = $participant_row['email'];
                    $participant_name = $participant_row['name'];
                
                    // Compose email message
                    $subject = "Event Registration Confirmation";
                    $message = "Dear $participant_name,\n\nThank you for registering for the event \"$event_title\" scheduled for $event_date at $event_time at $venue_name. We look forward to seeing you there!\n\nRegards,\nEvent Organizer";
                    $headers = "From: egertonevents@gmail.com";
                
                    // Send email
                    if (mail($to, $subject, $message, $headers)) {
                        echo "<script>
                                alert('Registered Successfully! Email notification sent.');
                                window.location.href='regNo.php';
                              </script>";
                    } else {
                        echo "<script>
                                alert('Registered Successfully! Failed to send email notification.');
                                window.location.href='regNo.php';
                              </script>";
                    }
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
    } else {
        echo "<script>
                alert('All fields are required');
                window.location.href='register.php';
              </script>";
    }
}
?>
