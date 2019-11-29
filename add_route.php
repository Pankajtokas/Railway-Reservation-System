<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        if (empty($source)) {
            $error .= "Please enter source.<br/>";
        }
        if (empty($destination)) {
            $error .= "Please enter destination.<br/>";
        }
        if (empty($distance)) {
            $error .= "Please enter distance.<br/>";
        }

        if (empty($error)) {
            $query = "insert into routes set source = '" . $source . "', destination ='" . $destination . "', distance = '" . $distance . "',route_via = '" . $route_via . "',created = '" . date('Y-m-d H:i:s') . "'";
            $r = mysql_query($query);
            $num = (int) $r;
            if ($num > 0) {                
                header("location:add_route.php?reg=success");
            } else {
                $error = "Your route has not been added.!!";
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Add Route - Railway Reservation System</title>
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
                            <h1>Add Route</h1>
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
                                echo '<div class="style">Route has been successfully added.</div>';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Source</label>
                                        <input type="text" id="source" name="source" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Destination</label>
                                        <input type="text" id="destination" name="destination" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Distance</label>
                                        <input type="text" id="distance" name="distance" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Route Via</label>
                                        <input type="text" id="route_via" name="route_via" class="form-control"/>
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