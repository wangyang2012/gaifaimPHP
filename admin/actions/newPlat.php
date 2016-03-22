<?php
session_start();

$filename = $_FILES['imageValue']['name'];
$path = "../../pictures/{$filename}";
if (file_exists($path)) {
	$_SESSION['msgErreur'] = "Nom d\'image existe déjà, merci de renommer le fichier.";
	header('Location: ../plats.php');
	exit();
} 
$resultat = move_uploaded_file($_FILES['imageValue']['tmp_name'],$path);

if (!$resultat) {
	$_SESSION['msgErreur'] = "Echec du téléchargement de fichier.";
	header('Location: ../plats.php');
	exit();
}

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=gaifaim', 'root', '');
}
catch (Exception $e) // Si erreur
{
	$_SESSION['msgErreur'] = 'Une erreur est survenue, veuillez ré-essayer ultérieurement.';
    die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare("INSERT INTO plat (titre, description, image) VALUES (:titre, :description, :image)");
$req->execute(array(
	"titre" => $_POST['titreValue'],
	"description" => $_POST['descriptionValue'],
	"image" =>$filename
	));
$_SESSION['msgErreur'] = "Le plat ".$_POST['titreValue']." est ajouté correctement.";
header('Location: ../plats.php');
exit();
?>

