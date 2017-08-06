<?php
declare(strict_types=1);
class View
{
	public function printHeaderAuth(): string
	{
		$text = '<!DOCTYPE html>';
		$text .='<html>';
		$text .='<head>';
		$text .='<title>File storage</title>';
		$text .='<meta charset="utf-8">';
		$text .='<link rel="stylesheet" href="styles/reset.css"/>';
		$text .='<link rel="stylesheet" href="styles/style01.css"/>';
		$text .='<script type="text/javascript" src="js/validate_registration.js"></script>';
		$text .='</head>';
		$text .='<body>';
		return $text;
	}
	
	public function printHeaderUser(): string
	{
		$text = '<!DOCTYPE html>';
		$text .='<html>';
		$text .='<head>';
		$text .='<title>File storage</title>';
		$text .='<meta charset="utf-8">';
		$text .='<link rel="stylesheet" href="styles/reset.css"/>';
		$text .='<link rel="stylesheet" href="styles/style02.css"/>';
		$text .='</head>';
		$text .='<body>';
		return $text;
	}
	
	public function printLoginForm(string $message): string
	{
		$text = '<h3>';
		$text .='Sign in to your File Storage!';
		$text .='</h3>';
		$text .=($message!='') ? '<b>'.$message.'</b><br/>' : '';
		$text .='<form id="registrationBlock" action = "index.php" method = "POST" onsubmit="return validate(this);">';
		$text .='<input type="email" name="email" id="email" size="40" maxlength="40" placeholder="E-mail"><br>';
		$text .='<input type="password" name="pass" id="pass" size="40" maxlength="40" placeholder="Password"><br>';
		$text .='<input type="submit" value="Login" id="button"><br>';
		$text .='</form>';
		return $text;
	}
	
	public function printUploadForm(string $username,string $message): string
	{
		$text  ='<div id="right_block">';
		$text .='<p id="login_name">You are logged in as: '.$username.' &nbsp&nbsp&nbsp<a href="?logout=go">Logout</a></p>';
		$text .=($message!='') ? '<b>'.$message.'</b><br/>' : '';
		$text .='<form action="" method="post" enctype="multipart/form-data">';
		$text .='<label for="filename">Upload:</label><br/>';
		$text .='<input type="file" name="filename"><br/>';
		$text .='<input type="submit" name="upload" value="Upload" id="button">';
		$text .='</form>';
		$text .='</div>';
		$text .='</div>';
		return $text;
	}
	
	public function printFooter(): string
	{
		$text= '</body>';
		$text .='</html>';
		return $text;
	}
	
	
}