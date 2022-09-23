<?php 
require_once 'main.php';
/**
 * 
 */
///*********CONTROLLER VALIDATION  START PAGE********///
class controller extends main
{	public $error;
	public function register($name,$lastname,$email,$pass)
	{
		return parent::intInsert($name,$lastname,$email,$pass);
	}
	public function Login($name)
	{
		return parent::intLogin($name);
	}
	public function nysc_mails($cid,$id)
	{
		return parent::nysc_mail($cid,$id);
	}
	//admin
	public function admin()
	{
		return parent::admin();
	}
	public function admin_user()
	{
		return parent::admin_users();
	}
	public function admin_user_posting()
	{
		return parent::admin_users_posting();
	}
		public function admin_blog_posting()
	{
		return parent::admin_blog_posting();
	}
		public function admin_blog_edit($slug)
	{
		return parent::admin_blog_edit($slug);
	}
			public function admin_blog_show($slug)
	{
		return parent::admin_blog_show($slug);
	}

    public function admin_blog_trash($slug)
	{
		return parent::admin_blog_trash($slug);
	}
	public function admin_blog_update($title,$slug,$body,$id)
	{
		return parent::admin_blog_update($title,$slug,$body,$id);
	}
	public function admin_users_verify($mail){
		return parent::admin_users_verify($mail);
	}
	public function admin_users_posted($mail){
		return parent::admin_users_posted($mail);
	}
	public function admin_users_edit($name,$area_posted,$lga,$state,$mail){
		return parent::admin_users_edit($name,$area_posted,$lga,$state,$mail);
	}
	public function admin_users_post($name,$area_posted,$lga,$state,$callup_no,$mail){
		return parent::admin_users_post($name,$area_posted,$lga,$state,$callup_no,$mail);
	}
	public function admin_post_info($email)
	{
		return parent::admin_post_info($email);
	}
	public function admin_detail_info($email)
	{
		return parent::admin_detail_info($email);
	}
	public  function totalData($email,$id){
		return parent::totalData($email,$id);
	}
	public  function data_search($email,$data)
	{
		return parent::data_search($email,$data);
	}
	public function admin_complain($email,$name){
		return parent::admin_complain($name,$email);
	}
	public function admin_reply_info(){
		return parent::admin_reply_info();
	}
	public function admin_queries($mail){
		return parent::admin_queries($mail);
	}
	public function Cuser($value)
	{
		return parent::users($value);
	}
	public function admin_blog($title,$slug,$body){
    return parent::admin_blog($title,$slug,$body);	    
	}
	public function nysc_Datas($matric_no, $fullname, $address, $sex, $dob,$age,$marital_status,$phone_no,$state_of_origin,$nationality,$lga,$ex_activities,$health_status,$qualification,$instituion,$service_year,$state,$dept,$approval_date,$callup_no,$religion,$cid)
	{
		return parent::nysc_Data($matric_no, $fullname, $address, $sex, $dob,$age,$marital_status,$phone_no,$state_of_origin,$nationality,$lga,$ex_activities,$health_status,$qualification,$instituion,$service_year,$state,$dept,$approval_date,$callup_no,$religion,$cid);
	}
		public function intInput($value)
	{	if (empty($value)) {
		return $this->error = $value;
		}else{
		$value = trim($value);
		$value = stripslashes($value);
		$value = filter_var($value, FILTER_SANITIZE_STRING);
		$value = htmlspecialchars($value);
		return $value;	
		}
		
	}
		public function valInput($value)
	{	if (!preg_match("/^[a-zA-Z0-9\s]{4,18}$/", $value)) {
		return $value;
	}
	}
		public function filter_page($value)
	{	if (!preg_match("/^[a-zA-Z0-9._,{}\s]{1,120}$/", $value)) {
		return $value;
	}
	}

	public function Mail($value)
	{	$value= filter_var($value, FILTER_SANITIZE_EMAIL);
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			return $value;
		}
		return parent::intMail($value);
		
	}
		public function User($name)
	{
		return parent::intUser($name);
	}
	public function passwordVerify($value)
	{if (!preg_match("/^[a-zA-Z0-9_.,!*$?#@%|\s]{6,15}$/", $value)) {
		return $value;
	}
	}
		public function erMsg($output)
	{	$output = "
	<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>".$output."</b></span></div>";
	return $output;
	}
		public function sucMsg($output)
	{	$output = "
	<div class='alert alert-success alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>".$output."</b></span></div>";
	return $output;
	}

	public function page_controller()
	{
		if (!isset($_SESSION['user-mail'])) {
			header("location: login-page.php");
		}
	}











}