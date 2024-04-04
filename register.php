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


                    <label>Student Name:</label><br>
                    <input type="text" name="name" id="name" pattern="[A-Za-z]+" title="please enter letters only" class="form-control" required><br><br>

                    <label>Branch:</label><br>
                    <select name="branch" id="branch" class="form-control" required>
                        <option value="select"></option>
                        <option value="Town campus">Town campus</option>
                        <option value="Main campus">Main campus</option>
                    </select><br><br>

                    <label>Semester:</label><br>
                    <select name="sem" id="sem" class="form-control" required>
                        <option value="select"></option>
                        <option value="One">One</option>
                        <option value="Two">Two</option>
                    </select><br><br>

                    <label>Email:</label><br>
                    <input type="email" name="email" class="form-control" required><br><br>

                    <label>Phone:</label><br>
                    <input type="number" name="phone" class="form-control" required><br><br>

                    <label>Faculty:</label><br>
                    <select name="faculty" id="faculty" class="form-control" required>
                        <option value="select"></option>
                        <option value="FASS">FASS</option>
                        <option value="FOS">FOS</option>
                        <option value="FERD">FERD</option>
                        <option value="FOA">FOA</option>
                        <option value="FEDCOS">FEDCOS</option>
                    </select><br><br>

                    <button type="submit" name="update" required>Submit</button><br><br>
                    <a href="regNo.php"><u>Already registered ?</u></a>

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
    $name = $_POST["name"];
    $branch = $_POST["branch"];
    $sem = $_POST["sem"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $faculty = $_POST["faculty"];


    if (!empty($reg_no) || !empty($name) || !empty($branch) || !empty($sem) || !empty($email) || !empty($phone) || !empty($faculty)) {

        include 'classes/db1.php';
        $INSERT = "INSERT INTO participant (reg_no,name,branch,sem,email,phone,faculty) VALUES('$reg_no','$name','$branch',$sem,'$email','$phone','$faculty')";
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