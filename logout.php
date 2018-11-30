<?php	 
	require_once 'business.php';
	check_session_status();
	session_destroy();
	header('Location: index.php');
	exit;
?>