<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM trains WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:trainlist.php?status=success");
        } else {
            $error = "Train has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Train List - Railway Reservation System</title>
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
                            <h1>Train List</h1>
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
                                    echo '<tr><td colspan="4">Train has been successfully deleted.</td></tr>';
                                }
                                if (!empty($error)) {
                                    echo '<tr><td>' . $error . '</td></tr>';
                                }
                                ?>
                                <tr>
                                    <td class="grid_heading">S.No</td>
                                    <td class="grid_heading">Source</td>
                                    <td class="grid_heading">Destination</td>
                                    <td class="grid_heading">Train No</td>
                                    <td class="grid_heading">Train Name</td>
                                    <td class="grid_heading">Start Time</td>
                                    <td class="grid_heading">Reached Time</td>
                                    <td class="grid_heading">Distance</td>
                                    
                                    <?php
                                    if ($user_type == "admin") {
                                        ?>
                                        <td class="grid_heading">Delete</td>
                                    <?php } ?>
                                </tr>
                                <?php
                                $i = 0;
                                $sql = "SELECT r.source,r.destination,r.distance,t.train_no,t.train_name,t.start_time,t.reached_time FROM trains t JOIN routes r WHERE r.id = t.route_id ORDER BY t.id DESC ";
                                $result = mysql_query($sql);
                                if (mysql_num_rows($result) > 0) {
                                    while ($row = mysql_fetch_array($result)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="grid_label"><?php echo $i; ?></td>
                                            <td class="grid_label"><?php echo $row['source'] ?></td>
                                            <td class="grid_label"><?php echo $row['destination'] ?></td>
                                            <td class="grid_label"><?php echo $row['train_no'] ?></td>
                                            <td class="grid_label"><?php echo $row['train_name'] ?></td>
                                            <td class="grid_label"><?php echo $row['start_time'] ?></td>
                                            <td class="grid_label"><?php echo $row['reached_time'] ?></td>
                                            <td class="grid_label"><?php echo $row['distance'] ?></td>
                                            <?php
                                            if ($user_type == "admin") {
                                                ?>
                                                <td class="grid_label"><a href="trainlist.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
                                            <?php } ?>

                                        </tr>
                                        <?php
                                    }
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
