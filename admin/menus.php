<html>
<head>
<?php
	include "include/libs.php";
?>

<title>Gaifaim - Menus</title>

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

</script>
</head>


<body>
	<div class="container">
		<?php
			include "../include/menu.php";
		?>
		
		<table id="tabUtilisateurs" class="table table-bordered table-striped table-hover">
		   <caption>
			  <h1>Menus</h1>
		   </caption>
		   <thead>
			  <tr>
					<th>Titre</th>
					<th>Entrée</th>
					<th>Plat</th>
					<th>Dessert</th>
					<th>Modifier</th>
					<th>Supprimer</th>
			  </tr>
		   </thead>
		   <tbody>
		   
			   <?php
					$query = "select menu.id as id, menu.titre as titre, p1.titre as entree, p2.titre as plat, p3.titre as dessert from menu join plat p1 on menu.entree = p1.id join plat p2 on menu.plat = p2.id join plat p3 on menu.dessert = p3.id order by menu.titre;";
					$rows = $pdo->query($query)->fetchAll();
					foreach($rows as $row) {
						echo '<tr>
							<td id="titre'.$row['id'].'">'.$row['titre'].'</td>
							<td id="entree'.$row['id'].'">'.$row['entree'].'</td>
							<td id="plat'.$row['id'].'">'.$row['plat'].'</td>
							<td id="dessert'.$row['id'].'">'.$row['dessert'].'</td>
							<td><span id="'.$row['id'].'" class="modify glyphicon glyphicon-pencil"></span></td>
							<td><span id="'.$row['id'].'" class="delete glyphicon glyphicon-trash"></span></td>
						  </tr>';
					}
				?>
			</tbody>
		</table>
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newUserModal">Ajouter</button>
	</div>

	<!-- MODAL CREATEION COMPTE -->
	<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="NewUser" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Création du compte</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="newUserForm" class="form-horizontal" action="actions/newUser.php" method="post">
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