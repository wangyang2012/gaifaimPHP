<?php
session_start();
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=gaifaim', 'root', '');
}
catch (Exception $e) // Si erreur
{
	$_SESSION['msgErreur'] = 'Une erreur est survenue, veuillez ré-essayer ultérieurement.';
    die('Erreur : ' . $e->getMessage());
}

$idValue = $_POST['idModValue'];
$loginValue = $_POST['loginModValue'];
$mdpValue = $_POST['mdpModValue'];
$telValue = $_POST['telModValue'];
$adresseValue = $_POST['adresseModValue'];
$emailValue = $_POST['emailModValue'];
if ($mdpValue == "999999") {
	$req = $bdd->prepare("UPDATE utilisateur SET login=:login, email=:email, telephone=:telephone, adresse=:adresse WHERE id=:id;");
	$req->execute(array(
		"id" => $idValue,
		"login" => $loginValue,
		"email" =>$emailValue,
		"telephone" =>$telValue,
		"adresse" =>$adresseValue
		));
		
} else {
	$req = $bdd->prepare("UPDATE utilisateur SET login=:login, mdp=:mdp, email=:email, telephone=:telephone, adresse=:adresse WHERE id=:id;");
	
	$req->execute(array(
		"id" => $idValue,
		"login" => $loginValue,
		"mdp" => $mdpValue,
		"email" =>$emailValue,
		"telephone" =>$telValue,
		"adresse" =>$adresseValue
		));
}

$_SESSION['msgErreur'] = "L\'utilisateur ".$loginValue." est modifié(e) correctement.";
header('Location: ../utilisateurs.php');
exit();
?>

