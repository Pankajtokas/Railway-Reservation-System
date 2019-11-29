<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($train_status)) {
            $error .= "Please enter train status.<br/>";
        }
        if (empty($train_reached)) {
            $error .= "Please enter train reached.<br/>";
        }
        if (empty($train_reached)) {
            $error .= "Please enter train reached.<br/>";
        }
       if (empty($error)) {
            $query = "insert into train_running_details set train_id = '" . $train_id . "', train_status ='" . $train_status . "', train_reached = '" . $train_reached . "',created = '" . date('Y-m-d H:i:s') . "'";
            $r = mysql_query($query);
            $num = (int) $r;
            if ($num > 0) {
                  header("location:add_train_runningstatus.php?reg=success");
            } else {
                $error = "Your train running status has not been added.!!";
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Add Train Running Status - Railway Reservation System</title>
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
                            <h1>Add Train Running Status</h1>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <?php
                        include 'leftmenu.php';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <form class="form-light mt-20" role="form" method="post" action="">                            
                            <?php
                            if (!empty($error)) {
                                echo '<div class="row"><div class="col-md-12">' . $error . '</div></div>';
                            }
                            if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                echo '<div class="style">Train Running status has been updated.</div>';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Train No</label>
                                       <select class="form-control" id="train_id" name="train_id">
                                            <?php
                                            $sql_subject = "SELECT * FROM trains ORDER BY id ASC";
                                            $result_subject = mysql_query($sql_subject);
                                            if (mysql_num_rows($result_subject) > 0) {
                                                while ($row = mysql_fetch_array($result_subject)) {
                                                    ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['train_no'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>   
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Train Status</label>
                                        <input type="text" id="train_status" name="train_status" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Train Reached</label>
                                        <input type="text" id="train_reached" name="train_reached" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-one" onclick="return adminValidation()"/>Submit</button><p><br/></p>
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
mysql_close();
?>