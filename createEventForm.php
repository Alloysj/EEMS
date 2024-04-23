<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>cems</title>
  <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->

  <script>
    function validateDate() {
      var selectedDate = new Date(document.getElementById("Date").value);
      var currentDate = new Date();
      
      // Check if the selected date is before the current date
      if (selectedDate < currentDate) {
        alert("Please select a future date.");
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <?php require 'utils/adminHeader.php'; ?>
  <form method="POST" onsubmit="return validateDate();">

    <div class="w3-container">

      <div class="content"><!--body content holder-->
        <div class="container">
          <div class="col-md-6 col-md-offset-3">
            <label for="event_ID">event_ID</label><br>
            <input type="number" name="event_id" required class="form-control"><br><br>
            <label>Event Name:</label><br>
            <input type="text" name="event_title" required pattern="[A-Za-z ]+" title="please enter letters only" class="form-control"><br><br>


            <label>Upload Path to Image:</label><br>
            <input type="text" name="img_link" required class="form-control" placeholder="images/img.jpg"><br><br>

            <label>Event Type</label><br>
            <select name="type_id" id="type_id" class="form-control" required>
              <option value="">Select event type</option>
              <option value="1">Technical event</option>
              <option value="2">Cultural event</option>
              <option value="3">Academic event</option>
              <option value="4">Sports and recreation</option>
              <option value="5">Community service</option>
            </select><br><br>

            <label>Event Date</label><br>
            <input type="date" name="Date" id="Date" required class="form-control"><br><br>

            <label>Event Time</label><br>
            <label>Time:</label><br>
            <input type="text" name="time" id="time" placeholder="12:30 PM" pattern="(08|09|1[0-2]):[0-5][0-9] (AM|PM)"
             title="Please follow the required format: HH:MM AM/PM Event time is between 8AM and PM" class="form-control" required><br><br>


            <label>Event Location</label><br>
            <select name="location" id="location">
              <option value="">Select location</option>
              <option value="Pavillion grounds">Pavillion ground</option>
              <option value="DH1">DH1</option>
              <option value="PST5">PST5</option>
              <option value="ARC HOTEL">ARC HOTEL</option>
              <option value="T1">T1</option>
            </select>
            <input type="text" name="location" required class="form-control"><br><br>
            <label>Staff co-ordinator name</label><br>
            <input type="text" name="sname" required pattern="[A-Za-z ]+" title="please enter letters only" class="form-control"><br><br>
            <label>Student co-ordinator name</label><br>
            <input type="text" name="st_name" pattern="[A-Za-z ]+" title="please enter letters only" required class="form-control"><br><br>

            <button type="submit" name="update" class="btn btn-default pull-right">Create Event <span class="glyphicon glyphicon-send"></span></button>

            <a class="btn btn-default navbar-btn" href="adminPage.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>


          </div>
        </div>
      </div>
  </form>

</body>

<?php require 'utils/footer.php'; ?>

</html>

<?php

if (isset($_POST["update"])) {
  $event_id = $_POST["event_id"];
  $event_title = $_POST["event_title"];

  $img_link = $_POST["img_link"];
  $type_id = $_POST["type_id"];
  $name = $_POST["sname"];
  $st_name = $_POST["st_name"];
  $Date = $_POST["Date"];
  $time = $_POST["time"];
  $location = $_POST["location"];
  if (!empty($event_id) || !empty($event_title) || !empty($event_price) || !empty($participents) || !empty($img_link) || !empty($type_id)) {
    include 'classes/db1.php';



    $INSERT = "INSERT INTO events(event_id,event_title,img_link,type_id) VALUES($event_id,'$event_title','$img_link',$type_id);";

    $INSERT .= "INSERT INTO event_info (event_id,Date,time,location) Values ($event_id,'$Date','$time','$location');";
    $INSERT .= "INSERT into student_coordinator(st_name,phone,event_id)  values('$st_name',NULL,$event_id);";
    $INSERT .= "INSERT into staff_coordinator(name,phone,event_id)  values('$name',NULL,$event_id)";

    if ($conn->multi_query($INSERT) === True) {
      echo "<script>
          alert('Event Inserted Successfully!');
          window.location.href='adminPage.php';
          </script>";
    } else {
      echo "<script>
          alert('Event already exsists!');
          window.location.href='createEventForm.php';
          </script>";
    }

    $conn->close();
  } else {
    echo "<script>
      alert('All fields are required');
      window.location.href='createEventForm1.php';
      </script>";
  }
}
?>
