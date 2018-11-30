<?php
function get_db()
	{
		$mongo = new MongoClient(
			"mongodb://localhost:27017/",
			[
				'username' => 'wai_web',
				'password' => 'w@i_w3b',
				'db' => 'wai',
			]);
			
		$db = $mongo->wai;
		return $db;
	}
function check_if_logged() 
	{
		if(session_id() == '' || !isset($_SESSION)) {
			session_start();
			} 
			if(isset($_SESSION['user_id'])) {
				include 'index_logged_user.php';
				exit();
			}
	}
function check_session_status()
	{
		if(session_id() == '' || !isset($_SESSION)) {
			session_start();
		}  
	}
	
function if_no_chosen()
	{
		if(!isset($_POST['if_chosen'])) {
		exit();
		}
	}
?>