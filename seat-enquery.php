<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $source = "";
    $destination = "";
    $tdate = "";    
    $tclass = "";
    $train_class_seat = "";
    $train_class_fare = "";
    $res_route = "";
    ?>
    <html>
        <head>
            <title>Seat Enquiry - Railway Reservation System</title>
            <?php include 'title.php'; ?>
            <script type="text/javascript">

                function bookingValidation() {

                    var source = document.getElementById('source').value;
                    if (source.trim() == "") {
                        alert('Please select source');
                        return false;
                    }
                    var destination = document.getElementById('destination').value;
                    if (destination.trim() == "") {
                        alert('Please select destination');
                        return false;
                    }
                    var tclass = document.getElementById('tclass').value;
                    if (tclass.trim() == "") {
                        alert('Please select class');
                        return false;
                    }
                    var tdate = document.getElementById('tdate').value;
                    if (tdate.trim() == "") {
                        alert('Please select date.');
                        return false;
                    }

                }
            </script>
        </head>
        <body>
            <?php
            include 'header.php';
            ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1>Seat Enquiry</h1>
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
                            //display train running details
                            if (isset($_POST['btnsubmit'])) {
                                extract($_POST);
                                //fetch route id from route table

                                if (!empty($tclass)) {
                                    if ($tclass == "Sleeper") {
                                        $train_class_seat = "sleeper_seat";
                                        $train_class_fare = "sleeper_fare";
                                    } else if ($tclass == "First AC") {
                                        $train_class_seat = "first_ac_seat";
                                        $train_class_fare = "first_ac_fare";
                                    } else if ($tclass == "Second AC") {
                                        $train_class_seat = "second_ac_seat";
                                        $train_class_fare = "second_ac_fare";
                                    } else if ($tclass == "Third AC") {
                                        $train_class_seat = "third_ac_seat";
                                        $train_class_fare = "third_ac_fare";
                                    }
                                }

                                $sql_route = "SELECT r.id as route_id,r.distance,t.id,t.train_no,t.train_name,t.start_time,t.reached_time,t.$train_class_seat,t.$train_class_fare FROM trains t JOIN routes r WHERE r.id = t.route_id AND r.source = '" . $source . "' AND r.destination = '" . $destination . "' GROUP BY t.train_no";
                                $res_route = mysql_query($sql_route);
                            }
                            ?>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">                                        
                                        <select class="form-control" id="source" name="source" required="">
                                            <option value="">- - - - Source - - - -</option>
                                            <?php
                                            $sql_source = "SELECT source FROM routes group by source order by source ASC";
                                            $res_source = mysql_query($sql_source);
                                            if (mysql_num_rows($res_source) > 0) {
                                                while ($row = mysql_fetch_array($res_source)) {

                                                    if ($source == $row['source']) {
                                                        ?>                                                    
                                                        <option selected="" value="<?php echo $row['source'] ?>"><?php echo $row['source'] ?></option>
                                                        <?php
                                                    } else {
                                                        ?>                                                    
                                                        <option value="<?php echo $row['source'] ?>"><?php echo $row['source'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>   
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">                                        
                                        <select class="form-control" id="destination" name="destination" required="">
                                            <option selected="" value="">- - - - Destination - - - -</option>
                                            <?php
                                            $sql_subject = "SELECT destination FROM routes group by destination order by destination ASC";
                                            $result_subject = mysql_query($sql_subject);
                                            if (mysql_num_rows($result_subject) > 0) {
                                                while ($row = mysql_fetch_array($result_subject)) {
                                                    if ($destination == $row['destination']) {
                                                        ?>                                                    
                                                        <option selected="" value="<?php echo $row['destination'] ?>"><?php echo $row['destination'] ?></option>
                                                        <?php
                                                    } else {
                                                        ?>                                                    
                                                        <option value="<?php echo $row['destination'] ?>"><?php echo $row['destination'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>   
                                        </select> 
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">                                        
                                        <select class="form-control" id="tclass" name="tclass" required="">
                                            <option selected="" value="">- - - - Class - - - -</option>                                                                                             
                                            <option value="Sleeper">Sleeper</option>
                                            <option value="First AC">First AC</option>
                                            <option value="Second AC">Second AC</option>
                                            <option value="Third AC">Third AC</option>    
                                            <?php
                                            if (!empty($tclass)) {
                                                ?>
                                                <option value="<?php echo $tclass ?>" selected=""><?php echo $tclass ?></option>    
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">                                        
                                        <input type="text" id="tdate" value="<?php echo $tdate; ?>" name="tdate" placeholder="Date" class="form-control" required="" onclick="scwShow(this, event)" readonly=""/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-one" onclick="return bookingValidation()"/>Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table_list">                                    
                                    <tr>
                                        <td class="grid_heading">S.No</td>                                        
                                        <td class="grid_heading">Train No</td>
                                        <td class="grid_heading">Train Name</td>
                                        <td class="grid_heading">Start Time</td>
                                        <td class="grid_heading">Reached Time</td>
                                        <td class="grid_heading">Class</td>
                                        <td class="grid_heading">Fare</td>
                                        <td class="grid_heading">Seat</td>                                        
                                        <td class="grid_heading">Distance</td>                                        
                                    </tr>
                                    <?php
                                    $i = 0;
                                    if (mysql_num_rows($res_route) > 0) {
                                        while ($row = mysql_fetch_array($res_route)) {
                                            $seat = 0;
                                            $i++;
                                            $tseat = $row[$train_class_seat];
                                            $sql_seat_count = "SELECT SUM(no_of_seat) AS seat_count FROM booking WHERE train_id = '" . $row ['id'] . "' AND booking_class = '" . $tclass . "' AND journey_date = '" . $tdate . "'";
                                            $res_seat_count = mysql_query($sql_seat_count);
                                            if (mysql_num_rows($res_seat_count) > 0) {
                                                $row_seat = mysql_fetch_array($res_seat_count);
                                                if (!empty($row_seat['seat_count'])) {
                                                    echo $row_seat['seat_count'];                                                    
                                                    $seat = $tseat - $row_seat['seat_count'];
                                                }else{
                                                    $seat = $tseat;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td class="grid_label"><?php echo $i; ?></td>
                                                <td class="grid_label"><?php echo $row['train_no'] ?></td>
                                                <td class="grid_label"><?php echo $row['train_name'] ?></td>
                                                <td class="grid_label"><?php echo $row['start_time'] ?></td>
                                                <td class="grid_label"><?php echo $row['reached_time'] ?></td>                                                
                                                <td class="grid_label"><?php echo $tclass ?></td>
                                                <td class="grid_label"><?php echo $row[$train_class_fare] ?></td>
                                                <td class="grid_label"><?php                                                
                                                    if ($seat > 0) {
                                                        echo $seat;
                                                    } else {
                                                        echo 'No Seat';
                                                    }
                                                    ?></td>
                                                <td class="grid_label"><?php echo $row['distance'] ?></td>                                                                                                
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="10">No Train Available.</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>

                            </div>
                        </div>



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