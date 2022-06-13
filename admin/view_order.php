<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script language="javascript" type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- start header  -->
        <?php include("includes/header.php"); ?>
        <!-- End header header -->
        <!-- start left Sidebar -->
        <?php include("includes/sidebar.php"); ?>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>

            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">View user Orders</h4>

                                <div class="table-responsive m-t-20">
                                    <table id="myTable" class="table table-bordered table-striped">

                                        <tbody>
                                            <?php
                                            $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id where o_id='" . $_GET['user_upd'] . "'";
                                            $query = mysqli_query($db, $sql);
                                            $rows = mysqli_fetch_array($query);

                                            ?>

                                            <tr>
                                                <td><strong>username:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['username']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="javascript:void(0);" onClick="popUpWindow('order_update.php?form_id=<?php echo htmlentities($rows['o_id']); ?>');" title="Update order">
                                                            <button type="button" class="btn btn-primary">Take Action</button>
                                                        </a>
                                                    </center>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td><strong>Quantity:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['quantity']; ?></center>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td><strong>Price:</strong></td>
                                                <td>
                                                    <center>Rp.<?php echo $rows['price']; ?></center>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td><strong>Address:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['address']; ?></center>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td><strong>Date:</strong></td>
                                                <td>
                                                    <center><?php echo $rows['date']; ?></center>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td><strong>status:</strong></td>
                                                <?php
                                                $status = $rows['status'];
                                                if ($status == "" or $status == "NULL") {
                                                ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars" aria-hidden="true">Memasak</button></center>
                                                    </td>
                                                <?php
                                                }
                                                if ($status == "Sedang Di antar") { ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>Sedang Di antar</button></center>
                                                    </td>
                                                <?php
                                                }
                                                if ($status == "Datang") {
                                                ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Datang</button></center>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($status == "rejected") {
                                                ?>
                                                    <td>
                                                        <center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button> </center>
                                                    </td>
                                                <?php
                                                }
                                                ?>


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->


    </div>
    <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>


    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>