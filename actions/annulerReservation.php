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
$query = "DELETE FROM reservation WHERE jour = ?;";
$parameters = array($_POST['jour']);
$statement = $bdd->prepare($query);
$statement->execute($parameters);
$_SESSION['msgErreur'] = "La réservation est annulée correctement.";
header('Location: ../mes_reservations.php');
exit();
?>

