<html>
<head>
<?php
	include "include/libs.php";
?>

<title>Gaifaim - Mes réservations</title>

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
		 
		 // annuler réservation
		 $('span.delete').click(function(e){
			e.preventDefault();
			var jour = $(this).attr('id');
			var parent = $(this).parent();
			
			var data = "jour=" + jour;
			$.post('actions/annulerReservation.php', data);
			setTimeout(location.reload(), 60000);
		 
		});
		 
		}); // end document.ready

</script>
</head>


<body>
	<div class="container">
		<?php
			include "include/menu.php";
		?>
		
		<table id="tabUtilisateurs" class="table table-bordered table-striped table-hover">
		   <caption>
			  <h1>Mes réservations</h1>
		   </caption>
		   <thead>
			  <tr>
					<th>Jour</th>
					<th>Menu</th>
					<th>Entrée</th>
					<th>Plat</th>
					<th>Dessert</th>
					<th>Annuler</th>
			  </tr>
		   </thead>
		   <tbody>
		   
			   <?php
					$query = "SELECT jour, menu.titre as menu, p1.titre as entree, p2.titre as plat, p3.titre as dessert FROM reservation join menu on reservation.id_menu = menu.id join plat p1 on menu.entree = p1.id join plat p2 on menu.plat = p2.id join plat p3 on menu.dessert = p3.id ORDER BY login";
					$rows = $pdo->query($query)->fetchAll();
					foreach($rows as $row) {
						echo '<tr>
							<td>'.$row['jour'].'</td>
							<td>'.$row['menu'].'</td>
							<td>'.$row['entree'].'</td>
							<td>'.$row['plat'].'</td>
							<td>'.$row['dessert'].'</td>
							<td><span id="'.$row['jour'].'" class="delete glyphicon glyphicon-trash"></span></td>
						  </tr>';
					}
				?>
			</tbody>
		</table>
	</div>

</body>
</html>