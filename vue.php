<?php
	class vue {

		public static function Affichage($page)
		{
			$contenu = "";

			$contenu = $contenu."
			<!DOCTYPE html>
			<html lang=\"fr\">
				<head>
	 				<meta charset=\"utf-8\" />
	 				<title>Dé Jeuner</title>
					<link rel=\"stylesheet\" href=\"bootstrap/css/bootstrap.css\" type=\"text/css\"/>
	 				<link rel=\"stylesheet\" href=\"design.css\" type=\"text/css\" /> 
	 				<script type=\"text/javascript\" src=\"bootstrap/js/bootstrap-select.js\"></script>
	 				
				</head>

				<body>
					<header>
						<div class=\"page-header\">
						  <h1>Dé Jeuner <small>La solution pour vos repas</small></h1>
						  <div class=\"panier\">
							<a role=\"button\" href=\"panier.php?a=panier\" class=\"btn btn-default btn-lg\">
							  <span class=\"glyphicon glyphicon-shopping-cart\"></span> ";
							  if(!empty($_SESSION['panier'])){
							  	$tot=0;
							  	$totPrix=0;
							  	foreach ($_SESSION['panier'] as $key => $value) {
							  		$platDet=modele_plat::findById($key);
							  		$tot=$tot+1*$value;
							  		$totPrix=$totPrix+$platDet->__get('prix')*$value;
							  	}
							  	$contenu=$contenu.$tot." Articles ".$totPrix." €";
							  }
							  else{
							  	$contenu=$contenu.'Panier Vide';
							  }
							$contenu=$contenu."</a>
						</div>
						</div>

						
					</header>

					<nav>
					<ol class=\"breadcrumb\">
					  <li><a href=\"index.php\">Accueil</a></li>
					  ";
					  
					  if(isset($_GET['theme'])){
					  	$theme = $_GET['theme'];
					  	$a = $_GET['a'];
					  	$contenu = $contenu."
							<li><a href=\"theme.php?a=detail&theme=$theme\">$theme</a></li>
					  	";
					  }
					  if(isset($_GET['restaurant'])){
					  	$restaurant = $_GET['restaurant'];
					  	$a = $_GET['a'];
					  	$theme = $_GET['theme'];
					  	$id = $_GET['id'];
					  	$contenu = $contenu."
							<li><a href=\"plat.php?a=$a&theme=$theme&restaurant=$restaurant&id=$id\">$restaurant</a></li>
					  	";
					  }
					  
					  $contenu = $contenu."
					  

					</ol>
					</nav>

					<div>
					$page
					</div>

					<footer>
						Copyright Dé Jeuner - 2014
						<br />
						Lucas GEHIN - Michel NUSSBAUM - Alexandre DAUSSY - Pierre LERICHE
					</footer>
				</body>
			</html>
 			";

 			echo($contenu);
		}

		

	}

?>