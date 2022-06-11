<!DOCTYPE html>
<html lang="en">
<?php


session_start();
error_reporting(0);
include("../connection/connect.php");

if (isset($_POST['submit'])) {
    if (
        empty($_POST['uname']) ||
        empty($_POST['fname']) ||
        empty($_POST['lname']) ||
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        empty($_POST['phone'])
    ) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>All fields Required!</strong>
					</div>';
    } else {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>invalid email!</strong>
				</div>';
        } elseif (strlen($_POST['password']) < 6) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Password must be >=6!</strong>
				</div>';
        } elseif (strlen($_POST['phone']) < 10) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>invalid phone!</strong>
				</div>';
        } else {


            $mql = "update users set username='$_POST[uname]', f_name='$_POST[fname]', l_name='$_POST[lname]',email='$_POST[email]',phone='$_POST[phone]',password='" . md5($_POST[password]) . "' where u_id='$_GET[user_upd]' ";
            mysqli_query($db, $mql);
            $success = '<div class="alert alert-success alert-dismissible fade show">
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>User Updated!</strong>
                        </div>';
        }
    }
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body class="fix-header">
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
        <div class="page-wrapper" style="height:1200px;">
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
                    <div class="container-fluid">
                        <!-- Start Page Content -->


                        <?php
                        echo $error;
                        echo $success;
                        ?>

                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header" style="background: rgb(0,128,0);">
                                    <h4 class="m-b-0 text-white">Update Users</h4>
                                </div>
                                <div class="card-body">
                                    <?php $ssql = "select * from users where u_id='$_GET[user_upd]'";
                                    $res = mysqli_query($db, $ssql);
                                    $newrow = mysqli_fetch_array($res); ?>
                                    <form action='' method='post'>
                                        <div class="form-body">
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Username</label>
                                                        <input type="text" name="uname" class="form-control" value="<?php echo $newrow['username']; ?>" placeholder="username">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">First-Name</label>
                                                        <input type="text" name="fname" class="form-control form-control-danger" value="<?php echo $newrow['f_name'];  ?>" placeholder="jon">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last-Name </label>
                                                        <input type="text" name="lname" class="form-control" placeholder="doe" value="<?php echo $newrow['l_name']; ?>">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" name="email" class="form-control form-control-danger" value="<?php echo $newrow['email'];  ?>" placeholder="example@gmail.com">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input type="text" name="password" class="form-control form-control-danger" value="<?php echo $newrow['password'];  ?>" placeholder="password">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo $newrow['phone'];  ?>" placeholder="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->


                                            <!--/span-->
                                        </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save" style="background: rgb(0, 188, 126);">
                                    <a href="dashboard.php" class="btn btn-warning">Cancel</a>
                                </div>
                                </form>
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

</body>

</html>