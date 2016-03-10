<html>
<head>
<?php
	include "include/libs.php";
?>

<title>Gaifaim - Accueil</title>

<script>
	<?php
		session_start();
		if (isset($_SESSION['msgErreur']) && !empty($_SESSION['msgErreur'])) {
			echo "alert('".$_SESSION['msgErreur']."');";
			$_SESSION['msgErreur'] = '';
		}
	?>

	function reserver() {
		<?php
			if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
				echo 'var loginUtilisateur = "'.$_SESSION['login'].'";';
				echo 'var telUtilisateur = "'.$_SESSION['telephone'].'";';
				echo 'var emailUtilisateur = "'.$_SESSION['email'].'";';
				echo 'var adresseUtilisateur = "'.$_SESSION['adresse'].'";';
				
		?>
			$("#loginValue").val(loginUtilisateur);
			$("#telValue").val(telUtilisateur);
			$("#emailValue").val(emailUtilisateur);
			$("#adresseValue").val(adresseUtilisateur);
			$('#reservationModal').modal('show');
		<?php
			} else {
				echo "alert('Veuillez vous connecter!');";
			}
		?>
	}
	
	function inscription() {
		$('#loginModal').modal('toggle');
		$('#newUserModal').modal('show');
	}
	
	function mdpOublier() {
		alert("Fonction à développer ultérieurement!");
		<?php
		// $to = "yang.1@tcs.com";
		// $subject = "Hi!";
		// $body = "Hi,\n\nHow are you?";
		// $headers = "From: myemail06@gmail.com";
		// if (mail($to, $subject, $body, $headers)) {
			// echo 'alert("Message successfully sent!");';
		// } else {
			// echo 'alert("Message delivery failed");';
		// }
		?>
	}
		
	
	 $(document).ready(function(){

		 $('#reserveationForm').validate(
		 {
		  rules: {
			loginValue: {
			  minlength: 2,
			  required: true
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
			},
			quantiteValue: {
			  required: true,
			  number: true
			}
		  }
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
		 
		}); // end document.ready

</script>
</head>


<body>
	<div class="container">
		<?php
			include "include/menu.php";
		?>
	
		<header class="row">
			<div class="col-lg-3">
				<img src="img/gaifaim.png" alt="Gaifaim" />
			</div>
			<div class="col-lg-5">
				<div id="menu-midi" class="titre1">MENU MIDI DELICIEUX</div>
				<br />

				<img src="img/cover.jpg"/>
				<br />
				<div id="livraison-gratuite" class="titre1">LIVRAISON GRATUITE</div><br/>
				<div>
				 Vous êtes lassé des fast-food habituels? Vous ne trouvez plus votre bonheur dans les restaurants près de votre lieu de travail/domicile ? 

    Commandez votre plat préféré chez GaiFaim et faites vous livrer un repas chaud 100% fait maison !
				</div>
			</div>
			<div class="col-lg-4">
				ENTREE<br/>
				 + <br/>
				 PLAT<br/>
				  + <br/>
				  DESSERT<br/>
				   = <br/>
				   10 €<br/>
				   ...................<br/>
				   ★ Un menu unique(le midi) par jour suggéré par le chef.<br/>
				   ★ Livraison uniquement à Boulogne-Billancourt<br/>

				<h1>
					<a  onClick="reserver()">RESERVER</a>
				</h1>
				
			</div>
		</header>

		<div class="row">
			<section class="col-lg-8">
				
			</section>

			<section class="col-lg-4">
			</section>
		</div>

		<footer class="row">
			<div class="col-lg-8">
				Tél: 06 95 39 00 07<br/> <a href="mailto:resa@gaifaim.com">resa@gaifaim.com</a>
			</div>
			<div class="col-lg-4"></div>
		</footer>
	</div>

	<!-- MODAL LOGIN -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Login</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="loginForm" method="post" class="form-horizontal" action="actions/login.php">
						<div class="form-group">
							<label class="col-xs-3 control-label">Login</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="login" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Mot de passe</label>
							<div class="col-xs-9">
								<input type="password" class="form-control" name="mdp" />
							</div>
						</div>

						<div class="form-group">
								
							<div class="col-xs-offset-7">
								<a href="javascript:inscription()">Inscription</a>
								 ou 
								<a href="javascript:mdpOublier()">Mot de passe oublié</a>
							</div>
						</div>
						
						<div class="form-group">
							<div class=" pull-right">
								<button type="submit" class="btn btn-primary">Se connecter</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL RESERVATION -->
	<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="Reservation" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Réservation</h5>
				</div>

				<div class="modal-body">
					<!-- The form is placed inside the body of modal -->
					<form id="reserveationForm" class="form-horizontal" action="actions/reservation.php" method="post">
						<div class="form-group">
							<label class="col-xs-2 control-label">Login</label>
							<div class="col-xs-10">
								<input type="text" class="form-control" name="loginValue" id="loginValue" disabled />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-2 control-label">Téléphone*</label>
							<div class="col-xs-10">
								<input type="text" class="form-control" name="telValue" id="telValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-xs-2 control-label">Email*</label>
							<div class="col-xs-10">
								<input type="text" data-validation="email" class="form-control" name="emailValue" id="emailValue" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-2 control-label">Adresse*</label>
							<div class="col-xs-10">
								<input type="text" class="form-control" name="adresseValue" id="adresseValue" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-xs-2 control-label">Quantité*</label>
							<div class="col-xs-10">
								<input type="text" data-validation="number" class="form-control" name="quantiteValue" value="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-2 control-label">Notes</label>
							<div class="col-xs-10">
							    <textarea class="form-control" rows="3" name="noteValue"></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-9 col-xs-offset-3">
								<button type="submit" class="btn btn-primary" name="valid" value="Valider">Valider</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
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

</body>
</html>