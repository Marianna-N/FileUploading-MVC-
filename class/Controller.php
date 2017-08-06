<?php
declare(strict_types=1);
class Controller
{
	private $database;
	private $model;
	private $view;
	private $message='';
		
	public function run()
	{
		$this->model = new Model();
		$this->view = new View();
		//Logout
		if ((isset($_GET['logout'])) && ($_GET['logout']=='go')) {
			$this->model->userLogout();
		}
		//Login	
		if ((isset($_POST['email']))&&(isset($_POST['pass']))) {
			$id_user = $this->model->checkUser($_POST['email'],$_POST['pass']);
			if ($id_user === NULL) {
				$this->message = 'Wrong email or password!';
			}
			else{
				$username = $this->model->getUserName($id_user);
				$_SESSION ['id_user'] = $id_user;
				$_SESSION ['email'] = $_POST['email'];
				$_SESSION ['username'] = $username;
				echo $this->view->printHeaderUser();
				echo $this->model->getUserFiles($id_user);
				echo $this->view->printUploadForm($username,$this->message);
				echo $this->view->printFooter();
				exit();
			}
		}
		//Upload file
		if(isset($_FILES['filename'])&&($_FILES['filename']['error']==0)){
			$id_user = $_SESSION ['id_user'];
			$username = $_SESSION ['username'];
			$email = $_SESSION ['email'];
			$this->message = $this->model->uploadFile($email,$id_user);
			echo $this->view->printHeaderUser();
			echo $this->model->getUserFiles($id_user);
			echo $this->view->printUploadForm($username,$this->message);
			echo $this->view->printFooter();
			exit();
		}
		//Delete file
		if(isset($_GET["number"])&&($_GET["filename"])){
				
			$id_user = $_SESSION ['id_user'];
			$username = $_SESSION ['username'];
			$email = $_SESSION ['email'];
			$filename = $_GET["filename"];
			$link = $email.'/'.$filename;
			unlink($link);
			
			$this->message = $this->model->deleteFile($_GET["number"]);
			echo $this->view->printHeaderUser();
			echo $this->model->getUserFiles($id_user);
			echo $this->view->printUploadForm($username,$this->message);
			echo $this->view->printFooter();
			exit();
		}
		echo $this->view->printHeaderAuth();
		echo $this->view->printLoginForm($this->message);
		echo $this->view->printFooter();
	}
}