<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM train_running_details WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:train_runningstatus-list.php?status=success");
        } else {
            $error = "Train running status has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Train Runing Status List - Railway Reservation System</title>
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
                            <h1>Train Runing Status List</h1>
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
                    <div class="col-md-9">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                         <table class="table_list">
                            <?php
                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<tr><td colspan="4">Record has been successfully deleted.</td></tr>';
                            }
                            if (!empty($error)) {
                                echo '<tr><td>' . $error . '</td></tr>';
                            }
                            ?>
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Train No.</td>
                                <td class="grid_heading">Train Status</td>
                                <td class="grid_heading">Train Reached</td>
                                <td class="grid_heading">Delete</td>
                            </tr>
                            <?php
                            $i = 0;
                            
                            $sql = "SELECT t.train_no,tr.id ,tr.train_status,tr.train_reached FROM trains t JOIN train_running_details tr WHERE t.id= tr.train_id ORDER BY tr.id DESC";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['train_no'] ?></td>
                                        <td class="grid_label"><?php echo $row['train_status'] ?></td>
                                        <td class="grid_label"><?php echo $row['train_reached'] ?></td>
                                        <td class="grid_label"><a href="train_runningstatus-list.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
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
?>
