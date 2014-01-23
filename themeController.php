<?php
include_once 'controller.php';
include_once 'modele_theme.php';
class themeController extends Controller{ 
	public function __construct(){
		$this->tab = array("list"=>"listAction","detail"=>"detailAction","default"=>"defaultAction");
	}

	public function listAction($t){
		$res='<div class="row">
 		<div class="col-sm-6 col-md-4">';
  		foreach (modele_theme::findByNom() as $theme) {
  		$res=$res.'<div class="thumbnail">
     	 <img data-src="images/'.$theme->__get('photo').'" alt="'.$theme->__get('photo').'">
      	<div class="caption">
        <h3>'.$theme->__get('nom').'</h3>
        <p>'.$theme->__get('description').'</p>
        <p><a href="theme.php?theme='.$theme->_get('nom').'" class="btn btn-primary" role="button">Liste des restaurants</a></p>
     	 </div>
    	</div>';
  		}
   		$res=$res.'</div></div>';
   		return $res;
	}

	public function detailAction($t){
		$res='<div class="row">
 		<div class="col-sm-6 col-md-4">';
 		$theme = $_GET['theme'];
 		$nomTheme = theme::findByNom($theme);
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
   		return $res;
	}

	public function defaultAction($t){
		$v=new vue(theme::findByDate());
		$v->affichage("liste");
	}
}

?>