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
		 
		 // Supprimer le menu
		 $('span.delete').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			var parent = $(this).parent();
			
			var data = "id=" + id;
			$.post('actions/deleteMenu.php', data);
			setTimeout(location.reload(), 60000);
		 
		});
		
		// Modifier menu
		 $('span.modify').click(function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			
			var titre = document.getElementById("titre"+id).innerHTML;
			var entree = document.getElementById("entree"+id).innerHTML;
			var plat = document.getElementById("plat"+id).innerHTML;
			var dessert = document.getElementById("dessert"+id).innerHTML;

			$("#titreModValue").val(titre);
			$("#entreeModValue").val(entree);
			$("#platModValue").val(plat);
			$("#dessertModValue").val(dessert);
			$('#modifyMenuModal').modal('show');
		});
	}); // end document.ready
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
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newMenuModal">Ajouter</button>
	</div>

	<!-- MODAL CREATEION MENU -->
	<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="NewMenu" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Création du menu</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="newMenuForm" class="form-horizontal" action="actions/newMenu.php" method="post">
						<div class="form-group">
							<label class="col-lg-3 control-label">Titre</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="titreValue" id="titreValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Entrée</label>
							<div class="col-lg-9">
								<select class="form-control" name="entreeValue" id="entreeValue">
									<?php
										$queryEntree = "select * from plat;";
										$rowsEntree = $pdo->query($queryEntree)->fetchAll();
										foreach($rowsEntree as $row) {
											echo '<option value="'.$row['id'].'">'.$row['titre'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Plat</label>
							<div class="col-lg-9">
								<select class="form-control" name="platValue" id="platValue">
									<?php
										$queryPlat = "select * from plat;";
										$rowsPlat = $pdo->query($queryPlat)->fetchAll();
										foreach($rowsEntree as $row) {
											echo '<option value="'.$row['id'].'">'.$row['titre'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Dessert</label>
							<div class="col-lg-9">
								<select class="form-control" name="dessertValue" id="dessertValue">
									<?php
										$queryDessert = "select * from plat;";
										$rowsDessert = $pdo->query($queryDessert)->fetchAll();
										foreach($rowsDessert as $row) {
											echo '<option value="'.$row['id'].'">'.$row['titre'].'</option>';
										}
									?>
								</select>
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
	
	
	<!-- MODAL MODIFICATION MENU -->
	<div class="modal fade" id="modifyMenuModal" tabindex="-1" role="dialog" aria-labelledby="ModifyMenu" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Modification du menu</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="modifyMenuForm" class="form-horizontal" action="actions/modifyMenu.php" method="post">
						<input type="hidden" class="form-control" name="idModValue" id="idModValue"/>
						<div class="form-group">
							<label class="col-lg-3 control-label">Titre</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="titreModValue" id="titreModValue" />
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Entrée</label>
							<div class="col-lg-9">
								<select class="form-control" name="entreeModValue" id="entreeModValue">
									<?php
										$queryEntree = "select * from plat;";
										$rowsEntree = $pdo->query($queryEntree)->fetchAll();
										foreach($rowsEntree as $row) {
											echo '<option value="'.$row['id'].'">'.$row['titre'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Plat</label>
							<div class="col-lg-9">
								<select class="form-control" name="platModValue" id="platModValue">
									<?php
										$queryPlat = "select * from plat;";
										$rowsPlat = $pdo->query($queryPlat)->fetchAll();
										foreach($rowsEntree as $row) {
											echo '<option value="'.$row['id'].'">'.$row['titre'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Dessert</label>
							<div class="col-lg-9">
								<select class="form-control" name="dessertModValue" id="dessertModValue">
									<?php
										$queryDessert = "select * from plat;";
										$rowsDessert = $pdo->query($queryDessert)->fetchAll();
										foreach($rowsDessert as $row) {
											echo '<option value="'.$row['id'].'">'.$row['titre'].'</option>';
										}
									?>
								</select>
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