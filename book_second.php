<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    $journey_date = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);        
        $no_of_person = 0;
        $price = 0;
        if (!empty($ubooking)) {
            foreach ($ubooking as $boookinga) {
                if (!empty($boookinga['name']) && !empty($boookinga['age']) && !empty($boookinga['gender'])) {
                    $no_of_person++;
                }
            }
        }
        if (empty($no_of_person )) {
            $error = "Please enter at least one person details";
        } else {
            $train_class_fare = "";
            $train_class_seat = "";
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
            $sql_route = "SELECT $train_class_seat, $train_class_fare FROM trains Where id = '" . $train_id . "'";
            $res_route = mysql_query($sql_route);
            if (mysql_num_rows($res_route) > 0) {
                $row_fare = mysql_fetch_array($res_route);
                $fare = $row_fare[$train_class_fare];
                $price = $fare * $no_of_person;
            }
        }
        if (empty($error)) {
            $pnr_no = uniqid();
            $query = "INSERT INTO booking (user_id,route_id,train_id,pnr_no,no_of_seat,booking_amount,booking_status,journey_date,booking_class,card_no,expiry_date,cvv,created) "
                    . "VALUES('" . $user_id . "','" . $route_id . "','" . $train_id . "','" . $pnr_no . "','" . $no_of_person . "','" . $price . "','" . $seat_status . "','" . $journey_date . "',"
                    . "'" . $tclass . "','" . $card_no . "','" . $expiry_date . "','" . $cvv . "','" . date('Y-m-d') . "')";
            $res_query = mysql_query($query);
            $booking_id = mysql_insert_id();
            if (!empty($booking_id)) {

                if (!empty($ubooking)) {
                    foreach ($ubooking as $boookinga) {
                        if (!empty($boookinga['name']) && !empty($boookinga['age']) && !empty($boookinga['gender'])) {
                            $query_booking = "INSERT INTO booking_details(user_id,booking_id,`name`,gender,age,booking_status,created) VALUES("
                                    . "'" . $user_id . "','" . $booking_id . "','" . $boookinga['name'] . "','" . $boookinga['gender'] . "','" . $boookinga['age'] . "','" . $seat_status . "','" . date('Y-m-d') . "')";
                            mysql_query($query_booking);
                        }
                    }
                  header("location:thankyou.php");
                } else {
                    $error = "Ticket has not been booked.";
                }
            } else {
                $error = "Ticket has not been booked.";
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Booking - Railway Reservation System</title>
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
                            <h1>Booking</h1>
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
                            $seat_status = "";
                            $route_id = $_GET['rid'];
                            $train_id = $_GET['tid'];
                            $tclass = $_GET['tclass'];
                            $seat = $_GET['seat'];
                            $journey_date = $_GET['journey_date'];
                            if (!empty($seat)) {
                                $seat_status = "Book";
                            } else {
                                $seat_status = "Waiting";
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="route_id" value="<?php echo $route_id ?>" />
                                    <input type="hidden" name="train_id" value="<?php echo $train_id; ?>" />
                                    <input type="hidden" name="tclass" value="<?php echo $tclass; ?>" />
                                    <input type="hidden" name="journey_date" value="<?php echo $journey_date; ?>" />
                                    <input type="hidden" name="seat_status" value="<?php echo $seat_status; ?>" />
                                    <label>Please enter person details</label>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group"> 

                                        <input type="text" id="ubooking[0][name]" name="ubooking[0][name]" class="form-control" placeholder="Name"  required=""/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <input type="number" id="ubooking[0][age]" name="ubooking[0][age]" class="form-control" placeholder="Age" required="" maxlength="2"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <select class="form-control" id="ubooking[0][gender]" name="ubooking[0][gender]" required="">
                                            <option selected="" value="">- - - - Gender - - - -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">                                        
                                        <input type="text" id="ubooking[1][name]" name="ubooking[1][name]" class="form-control" placeholder="Name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <input type="number" id="ubooking[1][age]" name="ubooking[1][age]" class="form-control" placeholder="Age" maxlength="2"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <select class="form-control" id="ubooking[1][gender]" name="ubooking[1][gender]">
                                            <option selected="" value="">- - - - Gender - - - -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">                                        
                                        <input type="text" id="ubooking[2][name]" name="ubooking[2][name]" class="form-control" placeholder="Name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <input type="number" id="ubooking[2][age]" name="ubooking[2][age]" class="form-control" placeholder="Age" maxlength="2"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <select class="form-control" id="ubooking[2][gender]" name="ubooking[2][gender]">
                                            <option selected="" value="">- - - - Gender - - - -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                             
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">                                        
                                        <input type="text" id="ubooking[3][name]" name="ubooking[3][name]" class="form-control" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <input type="number" id="ubooking[3][age]" name="ubooking[3][age]" class="form-control" placeholder="Age"  maxlength="2"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <select class="form-control" id="ubooking[3][gender]" name="ubooking[3][gender]" >
                                            <option selected="" value="">- - - - Gender - - - -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Please enter payment details</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">                                        
                                        <input type="number" id="card_no" name="card_no" class="form-control" placeholder="Card No" required="" maxlength="16"a/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="Expiry Date" required="" maxlength="10"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">                                       
                                        <input type="number" id="cvv" name="cvv" class="form-control" placeholder="CVV" required="" maxlength="3"/>
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