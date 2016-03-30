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
if ($number_of_days <= 0) {
	$_SESSION['msgErreur'] = "Le jour du ".$_POST['jourValue']." n\'a pas encore de menu.";
	header('Location: ../jours_et_menus.php');
	exit();
}


$jourValue = $_POST['jourModValue'];
$menuValue = $_POST['menuModValue'];

$req = $bdd->prepare("UPDATE jour_has_menu SET id_menu=:menu WHERE jour=:jour;");
$req->execute(array(
	"jour" => $jourValue,
	"menu" => $menuValue
	));

$_SESSION['msgErreur'] = "Le jour et le menu sont modifiés correctement.";
header('Location: ../jours_et_menus.php');
exit();
?>

