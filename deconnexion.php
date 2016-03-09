<?php
session_start();
if(!empty($_SESSION['login']))
{
	$_SESSION['login']='';	
	unset($_SESSION['id']);
	unset($_SESSION['login']);
	unset($_SESSION['email']);
	unset($_SESSION['telephone']);
	unset($_SESSION['adresse']);
}
session_destroy();
header('Location: index.php');
exit();
?>