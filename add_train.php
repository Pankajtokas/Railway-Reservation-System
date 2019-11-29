<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($start_time)) {
            $error .= "Please enter start time.<br/>";
        }
        if (empty($reached_time)) {
            $error .= "Please enter reached time.<br/>";
        }
        if (empty($route_id)) {
            $error .= "Please enter route id.<br/>";
        }
        if (empty($train_no)) {
            $error .= "Please enter train no.<br/>";
        }
        if (empty($train_name)) {
            $error .= "Please enter  train name.<br/>";
        }
        if (empty($error)) {
            $query = "insert into trains set start_time = '" . $start_time . "', reached_time ='" . $reached_time . "', route_id = '" . $route_id . "',train_no = '" . $train_no . "',train_name = '" . $train_name . "', sleeper_seat = '" . $sleeper_seat . "', sleeper_fare='" . $sleeper_fare . "', third_ac_seat='$third_ac_seat', third_ac_fare='$third_ac_fare', second_ac_seat='$second_ac_seat', second_ac_fare='$second_ac_fare', first_ac_seat='" . $first_ac_seat . "', first_ac_fare = '" . $first_ac_fare . "',running_day ='" . $running_day . "',created = '" . date('Y-m-d H:i:s') . "'";
            $r = mysql_query($query);
            $num = (int) $r;
            if ($num > 0) {                
                header("location:add_train.php?reg=success");
            } else {
                $error = "Your train has not been added.!!";
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Add Train - Railway Reservation System</title>
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
                            <h1>Add Train</h1>
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
                                echo '<div class="style">Train has been added.</div>';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <input type="text" id="start_time" name="start_time" class="form-control" placeholder="10:10" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reached Time</label>
                                        <input type="text" id="reached_time" name="reached_time" class="form-control" placeholder="12:10" required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Route Id</label>
                                        <select class="form-control" id="route_id" name="route_id" required="">
                                            <option selected="">- - - - Route - - - -</option>
                                            <?php
                                            $sql_subject = "SELECT * FROM routes ORDER BY id ASC";
                                            $result_subject = mysql_query($sql_subject);
                                            if (mysql_num_rows($result_subject) > 0) {
                                                while ($row = mysql_fetch_array($result_subject)) {
                                                    ?>                                                    
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['source'] ?> - <?php echo $row['destination'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>   
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Train No</label>
                                        <input type="text" id="train_no" name="train_no" class="form-control" required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Train Name</label>
                                        <input type="text" id="train_name" name="train_name" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sleeper Seat</label>
                                        <input type="text" id="sleeper_seat" name="sleeper_seat" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sleeper Fare</label>
                                        <input type="text" id="sleeper_fare" name="sleeper_fare" class="form-control"/>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Third Ac Seat</label>
                                        <input type="text" id="third_ac_seat" name="third_ac_seat" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Third Ac Fare</label>
                                        <input type="text" id="third_ac_fare" name="third_ac_fare" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Second Ac Seat</label>
                                        <input type="text" id="second_ac_seat" name="second_ac_seat" class="form-control" maxlength="6" min="0"/>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Second Ac Fare</label>
                                        <input type="text" id="second_ac_fare" name="second_ac_fare" class="form-control" maxlength="6" min="0"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Ac Seat</label>
                                        <input type="text" id="first_ac_seat" name="first_ac_seat" class="form-control" min="0"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Ac Fare</label>
                                        <input type="text" id="first_ac_fare" name="first_ac_fare" class="form-control" maxlength="6" min="0"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Running Day</label>
                                        <input type="text" id="running_day" name="running_day" class="form-control" min="0" required=""/>
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