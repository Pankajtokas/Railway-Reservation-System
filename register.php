<?php
include './dbconfigur.php';
if (isset($_POST['btnsubmit'])) {
    $error = "";
    extract($_POST);
    if (empty($name)) {
        $error .= "Please enter your name.<br/>";
    }
    if (empty($email)) {
        $error .= "Please enter your email.<br/>";
    }
    if (empty($phone_no)) {
        $error .= "Please enter your phone no.<br/>";
    }
    if (empty($password)) {
        $error .= "Please enter your password.<br/>";
    }
    if (empty($error)) {
        $sql_query = "INSERT INTO users(name,email,phone_no,password,adding_date,gender,address,city,state,pin_no,user_type)"
                . "VALUES('" . $name . "','" . $email . "','" . $phone_no . "','" . $password . "','" . date('Y-m-d h:i:s') . "','" . $gender . "','" . $address . "','" . $city . "','" . $state . "','" . $pin_no . "','user')";
        $result = mysql_query($sql_query);
        if ($result) {
            header("location:register.php?reg=success");
        } else {
            $error = "Data has not been saved.";
        }
    }
}
?>
<html>
    <head>
        <title>Register - Railway Reservation System</title>
        <?php include 'title.php'; ?> 
        <script type="text/javascript">
            //check for integer
            function checkForIntegers(i)
            {
                if (i.value.length > 0)
                {
                    i.value = i.value.replace(/[^\d]+/g, '');

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
                        <h1>Register</h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h3 class="section-title">Register</h3>
                    <form class="form-light mt-20" role="form" method="post" action="register.php" id="register-form" novalidate>
                        <?php
                        if (!empty($error)) {
                            echo '<div class="style">' . $error . '</div>';
                        }
                        if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                            echo '<div class="style">You have been successfuly registered.</div>';
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Your name" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address"maxlength="125">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" id="phone_no" name="phone_no"class="form-control" placeholder="Phone number"maxlength="10"  onkeyup="checkForIntegers(this)" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option selected=""> - - - - - Select - - - - - </option>
                                    <?php
                                    echo '<option value="Male">Male</option>';
                                    echo '<option value="Female">Female</option>';
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address" style="height:50px;"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pin</label>
                                    <input type="number" id="pin_no" name="pin_no" class="form-control" maxlength="6" min="0"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" id="city" name="city" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control" id="state" name="state">
                                        <option value="">- - - - State - - - -</option>
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
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"maxlength="25">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" id="cnfpassword" name="cnfpassword" class="form-control" placeholder="Confirm Password"maxlength="25">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-one" onClick="return regFormValidation()">Submit</button><p><br/></p>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="title-box clearfix ">
                        <h2 class="title-box_primary">Locations</h2></div> 
                    <figure class="frame thumbnail alignnone clearfix">
                        <p><img class="size-full " alt="usa" src="images/rail.png" width="" height="250"></p>
                    </figure>                   						
                </div>
            </div>
        </div>       
        <?php
        include 'footer.php';
        ?>               

    </body>
</html>
