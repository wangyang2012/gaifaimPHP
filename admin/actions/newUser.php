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

$req = $bdd->prepare("INSERT INTO utilisateur (role, login, mdp, email, telephone, adresse) VALUES (2, :login, :mdp, :email, :telephone, :adresse)");
$req->execute(array(
	"login" => $_POST['loginValue'],
	"mdp" => $_POST['mdpValue'],
	"email" =>$_POST['emailValue'],
	"telephone" =>$_POST['telValue'],
	"adresse" =>$_POST['adresseValue']
	));
$_SESSION['msgErreur'] = "L\'utilisateur ".$_POST['loginValue']." est ajouté(e) correctement.";
header('Location: ../utilisateurs.php');
exit();
?>

