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
                <form method="POST" id="form" onsubmit="selectFaculty()">


                    <label>Student Name:</label><br>
                    <input type="text" name="name" id="name" pattern="[A-Za-z ]+" title="please enter letters only" class="form-control" required><br><br>
                    <label>registration number:</label><br>
                    <input type="text" name="reg_no" id="reg_no" pattern="[A-Z]\d{2}/\d{5}/\d{2}" title="Please follow the required format: A13/09487/19" class="form-control" required><br><br>

                    <label>Faculty:</label><br>
                    <select name="faculty" id="faculty" required class="form-control">
                        <!-- No <option> elements here; they are dynamically set by JavaScript -->
                        <option value="">select faculty</option>

                        <br><br>

                        <label>Branch:</label><br>
                        <select name="branch" id="branch" class="form-control" required>

                        </select><br><br>
                        <label for="branch">Branch:</label><br>
                        <select name="branch" id="branch" class="form-control" required>
                            <option value="">select branch</option>
                            <option value="Town campus">Town campus</option>
                            <option value="Main campus">Main campus</option>
                        </select><br><br>
                        <label>Semester:</label><br>
                        <select name="sem" id="sem" class="form-control" required>
                            <option value="">select semester</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select><br><br>

                        <label>Email:</label><br>
                        <input type="email" name="email" class="form-control" required><br><br>

                        <label>Phone:</label><br>
                        <input type="number" name="phone" placeholder="0721270001" class="form-control" required><br><br>

                        <button type="submit" name="update" required>Submit</button><br><br>
                        <a href="regNo.php"><u>Already registered ?</u></a>

                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("reg_no").addEventListener("input", selectFaculty);

        function selectFaculty() {
            var regNoInput = document.getElementById("reg_no").value;
            var facultySelect = document.getElementById("faculty");

            // Define an array of faculties
            var faculties = [{
                    prefix: "S",
                    value: "FOS"
                }, // Faculty of Science
                {
                    prefix: "E",
                    value: "FEDCOS"
                }, // Faculty of Education and Community Studies
                {
                    prefix: "P",
                    value: "ENGINEERING"
                }, // Engineering
                {
                    prefix: "K",
                    value: "FOA"
                }, // Faculty of Agriculture
                {
                    prefix: "A",
                    value: "FASS"
                } // Faculty of Arts and Social Sciences
            ];

            // Find the matching faculty based on the registration number prefix
            var selectedFaculty = faculties.find(faculty => regNoInput.startsWith(faculty.prefix));

            if (selectedFaculty) {
                // If a matching faculty is found, set the value of the select element
                facultySelect.value = selectedFaculty.value;
            } else {
                // If no matching faculty is found, reset the select element
                facultySelect.value = "";
            }
        }
    </script>
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

        // Check if the registration number already exists
        $check_query = $conn->prepare("SELECT reg_no FROM participant WHERE reg_no = ?");
        $check_query->bind_param("s", $reg_no);
        $check_query->execute();
        $check_query->store_result();

        if ($check_query->num_rows > 0) {
            // Registration number already exists
            echo "<script>
                    alert('Registration number already exists!');
                    window.location.href='registerEvent.php';
                    </script>";
            exit; // Stop further execution
        }

        // Proceed with insertion if the registration number is unique
        $INSERT = "INSERT INTO participant (reg_no, name, branch, sem, email, phone, faculty) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssss", $reg_no, $name, $branch, $sem, $email, $phone, $faculty);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Registered Successfully!');
                    window.location.href='index.php';
                    </script>";
        } else {
            echo "<script>
                    alert('An error occurred while registering.');
                    window.location.href='registerEvent.php';
                    </script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>
            alert('All fields are required');
            window.location.href='registerEvent.php';
                    </script>";
    }
}

?>