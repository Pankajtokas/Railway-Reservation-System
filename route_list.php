<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM routes WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:route_list.php?status=success");
        } else {
            $error = "Route has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Route List - Railway Reservation System</title>
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
                            <h1>Route List</h1>
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
                        <form class="form-light mt-20" role="form" method="post" action="route_list.php">
                            <table class="table_list">
                                <?php
                                if (isset($_GET['status']) && $_GET['status'] == "success") {
                                    echo '<tr><td colspan="4">Route has been successfully deleted.</td></tr>';
                                }
                                if (!empty($error)) {
                                    echo '<tr><td>' . $error . '</td></tr>';
                                }
                                ?>
                                <tr>
                                    <td class="grid_heading">S.No</td>
                                    <td class="grid_heading">Source</td>
                                    <td class="grid_heading">Destination</td>
                                    <td class="grid_heading">Distance</td>
                                    <td class="grid_heading">Route Via</td>
                                    <td class="grid_heading">Delete</td>
                                </tr>
                                <?php
                                $i = 0;
                                $sql = "SELECT * FROM routes ORDER BY id ASC";
                                $result = mysql_query($sql);
                                if (mysql_num_rows($result) > 0) {
                                    while ($row = mysql_fetch_array($result)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="grid_label"><?php echo $i; ?></td>
                                            <td class="grid_label"><?php echo $row['source'] ?></td>
                                            <td class="grid_label"><?php echo $row['destination'] ?></td>
                                            <td class="grid_label"><?php echo $row['distance'] ?></td>
                                             <td class="grid_label"><?php echo $row['route_via'] ?></td>
                                             <td class="grid_label"><a href="route_list.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
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
