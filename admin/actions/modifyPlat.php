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
$descriptionValue = $_POST['descriptionModValue'];
$imageValue = $_FILES['imageModValue']['name'];

print_r($_FILES['imageModValue']);
if (isset($imageValue) && !empty($imageValue)) {
	

	// ajouter nouvelle image
	$path = "../../pictures/{$imageValue}";
	if (file_exists($path)) {
		$_SESSION['msgErreur'] = "Nom d\'image existe déjà, merci de renommer le fichier.";
		header('Location: ../plats.php');
		exit();
	}
	$resultat = move_uploaded_file($_FILES['imageModValue']['tmp_name'],$path);

	// supprimer ancienne image
	$query = "SELECT * FROM plat WHERE id = ".$_POST['idModValue'].";";
	$row = $bdd->query($query)->fetch();
	$filename = $row['image'];
	$path = "../../pictures/{$filename}";
	if (file_exists($path)) {
		unlink($path);
	}
	 
	$req = $bdd->prepare("UPDATE plat SET titre=:titre, description=:description, image=:image WHERE id=:id;");
	$req->execute(array(
		"id" => $idValue,
		"titre" => $titreValue,
		"description" =>$descriptionValue,
		"image" =>$imageValue
		));
} else {
	$req = $bdd->prepare("UPDATE plat SET titre=:titre, description=:description WHERE id=:id;");
	$req->execute(array(
		"id" => $idValue,
		"titre" => $titreValue,
		"description" =>$descriptionValue
		));
		
}

$_SESSION['msgErreur'] = "Le plat ".$titreValue." est modifié correctement.";
header('Location: ../plats.php');
exit();
?>

