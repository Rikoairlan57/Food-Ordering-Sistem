<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();




if (isset($_POST['submit'])) {


    if (empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price'] == '' || $_POST['res_name'] == '') {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>All fields Must be Fillup!</strong>
				</div>';
    } else {

        $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.', $fname);
        $extension = strtolower(end($extension));
        $fnew = uniqid() . '.' . $extension;
        $store = "Res_img/dishes/" . basename($fnew);
        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            if ($fsize >= 1000000) {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Max Image Size is 1024kb!</strong> Try different Image.
												</div>';
            } else {

                $sql = "update dishes set rs_id='$_POST[res_name]',title='$_POST[d_name]',slogan='$_POST[about]',price='$_POST[price]',img='$fnew' where d_id='$_GET[menu_upd]'";  // update the submited data ino the database :images
                mysqli_query($db, $sql);
                move_uploaded_file($temp, $store);

                $success = '<div class="alert alert-success alert-dismissible fade show">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Record</strong>Updated.
												</div>';
            }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->


                <?php
                echo $error;
                echo $success;
                ?>




                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header" style="background: rgb(0, 128, 0);">
                            <h4 class="m-b-0 text-white">Add Menu to Restaurant</h4>
                        </div>
                        <div class="card-body">
                            <form action='' method='post' enctype="multipart/form-data">
                                <div class="form-body">
                                    <?php
                                    $qml = "select * from dishes where d_id='$_GET[menu_upd]'";
                                    $rest = mysqli_query($db, $qml);
                                    $roww = mysqli_fetch_array($rest);
                                    ?>
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Dish Name</label>
                                                <input type="text" name="d_name" value="<?php echo $roww['title']; ?>" class="form-control" placeholder="Morzirella">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">About</label>
                                                <input type="text" name="about" value="<?php echo $roww['slogan']; ?>" class="form-control form-control-danger" placeholder="slogan">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">price </label>
                                                <input type="text" name="price" value="<?php echo $roww['price']; ?>" class="form-control" placeholder="$">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                    <!--/span-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Category</label>
                                                <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                    <option>--Select Restaurant--</option>
                                                    <?php $ssql = "select * from restaurant";
                                                    $res = mysqli_query($db, $ssql);
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        echo ' <option value="' . $row['rs_id'] . '">' . $row['title'] . '</option>';;
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

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