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
$query = "DELETE FROM menu WHERE id = ?;";
$parameters = array($_POST['id']);
$statement = $bdd->prepare($query);
$statement->execute($parameters);
$_SESSION['msgErreur'] = "Le menu est supprimé correctement.";
header('Location: ../menus.php');
exit();
?>

