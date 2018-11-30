<?php
	require_once 'business.php';
	$log_password = 	$_POST['log_on_password'];
	$log_name = 		$_POST['log_on_name'];
	$db = get_db();
	$collection = $db->users;
	$query = array('login' => $log_name);
	$users= $db->users->find($query);
	foreach ($users as $user) {
		if ($user != null)  {		
			if (password_verify($log_password, $user['haslo'])) {
				session_start();
				$_SESSION['user_id'] = $log_name;
				include 'index.php';
				exit;
			}
		}
	}
	ob_start();
	echo 'Błędny login lub hasło. Przekierowywanie...';
	header( "refresh:5; url=index.php" ); 
	ob_flush();
?>