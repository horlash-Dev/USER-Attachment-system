<?php  
///*********VALIDATION START PAGE********///
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'includes/config/database.php';
require_once 'includes/session.in.php';
require_once 'includes/controller.php';
// Load Composer's autoloader require 'vendor/autoload.php';
require_once 'phpmailer/phpmailer/src/PHPMailer.php';
require_once 'phpmailer/phpmailer/src/SMTP.php';
require_once 'phpmailer/phpmailer/src/Exception.php';
session_start();
$users = new session;
 $users->currentUser();
$command= new controller;
$mail = new PHPMailer(true);
if (isset($_POST['registers'])) {
$firstname= $command->intInput($_POST['firstname']);
$lastname= $command->intInput($_POST['lastname']);
$email= $command->intInput($_POST['email']);
$password= $command->intInput($_POST['password']);
$cpassword= $command->intInput($_POST['c-password']);
$hashPass= password_hash($password, PASSWORD_ARGON2I);
if (isset($command->error)) {
header("Location:registration.php?emptyField");
exit();
}elseif ($command->Mail($email) !== false) {
header("location:registration.php?email-f");
exit();
}elseif ($password != $cpassword) {
header("Location:registration.php?mis-match");
exit();
}else{
	if ($command->register($firstname,$lastname,$email,$hashPass) != false) {
		$_SESSION['start_time'] = time();
		$_SESSION['user-mail'] = $email;
		
		try {
    //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = database::USERNAME;                     
    $mail->Password   = database::PASSWORD;                         
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;
    $mail->setFrom(database::USERNAME, 'Nysc Portal Management!!');    
    $mail->addAddress($email, 'Dear User');               
    $mail->addReplyTo(database::USERNAME, 'no reply');
    $mail->addCC($email);
    $mail->addBCC(database::USERNAME);
    $mail->isHTML(true);
    $mail->Subject = "Nysc Portal Email Confirmation";
    $mail->Body    =  '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Email Confirmation</title>
		<style>
		.bold{
			text-transform: capitalize;
			font-size: 15px;
			font-family: helvetica;
			max-width: 100%;
			padding: 20px;
			margin: auto;
			text-align: justify;
			border-radius: 5px;
			background-color:rgba(0,0,0,0.1);
		}
		a{text-transform: lowercase;}
	</style>
	</head>
	<body>
		<div class="container">
		<div  class="text-center bold col-md-8">
			<h3>Nysc Portal Email Confirmation</h3>
			<p class="lead"><b>dear user </b> to continue to your dashboard click the below link..</p>
			<a href="'.$_SERVER['SERVER_NAME'].'/nysc/php/email.php?email='.$_SESSION['user-mail'].'">
			    '.$_SERVER['SERVER_NAME'].'/nysc/php/email.php?email='.$_SESSION['user-mail'].'
			</a> 
		</div>
		</div>
	</body>
	</html>';
    $mail->send();
		} catch (Exception $e) {
    echo $mail->ErrorInfo;
}
header("Location:dashboard-page.php");
exit();
	}else{
header("Location:registration.php?errors");
exit();
}
}
}

// //login validation
if (isset($_POST['action-login'])) {
$username= $command->intInput($_POST['email']);
$password= $command->intInput($_POST['password']);
if (isset($command->error)) {
	header("Location:login-page.php?emptyField");
	exit();
}else{
	if ($check= $command->Login($username)) {
		if (password_verify($password, $check['user_password'])) {
		$_SESSION['start_time'] = time();
		$_SESSION['user-mail']= $check['user_email'];
header("Location:dashboard-page.php");
exit();
		}else{
header("Location:login-page.php?incorrect");
exit();
}
}else{
	header("Location:login-page.php?incorrect");
	exit();}
}

}

if (isset($_POST['d-nysc'])) {
	$cid= $users->cid;
	$matric_no= $command->intInput($_POST['matric_no']);
	$dob= $command->intInput($_POST['date']);
	$fullname= $command->intInput($_POST['name']);
	$address= $command->intInput($_POST['address']);
	$sex= $command->intInput($_POST['sex']);
		$age= $command->intInput($_POST['age']);
		$marital_status= $command->intInput($_POST['marital_status']);
		$phone_no= $command->intInput($_POST['phone_number']);
		$state_of_origin= $command->intInput($_POST['state_of_origin']);
		$nationality= $command->intInput($_POST['nationality']);
		$religion= $command->intInput($_POST['religion']);
		$lga= $command->intInput($_POST['lga']);
		$qualification= $command->intInput($_POST['qualification']);
		$instituion= $command->intInput($_POST['institution']);
		$service_year= $command->intInput($_POST['service_year']);
		$dept= $command->intInput($_POST['department']);
		$approval_date= $command->intInput($_POST['approval_date']);
		$state= $command->intInput($_POST['state']);
		$callup_no= $command->intInput($_POST['c-number']);
		$ex_activities= $command->intInput($_POST['ex_activities']);
		$health_status= $command->intInput($_POST['health_status']);
	if (isset($command->error)) {
		header("Location:dashboard-page.php?emptyField");
		exit();
	}else{
		if ($command->nysc_Datas($matric_no, $fullname, $address, $sex, $dob,$age,$marital_status,$phone_no,$state_of_origin,$nationality,$lga,$ex_activities,$health_status,$qualification,$instituion,$service_year,$state,$dept,$approval_date,$callup_no,$religion,$cid) !== null){
			header("Location:dashboard-page.php?suclog");
			exit();
		}else{header("Location:dashboard-page.php?errors");
			exit();}
	}
	
	}

//admin forms

if (isset($_POST['p_blog'])) {
$title= $command->intInput($_POST['title']);
$body= $command->intInput($_POST['body']);
  $slug = strtolower(preg_replace('~[^\pL\d]+~u', '-', $title));
if (isset($command->error)) {
header("Location:admin/publish.php?emptyField");
exit();
}elseif ($command->admin_blog($title,$slug,$body) !== null) {
		header("Location:admin/posts.php?suclog");
		exit();
	}else{
header("Location:admin/publish.php?error");
exit(); 
	}
}

if (isset($_POST['p_blog_update'])) {
$title= $command->intInput($_POST['title']);
$id= $_POST['ids'];
$body= $command->intInput($_POST['body']);
  $slug = strtolower(preg_replace('~[^\pL\d]+~u', '-', $title));
if (isset($command->error)) {
header("Location:admin/posts.php?emptyField");
exit();
}elseif ($command->admin_blog_update($title,$slug,$body,$id) !== null) {
		header("Location:admin/posts.php");
		exit();
	}else{
header("Location:admin/publish.php?error");
exit(); 
	}
}

if (isset($_GET['i'])) {
    if($command->admin_blog_trash($_GET['i']) !== null){
    header("Location:admin/posts.php?trash");
	exit();
}
}

if (isset($_POST['u-approved'])) {
	$mail = $_POST['v_mail'];
	if ($command->admin_users_verify($mail) !== null) {
		header("Location:admin/verified_user.php?approved");
		exit();
	}

}

if (isset($_POST['posting_user'])) {
	$name= $command->intInput($_POST['name']);
	$area_posted= $command->intInput($_POST['area_posted']);
	$state= $command->intInput($_POST['state']);
	$mails= $command->intInput($_POST['a_email']);
	$callup_no= $command->intInput($_POST['callup_no']);
	$lga= $command->intInput($_POST['lga']);
	if (isset($command->error)) {
		header("Location:admin/verified_user.php?errors");
		exit();
	}else{
	if ($command->admin_users_post($name,$area_posted,$lga,$state,$callup_no,$mails) !== null) {
		$command->admin_users_posted($mails);
	try {
    //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = database::USERNAME;                     
    $mail->Password   = database::PASSWORD;                         
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;
    $mail->setFrom(database::USERNAME, 'Nysc Portal Management!!');    
    $mail->addAddress($mails, 'Dear User');               
    $mail->addReplyTo(database::USERNAME, 'no reply');
    $mail->addCC($mails);
    $mail->addBCC(database::USERNAME);
    $mail->isHTML(true);
    $mail->Subject = "Nysc  Posting Details";
    $mail->Body    =  '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Email Confirmation</title>
		<style>
		.bold{
			text-transform: capitalize;
			font-size: 15px;
			font-family: helvetica;
			max-width: 100%;
			padding: 20px;
			margin: auto;
			text-align: justify;
			border-radius: 5px;
			background-color:rgba(0,0,0,0.1);
		}
		a{text-transform: lowercase;}
	</style>
	</head>
    	<body>
		<div class="container">
		<div  class="text-center bold col-md-8">
			<h3>Nysc  Posting Details</h3>
			<p class="lead"><b>dear user </b> you have been successfully posted, below are your posting details. </p>
			<a href="'.$_SERVER['SERVER_NAME'].'/nysc/php/dashboard-page.php">
			visit dashboard
			</a>
			<p class="text-capitalize"><b>Callup Number</b>: <span>'.$callup_no.'</span></p><br> 
			<p class="text-capitalize"><b>Fullname</b>: <span>'.$name.'</span></p><br> 
			<p class="text-capitalize"><b>area posted</b>: <span>'.$area_posted.'</span></p><br> 
			<p class="text-capitalize"><b>Lga</b>: <span>'.$lga.'</span></p><br>
			<p class="text-capitalize"><b>State</b>: <span>'.$state.'</span></p><br>  
			<span class="text-capitalize text-center">Nysc Portal Management &copy; 2021</span>
		</div>
		</div>
	</body>
	</html>';
    $mail->send();
		} catch (Exception $e) {
    echo $mail->ErrorInfo;
}
	header("Location:admin/verified_user.php?posted");
	exit();
	}else{
		header("Location:admin/verified_user.php?errors");
		exit();
	}
	}
}

if (isset($_POST['posting_edit_user'])) {
	$name= $command->intInput($_POST['name']);
	$area_posted= $command->intInput($_POST['area_posted']);
	$state= $command->intInput($_POST['state']);
	$mail= $command->intInput($_POST['a_email']);
	$lga= $command->intInput($_POST['lga']);
	if (isset($command->error)) {
		header("Location:admin/edit_posting.php?emptyField");
		exit();
	}else{
	if ($command->admin_users_edit($name,$area_posted,$lga,$state,$mail) !== null) {
		header("Location:admin/verified_user.php?post-edited");
		exit();
	}else{
		header("Location:admin/verified_user.php?errors");
		exit();
	}
	}
}

if (isset($_POST['complain'])) {
	$cname= $command->intInput($_POST['complain_text']);
	$mail= $command->intInput($_POST['c_mail']);
	if (isset($command->error)) {
		header("Location:filter_error.php?emptyField");
		exit();
	}else{
	if ($command->admin_complain($cname,$mail) !== null) {
		header("Location:dashboard-page.php?c-sent");
		exit();
	}else{
		header("Location:dashboard-page.php?errors");
		exit();
	}
	}
}

if (isset($_POST['q-approved'])) {
	$mail = $_POST['q_mail'];
	if ($command->admin_queries($mail) !== null) {
		header("Location:admin/reply.php");
		exit();
	}

}

//search
if (isset($_GET['q-search'])) {
	$name= $command->intInput($_GET['q']);
	if (isset($command->error)) {
		header("Location:dashboard-page.php?empty");
		exit();
	}
	if ($command->data_search($users->cUser,$name) != null) {
		header("Location:filter.php");
		exit();
	}else{
		header("Location:filter_error.php");
		exit();
	}
}

///*********VALIDATION START END********///