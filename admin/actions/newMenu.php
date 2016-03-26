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

$req = $bdd->prepare("INSERT INTO menu (titre, entree, plat, dessert) VALUES (:titre, :entree, :plat, :dessert)");
$req->execute(array(
	"titre" => $_POST['titreValue'],
	"entree" => $_POST['entreeValue'],
	"plat" => $_POST['platValue'],
	"dessert" => $_POST['dessertValue']
	));
$_SESSION['msgErreur'] = "Le menu ".$_POST['titreValue']." est ajouté correctement.";
header('Location: ../menus.php');
exit();
?>

