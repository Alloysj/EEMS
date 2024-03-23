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
                <form action="RegisteredEvents.php" class="form-group" method="POST">


                    <label>Student reg number:</label><br>
                    <input type="text" name="reg_no" class="form-control" required><br><br>

                    <button type="submit" name="update" required>Submit</button><br><br>
                    <a href="usn.php"><u>Already registered ?</u></a>
                </form>
            </div>
        </div>
    </div>


    <?php require 'utils/footer.php'; ?>
</body>

</html>

<?php
// Assuming you have already established a database connection
if (isset($_POST["update"])) {
    $reg_no = $_POST["reg_no"];

    if (!empty($reg_no)) {
        include 'classes/db1.php';

        $INSERT = "INSERT INTO registered (rid,reg_no,event_id) VALUES('$rid','$reg_no','$event_id')";

        if ($conn->query($INSERT) === True) {
            echo "<script>
                alert('Registered Successfully!');
                window.location.href='regNo.php';
                </script>";
        } else {
            echo "<script>
                alert(' Already registered this registration number');
                window.location.href='regNo.php';
                </script>";
        }

        $conn->close();
    } else {
        echo "<script>
        alert('All fields are required');
        window.location.href='register.php';
                </script>";
    }
}
?>