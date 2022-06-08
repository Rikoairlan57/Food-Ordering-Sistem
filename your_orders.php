<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} else {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>My Orders</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="footer.css" rel="stylesheet">
        <style type="text/css" rel="stylesheet">
            .indent-small {
                margin-left: 5px;
            }

            .form-group.internal {
                margin-bottom: 0;
            }

            .dialog-panel {
                margin: 10px;
            }

            .datepicker-dropdown {
                z-index: 200 !important;
            }

            label.control-label {
                font-weight: 600;
                color: #777;
            }


            table {
                width: 750px;
                border-collapse: collapse;
                margin: auto;

            }

            tr:nth-of-type(odd) {
                background: #eee;
            }

            th {
                background: rgb(0, 128, 0);
                color: white;
                font-weight: bold;

            }

            td,
            th {
                padding: 10px;
                border: 1px solid #ccc;
                text-align: left;
                font-size: 14px;

            }

            @media only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px) {

                table {
                    width: 100%;
                }

                table,
                thead,
                tbody,
                th,
                td,
                tr {
                    display: block;
                }

                thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr {
                    border: 1px solid #ccc;
                }

                td {
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }

                td:before {
                    position: absolute;
                    top: 6px;
                    left: 6px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                    content: attr(data-column);

                    color: #000;
                    font-weight: bold;
                }

            }
        </style>

    </head>

    <body>

        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom headerBg">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> Angkring </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                            <?php
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active bgGreen">Sign Up</a> </li>';
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
            <!-- top Links -->

            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <div class="inner-page-hero bg-image" data-image-src="images/Gado_gado.jpg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">


                    </div>
                </div>
            </div>
            <!-- //results show -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <div class="bg-gray restaurant-entry">
                                <div class="row">

                                    <table>
                                        <thead>
                                            <tr>

                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>price</th>
                                                <th>status</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>



                                            <?php
                                            $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                                            if (!mysqli_num_rows($query_res) > 0) {
                                                echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
                                            } else {
                                                while ($row = mysqli_fetch_array($query_res)) {

                                            ?>
                                                    <tr>
                                                        <td data-column="Item"> <?php echo $row['title']; ?></td>
                                                        <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                                                        <td data-column="price">$<?php echo $row['price']; ?></td>
                                                        <td data-column="status">
                                                            <?php
                                                            $status = $row['status'];
                                                            if ($status == "" or $status == "NULL") {
                                                            ?>
                                                                <button type="button" class="btn btn-info" style="font-weight:bold;">Dispatch</button>
                                                            <?php
                                                            }
                                                            if ($status == "in process") {
                                                            ?>
                                                                <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>On a Way!</button>
                                                            <?php
                                                            }
                                                            if ($status == "closed") {
                                                            ?>
                                                                <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($status == "rejected") {
                                                            ?>
                                                                <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-column="Date"> <?php echo $row['date']; ?></td>
                                                        <td data-column="Action"> <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> </td>
                                                    </tr>


                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end:row -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <!-- Featured restaurants ends -->



        <!-- FOOTER SECTION ----------------------- -->
        <section class="footerSection">
            <div class="contentContainer container">
                <div class="footerIntro">
                    <div class="footerLogoDiv">
                        <span class="hotelName">
                            Angkring<span>..</span>
                        </span>
                    </div>
                    <p>Angkring adalah sebuah website yang menawarkan pengiriman makanan via online di restoran favorite mu.</p>

                    <div class="footContactDetails">
                        <div class="info">
                            <div class="iconDiv"><i class='bx bx-mail-send'></i></div>
                            <span>Angkring@gmail.com</span>
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