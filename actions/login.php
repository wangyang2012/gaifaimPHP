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

$query = "SELECT * FROM utilisateur WHERE mdp = ? AND login = ?";
$parameters = array($_POST['mdp'], $_POST['login']);
$statement = $bdd->prepare($query);
$statement->execute($parameters);
$row = $statement->fetch(PDO::FETCH_ASSOC);
$found_rows = $statement->rowCount();

if($found_rows > 0) { // On as trouvé un membre avec ce couple mdp, login
	$_SESSION['id'] = $row['id'];
	$_SESSION['role'] = $row['role'];
	$_SESSION['login'] = $row['login'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['telephone'] = $row['telephone'];
	$_SESSION['adresse'] = $row['adresse'];
	$_SESSION['msgErreur'] = '';
}
else { // Personne n'existe dans la table avec ce couple mdp, login
	$_SESSION['msgErreur'] = 'Le login et le mot de passe rentrés sont invalides';
	unset($_SESSION['id']);
	unset($_SESSION['role']);
	unset($_SESSION['login']);
	unset($_SESSION['email']);
	unset($_SESSION['telephone']);
	unset($_SESSION['adresse']);
}

header('Location: ../index.php');
exit();
?>
