<?php
include_once 'controller.php';
include_once 'modele_theme.php';
include_once 'modele_restaurant.php';
include_once 'modele_plat.php';
class platController extends Controller{ 
	public function __construct(){
		$this->tab = array("list"=>"listAction");
	}

	public function listAction($t){
		$res='<div class="row">
 		<div class="col-sm-6 col-md-4">';
  		foreach (modele_plat::findByIdResto($_GET['id']) as $plat) {
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
}
?>