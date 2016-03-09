<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link href="jquery/jquery-ui.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="css/gaifaim.css" rel="stylesheet">

<script src="jquery/jquery-1.10.2.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<title>Gaifaim - Accueil</title>

<script>
	
		
	// dialogue reserver
	$(document).ready(function() {
		<?php
			session_start();
			if (isset($_SESSION['msgErreur']) && !empty($_SESSION['msgErreur'])) {
				echo "alert('".$_SESSION['msgErreur']."');";
			}
		?>
		// $('#loginForm').formValidation({
			// framework: 'bootstrap',
			// excluded: ':disabled',
			// icon: {
				// valid: 'glyphicon glyphicon-ok',
				// invalid: 'glyphicon glyphicon-remove',
				// validating: 'glyphicon glyphicon-refresh'
			// },
			// fields: {
				// username: {
					// validators: {
						// notEmpty: {
							// message: 'The username is required'
						// }
					// }
				// },
				// password: {
					// validators: {
						// notEmpty: {
							// message: 'The password is required'
						// }
					// }
				// }
			// }
		// });
	
	
		// $("#dialog-login").hide("slow");
		$("#dialog-reserver").hide("slow");
		   
		  // $('#formReserver').submit(function(event) {
			   
			  // var nom = $('#nom').val();
			  // var prenom = $('#prenom').val();
			  // var telephone = $('#telephone').val();
			  // var adresse = $('#adresse').val();
			  // var note = $('#note').val();
			  // var quantite = $('#quantite').val();
			  // var json = { "nom" : nom, "prenom" : prenom, "telephone" : telephone, "adresse" : adresse, "note" : note, "quantite" : quantite};
			   
			// $.ajax({
				// url: $("#formReserver").attr( "action"),
				// data: JSON.stringify(json),
				// type: "POST",
				 
				// beforeSend: function(xhr) {
					// xhr.setRequestHeader("Accept", "application/json");
					// xhr.setRequestHeader("Content-Type", "application/json");
				// },
				// success: function(response) {
					 
					// var respContent = "";
					// if (response != null && response.codeRetour == 1) {
						// hideFormReserver();
					// } else {
						// respContent = "<span class='error'>Une erreur est survenue!</span>";
						// $("#loginFormResponse").html(respContent);
					// }
				// }
			// });
			  
			// event.preventDefault();
		  // });
			
		});
		
		function reserver() {
			<?php
				if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
					echo 'var loginUtilisateur = '.$_SESSION['login'].';';
					echo 'var emailUtilisateur = '.$_SESSION['email'].';';
					echo 'var telUtilisateur = '.$_SESSION['telephone'].';';
					echo 'var adresseUtilisateur = '.$_SESSION['adresse'].';';
					echo 'var idUtilisateur = '.$_SESSION['id'].';';
					
					echo 'alert(loginUtilisateur+" "+emailUtilisateur + " " + telUtilisateur + " " + adresseUtilisateur + " " + idUtilisateur);';
				} else {
					echo 'alert("Veuillez vous connecter!");';
				}
			?>
			
			
		}

</script>

</head>


<body>
	<div class="container">
	
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
			  <a class="navbar-brand" href="#">GAI FAIM</a>
		    </div>
	        <div class="container-fluid">
	          <ul class="nav navbar-nav">
	            <li class="active"> <a href="#">ACCUEIL</a> </li>
	            <li> <a href="${contextPath}/menu">MENUS</a> </li>
	            <li> <a href="#">MES RESERVATIONS</a> </li>
	            <li> <a href="#">SAVOIR-FAIRE</a> </li>
         
	            <li class="dropdown"> 
					<a  data-toggle="dropdown" class="dropdown-toggle">ADMIN<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Comptes</a></li>
					  	<li><a href="#">Menus</a></li>
					  	<li><a href="#">Réservations</a></li>
					</ul>
				  </li>
	          </ul>
	          <div class="navbar-form navbar-right inline-form" id="seConnecterField">
				<?php
					if (empty($_SESSION['login']))
						echo '<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#loginModal">Login</button>';
					else
						echo '<div id="bonjour">Bonjour, '. $_SESSION['login'] .'</div>    <a href="deconnexion.php">Deconnexion</a>';
				?>
	          </div>
	        </div>
	      </nav>
	
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

		<div class="row"*>
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
					<form id="loginForm" method="post" class="form-horizontal" action="login.php">
						<div class="form-group">
							<label class="col-xs-3 control-label">Login</label>
							<div class="col-xs-5">
								<input type="text" class="form-control" name="login" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Mot de passe</label>
							<div class="col-xs-5">
								<input type="password" class="form-control" name="mdp" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-5 col-xs-offset-3">
								<button type="submit" class="btn btn-primary">Login</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- 	RESERVATION -->
	<form id="reserveationForm" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label">Login</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="loginValue" disabled />
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Téléphone</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="telValue" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-xs-3 control-label">Email</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="emailValue" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Adresse</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="adresseValue" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-xs-3 control-label">Quantité</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" name="quantiteValue" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Note</label>
			<div class="col-xs-5">
				<input type="textarea" class="form-control" name="noteValue" />
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-9 col-xs-offset-3">
				<button type="submit" class="btn btn-primary" name="valid" value="Valider">Valider</button>
			</div>
		</div>
	</form>


	<div id="dialog-reserver" title="Réservation">
		<form id="formReserver" class="form-horizontal col-lg-11"
			action="/gaifaim/reserver">
			<div class="row">
				<div id="reserverFormResponse"></div>
			</div>
			<!-- login -->
			<div class="row">
				<div class="form-group">
					<label for="login" class="col-lg-4 control-label">Login : </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="login">
					</div>
				</div>
			</div>
			<!-- téléphone -->
			<div class="row">
				<div class="form-group">
					<label for="telephone" class="col-lg-4 control-label">Téléphone : </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="telephone">
					</div>
				</div>
			</div>
			<!-- e-mail -->
			<div class="row">
				<div class="form-group">
					<label for="email" class="col-lg-4 control-label">E-mail :
					</label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="email" >
					</div>
				</div>
			</div>
			<!-- adresse -->
			<div class="row">
				<div class="form-group">
					<label for="adresse" class="col-lg-4 control-label">Adresse : </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="adresse" >
					</div>
				</div>
			</div>
			<!-- quantite -->
			<div class="row">
				<div class="form-group">
					<label for="quantite" class="col-lg-4 control-label">Quantité : </label>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="quantite" value="1">
					</div>
				</div>
			</div>

			<!-- note -->
			<div class="row">
				<div class="form-group">
					<label for="note" class="col-lg-4 control-label">Note : </label>
					<div class="col-lg-8">
						<input type="textarea" class="form-control" id="note">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<button class="pull-right btn btn-default">Confirmer</button>
					<button class="pull-right btn btn-default"
						onClick="fermerFormReserver()">Annuler</button>
				</div>
			</div>
		</form>
	</div>
	
</body>
</html>