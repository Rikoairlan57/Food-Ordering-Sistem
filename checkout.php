<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {

    foreach ($_SESSION["cart_item"] as $item) {

        $item_total += ($item["price"] * $item["quantity"]);

        if ($_POST['submit']) {

            $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";

            mysqli_query($db, $SQL);

            $success = "Thankyou! Your Order Placed successfully!";
        }
    }
?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Check Out Page</title>
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

        <div class="site-wrapper">
            <!--header starts-->
            <header id="header" class="header-scroll top-header headrom headerBg">
                <!-- .navbar -->
                <nav class="navbar navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                        <a class="navbar-brand" href="index.php"> Angkringan </a>
                        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                                <?php
                                if (empty($_SESSION["user_id"])) {
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active greenBg">Sign Up</a> </li>';
                                } else {
                                    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                    echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Log Out</a> </li>';
                                }

                                ?>

                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- /.navbar -->
            </header>
            <div class="page-wrapper">
                <div class="top-links">
                    <div class="container">
                        <ul class="row links">

                            <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                            <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                            <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and Pay online</a></li>
                        </ul>
                    </div>
                </div>

                <div class="container">
                    <span style="color:green;">
                        <?php echo $success; ?>
                    </span>
                </div>




                <div class="container m-t-30">
                    <form action="" method="post">
                        <div class="widget clearfix">

                            <div class="widget-body">
                                <form method="post" action="#">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="cart-totals margin-b-20">
                                                <div class="cart-totals-title">
                                                    <h4>Cart Summary</h4>
                                                </div>
                                                <div class="cart-totals-fields">

                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Cart Subtotal</td>
                                                                <td> <?php echo "Rp." . $item_total; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Shipping &amp; Handling</td>
                                                                <td>free shipping</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-color"><strong>Total</strong></td>
                                                                <td class="text-color"><strong> <?php echo "Rp." . $item_total; ?></strong></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--cart summary-->
                                            <div class="payment-option">
                                                <ul class=" list-unstyled">
                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-20">
                                                            <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                            <br> <span>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span> </label>
                                                    </li>
                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-10">
                                                            <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Paypal <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                                    </li>
                                                </ul>
                                                <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit" class="btn btn-outline-success btn-block" value="Order now"> </p>
                                            </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
            </form>
        </div>


        <!-- Featured restaurants ends -->




        <!-- FOOTER SECTION ----------------------- -->
        <section class="footerSection">
            <div class="contentContainer container">
                <div class="footerIntro">
                    <div class="footerLogoDiv">
                        <span class="hotelName">
                            Angkringan<span>..</span>
                        </span>
                    </div>
                    <p>Angkringan adalah sebuah website yang menawarkan pengiriman makanan via online di restoran favorite mu.</p>

                    <div class="footContactDetails">
                        <div class="info">
                            <div class="iconDiv"><i class='bx bx-mail-send'></i></div>
                            <span>Angkringan@gmail.com</span>
                        </div>

                        <div class="info">
                            <div class="iconDiv"><i class='bx bxs-phone-outgoing'></i></div>
                            <span>+62 8990761528</span>
                        </div>

                        <div class="info">
                            <div class="iconDiv"><i class='bx bx-current-location'></i></div>
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
        <!-- FOOTER SECTION END----------------- -->
        </div>
        <!-- end:page wrapper -->
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

<?php
}
?>