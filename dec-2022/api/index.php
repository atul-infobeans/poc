<?php 
/**
* API AUTHOR : Sandeep Jain
* description : Get data according to api call
* verion : 1.0
*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

$action = $_GET['action'];
$username = $password = $fcm_token = '';
$header = apache_request_headers();
require "functions.php";
$obj = new ApisController();

//print_r($header);
/* Authorization of API Call */
foreach ($header as $headers => $value) { 
	if($headers == 'Authorization'){
		$head = explode(' ',$value);
		$userPass = explode(':', base64_decode($head[1]));
		$username = $userPass[0];
		$password = $userPass[1]; 
	}
	
	if($headers == 'fcm_token'){
		$fcm_token = $value; 
	}
} 

/* Validate API Call */
//if(!empty($username) && $username == 'root' && !empty($password) && $password == 'root@1234'){

	/**
	* For User Registration
	*/
	if($action == 'register'){
		
		$arrData = json_decode(file_get_contents('php://input'));
		
		$name = test_input($arrData->name); 
		$email = test_input($arrData->email);
		$pwd = test_input($arrData->pwd); 
		$mobile = test_input($arrData->mobile);
	
		if(!empty($name) || !empty($email) ||! empty($pwd) || !empty($mobile)){
			//$isExists = email_exists($email);
			$isEmailExits = $obj->isEmailExits($email);
			if($isEmailExits){
				/* Send OTP */
				apiResponse('Email is already exist.', 400, $arrData);
			}else{
				$result = $obj->insert($name,$email,$pwd,$mobile);
				if($result){
					$uData = array('user_id' => $result);	
					apiResponse('success', 200, $uData); 
				}else{
					apiResponse('Opps! something went wrong please try again.', 400);
				}
			}
		}else{
			apiResponse('Please fill all mandetory fields.', 404);
		}
	}

	/**
	* For User Login
	*/
	if($action == 'login'){
		
		$arrData = json_decode(file_get_contents('php://input'));
		//print_r($arrData); die;	
		
		$username = test_input($arrData->username);
		$password = test_input($arrData->password);
		
		if(!empty($username) || !empty($password)){
			
			$userData = $obj->validUser($username, $password);
			
			if($userData) {
				while($row = mysqli_fetch_assoc($userData))
				{
					$rows[] = $row;
				}
				apiResponse('success', 200, $rows);
			}else{
				apiResponse('Opps! Something went wrong, please try again.', 404);
			}
		}else{
			apiResponse('Please fill all mandetory fields.', 404);
		}
	}
	
	/**
	* For Get All Data
	*/
	if($action == 'getAllData'){
		$id = @$_GET['id'];
		$userData = $obj->getData($id);
		
		if($userData) {
			while($row = mysqli_fetch_assoc($userData))
			{
				$rows[] = $row;
			}
			
			apiResponse('success', 200, $rows);
		}else{
			apiResponse('Opps! Something went wrong, please try again.', 404);
		}
		
	}
	
	/**
	* For Update User Details
	*/
	if($action == 'updateDetails'){
		
		$arrData = json_decode(file_get_contents('php://input'));
		
		$name = test_input($arrData->name); 
		$email = test_input($arrData->email);
		$pwd = test_input($arrData->pwd); 
		$mobile = test_input($arrData->mobile);
		$Id = test_input($arrData->id);
		if(!empty($name) || !empty($email) || !empty($pwd) || !empty($mobile) || !empty($Id)){
			$result = $obj->updateData($name,$email,$pwd,$mobile,$Id);
			if($result){
				apiResponse('success', 200); 
			}else{
				apiResponse('Opps! something went wrong please try again.', 400);
			}
		}else{
			apiResponse('Please fill all mandetory fields.', 404);
		}
	}

	/**
	* For Get All Data
	*/
	if($action == 'delete'){
		$id = @$_GET['id'];
		$userData = $obj->deleteData($id);
		
		if($userData) {
			apiResponse('success', 200);
		}else{
			apiResponse('Opps! Something went wrong, please try again.', 404);
		}
		
	}

/* }else{
	apiResponse('You are not authorized person.', 400);
} */
	
	

/**
* For validate form fields
*/
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	
/**
* Set Response for API call 
*/
function apiResponse($message, $state, $data=null){
	$response['state'] = $state;
	$response['msg'] = $message;
	if($data){
		$response['data'] = $data;
	}
	echo json_encode($response);
	die;
}
?>