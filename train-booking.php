<?php
include './dbconfigur.php';
if (!empty($user_id)) {    
    ?>
    <html>
        <head>
            <title>Booking List  - Railway Reservation System</title>
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
                            <h1>Booking List</h1>
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
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Name</td>
                                <td class="grid_heading">PNR&nbsp;No.</td>
                                <td class="grid_heading">Train&nbsp;No.</td>
                                <td class="grid_heading">Train&nbsp;Name</td>
                                <td class="grid_heading">No&nbsp;of&nbsp;Seat</td>                                
                                <td class="grid_heading">Amount</td>
                                <td class="grid_heading">Class</td>
                                <td class="grid_heading">Status</td>
                                <td class="grid_heading">Journey</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT u.name,b.pnr_no,b.no_of_seat,b.booking_amount,b.booking_status,b.journey_date,t.train_no,t.train_name,b.booking_class,b.id FROM users u JOIN booking b ON u.id= b.user_id JOIN trains t ON  t.id = b.train_id";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['name'] ?></td>
                                        <td class="grid_label"><?php echo $row['pnr_no'] ?></td>
                                        <td class="grid_label"><?php echo $row['train_no'] ?></td>
                                        <td class="grid_label"><?php echo $row['train_name'] ?></td>                                        
                                        <td class="grid_label"><?php echo $row['no_of_seat'] ?></td>
                                        <td class="grid_label"><?php echo $row['booking_amount'] ?></td>
                                        <td class="grid_label"><?php echo $row['booking_class'] ?></td>
                                        <td class="grid_label"><?php echo $row['booking_status'] ?></td>
                                        <td class="grid_label"><?php echo $row['journey_date'] ?></td>                                        
                                    </tr>
                                         <tr>
                                            <td colspan="11">
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
                            }
                            ?>
                        </table>
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
mysql_close();
?>