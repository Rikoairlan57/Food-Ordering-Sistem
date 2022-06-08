<!DOCTYPE html>
<html lang="en">
<?php
session_start(); 
error_reporting(0); 
include("connection/connect.php"); 
if(isset($_POST['submit'] )) 
{
     if(empty($_POST['firstname']) ||  
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['cpassword']) ||
		empty($_POST['cpassword']))
		{
			$message = "All fields must be Required!";
		}
	else
	{
	$check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  
       	$message = "Password not match";
    }
	elseif(strlen($_POST['password']) < 6)  
	{
		$message = "Password Must be >=6";
	}
	elseif(strlen($_POST['phone']) < 10) 
	{
		$message = "invalid phone number!";
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
       	$message = "Invalid email address please type a valid email!";
    }
	elseif(mysqli_num_rows($check_username) > 0) 
     {
    	$message = 'username Already exists!';
     }
	elseif(mysqli_num_rows($check_email) > 0)
     {
    	$message = 'Email Already exists!';
     }
	else{
       
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
		$success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
					<script type='text/javascript'>
					    function countdown() {
					    	var i = document.getElementById('counter');
					    	if (parseInt(i.innerHTML)<=0) {
					    		location.href = 'login.php';
					    	}
					    	i.innerHTML = parseInt(i.innerHTML)-1;
					    }
					    setInterval(function(){ countdown(); },1000);
					</script>'";
		 header("refresh:3;url=login.php"); 
    }
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
    <title>Register Form</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
    <link href="css/footer.css" rel="stylesheet">
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
        <div class="breadcrumb">
           <div class="container">
              <ul>
                 <li>
                    <a href="#" class="active">
				        <span style="color:g;"><?php echo $message; ?></span>
				        <span style="color:green;">
					    <?php echo $success; ?>
				        </span>
				    </a>
                </li>
              </ul>
           </div>
        </div>
        <section class="contact-page inner-page">
            <div class="container">
              <div class="row">
                 <!-- REGISTER -->
                <div class="col-md-8">
                    <div class="widget">
                       <div class="widget-body">
					  <form action="" method="post">
                             <div class="row">
						  <div class="form-group col-sm-12">
                                   <label for="exampleInputEmail1">Username</label>
                                   <input class="form-control" type="text" name="username" id="example-text-input" placeholder="Username"> 
                                </div>
                                <div class="form-group col-sm-6">
                                   <label for="exampleInputEmail1">First Name</label>
                                   <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="First Name"> 
                                </div>
                                <div class="form-group col-sm-6">
                                   <label for="exampleInputEmail1">Last Name</label>
                                   <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Last Name"> 
                                </div>
                                <div class="form-group col-sm-6">
                                   <label for="exampleInputEmail1">Email address</label>
                                   <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small> 
                                </div>
                                <div class="form-group col-sm-6">
                                   <label for="exampleInputEmail1">Phone number</label>
                                   <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Phone"> <small class="form-text text-muted">We"ll never share your email with anyone else.</small> 
                                </div>
                                <div class="form-group col-sm-6">
                                   <label for="exampleInputPassword1">Password</label>
                                   <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password"> 
                                </div>
                                <div class="form-group col-sm-6">
                                   <label for="exampleInputPassword1">Repeat password</label>
                                   <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password"> 
                                </div>
							 <div class="form-group col-sm-12">
                                   <label for="exampleTextarea">Delivery Address</label>
                                   <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-sm-4">
                                   <p> <input type="submit" value="Register" name="submit" class="btn input theme-btn"> </p>
                                </div>
                             </div> 
                          </form>
                       
				   </div>
                       <!-- end: Widget -->
                    </div>
                    <!-- /REGISTER -->
                </div>    
            </div>
        </section>

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
                            <div class="iconDiv"><i class='bx bx-mail-send' ></i></div>
                            <span>Angkring@gmail.com</span>
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
        <!-- FOOTER SECTION END----------------- -->
         
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