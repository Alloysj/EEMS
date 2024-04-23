<div class="container">
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row">
        <section>
            <div class="container">
                <div class="col-md-6">
                    <img src="<?php echo $row['img_link']; ?>" class="img-responsive">
                </div>
                <div class="subcontent col-md-6">
                    <h1 style="color:#003300 ; font-size:38px ;"><u><strong><?php echo '<td>' . $row['event_title'] . '</td>'; ?></strong></u></h1>
                    <p style="color:#003300  ;font-size:20px ">
                        <?php
                            echo 'Date: ' . $row['Date'] . '<br>';
                            echo 'Time: ' . $row['time'] . '<br>';
                            // Retrieve venue information based on venue_id
                            $venue_id = $row['venue_id'];
                            // Assuming $conn is your database connection
                            $venue_query = "SELECT * FROM venues WHERE venue_id = $venue_id";
                            $venue_result = mysqli_query($conn, $venue_query);
                            if (mysqli_num_rows($venue_result) > 0) {
                                $venue_row = mysqli_fetch_assoc($venue_result);
                                echo 'Venue: ' . $venue_row['venue_name'] . '<br>';
                                // You can display other venue information here as needed
                            }
                            echo 'Student Co-ordinator: ' . $row['st_name'] . '<br>';
                            echo 'Staff Co-ordinator: ' . $row['name'] . '<br>';
                            
                            // Check if the event is past or upcoming
                            $event_time = strtotime($row['Date'] . ' ' . $row['time']);
                            $current_time = time();
                            if ($event_time < $current_time) {
                                // Event is past
                                echo '<span style="color:red;">This event has already passed.</span><br>';
                                $register_disabled = true; // Set flag to disable register button
                            } else {
                                // Event is upcoming
                                $register_disabled = false; // Set flag to enable register button
                            }
                        ?>
                    </p>
                    <br><br>
                    <?php
                        if ($register_disabled) {
                            // If the event is past, disable the register button
                            echo '<button class="btn btn-default" disabled>Register</button>';
                        } else {
                            // If the event is upcoming, enable the register button
                            echo '<a class="btn btn-default" href="register.php?event_id=' . $row['event_id'] . '"> <span class="glyphicon glyphicon-circle-arrow-right"></span>Register</a>';
                        }
                    ?>
                </div><!--subcontent div-->
            </div><!--container div-->
        </section>
    </div>
</div><!--row div-->
