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
$titreValue = $_POST['titreModValue'];
$entreeValue = $_POST['entreeModValue'];
$platValue = $_POST['platModValue'];
$dessertValue = $_POST['dessertModValue'];
$req = $bdd->prepare("UPDATE menu SET titre=:titre, entree=:entree, plat=:plat, dessert=:dessert WHERE id=:id;");
$req->execute(array(
	"id" => $idValue,
	"titre" => $titreValue,
	"entree" =>$entreeValue,
	"plat" =>$platValue,
	"dessert" =>$dessertValue
	));

$_SESSION['msgErreur'] = "Le menu ".$titreModValue." est modifié(e) correctement.";
header('Location: ../menus.php');
exit();
?>

