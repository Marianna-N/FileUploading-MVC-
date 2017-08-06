<?php
class Database
{
	private $link; 
	
	public function connect()
	{
		require('config.php');
		$dsn = 'mysql:host = '.$return['host'].';dbname='.$return['db_name'].';charset='.$return['charset'];
		$this->link = new PDO($dsn, $return['username'], $return['password']);
		return $this;
	}
	
	public function execute($sql)
	{
		$ath = $this->link->prepare($sql);
		return $ath->execute();
	}
	
	public function query($sql)
	{
		$ath = $this->link->prepare($sql);
		$ath->execute();
		$result = $ath->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function getUserEmailPass()
	{
		$tmp = $this->query("SELECT `u_id`,`u_email`,`u_password` FROM `user`");
		return $tmp;
	}
	
	public function getUserName($id_user)
	{
		$username = $this->query('SELECT `u_name` FROM `user` WHERE `u_id` = '.$id_user.'');
		return $username;
	}
	
	public function getUserFiles($id_user)
	{
		$files=$this->query('SELECT `f_id`,`f_name`,`f_size`,`f_date` FROM `file` WHERE `f_user` = '.$id_user.'');
		return $files;
	}
	
	public function uploadUserFile($id_user, $file_name, $upload_file_size_mb)
	{
		$this->execute('insert into `file` (`f_user`,`f_name`,`f_size`,`f_date`) values ('.$id_user.',\''.$file_name.'\','.$upload_file_size_mb.',NOW())');
	}
	
	public function deleteUserFile($f_id){
		$this->execute('DELETE FROM `file` WHERE `f_id`='.$f_id.'');
	}
	

}