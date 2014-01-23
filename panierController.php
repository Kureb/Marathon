<?php

	include_once 'controller.php';
	include_once 'modele_theme.php';
	include_once 'modele_restaurant.php';
	include_once 'modele_plat.php';
	include_once 'modele_panier.php';

	class panierController extends Controller{ 
	public function __construct(){
		$this->tab = array("addpanier"=>"addPanier","detail"=>"detailAction");
	}

	public function addPanier($t)
	{
		if(isset($_GET['id'])){
			$idplat = $_GET['id'];
			$plat = modele_plat::findById($idplat);
			if(empty($plat)){
				die("Le produit selectionne n'existe pas");
			}
		}
		else{
			die("Erreur");
		}
	}

}
?>