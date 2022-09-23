<?php 
require_once 'includes/session.in.php';

$users = new session;
$users->currentUser();
if (isset($_GET["post"])) {
$post =  $users->blogShow($_GET["post"]);
}
 ?>
 <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Blog - Nysc  Information Management System</title>

		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png">


		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- responsive style sheet -->
		<link rel="stylesheet" type="text/css" href="../css/responsive.css">


		<!-- Fix Internet Explorer ______________________________________-->

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->

			
	</head>

	<body>

		<div class="main-page-wrapper">

			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="loader-wrapper">
				<div id="loader"></div>
			</div>



			<!-- 
			=============================================
				Theme Header
			============================================== 
			-->
						<header class="theme-main-header">
<!-- /.top-header -->
				
				<div class="main-menu-wrapper clearfix">
					<div class="container clearfix">
						<!-- Logo --> 
						<div class="logo float-left"><a href="../index.php"><img src="../images/gal1.webp" width="50" style="border-radius: 100%;" alt="Logo"></a></div>
						<!-- ============================ Theme Menu ========================= -->
						<nav class="navbar-expand-lg float-right navbar-light" id="mega-menu-wrapper">
					    	<button class="navbar-toggler float-right clearfix mb-4" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					    		<i class="flaticon-menu-options"></i>
					    	</button>
					    	<div class="collapse navbar-collapse clearfix" id="navbarNav">
					    	  <ul class="navbar-nav nav">
					    	    <li class="nav-item active"><a class="nav-link" href="../index.php">Home</a></li>
					    	    			 <li class="nav-item active"><a class="nav-link" href="blog.php">News</a></li>
								<!-- <li class="nav-item "><a class="nav-link" href="dashboard-page.php">dashboard</a></li>
						 -->
							</ul>
					    	</div>
						</nav>
					</div> <!-- /.container -->
				</div> <!-- /.main-menu-wrapper -->
			</header> <!-- /.theme-main-header -->
			
			
					<div class="our-blog blog-details">
				<div class="container">
					<div class="row">
						<div class="col-xl-9 col-lg-8 col-12">
							<div class="blog-post">
								<div class="date">
								    <?php echo date('D M Y, h:i:a', strtotime($users->post['created_at'])) ?>
								</div>
								<h5 class="title"><?php echo $users->post["title"]; ?></h5>
								<p><?php echo $users->post["body"]; ?></p>
			
							</div> <!-- /.blog-post -->
	

						</div> <!-- /.col- -->
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-8 col-12 blog-sidebar">
						
						</div> <!-- /.blog-sidebar -->
					</div> <!-- /.row -->
				</div> <!-- /.container -->
			</div> <!-- /.our-blog -->
			
			
			<footer class="theme-footer">
				<div class="container">
					<div class="content-wrapper">
									
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
		<script src="../vendor/jquery-3.3.1.min.js"></script>
		<!-- Popper js -->
		<script src="../vendor/popper.js/popper.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
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
		<!-- Validation -->
		<script type="text/javascript" src="../vendor/contact-form/validate.js"></script>
		<script type="text/javascript" src="../vendor/contact-form/jquery.form.js"></script>
		<!-- Google map js -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjQLCCbRKFhsr8BY78g2PQ0_bTyrm_YXU" type="text/javascript"></script>
		<script src="../vendor/sanzzy-map/dist/snazzy-info-window.min.js"></script>
		<script src="js/validate.in.js"></script>

		<!-- Theme js -->
		<script src="../js/theme.js"></script>
		<script src="../js/map-script.js"></script>
		</div> <!-- /.main-page-wrapper -->
	</body>
</html>