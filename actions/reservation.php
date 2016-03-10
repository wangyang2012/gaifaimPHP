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

$req = $bdd->prepare("INSERT INTO reservation (date, id_menu, quantite, login, telephone, email, note) VALUES (now(), :id_menu, :quantite, :login, :telephone, :email, :note)");
$req->execute(array(
	"id_menu" => 1,
	"quantite" =>$_POST['quantiteValue'],
	"login" =>$_SESSION['login'],
	"telephone" =>$_POST['telValue'],
	"email" =>$_POST['emailValue'],
	"note" => $_POST['noteValue']
	));
$_SESSION['msgErreur'] = "Votre réservation est bien enregistrée!";

header('Location: ../index.php');
exit();
?>