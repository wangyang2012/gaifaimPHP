<nav class="navbar navbar-inverse">
			<div class="navbar-header">
			  <a class="navbar-brand" href="index.php">GAI FAIM</a>
		    </div>
	        <div class="container-fluid">
	          <ul class="nav navbar-nav">
	            <li class="active"> <a href="index.php">ACCUEIL</a> </li>
	            <li> <a href="menus.php">MENUS</a> </li>
	            <li> <a href="mes_reservations.php">MES RESERVATIONS</a> </li>
	            <li> <a href="#">SAVOIR-FAIRE</a> </li>
				<?php
					if (isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] == 1) {
				?>
						<li class="dropdown"> 
							<a  data-toggle="dropdown" class="dropdown-toggle">ADMIN<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="admin/utilisateurs.php">Utilisateurs</a></li>
								<li><a href="admin/plats.php">Plats</a></li>
								<li><a href="admin/menus.php">Menus</a></li>
								<li><a href="#">Réservations</a></li>
							</ul>
						  </li>
				<?php
					}
				?>
	          </ul>
	          <div class="navbar-form navbar-right inline-form" id="seConnecterField">
				<?php
					if (empty($_SESSION['login']))
						echo '<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#loginModal">Se connecter</button>';
					else
						echo '<div id="bonjour">Bonjour, '. $_SESSION['login'] .'</div>    <a href="actions/deconnexion.php">Deconnexion</a>';
				?>
	          </div>
	        </div>
	      </nav>