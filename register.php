<?php
	
	$reg_password =		$_POST['user_password'];
	$reg_password_2 =	$_POST['user_password_repeat'];
	$reg_name =			$_POST['user_name'];
	$reg_mail =			$_POST['user_email'];
	
	require_once 'business.php';
	$correct_reg = 1;
	if($reg_password !== $reg_password_2) {
		ob_start();
		echo "Hasła się nie zgadzają! Przekierowywanie...";
		header( "refresh:5; url=index.php"); 
		ob_flush();
		$correct_reg = 0;
	}
	if(empty($reg_password) || empty($reg_password_2) || empty($reg_mail) || empty($reg_name) ) {
		ob_start();
		echo "Pozostawiono puste pola! Przekierowywanie...";
		header( "refresh:5; url=index.php"); 
		ob_flush();
		$correct_reg = 0;
	}
	$db = get_db();
	$collection = $db->users;
	
	$safe_password = password_hash($reg_password, PASSWORD_DEFAULT);
	$user = [
		'login' => $reg_name,
		'haslo' => $safe_password,
		'email' => $reg_mail,
	];
   	$query = array('login' => $reg_name);
		$users= $db->users->find($query);
		foreach ($users as $user) {
			if ($user != null)  {		
				if ($user['login'] = $reg_name) {
					ob_start();
					echo "Login zajęty! Przekierowywanie...";
					header( "refresh:5; url=index.php");
					ob_flush();
					$correct_reg = 0;
				}
			}
		}
	if($correct_reg === 1) {
		$db->users->insert($user);
		ob_start();
		echo "Rejestracja zakończona powodzeniem. Przekierowywanie...";
		header( "refresh:5; url=index.php"); 
		ob_flush();
	}
?>