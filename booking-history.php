<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    
    if (isset($_GET['bid']) && !empty($_GET['bid'])) {
        $bid = mysql_real_escape_string($_GET['bid']);
        $sql = "UPDATE booking SET booking_status = 'Cancelled' WHERE id='" . $bid . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:booking-history.php?status=success");
        } else {
            $error = "Booking has not been cancelled.";
        }
    }
    ?>
    <html>
        <head>
            <title>Booking History - Railway Reservation System</title>
            <?php include 'title.php'; ?>
        </head>
        <body>
            <?php
            include 'header.php';
            ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1>Booking History</h1>
                        </div>
                    </div>
                </div>
            </header>            
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <?php
                        include './leftmenu.php';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <form class="form-light mt-20" role="form" method="post" action="">
                            <table class="table_list">      
                                <?php
                                if (isset($_GET['status']) && $_GET['status'] == "success") {
                                    echo '<tr><td colspan="11">Booking has been successfully cancelled.</td></tr>';
                                }
                                if (!empty($error)) {
                                    echo '<tr><td colspan="11">' . $error . '</td></tr>';
                                }
                                ?>
                                <tr>
                                    <td class="grid_heading">S.No</td>
                                    <td class="grid_heading">Source</td>
                                    <td class="grid_heading">Destination</td>
                                    <td class="grid_heading">PNR No.</td>
                                    <td class="grid_heading">Train No</td>
                                    <td class="grid_heading">Train Name</td>
                                    <td class="grid_heading">No of Person</td>
                                    <td class="grid_heading">Amount</td>
                                    <td class="grid_heading">Class</td>
                                    <td class="grid_heading">Journey Date</td>
                                    <td class="grid_heading">Status</td>
                                    <td class="grid_heading">Booking</td>                                                                       
                                </tr>
                                <?php
                                $i = 0;
                                $sql = "SELECT r.source,r.destination,t.train_no,t.train_name,b.pnr_no,b.no_of_seat,b.booking_amount,b.booking_status,b.journey_date,b.booking_class,b.id FROM trains t JOIN routes r ON r.id = t.route_id JOIN booking b ON b.train_id = t.id WHERE b.user_id = '" . $user_id . "' AND b.booking_status IN ('Book','Waiting')";
                                $result = mysql_query($sql);
                                if (mysql_num_rows($result) > 0) {
                                    while ($row = mysql_fetch_array($result)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="grid_label"><?php echo $i; ?></td>
                                            <td class="grid_label"><?php echo $row['source'] ?></td>
                                            <td class="grid_label"><?php echo $row['destination'] ?></td>
                                            <td class="grid_label"><?php echo $row['pnr_no'] ?></td>
                                            <td class="grid_label"><?php echo $row['train_no'] ?></td>
                                            <td class="grid_label"><?php echo $row['train_name'] ?></td>                                            
                                            <td class="grid_label"><?php echo $row['no_of_seat'] ?></td>
                                            <td class="grid_label"><?php echo $row['booking_amount'] ?></td>
                                            <td class="grid_label"><?php echo $row['journey_date'] ?></td>
                                            <td class="grid_label"><?php echo $row['booking_class'] ?></td>
                                            <td class="grid_label"><?php echo $row['booking_status'] ?></td>                                           
                                            <td class="grid_label"><a href="booking-history.php?bid=<?php echo $row ['id']; ?>">Canceled</a></td>  
                                        </tr>
                                          <tr>
                                            <td colspan="12">
                                                <table width="90%" align="center" style="font-size: 12px;background: #fff;" cellpaddin="3" cellspacing="3">
                                                    <tr bgcolor="#ccc">
                                                        <td height="24" align="center"><strong>S.No</strong></td>
                                                        <td><strong>Name</strong></td>
                                                        <td><strong>Gender</strong></td>
                                                        <td><strong>Age</strong></td>
                                                        <td><strong>Status</strong></td>                                                        
                                                    </tr>
                                                    <?php
                                                    $k = 0;
                                                    $sql_details = "SELECT `name`,gender,age,booking_status FROM booking_details WHERE booking_id = '" . $row['id'] . "'";
                                                    $result_details = mysql_query($sql_details);
                                                    if (mysql_num_rows($result_details) > 0) {
                                                        while ($row_data = mysql_fetch_array($result_details)) {
                                                            $k++;
                                                            ?>
                                                    <tr bgcolor="#f3f3f3">
                                                                <td height="22"  align="center"><?php echo $k; ?></td>
                                                                <td><?php echo $row_data['name'] ?></td>
                                                                <td><?php echo $row_data['gender'] ?></td>
                                                                <td><?php echo $row_data['age'] ?></td>
                                                                <td><?php echo $row['booking_status'] ?></td>                                                                                                                                                      
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </table>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="10">
                                            No Data.
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </form>
                    </div>                
                </div>
            </div>       
            <?php
            include 'footer.php';
            ?>               
        </body>
    </html>
    <?php
} else {
    header("location:login.php?msg=login");
    ob_flush();
}
?>
