<?php
require_once 'classes/db1.php';

// Check if 'event_id' and 'reg_no' are set in the $_POST array
if(isset($_POST['event_id']) && isset($_POST['reg_no'])) {
    $event_id = $_POST['event_id'];
    $reg_no = $_POST['reg_no'];

    // SQL query to delete student details from the registered table
    $sql = "DELETE FROM registered WHERE event_id = '$event_id' AND reg_no = '$reg_no'";

    if ($conn->query($sql) === true) {
        echo "<script>
                alert('Unregistered Successfully');
                window.location.href = 'registeredEvents.php?reg_no=$reg_no'; 
              </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Event ID and registration number are required.";
}
?>
