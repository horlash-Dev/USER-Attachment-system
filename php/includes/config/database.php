<?php  
				///*********CONNECTION  START PAGE********///
class  database 
{   const USERNAME="inbox4project@gmail.com";
    const PASSWORD="tvvjtsrglvmnmstl";
    private $host= "localhost";
	private $username= "root"; 
	private $token= "";
	private $database= "user_nysc";
	public $conn;

	function __construct()
	{
		$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
		try{$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database",$this->username,$this->token);
		}catch(PDOException $e){
			echo die("connection failed" . $e->getMessage()); 
		}
	}


}
