<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


if (isset($_POST['submit'])) {
    if (empty($_POST['c_name'])) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
						button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						strong>field Required!</strong>
					</div>';
    } else {

        $check_cat = mysqli_query($db, "SELECT c_name FROM res_category where c_name = '" . $_POST['c_name'] . "' ");



        if (mysqli_num_rows($check_cat) > 0) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Category already exist!</strong>
				</div>';
        } else {


            $mql = "INSERT INTO res_category(c_name) VALUES('" . $_POST['c_name'] . "')";
            mysqli_query($db, $mql);
            $success = '<div class="alert alert-success alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Congrass!</strong> New Category Added Successfully.</br>
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
    <!-- icon -->
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
        <!-- start sidebar -->
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
                                <div class="card-header" style="background: rgb(0, 128, 0);">
                                    <h4 class="m-b-0 text-white">Add Restaurant Category</h4>
                                </div>
                                <div class="card-body">
                                    <form action='' method='post'>
                                        <div class="form-body">

                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <input type="text" name="c_name" class="form-control" placeholder="Category Name">
                                                    </div>
                                                </div>
                                                <!--/span-->

                                            </div>
                                            <div class="form-actions">
                                                <input type="submit" name="submit" class="btn btn-success" value="Save" style="background: rgb(0, 188, 126);">
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Listed Categories</h4>

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $sql = "SELECT * FROM res_category order by c_id desc";
                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="7"><center>No Categories-Data!</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {

                                                    echo ' <tr><td>' . $rows['c_id'] . '</td>
																				<td>' . $rows['c_name'] . '</td>
																				<td>' . $rows['date'] . '</td>
																				<td><a href="includes/delete/delete_category.php?cat_del=' . $rows['c_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa-solid fa-trash" style="font-size:16px"></i></a> 
																				<a href="update_category.php?cat_upd=' . $rows['c_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5" style="background: rgb(0, 188, 126);"><i class="fa-solid fa-gear"></i></a>
																				</td>
                                                                            </tr>';
                                                }
                                            }


                                            ?>



                                        </tbody>
                                    </table>
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

</body>

</html>