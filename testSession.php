<?php
	session_start();
	
	$_SESSION['test'] = 'aaa';
header('Location: testSession2.php');
exit();
?>