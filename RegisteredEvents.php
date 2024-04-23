<?php
require_once 'utils/header.php';
require_once 'utils/styles.php';

// Check if 'reg_no' is set in the $_POST array
if(isset($_POST['reg_no'])) {
    $reg_no = $_POST['reg_no'];

    include_once 'classes/db1.php';

    $result = mysqli_query($conn, "SELECT * FROM registered r, staff_coordinator s, event_info ef, student_coordinator st, events e WHERE e.event_id = ef.event_id AND e.event_id = s.event_id AND e.event_id = st.event_id AND r.reg_no = '$reg_no' AND r.event_id = e.event_id");
?>

<div class="content">
    <div class="container">
        <h1> Registered Events</h1>
        <?php
        if (mysqli_num_rows($result) > 0) {
        ?>
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th>Event_name</th>
                        <th>Student Co-ordinator</th>
                        <th>Staff Co-ordinator</th>

                        <th>Date</th>

                        <th>Time</th>
                        <th>location </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {

                        echo '<tr>';
                        echo '<td>' . $row['event_title'] . '</td>';
                        echo '<td>' . $row['st_name'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';

                        echo '<td>' . $row['Date'] . '</td>';
                        echo '<td>' . $row['time'] . '</td>';
                        $venue_id = $row['venue_id'];
                            // Assuming $conn is your database connection
                            $venue_query = "SELECT * FROM venues WHERE venue_id = $venue_id";
                            $venue_result = mysqli_query($conn, $venue_query);
                            if (mysqli_num_rows($venue_result) > 0) {
                                $venue_row = mysqli_fetch_assoc($venue_result);
                                echo '<td>' . $venue_row['venue_name'] . '<td>';
                                
                            }


                        echo '</tr>';

                        $i++;
                    }

                    ?>
                </tbody>
            </table>
        <?php } else {
            echo 'Not Yet Registered any events';
        } ?>
    </div>
</div>
<?php
} else {
    echo 'Please provide registration number.';
}
include 'utils/footer.php';
?>
