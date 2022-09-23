<?php  
require_once 'config/database.php';
		/////*********DATABASE VALIDATION  START PAGE********///
class main extends database
{
	protected function intInsert($name,$lastname,$email,$pass)
	{
		$stmt= $this->conn->prepare("INSERT INTO all_users_nysc (firstname, lastname, user_email, user_password, type) VALUES (?,?,?,?,?)");
		$stmt->execute([$name,$lastname,$email,$pass,2]);
		return true;
	}
	protected function intLogin($name)
	{
		$stmt= $this->conn->prepare("SELECT user_password, user_email FROM all_users_nysc WHERE user_email= ?");
		$stmt->execute([$name]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	protected function intMail($mail)
	{
		$sql= "SELECT user_email FROM all_users_nysc WHERE user_email= ?";
		$stmt= $this->conn->prepare($sql);
		$stmt->execute([$mail]);
		$result= $stmt->fetch();
		return $result;
	}

 	protected function intUser($user)
	{
		$sql= "SELECT  user_username FROM all_users_nysc WHERE user_username= ?";
		$stmt= $this->conn->prepare($sql);
		$stmt->execute([$user]);
		$result= $stmt->fetch();
		return $result;
	}

	protected function users($value)
	{
		$stmt= $this->conn->prepare("SELECT id, user_email, type, user_approved, user_posted, email_verify, matric_no, fullname, address, sex, dob,age,marital_status,phone_no,state_of_origin,nationality,lga,ex_activities,health_status,qualification,institution,service_year,state,dept,approval_date,callup_no,religion
		FROM all_users_nysc WHERE user_email= ?");
		$stmt->execute([$value]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	//admin

	protected function admin()
	{
		$stmt= $this->conn->prepare("SELECT id, user_email, type 
		FROM all_users_nysc WHERE type = 1");
		$stmt->execute();
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	protected function admin_users()
	{
		$stmt= $this->conn->prepare("SELECT id, user_email, fullname, user_approved, user_posted
		FROM all_users_nysc WHERE email_verify = 1 AND status = 1 AND type = 2");
		$stmt->execute();
		$result= $stmt->fetchAll();
		return $result;
	}
	protected function admin_users_posting()
	{
		$stmt= $this->conn->prepare("SELECT id, user_email, fullname, user_approved, user_posted
		FROM all_users_nysc WHERE user_approved = 1 AND user_posted = 1 AND type = 2");
		$stmt->execute();
		$result= $stmt->fetchAll();
		return $result;
	}
		protected function admin_blog_posting()
	{
		$stmt= $this->conn->prepare("SELECT *
		FROM nysc_blog");
		$stmt->execute();
		$result= $stmt->fetchAll();
		return $result;
	}
	
		protected function admin_blog_show($slug)
	{
		$stmt= $this->conn->prepare("SELECT *
		FROM nysc_blog WHERE slug = ?");
		$stmt->execute([$slug]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
			protected function admin_blog_edit($slug)
	{
		$stmt= $this->conn->prepare("SELECT *
		FROM nysc_blog  WHERE slug= ?");
		$stmt->execute([$slug]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	protected function admin_blog_trash($slug)
	{
		$stmt= $this->conn->prepare("DELETE FROM nysc_blog WHERE slug = ?");
		$stmt->execute([$slug]);
		return true;
	}
	
		protected function admin_blog_update($title,$slug,$body,$id)
	{	$stmt=$this->conn->prepare("UPDATE nysc_blog SET title = ?, slug = ?, body = ? WHERE id = ?");
		$stmt->execute([$title,$slug,$body,$id]);
		return true;
	}
	protected function admin_users_verify($mail)
	{	$stmt=$this->conn->prepare("UPDATE all_users_nysc SET user_approved = 1 WHERE user_email = ?");
		$stmt->execute([$mail]);
		return true;
	}
	
	protected function admin_queries($mail)
	{	$stmt=$this->conn->prepare("UPDATE nysc_message SET status = 1 WHERE email = ?");
		$stmt->execute([$mail]);
		return true;
	}
	protected function admin_users_post($name,$area_posted,$lga,$state,$callup_no,$mail)
	{	$stmt=$this->conn->prepare("INSERT INTO nysc_posting  (name, area_posted, lga, state, callup_no, email) VALUES (?,?,?,?,?,?)");
		$stmt->execute([$name,$area_posted,$lga,$state,$callup_no,$mail]);
		return true;
	}

	protected function totalData($email,$id)
	{
		$stmt= $this->conn->prepare("SELECT COUNT(*) AS total FROM all_users_nysc  WHERE $email = $id AND TYPE = 2");
		$stmt->execute([$email,$id]);
		$result = $stmt->fetch();
		return $result['total'];
	}


	protected function admin_complain($email,$name)
	{
		$stmt= $this->conn->prepare("INSERT INTO nysc_message (email,complain) VALUES (?,?)");
		$stmt->execute([$email,$name]);
		return true;
	}

	protected function admin_users_posted($mail)
	{	$stmt=$this->conn->prepare("UPDATE all_users_nysc SET user_posted = 1 WHERE user_email = ?");
		$stmt->execute([$mail]);
		return true;
	}
	protected function admin_users_edit($name,$area_posted,$lga,$state,$mail)
	{	$stmt=$this->conn->prepare("UPDATE nysc_posting SET name = ?, area_posted = ?, lga = ?, state = ? WHERE email = ?");
		$stmt->execute([$name,$area_posted,$lga,$state,$mail]);
		return true;
	}
	protected function admin_post_info($email)
	{
		$stmt= $this->conn->prepare("SELECT * 
		FROM nysc_posting WHERE email= ?");
		$stmt->execute([$email]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	protected function admin_reply_info()
	{
		$stmt= $this->conn->prepare("SELECT * 
		FROM nysc_message");
		$stmt->execute();
		$result= $stmt->fetchAll();
		return $result;
	}
	protected function admin_detail_info($email)
	{
		$stmt= $this->conn->prepare("SELECT * 
		FROM all_users_nysc WHERE user_email= ?");
		$stmt->execute([$email]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	protected function data_search($email,$data)
	{
		$stmt= $this->conn->prepare("SELECT callup_no FROM nysc_posting WHERE email= ? AND callup_no LIKE '%".$data."' ");
		$stmt->execute([$email]);
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	protected function nysc_mail($cid,$id)
	{
		$stmt=$this->conn->prepare("UPDATE all_users_nysc SET email_verify= ? WHERE id = ?");
		$stmt->execute([$cid,$id]);
		return true;
	}
		protected function admin_blog($title,$slug,$body)
	{
		$stmt= $this->conn->prepare("INSERT INTO nysc_blog (title, slug, body) VALUES (?,?,?)");
		$stmt->execute([$title,$slug,$body]);
		return true;
	}
	protected function nysc_Data($matric_no, $fullname, $address, $sex, $dob,$age,$marital_status,$phone_no,$state_of_origin,$nationality,$lga,$ex_activities,$health_status,$qualification,$instituion,$service_year,$state,$dept,$approval_date,$callup_no,$religion,$cid)
	{
		$stmt=$this->conn->prepare("UPDATE all_users_nysc SET matric_no= ?, fullname= ?, address= ?, sex= ?, dob= ?,age= ?,marital_status= ?,phone_no= ?,state_of_origin= ?,nationality= ?,lga= ?,ex_activities= ?,health_status= ?,qualification= ?,institution= ?,service_year= ?,state= ?,dept= ?,approval_date= ?,callup_no= ?,religion= ?, status = 1 WHERE id = ?");
		$stmt->execute([$matric_no, $fullname, $address, $sex, $dob,$age,$marital_status,$phone_no,$state_of_origin,$nationality,$lga,$ex_activities,$health_status,$qualification,$instituion,$service_year,$state,$dept,$approval_date,$callup_no,$religion,$cid]);
		return true;
	}

	



}
