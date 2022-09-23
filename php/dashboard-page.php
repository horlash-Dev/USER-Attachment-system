<?php 

require_once 'includes/session.in.php';
session_start(); 
if (!isset($_SESSION['user-mail'])) {
header("Location:login-page.php");
}
$users = new session;
$users->currentUser();
if($users->details['email_verify'] != 1) {
	header("Location:verify.php");
}
$users->edit_posting($users->cUser); 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Nysc  Information Management System</title>

		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png">


		<!-- Main style sheet -->
			<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- responsive style sheet -->

		<link rel="stylesheet" type="text/css" href="../datatable/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="../css/responsive.css">
	


		<!-- Fix Internet Explorer ______________________________________-->

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->

			<style type="">

			</style>
	</head>

	<body>
		<div class="main-page-wrapper">

			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="loader-wrapper">
				<div id="loader"></div>
			</div>

		<header class="theme-main-header">
				<div class="top-header">
					<div class="container">
						<div class="clearfix">

							<div class="float-right">
								<ul class="right-widget clearfix">
									<?php if (isset($_SESSION['user-mail'])): ?>
									<li class="quote m-1"><a href="signout.php">logout</a></li>
									<?php else: ?>
										<li class="quote m-1"><a href="login-page.php"><i class="fa fa-key" aria-hidden="true"></i> login</a></li>	
									<li class="quote m-1"><a href="registration.php">register</a></li>
									<?php endif ?>
								</ul>
							</div>
						</div>
					</div> 
				</div> <!-- /.top-header -->
				
				<div class="main-menu-wrapper clearfix">
					<div class="container clearfix">
						<!-- Logo --> 
						<div class="logo float-left"><a href="../index.php"><img src="../images/gal1.webp" width="50" style="border-radius: 100%;" alt="Logo"></a></div>
						<!-- ============================ Theme Menu ========================= -->
						<div class="right-widget float-right">
					   		<ul>
					   			<li class="search-option">
					   				<div class="dropdown">
					   					<button type="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search" aria-hidden="true"></i></button>
										<form action="user-validity.php" method="$_GET"   class="d-block dropdown-menu">
											<input type="search" name="q" Placeholder="Call Up No: NYSC/etee23">
											<button type="submit" name="q-search"><i class="fa fa-search"></i></button>
										</form>
					   				</div>
					   			</li>
					   		</ul>
					   	</div> <!-- /.right-widget -->
						<nav class="navbar-expand-lg float-right navbar-light" id="mega-menu-wrapper">
					    	<button class="navbar-toggler float-right clearfix mb-4" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					    		<i class="flaticon-menu-options"></i>
					    	</button>
					    	<div class="collapse navbar-collapse clearfix" id="navbarNav">
					    	  <ul class="navbar-nav nav">
					    	    <li class="nav-item active"><a class="nav-link" href="../index.php">Home</a></li>
								<li class="nav-item "><a class="nav-link" href="dashboard-page.php">dashboard</a></li>
                                <li class="nav-item active"><a class="nav-link" href="feedback.php">Feedback</a></li>
										 <li class="nav-item active"><a class="nav-link" href="blog.php">News</a></li>
								<li class="nav-item "><a class="nav-link" href="signout.php">logout</a></li>	
							</ul>
					    	</div>
						</nav>
					</div> <!-- /.container -->
				</div> <!-- /.main-menu-wrapper -->
			</header> <!-- /.theme-main-header -->
		
			<div class="portfolio-details">
				<div class="container">
					<div class="image-gallery row">
						<div class="col-md-8 col-12"><img src="images/portfolio/13.jpg" alt=""></div>
						<div class="col-md-4 col-12"><img src="images/portfolio/14.jpg" alt=""></div>
					</div> <!-- /.image-gallery -->

					<div class="details-text">
						<div class="row">
						<?php if($users->details['type'] == 2): ?>
						<div class="col-lg-8 col-12 text-left-side">
								<h2>Nysc Application Form</h2>
								<h5>Upload your details for processing,make sure you fill validated info else your details wont be approved,you will be notified via email once you are posted.</h5>
							<?php if (isset($_GET['emptyField'])): ?>
								<div class="col-sm-10 col-12"><div class='alert alert-danger alert-dismissible'>
								<button class='close' data-dismiss='alert'>&times</button>
								<span><strong class="text-center" id="msgpop">fill in blank fields!</strong></span></div> 
								</div>
							<?php endif ?>
							<?php if (isset($_GET['s-error'])): ?>
								<div class="col-sm-10 col-12"><div class='alert alert-danger alert-dismissible'>
								<button class='close' data-dismiss='alert'>&times</button>
								<span><strong class="text-center" id="msgpop">no result found</strong></span></div> 
								</div>
							<?php endif ?>
							<?php if (isset($_GET['suclog'])): ?>
								<div class="col-sm-10 col-12"><div class='alert alert-success alert-dismissible'>
								<button class='close' data-dismiss='alert'>&times</button>
								<span><strong class="text-center" id="msgpop">Details Updated!</strong></span></div> 
								</div>
							<?php endif ?>

							<?php if (isset($_GET['c-sent'])): ?>
								<div class="col-sm-10 col-12"><div class='alert alert-success alert-dismissible'>
								<button class='close' data-dismiss='alert'>&times</button>
								<span><strong class="text-center" id="msgpop">your query as been received and will be reviewed</strong></span></div> 
								</div>
							<?php endif ?>

								<form action="user-validity.php" method="POST" class="form-validation form-styl-two row" id="outbak-form" >
																	
										<div class="col-sm-5 col-12">
										<label for="input">matric no</label>
										<input type="text" class="" value="<?php echo $users->details['matric_no'] ?? null ?>" placeholder="matric no*" name="matric_no"></div>
										<div class="col-sm-5 col-12">
										<label for="input"> date of birth</label>
										<input type="date" class="" placeholder="date*" name="date" value="<?php echo $users->details['dob'] ?? null ?>" ></div>
										<div class="col-sm-5 col-12">
										<label for="input">Name</label>
										<input type="text" class="" placeholder="Name*" name="name" value="<?php echo $users->details['fullname'] ?? null; ?>" ></div>
										<div class="col-sm-5 col-12">
										<label for="input">address</label>
										<input type="text" class="" placeholder="address*" name="address" value="<?php echo $users->details['address'] ?? null ?>" ></div>
										<div class="col-sm-5 col-12">
										<label for="input">gender</label>
										<br>
										<label for="">male</label>
										<input type="radio" class=""  value="male" name="sex" value="" >
										<label for="">female</label>
										<input type="radio" class="" value="female"  name="sex" value="" >
									</div>
									<div class="col-sm-5 col-12">
										<label for="input">age</label>
										<input type="text" class="" placeholder="age*" name="age" value="<?php echo $users->details['age'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">marital status</label>
										<input type="text" class="" placeholder="marital status*" value="<?php echo $users->details['marital_status'] ?? null ?>" name="marital_status"></div>
										<div class="col-sm-5 col-12">
										<label for="input">phone number</label>
										<input type="text" class="" placeholder="phone number*" name="phone_number" value="<?php echo $users->details['phone_no'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">state of origin</label>
										<input type="text" class="" placeholder="state of origin*" name="state_of_origin" value="<?php echo $users->details['state_of_origin'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">religion</label>
										<input type="text" class="" placeholder="religion*" name="religion" value="<?php echo $users->details['religion'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">nationality</label>
										<input type="text" class="" placeholder="nationality*" name="nationality" value="<?php echo $users->details['nationality'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">LGA</label>
										<input type="text" class="" placeholder="lga*" name="lga" value="<?php echo $users->details['lga'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">extracuricullar activities</label>
										<input type="text" class="" placeholder="ex-activities*" name="ex_activities" value="<?php echo $users->details['ex_activities'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">health status</label>
										<input type="text" class="" placeholder="health status*" name="health_status" value="<?php echo $users->details['health_status'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">qualification</label>
										<input type="text" class="" placeholder="qualification*" name="qualification"value="<?php echo $users->details['qualification'] ?? null ?>" ></div>
										<div class="col-sm-5 col-12">
										<label for="input">institution</label>
										<input type="text" class="" placeholder="institution*" name="institution" value="<?php echo $users->details['institution'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">service year</label>
										<input type="text" class="" placeholder="service year*" name="service_year" value="<?php echo $users->details['service_year'] ?? null ?>"></div>				
										<div class="col-sm-5 col-12">
										<label for="input">department</label>
										<input type="text" class="" placeholder="department*" name="department" value="<?php echo $users->details['dept'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">approval date</label>
										<input type="date" class="" placeholder="approval date*" name="approval_date" value="<?php echo $users->details['approval_date'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">state (school)</label>
										<input type="text" class="" placeholder="state*" name="state" value="<?php echo $users->details['state'] ?? null ?>"></div>
										<div class="col-sm-5 col-12">
										<label for="input">call-up number</label>
										<input type="text" class="" placeholder="call up number*" name="c-number" value="<?php echo $users->details['callup_no'] ?? null ?>"></div>
										<div class="col-sm-12">
									<input type="submit" class="ml-3" name="d-nysc" id="outbrebtn" value="SAVE">
									</div>
								</form>
							</div> <!-- /.text-left-side -->
							<?php endif ?>
						<div class="col-lg-4 col-md-6 col-sm-8 col-12 portfolio-info-list">
								<ul>
								<?php if($users->details['type'] == 2): ?>
									<li><strong>Fullname</strong> <?php echo $users->details['fullname'] ?? null ?> </li>
									<?php endif ?>
									<li><strong>Email</strong><?php echo $users->cUser ?? null ?></li>
									<li><strong>verification</strong>
									<?php if($users->details['email_verify'] == 1): ?>
									<i class="badge badge-success">verified</i></li>
									<?php else: ?>
										<i class="badge badge-danger">not-verified</i></li>
							<?php endif ?>
							<?php if($users->details['user_posted'] == 1 && $users->details['user_approved'] == 1 && $users->details['type'] == 2): ?>
									<li class="text-center"><strong>Callup Number</strong><?php echo $users->details_post['callup_no']; ?></li>
									<strong>check your email for complete details.</strong>	
							<?php  endif;  ?>
							<?php if($users->details['type'] == 1): ?>
									<li> <i class="badge badge-success">ADMIN</i></li>
								<li><a href="admin/dashboard.php" class="btn btn-success px-3">Adimin Panel</a></li>
							<?php endif ?>
								</ul>
							</div> <!-- /.portfolio-info-list -->


						</div> <!-- /.row -->
					</div> <!-- /.details-text -->
				</div> <!-- /.container -->
			</div> <!-- /.portfolio-details -->

		
			<footer class="theme-footer">
				<div class="container">
					<div class="content-wrapper">
						<div class="footer-bottom-wrapper row">
							
							<div class="col-lg-3 col-sm-6 col-12 footer-list text-capitalize">
								<h4>navigation</h4>
								<ul>
								<li class="nav-item "><a class="nav-link" href="dashboard-page.php">dashboard</a></li>
								<li class="nav-item "><a class="nav-link" href="signout.php">logout</a></li>	
								</ul>
							</div> <!-- /.footer-list -->
	
						</div> <!-- /.footer-bottom-wrapper -->

							<div class="copyright-wrapper row">
							<div class="col-md-6 col-sm-8 col-12">
								<p>© 2021 <a href="../index.php">Nysc  Information Management System</a> </p>
							</div>

						</div> <!-- /.copyright-wrapper -->
					</div>
				</div> <!-- /.container -->
			</footer> <!-- /.theme-footer -->
			

	        

	        <!-- Scroll Top Button -->
			<button class="scroll-top tran3s">
				<i class="fa fa-angle-up" aria-hidden="true"></i>
			</button>
			


	
		<!-- Optional JavaScript _____________________________  -->

    	
    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<!-- jQuery -->
		<script src="../vendor/jquery.2.2.3.min.js"></script>
		<!-- Popper js -->
		<script src="../vendor/popper.js/popper.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<!-- Camera Slider -->
		<script src='../vendor/Camera-master/scripts/jquery.mobile.customized.min.js'></script>
	    <script src='../vendor/Camera-master/scripts/jquery.easing.1.3.js'></script> 
	    <script src='../vendor/Camera-master/scripts/camera.min.js'></script>
		<!-- Language Stitcher -->
		<script src="../vendor/language-switcher/jquery.polyglot.language.switcher.js"></script>
	    <!-- Mega menu  -->
		<script src="../vendor/bootstrap-mega-menu/js/menu.js"></script>
		<!-- WOW js -->
		<script src="../vendor/WOW-master/dist/wow.min.js"></script>
		<!-- owl.carousel -->
		<script src="../vendor/owl-carousel/owl.carousel.min.js"></script>
		<!-- js count to -->
		<script src="../vendor/jquery.appear.js"></script>
		<script src="../vendor/jquery.countTo.js"></script>
		<!-- Fancybox -->
		<script src="../vendor/fancybox/dist/jquery.fancybox.min.js"></script>
		<script src="js/validate.in.js"></script>
	<script src="../datatable/datatables.min.js"></script> 

		<!-- Theme js -->
		<script src="../js/theme.js"></script>
		
		</div> <!-- /.main-page-wrapper -->
	</body>
</html>