<?php 
require_once 'controller.php';
///*********VIEWS VALIDATION  START PAGE********///
class session extends controller
{
	public $cid;
	public $cUser;
	public $details;
	public $details_check;
	public $details_users;
	public $details_post;
	public $details_posting;
    public $details_blog;
	public $user_details;
	public $blogs;
		public $post;
	public $details_edit_blog;

	public function currentUser()
	{	if (isset($_SESSION['user-mail'])) {
	$this->details	= $userIN= parent::Cuser($_SESSION['user-mail']);
	$this->cid= $userIN['id'];
	$this->cUser= $userIN['user_email'];
	}

}

public function blogs()
	{
        $this->blogs = $active= parent::admin_blog_posting();	    
	}

public function adminUser()
{	if (isset($_SESSION['user-mail'])) {
$this->details_check= $userIN= parent::admin();
$this->details_users = $active= parent::admin_user();
$this->details_posting = $active= parent::admin_user_posting();
$this->details_blog = $active= parent::admin_blog_posting();
}
}

public function edit_posting($mail)
{	if (isset($_SESSION['user-mail'])) {
$this->details_post= $userIN= parent::admin_post_info($mail);
}
}

public function admin_blog_edit($slug)
{	if (isset($_SESSION['user-mail'])) {
$this->details_edit_blog= $userIN= parent::admin_blog_edit($slug);
}
}

public function user_info($mail)
{	if (isset($_SESSION['user-mail'])) {
$this->user_details= $userIN= parent::admin_detail_info($mail);
}
}

public  function totalDatas($email,$id){
	return parent::totalData($email,$id);
}

public  function blogShow($slug){
	$this->post = parent::admin_blog_show($slug);
}

public  function replyDatas(){
	return parent::admin_reply_info();
}

}

 ?>