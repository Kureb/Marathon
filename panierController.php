<?php

	include_once 'controller.php';
	include_once 'modele_theme.php';
	include_once 'modele_restaurant.php';
	include_once 'modele_plat.php';
	include_once 'modele_panier.php';

	class panierController extends Controller{ 
	public function __construct(){
		$this->tab = array("addpanier"=>"addPanier","panier"=>"panier");
	}

	public function addPanier($t)
	{
		if(isset($_GET['id'])){
			$idplat = $_GET['id'];
			$plat = modele_plat::findById($idplat);
			if(empty($plat)){
				die("Le produit selectionne n'existe pas");
			}
			modele_panier::add($idplat);
			header('Location: panier.php?a=panier'); 
		}
		else{
			die("Erreur");
		}
	}

	public function panier($t)
	{

		$res = '';
		
		if(!empty($_SESSION)){
			$res = $res.'
			<table class="table table-striped" style="width:90%;margin=auto;">
			<thead>
				<tr>
					<th>Produit</th>
					<th>Quantité</th>
					<th>Prix Unité</th>
					<th>Prix Total</td>
				</tr>
			</thead>
			<tbody>

			</tbody>
			</table>
			';
		}
		else{
			$res = $res.'
			<div class="alert alert-info" style="width:80%;margin:auto;text-align:center;">Panier vide</div>
			';
		}
		vue::affichage($res);
	}

}
?>