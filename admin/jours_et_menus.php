<html>
<head>
<?php
	include "include/libs.php";
?>

<title>Gaifaim - Jours et menus</title>

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
		
		$( "#datepicker" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
		 
		$( "#datepickerMod" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
		
		 // Supprimer le jour et menu
		 $('span.delete').click(function(e){
			e.preventDefault();
			var jour = $(this).attr('id');
			var parent = $(this).parent();
			
			var data = "jour=" + jour;
			$.post('actions/deleteJourEtMenu.php', data);
			setTimeout(location.reload(), 60000);
		 
		});
		
		
		// Modifier le jour et menu
		 $('span.modify').click(function(e){
			e.preventDefault();
			var jour = $(this).attr('id');
			
			var jourVal = document.getElementById("jour"+jour).innerHTML;
			var menuVal = document.getElementById("idMenu"+jour).value;
			
			$("#datepickerMod").datepicker( "setDate", jourVal );
			$("#menuModValue").val(menuVal);
			$('#modifyJourEtMenuModal').modal('show');
		});
	}); // end document.ready

</script>
</head>


<body>
	<div class="container">
		<?php
			include "include/menu.php";
		?>
		
		<table id="tabJoursEtMenus" class="table table-bordered table-striped table-hover">
		   <caption>
			  <h1>Jours et menus</h1>
		   </caption>
		   <thead>
			  <tr>
					<th>Jour</th>
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
					$query = "select jour, menu.id as id, menu.titre as titre, p1.titre as entree, p1.id as entreeId, p2.titre as plat, p2.id as platId, p3.titre as dessert, p3.id as dessertId from jour_has_menu join menu on jour_has_menu.id_menu = menu.id join plat p1 on menu.entree = p1.id join plat p2 on menu.plat = p2.id join plat p3 on menu.dessert = p3.id order by jour;";
					$rows = $pdo->query($query)->fetchAll();
					foreach($rows as $row) {
						echo '<tr>
							<td id="jour'.$row['jour'].'">'.$row['jour'].'</td>
							<td id="titre'.$row['jour'].'">'.$row['titre'].'</td>
							<td id="entree'.$row['jour'].'">'.$row['entree'].'</td>
							<td id="plat'.$row['jour'].'">'.$row['plat'].'</td>
							<td id="dessert'.$row['jour'].'">'.$row['dessert'].'</td>
							<td><span id="'.$row['jour'].'" class="modify glyphicon glyphicon-pencil"></span></td>
							<td><span id="'.$row['jour'].'" class="delete glyphicon glyphicon-trash"></span></td>
							<input type="hidden" id="idMenu'.$row['jour'].'" value="'.$row['id'].'"/>
						  </tr>';
					}
				?>
			</tbody>
		</table>
		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newJourEtMenuModal">Ajouter</button>
	</div>
	
	
	<!-- MODAL CREATEION JOUR ET MENU -->
	<div class="modal fade" id="newJourEtMenuModal" tabindex="-1" role="dialog" aria-labelledby="NewJourEtMenu" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Ajouter les jours et les menus</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="newJourEtMenuForm" class="form-horizontal" action="actions/newJourEtMenu.php" method="post">
						<div class="form-group">
							<label class="col-lg-3 control-label">Jour</label>
							<div class="col-lg-9">
								<input type="text" id="datepicker" class="form-control" name="jourValue" id="jourValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Menu</label>
							<div class="col-lg-9">
								<select class="form-control" name="menuValue" id="menuValue">
									<?php
										$query = "select * from menu;";
										$rows = $pdo->query($query)->fetchAll();
										foreach($rows as $row) {
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
	
	
	<!-- MODAL MODIFICATION COMPTE -->
	<div class="modal fade" id="modifyJourEtMenuModal" tabindex="-1" role="dialog" aria-labelledby="ModifyJourEtMenu" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Modifier jour et menu</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="modifyPlatForm" class="form-horizontal" action="actions/modifyJourEtMenu.php" method="post">
						<input type="hidden" class="form-control" name="idModValue" id="idModValue"/>
						<div class="form-group">
							<label class="col-lg-3 control-label">Jour</label>
							<div class="col-lg-9">
								<input type="text" id="datepickerMod" class="form-control" name="jourModValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-3 control-label">Menu</label>
							<div class="col-lg-9">
								<select class="form-control" name="menuModValue" id="menuModValue">
									<?php
										$query = "select * from menu;";
										$rows = $pdo->query($query)->fetchAll();
										foreach($rows as $row) {
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