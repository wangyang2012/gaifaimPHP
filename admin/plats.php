<html>
<head>
<?php
	include "include/libs.php";
?>

<title>Gaifaim - Plats</title>

<script>
	<?php
		session_start();
		if (isset($_SESSION['msgErreur']) && !empty($_SESSION['msgErreur'])) {
			echo "alert('".$_SESSION['msgErreur']."');";
			$_SESSION['msgErreur'] = '';
		}
		
		try
		{
			$pdo = new PDO('mysql:host=localhost;dbname=gaifaim', 'root', '');
		}
		catch (Exception $e) // Si erreur
		{
			$_SESSION['msgErreur'] = 'Une erreur est survenue, veuillez ré-essayer ultérieurement.';
			die('Erreur : ' . $e->getMessage());
		}

	?>

	
	$(document).ready(function(){
		 
		 // Supprimer le plat
		 $('span.delete').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			var parent = $(this).parent();
			
			var data = "id=" + id;
			$.post('actions/deletePlat.php', data);
			setTimeout(location.reload(), 60000);
		 
		});
		
		// Image du plat
		 $('a.image').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			var image = document.getElementById(id).innerHTML;
			$("#imagePlatModal").attr("src", "../pictures/"+image);
		});
		
		
		// Modifier le plat
		 $('span.modify').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			
			var titre = document.getElementById("titre"+id).innerHTML;
			var description = document.getElementById("description"+id).innerHTML;
			var image = document.getElementById("image"+id).innerHTML;
			
			$("#idModValue").val(id);
			$("#titreModValue").val(titre);
			$("#descriptionModValue").val(description);
			$("#imageModValue").val("");
			// document.getElementById("uploadCaptureInputFile").value = "";
			$('#modifyPlatModal').modal('show');
		});
	}); // end document.ready

</script>
</head>


<body>
	<div class="container">
		<?php
			include "../include/menu.php";
		?>
		
		<table id="tabPlats" class="table table-bordered table-striped table-hover">
		   <caption>
			  <h1>Plats</h1>
		   </caption>
		   <thead>
			  <tr>
					<th>Titre</th>
					<th>Description</th>
					<th>Image</th>
					<th>Modifier</th>
					<th>Supprimer</th>
			  </tr>
		   </thead>
		   <tbody>
		   
			   <?php
					$query = "SELECT * FROM plat ORDER BY titre";
					$rows = $pdo->query($query)->fetchAll();
					foreach($rows as $row) {
						echo '<tr>
							<td id="titre'.$row['id'].'">'.$row['titre'].'</td>
							<td id="description'.$row['id'].'">'.$row['description'].'</td>
							<td><a id="image'.$row['id'].'" class="image" data-toggle="modal" data-target="#pictureModal">'.$row['image'].'</a></td>
							<td><span id="'.$row['id'].'" class="modify glyphicon glyphicon-pencil"></span></td>
							<td><span id="'.$row['id'].'" class="delete glyphicon glyphicon-trash"></span></td>
						  </tr>';
					}
				?>
			</tbody>
		</table>
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newPlatModal">Ajouter</button>
	</div>
	
	
	<!-- MODAL PICTURE -->
	<div class="modal fade" id="pictureModal" tabindex="-1" role="dialog" aria-labelledby="Picture" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Image du plat</h5>
				</div>

				<div class="modal-body">
					<img id="imagePlatModal" alt="Image indisponible" max-width:100%; max-height:100%;/>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL CREATEION PLAT -->
	<div class="modal fade" id="newPlatModal" tabindex="-1" role="dialog" aria-labelledby="NewPlat" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Création du plat</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="newPlatForm" class="form-horizontal" action="actions/newPlat.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-lg-3 control-label">Titre</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="titreValue" id="titreValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Description</label>
							<div class="col-lg-9">
								<input type="textarea" class="form-control" name="descriptionValue" id="descriptionValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Image</label>
							<div class="col-lg-9">
								<input type="file" class="form-control" name="imageValue" id="imageValue" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<button type="submit" class="btn btn-primary" name="valid" value="Valider">Valider</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- MODAL MODIFICATION COMPTE -->
	<div class="modal fade" id="modifyPlatModal" tabindex="-1" role="dialog" aria-labelledby="ModifyPlat" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Modification du plat</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="modifyPlatForm" class="form-horizontal" action="actions/modifyPlat.php" method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="idModValue" id="idModValue"/>
						<div class="form-group">
							<label class="col-lg-3 control-label">Titre</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="titreModValue" id="titreModValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Description</label>
							<div class="col-lg-9">
								<input type="textarea" class="form-control" name="descriptionModValue" id="descriptionModValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Image</label>
							<div class="col-lg-9">
								<input type="file" class="form-control" name="imageModValue" id="imageModValue" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<button type="submit" class="btn btn-primary" name="valid" value="Valider">Valider</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>