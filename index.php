<?php
include './dbconfigur.php';
?>
<html>
    <head>
        <title>Welcome to Railway Reservation System</title>
        <?php include 'title.php'; ?>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <!-- Header -->
        <header id="head">
            <div class="container">
                <div class="banner-content">
                    <div id="da-slider" class="da-slider">

                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->

        <section class="container">
            <div class="heading">
                <!-- Heading -->
                <h2>About the project</h2>
            </div>
            <div class="row">                
                <div class="col-md-7">
                    <p>
                        Railway ticket booking system software projects main aim is to provide a secure and easy way to book train tickets. This project is developed in PHP language and MySql Database. This RAILWAY RESERVATION MANAGEMENT SYSTEM should be able to manage all the reservation related functions.
                    </p>     
                </div>
                <div class="col-md-5">
                        <img src="images/about.jpg" alt="">
                    </div>
            </div>
        </section>

        <section class="container">
            <div class="row">
                <div class="col-md-4"><div class="title-box clearfix "><h2 class="title-box_primary">Our Goals</h2></div> 
                    <p>
                        <span>
                            The purpose of Railway Reservation System is a software application which provides the train timing details, reservation,billing and cancellation.<br/><br/>

                            Using these systems Ticket Counter person can perform operations like finding out the train timings and to know information about PNR status, seats availability and costs of each ticket,etc.
                        </span>
                    </p>                   
                </div>                                
                <div class="col-md-4">
                    <div class="title-box clearfix "><h2 class="title-box_primary">Help</h2></div> 
                    <div class="list styled custom-list">
                        <ul>                            
                            <li><span><a href="register.php">Register</a></span></li>
                            <li><span><a href="login.php">Login</a></span></li>                            
                            <li><span><a href="#">Ticket Booking</a></span></li>                            
                            <li><span><a href="#">Ticket Cancellation</a></span></li>                            
                            <li><span><a href="#">Booking History</a></span></li>                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="title-box clearfix "><h2 class="title-box_primary">Reservation</h2></div> 
                    <figure class="frame thumbnail alignnone clearfix">
                        <p><img src="images/time-table1.jpg" alt="" class="img-responsive"></p>
                    </figure>
                </div>
            </div>
        </section>
        <?php include './footer.php'; ?> 
    </body>
</html>
