<script>
    function registerForEvent(event_id, event_title, event_date, event_time, venue_name, venue_capacity, participants) {
        if (participants < venue_capacity) {
            window.location.href = 'register.php?event_id=' + event_id + '&event_title=' + event_title + '&event_date=' + event_date + '&event_time=' + event_time + '&venue_name=' + venue_name;
        } else {
            alert('Event capacity has been reached. You cannot register for this event.');
        }
    }
</script>

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
                            
                            $venue_id = $row['venue_id'];
                            
                            $venue_query = "SELECT * FROM venues WHERE venue_id = $venue_id";
                            $venue_result = mysqli_query($conn, $venue_query);
                            if (mysqli_num_rows($venue_result) > 0) {
                                $venue_row = mysqli_fetch_assoc($venue_result);
                                echo 'Venue: ' . $venue_row['venue_name'] . '<br>';
                                $venue_capacity = $venue_row['capacity']; 
                            }
                            echo 'Student Co-ordinator: ' . $row['st_name'] . '<br>';
                            echo 'Staff Co-ordinator: ' . $row['name'] . '<br>';
                            
                            // Check if the event is past or upcoming
                            $event_time = strtotime($row['Date'] . ' ' . $row['time']);
                            $current_time = time();
                            if ($event_time < $current_time) {
                                // Event is past
                                echo '<span style="color:red;">This event has already passed.</span><br>';
                                $register_disabled = true; 
                            } else {
                                // Event is upcoming
                                $register_disabled = false; 
                            }
                        ?>
                    </p>
                    <br><br>
                    <?php
                        if ($register_disabled) {
                            // If the event is past, disable the register button
                            echo '<button class="btn btn-default" disabled>Register</button>';
                        } else {
                            // If the event is upcoming, enable the register button with event listener
                            echo '<button class="btn btn-default" onclick="registerForEvent(' . $row['event_id'] . ', \'' . $row['event_title'] . '\', \'' . $row['Date'] . '\', \'' . $row['time'] . '\', \'' . $venue_row['venue_name'] . '\', ' . $venue_capacity . ', ' . $row['participents'] . ')">Register</button>';
                        }
                    ?>
                </div><!--subcontent div-->
            </div><!--container div-->
        </section>
    </div>
</div><!--row div-->
