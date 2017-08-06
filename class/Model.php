<?php
declare(strict_types=1);
class Model
{
	private $db;
	
	public function __construct() {
		$this->db = new Database();
	}
	
	public function userLogout () 
	{
		unset($_SESSION['email']);
		unset($_SESSION['pass']);
	}
	
	public function checkUser ($email, $password)
	{
		$email = trim($email);
		$id_user = NULL;
		if(strlen($password) == 40){
			return $password;
		}
		else{
			$password = trim($password);
			$password = sha1($password);
		}
		$this->db->connect();
		$users = $this->db->getUserEmailPass();
		//var_dump($users);
		for($i=0;$i<count($users);$i++){
			if($email == $users[$i]["u_email"] and $password == $users[$i]["u_password"])
			{
				$id_user = $users[$i]["u_id"];
			}
		}
		return $id_user;
	}
	
	public function getUserName ($id_user) :string
	{
		$this->db->connect();
		$username_arr = $this->db->getUserName($id_user);
		$username = $username_arr[0]['u_name'];
		return $username;
	}
	
	public function getUserFiles ($id_user) :string
	{
		$text ='<h3>';
		$text .='Nice to see you again in our File Storage!';
		$text .='</h3>';
		$text .='<div id="main_block">';
		$text .='<div id="left_block">';
		$text .='<table border=1">';
		$text .='<tr>';
		$text .='<th>File</th><th>Size (Mb)</th><th>Date/Time</th><th>Delete</th>';
		$text .='<tr>';
		
		$this->db->connect();
		$files_data = $this->db->getUserFiles($id_user);

		for($i=(count($files_data)-1);$i>=0;$i--)
		{
			$text .= '<tr><th>'.$files_data[$i]["f_name"].'</th><th>'.$files_data[$i]["f_size"].'</th><th>'.$files_data[$i]["f_date"].' </th><th><a href = "index.php?number='.$files_data[$i]["f_id"].
			'&filename='.$files_data[$i]["f_name"].'">Удалить</a></th>
				<tr>';
		}
		$text .='</table>';
		$text .='</div>';
		return $text;
	}
	
	public function uploadFile (string $email, $id_user) : string
	{
		$message = '';
		$upload_file_size_mb = $_FILES["filename"]["size"]/1048576;
		$file_name = $_FILES["filename"]["name"];
	
		$uploads_dir = $email.'/'.$file_name;
		if(!file_exists($email)){
			mkdir($email);
		}
		
		if(file_exists($uploads_dir)){
			$message ='File already exists!';
		}
		elseif(is_uploaded_file($_FILES["filename"]["tmp_name"])) 
		{
			move_uploaded_file($_FILES["filename"]["tmp_name"], $uploads_dir); 
			$this->db->connect();
			$this->db->uploadUserFile($id_user, $file_name, $upload_file_size_mb);	
			$message ='File was uploaded!';	
		}
		else {
		  $message='File upload error';
		}
		return $message;
	   
	}
	
	public function deleteFile (string $f_id)
	{
		$this->db->connect();
		$this->db->deleteUserFile($f_id);
		$message='File was deleted!';
		return $message;
	}
	
}