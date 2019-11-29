<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">            
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="margin-top: -25px;">
                <h1 style="color:#666666;">Railway Reservation</h1>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right mainNav">               
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <?php                
                if (!empty($user_type)) {
                    ?> 
                    <li><a href="myaccount.php">My Account</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                    <?php
                }
                ?>  
            </ul>
        </div>       
    </div>
</div>