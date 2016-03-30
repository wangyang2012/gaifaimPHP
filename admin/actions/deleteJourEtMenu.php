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

$queryDelete = "DELETE FROM jour_has_menu WHERE jour = ?;";
$parameters = array($_POST['jour']);
$statement = $bdd->prepare($queryDelete);
$statement->execute($parameters);
$_SESSION['msgErreur'] = "Le menu est supprimé correctement.";

print_r ($statement);

exit();
?>

