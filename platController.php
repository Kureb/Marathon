<?php
include_once 'controller.php';
include_once 'modele_theme.php';
include_once 'modele_restaurant.php';
include_once 'modele_plat.php';
class platController extends Controller{ 
	public function __construct(){
		$this->tab = array("list"=>"listAction","detail"=>"detailAction");
	}

	public function listAction($t){
		$res='<div class="row">
 		<div class="col-sm-6 col-md-4">';
  		foreach (modele_plat::findAll() as $plat) {
  		$res=$res.'<div class="thumbnail">
     	 <img data-src="images/'.$plat->__get('photo').'" alt="'.$plat->__get('photo').'">
      	<div class="caption">
        <h3>'.$plat->__get('nom').'</h3>
        <p>'.$plat->__get('description').'</p>
        <p>'.$plat->__get('prix').'</p>
        <p><a href="#" class="btn btn-primary" role="button">Ajouter au panier</a></p>
     	 </div>
    	</div>';
  		}
   		$res=$res.'</div></div>';
   		vue::affichage($res);
	}

	public function detailAction($t){
		$res='<div class="row">
 		<div class="col-sm-6 col-md-4">';
 		$theme = $_GET['theme'];
 		$nomTheme = modele_theme::findByNom($theme);
 		$idTheme = $nomTheme->__get('id');
  		foreach (modele_restaurant::findByIdtheme($idTheme) as $resto) {
  		$res=$res.'<div class="thumbnail">
     	 <img data-src="images/'.$resto->__get('photo').'" alt="'.$resto->__get('photo').'">
      	<div class="caption">
        <h3>'.$resto->__get('nom').'</h3>
        <p>'.$resto->__get('description').'</p>
        <p><a href="restaurant.php?theme='.$theme.'&restaurant='.$resto->__get('nom').'" class="btn btn-primary" role="button">Listes des plats</a> <a href="#" class="btn btn-default" role="button">Contact</a><a href="#" class="btn btn-default" role="button">Plan</a></p>
     	</div>
    	</div>';
  		}
   		$res=$res.'</div></div>';
   		vue::affichage($res);
	}
}
?>