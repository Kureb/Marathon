<?php

	include_once 'controller.php';
	include_once 'modele_theme.php';
	include_once 'modele_restaurant.php';
	include_once 'modele_plat.php';
	include_once 'modele_panier.php';
	session_start();
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
			<table class="table table-striped" style="width:100%;margin=auto;">
			<thead>
				<tr>
					<th>Produit</th>
					<th>Quantité</th>
					<th>Prix Unité</th>
					<th>Prix Total</th>
				</tr>
			</thead>
			<tbody>';
			$totPrix=0;
			foreach ($_SESSION['panier'] as $plat => $quantite) {
				$platDet=modele_plat::findById($plat);
				$totPrix=$totPrix+$platDet->__get('prix')*$quantite;
				$res=$res.'<tr><td>'.$platDet->__get("nom")
				.'</td><td>'.$quantite.'</td><td>'
				.$platDet->__get("prix").'</td><td>'
				.$platDet->__get("prix")*$quantite
				.'</td>';
			}
			$res=$res.'<tr><td><br><strong>Total</strong></br></td><td></td><td></td><td><br><strong>'.$totPrix.' €</strong></br></td></tr></tbody>
			</table>
			<p class="valider"><a href="#" class="btn btn-primary" role="button">Valider la commande</a> <a href="#" class="btn btn-default" role="button">Vider le panier</a></p>
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