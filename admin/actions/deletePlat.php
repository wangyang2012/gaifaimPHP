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

$query = "SELECT * FROM plat WHERE id = ".$_POST['id'].";";
$row = $bdd->query($query)->fetch();
$filename = $row['image'];
$path = "../../pictures/{$filename}";
if (file_exists($path)) {
	unlink($path);
} 

$queryDelete = "DELETE FROM plat WHERE id = ?;";
$parameters = array($_POST['id']);
$statement = $bdd->prepare($queryDelete);
$statement->execute($parameters);
$_SESSION['msgErreur'] = "Le plat est supprimé correctement.";
print_r($queryDelete);
// header('Location: ../plats.php');
exit();
?>

