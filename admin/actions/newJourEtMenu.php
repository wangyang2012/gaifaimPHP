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


$queryJour = "select * from jour_has_menu where jour='".$_POST['jourValue']."';";
$result = $bdd->prepare($queryJour); 
$result->execute(); 
$number_of_days = $result->fetchColumn(); 
if ($number_of_days > 0) {
	$_SESSION['msgErreur'] = "Un menu est déjà affecté au ".$_POST['jourValue'].".";
	header('Location: ../jours_et_menus.php');
	exit();
}

$req = $bdd->prepare("INSERT INTO jour_has_menu (jour, id_menu) VALUES (:jour, :idMenu)");
$req->execute(array(
	"jour" => $_POST['jourValue'],
	"idMenu" => $_POST['menuValue']
	));
$_SESSION['msgErreur'] = "Le menu est ajouté correctement.";
header('Location: ../jours_et_menus.php');
exit();
?>

