<?php
include 'dbconfigur.php';
if (!empty($user_id)) {

    
    $error = "";
    if (isset($_POST['btnupdate'])) {
        extract($_POST);

        $query = "update users set name = '" . $name . "', phone_no ='" . $phone_no . "',gender = '" . $gender . "',city='$city', state='$state', address='$address', pin_no='$pin_no' where id = '$user_id' ";
        $r = mysql_query($query);
        $num = (int) $r;
        if ($num > 0) {
            $error = "Your profile has been successfully updated.!!";
        } else {
            $error = "Your profile has not been updated.!!";
        }
    }
    ?>
    <html>
        <head>
            <title>My Account - Railway Reservation System</title>
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
                            <h1>My Account</h1>
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
                        <form class="form-light mt-20" role="form" method="post" action="myaccount.php" enctype="multipart/form-data">
                            <?php
                                if (!empty($error)) {
                                    echo '<div class="form-group">' . $error . '</div>';
                                }                                
                                ?>
                            
                            
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM users WHERE id = '" . $user_id . "' ";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                $row = mysql_fetch_array($result);
                                ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $row['phone_no']; ?>">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option selected=""> - - - - - Select - - - - - </option>
                                            <?php
                                            if (strtolower($row['gender']) == "male") {
                                                echo '<option value="Male" selected="">Male</option>';
                                                echo '<option value="Female">Female</option>';
                                            } else {
                                                echo '<option value="Male">Male</option>';
                                                echo '<option value="Female">Female</option>';
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control" id="state" name="state">
                                                <option value="">- - - - State - - - -</option>
                                                <option value="<?php echo $row['state']; ?>" selected=""><?php echo $row['state']; ?></option>
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands </option>
                                                <option value="Andhra Pradesh">Andhra Pradesh </option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam </option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chandigarh">Chandigarh </option>
                                                <option value="Chhattisgarh">Chhattisgarh </option>
                                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli </option>
                                                <option value="Daman and Diu">Daman and Diu </option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Goa">Goa </option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Lakshadweep">Lakshadweep</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur </option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Puducherry">Odisha</option>
                                                <option value="Puducherry">Puducherry</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal </option>   
                                            </select> 
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" id="address" name="address" style="height:120px;"><?php echo $row['address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pin</label>
                                            <input type="text" id="pin_no" name="pin_no" class="form-control" value="<?php echo $row['pin_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" id="city" name="city" class="form-control" value="<?php echo $row['city']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="btnupdate" name="btnupdate" class="btn btn-one" onclick="return myaccountFormValidation()"/>Update</button><p><br/></p>
                                <?php } ?>
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