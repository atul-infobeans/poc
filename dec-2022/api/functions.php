<?php 
require_once "config.php";

/**
* API AUTHOR : Sandeep Jain
* description : Get WP data according to api call
* verion : 1.0
*/
Class ApisController {
	
	private $db;
	
	function __construct(){
		$this->db = new mysqli(hostname,username,password,database);
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}
    }
	
	function isEmailExits($email){
		$query = "select email from employee where email = ".$email;
		if($this->db->query($query) === TRUE){
			return true;
		}else{
			return false;
		}
	}
	
	function insert($name,$email,$pwd,$mobile){
		$query = "insert into employee(name,email,pwd,mobile) values('".$name."','".$email."','".$pwd."','".$mobile."')";
		if($this->db->query($query) === TRUE){
			return mysqli_insert_id($this->db);
		}else{
			return false;
		}
	}
	
	function validUser($username, $password){
		$query = "select * from employee where email = '".$username."' and pwd = '".$password."' ";
		$result = $this->db->query($query) or die(mysqli_error($this->db));
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	function getData($id=''){
		$query = "select * from employee";
		if($id != 0){
			$query .= " where Id = $id";
		}
		$result = $this->db->query($query) or die(mysqli_error($this->db));
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	function updateData($name,$email,$pwd,$mobile,$Id){
		$query = "update employee set name='".$name."',email='".$email."',pwd='".$pwd."',mobile='".$mobile."' where Id = '".$Id."'";
		if($this->db->query($query) === TRUE){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteData($Id){
		$query = "delete from employee where Id = '".$Id."'";
		if($this->db->query($query) === TRUE){
			return true;
		}else{
			return false;
		}
	}
}
?>