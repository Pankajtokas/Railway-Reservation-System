<div class="list styled custom-list" style="min-height: 500px;">   
    <ul>
        <li><a href="myaccount.php">My Account</a></li>
        <?php
        if ($user_type == "admin") {
            ?> 
            <li><a href="add_route.php">Add Route</a></li>
            <li><a href="route_list.php">Route List</a></li>
            <li><a href="add_train.php">Add Train</a></li>
            <li><a href="trainlist.php">Train List</a></li>
            <li><a href="add_train_runningstatus.php">Add Train Running Status</a></li>
            <li><a href="train_runningstatus-list.php">Train Running List</a></li>
            <li><a href="train-booking.php">Train Booking</a></li>
            <li><a href="userlist.php">User List</a></li>
            <?php
        } else {
            ?>
            <li><a href="trainlist.php">Train List</a></li>
            <li><a href="booking.php">Booking</a></li>
            <li><a href="booking-history.php">Booking History</a></li>
            <li><a href="seat-enquery.php">Seat Enquiry</a></li>
            <li><a href="pnr-enquery.php">PNR Enquiry</a></li>
            <li><a href="cancelticket.php">Cancelation Ticket</a></li>            
        <?php } ?>
        <li><a href="changepassword.php">Change Password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>