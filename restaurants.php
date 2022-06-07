<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Foodie Restaurant</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
 </head>

<body>
     <!--header starts-->
    <header id="header" class="header-scroll top-header headrom headerBg">
        <!-- .navbar -->
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> Angkring</a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>
                        
						<?php
					if(empty($_SESSION["user_id"]))
						{
							echo '
                            <li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
						    <li class="nav-item"><a href="registration.php" class="nav-link active greenBg" style="padding: 10px 15px; border-radius: 3rem">Signup</a></li>';
						}
					else
						{	
							echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">your orders</a> </li>';
							echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">logout</a> </li>';
						}
					?>
						 
                    </ul>
                </div>
            </div>
        </nav>
    <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay online</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
 
                    

        <!-- FOOTER SECTION ----------------------- -->
        <section class="footerSection">
                <div class="contentContainer container">
                    <div class="footerIntro">
                        <div class="footerLogoDiv">
                            <span class="hotelName">
                                Angkring<span>..</span>
                            </span>
                        </div>
                        <p>We are a trusted company in unity to provide quality service and food solution to the world around us.</p>

                        <div class="footContactDetails">
                            <div class="info">
                                <div class="iconDiv"><i class='bx bx-mail-send' ></i></div>
                                <span>FoodOrder@gmail.com</span>
                            </div>

                            <div class="info">
                                <div class="iconDiv"><i class='bx bxs-phone-outgoing'></i></div>
                                <span>+62 8990761528</span>
                            </div>

                            <div class="info">
                                <div class="iconDiv"><i class='bx bx-current-location' ></i></div>
                                <span>jl.blok duku, jakarta timur</span>
                            </div>
                        </div>
                    </div>

                    <div class="linksDiv">
                        <div class="footersectionTitle">
                            <h5>Mitra</h5>
                        </div>
                        <ul>
                            <span>Gojek</span>
                            <span>Grab</span>
                            <span>Paypal</span>
                            <span>Affiliation</span>
                            <span>FAQs</span>
                        </ul>
                    </div>

                    <div class="linksDiv">
                        <div class="footersectionTitle">
                            <h5>OUR SERVICES</h5>
                        </div>
                        <ul>
                            <span>Online Order Food</span>
                            <span>Free Ongkir</span>
                            <span>Cash on Delivery</span>
                            <span>Wishlist</span>
                            <span>Discount</span>
                        </ul>
                    </div>

                    <div class="linksDiv footerForm">
                        <div class="footersectionTitle">
                            <h5> OUR NEWSLETTER</h5>
                        </div>

                        <form action="">
                            <label> Subscribe To Our Newsletter...</label>
                            <input type="text" placeholder="Name" required>
                            <input type="email" placeholder="Email" required>
                            <button type="submit">Submit</button>
                        </form>
                    </div>

                </div>
        </section>
    
    </div>

    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>