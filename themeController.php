<?php
include_once 'controller.php';
include_once 'modele_theme.php';
include_once 'modele_restaurant.php';
class themeController extends Controller{ 
	public function __construct(){
		$this->tab = array("list"=>"listAction","detail"=>"detailAction");
	}

	public function listAction($t){
		$res='<div class="row liste_theme">';
  		foreach (modele_theme::findAll() as $theme) {
        $liste=modele_theme::findAllImage($theme->id);
        $nb = rand(0,sizeof($liste)-1);
  		$res=$res.'
      <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
     	 <img src="images/originales/'.$liste[$nb].'">
      	<div class="caption">
        <h3>'.$theme->__get('nom').'</h3>
        <p>'.$theme->__get('description').'</p>
        <p><a href="theme.php?a=detail&theme='.$theme->__get('nom').'" class="btn btn-primary" role="button">Liste des restaurants</a></p>
     	 </div>
    	</div>
      </div>';
  		}
   		$res=$res.'</div>';
   		vue::affichage($res);
	}

	public function detailAction($t){
		$res='<div class="row">
 		';
 		$theme = $_GET['theme'];
 		$nomTheme = modele_theme::findByNom($theme);
 		$idTheme = $nomTheme->__get('id');
  		foreach (modele_restaurant::findByIdtheme($idTheme) as $resto) {
        $listeResto=modele_restaurant::findAllImage($resto->id);
        $nb = rand(0,sizeof($listeResto)-1);
  		$res=$res.'
      <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
     	 <img src="images/originales/'.$listeResto[$nb].'">
      	<div class="caption">
        <h3>'.$resto->__get('nom').'</h3>
        <p>'.$resto->__get('description').'</p>
        <p><a href="plat.php?a=list&theme='.$theme.'&restaurant='.$resto->__get('nom').'&id='.$resto->__get("id"). '" class="btn btn-primary" role="button">Listes des plats</a> <a href="#" class="btn btn-default" role="button">Contact</a><a href="#" class="btn btn-default" role="button">Plan</a></p>
     	</div>
    	</div>
      </div>';
  		}
   		$res=$res.'</div>';
   		vue::affichage($res);
	}
}

?>