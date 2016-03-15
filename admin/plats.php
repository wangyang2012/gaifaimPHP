<html>
<head>
<?php
	include "../include/libs.php";
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
		 
		 // Supprimer l'utilisateur
		 $('span.delete').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			var parent = $(this).parent();
			
			var data = "id=" + id;
			$.post('actions/deleteUser.php', data);
			setTimeout(location.reload(), 60000);
		 
		});
		
		// Image du plat
		 $('a.image').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			
			var image = document.getElementById("image"+id).innerHTML;
			$("#imagePlatModal").attr("src", "../pictures/"+image);
		});
		
		
		// Modifier utilisateur
		 $('span.modify').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			
			var login = document.getElementById("login"+id).innerHTML;
			var telephone = document.getElementById("telephone"+id).innerHTML;
			var email = document.getElementById("email"+id).innerHTML;
			var adresse = document.getElementById("adresse"+id).innerHTML;
			
			$("#idModValue").val(id);
			$("#loginModValue").val(login);
			$("#telModValue").val(telephone);
			$("#emailModValue").val(email);
			$("#adresseModValue").val(adresse);
			$('#modifyUserModal').modal('show');
		});
		
		 $('#newUserForm').validate(
		 {
		  rules: {
			loginValue: {
			  minlength: 2,
			  required: true
			},
			mdpValue: {
			  minlength: 2,
			  required: true
			},
			mdpConfirmValue: {
				minlength: 2,
				required: true,
				equalTo: "#mdpValue"
			},
			telValue: {
			  required: true
			},
			emailValue: {
			  required: true,
			  email: true
			},
			adresseValue: {
			  required: true
			}
		  }
		 });
		 
		 $('#modifyUserForm').validate(
		 {
		  rules: {
			loginModValue: {
			  minlength: 2,
			  required: true
			},
			mdpModValue: {
			  minlength: 2,
			  required: true
			},
			mdpModConfirmValue: {
				minlength: 2,
				required: true,
				equalTo: "#mdpModValue"
			},
			telModValue: {
			  required: true
			},
			emailModValue: {
			  required: true,
			  email: true
			},
			adresseModValue: {
			  required: true
			}
		  }
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
							<td><a id="'.$row['id'].'" class="image" data-toggle="modal" data-target="#pictureModal">'.$row['image'].'</a></td>
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
					<img id="imagePlatModal" alt="Image indisponible"/>
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
					<form id="newPlatForm" class="form-horizontal" action="actions/newPlat.php" method="post">
						<div class="form-group">
							<label class="col-lg-3 control-label">Login*</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="loginValue" id="loginValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Mot de passe*</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="mdpValue" id="mdpValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Confirmer mot de passe*</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="mdpConfirmValue" id="mdpConfirmValue" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Téléphone*</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="telValue" id="telValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Email*</label>
							<div class="col-lg-9">
								<input type="text" data-validation="email" class="form-control" name="emailValue" id="emailValue" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Adresse*</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="adresseValue" id="adresseValue" />
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
	<div class="modal fade" id="modifyUserModal" tabindex="-1" role="dialog" aria-labelledby="ModifyUser" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Modification du compte</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="modifyUserForm" class="form-horizontal" action="actions/modifyUser.php" method="post">
						<input type="hidden" class="form-control" name="idModValue" id="idModValue"/>
						<div class="form-group">
							<label class="col-lg-3 control-label">Login</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="loginModValue" id="loginModValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Mot de passe*</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="mdpModValue" value="999999" id="mdpModValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Confirmer mot de passe*</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="mdpModConfirmValue" value="999999" id="mdpModConfirmValue" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Téléphone*</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="telModValue" id="telModValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Email*</label>
							<div class="col-lg-9">
								<input type="text" data-validation="email" class="form-control" name="emailModValue" id="emailModValue" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Adresse*</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="adresseModValue" id="adresseModValue" />
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