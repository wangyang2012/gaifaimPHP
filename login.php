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

$query = "SELECT COUNT(*) AS membre_valide FROM utilisateur WHERE mdp = ? AND login = ?";
$parameters = array($_POST['mdp'], $_POST['login']);
$statement = $bdd->prepare($query);
$statement->execute($parameters);
$row = $statement->fetch(PDO::FETCH_ASSOC);
$found_rows = $row['membre_valide'];

if($found_rows > 0) { // On as trouvé un membre avec ce couple mdp, login
    $_SESSION['login'] = $_POST['login'];
	$_SESSION['msgErreur'] = '';
}
else { // Personne n'existe dans la table avec ce couple mdp, login
	$_SESSION['msgErreur'] = 'Le login et le mot de passe rentrés sont invalides';
	if (isset($_SESSION['login']))
		unset($_SESSION['login']);
}

header('Location: index.php');
exit();
?>
