<?php 
  include('Fun.php');

  // session_start();

  
  class Staff{
  	protected $staff_name;
  	protected $staff_email;
  	protected $staff_password;
  	protected $staff_info;
  	public function __construct($name , $email, $password){
  		$this->staff_name = $name;
  		$this->staff_email = $email;
  		$this->staff_password = $password;
  		$this->staff_info = array($name, $email, $password);
  	}
  	public function create_staff(){
  		myInsert("staff",$this->staff_info, "index.php");
  	}
  	public function hello(){
  		print_r($this->staff_info);
  	}
  }
  class Auth{
  	private $staff_email;
  	private $staff_password;
  	private $staff_info;
  	public function __construct($email, $password){
  		$this->staff_email = $email;
  		$this->staff_password = $password;
  		$this->staff_info = array($email, $password);
  	}
  	public function hello(){
  		print_r($this->staff_info);
  	}
  	public function authorize(){
  		// $info = getBy("staff","WHERE staff_email = '$this->staff_email' AND staff_password = '$this->staff_password' ")[0];
  		$info = getBy1("staff","WHERE staff_email = '$this->staff_email' AND staff_password = '$this->staff_password' ");
  		if(!empty($info)){
  			foreach($info as $k => $v){
  			   $_SESSION[$k] = $v;
  		    }
  		    if($_SESSION['staff_email'] == $this->staff_email && $_SESSION['staff_password'] == $this->staff_password){
		            		echo "hello ".$info['staff_name'];
		            		header("location: staff.php");
		            	}else{
		            		echo "bye";
		            		header("location : index.php");
		            	}
  		}

  	}
  }

?>