<?php
include_once 'controller.php';
include_once 'modele_theme.php';
include_once 'modele_restaurant.php';
include_once 'modele_plat.php';
session_start();
class themeController extends Controller{ 
	public function __construct(){
		$this->tab = array("list"=>"listAction","detail"=>"detailAction");
	}

	public function listAction($t){
		$res='<div class="row liste_theme">';
  		foreach (modele_theme::findAll() as $theme) {
        $liste=modele_theme::findAllImage($theme->id);
        $nb = rand(0,sizeof($liste)-1);
      $idtheme = $theme->__get('id');
      $nbresto = modele_theme::nbResto($idtheme);
      $pluriel = "";
      if($nbresto>1){ $pluriel = "s"; }
  		$res=$res.'
      <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
     	 <img src="images/originales/'.$liste[$nb].'">
      	<div class="caption">
        <h3>'.$theme->__get('nom').'</h3>
        <p>'.$theme->__get('description').'</p>
        <p><a href="theme.php?a=detail&theme='.$theme->__get('nom').'" class="btn btn-primary" role="button">'.$nbresto.' restaurant'.$pluriel.'</a></p>
     	 </div>
    	</div>
      </div>';
  		}
   		$res=$res.'</div>';
   		vue::affichage($res);
	}

	public function detailAction($t){
		$res='<div class="row liste_theme">';
    $carte  = '';
 		$theme = $_GET['theme'];
 		$nomTheme = modele_theme::findByNom($theme);
 		$idTheme = $nomTheme->__get('id');
  		foreach (modele_restaurant::findByIdtheme($idTheme) as $resto) {

        $listeResto=modele_restaurant::findAllImage($resto->id);
        $nb = rand(0,sizeof($listeResto)-1);
        
        $carte  = $resto->__get('map');
        

      $idresto = $resto->__get('id');
      $nbplat = modele_restaurant::nbPlat($idresto);
      $pluriel = "";
      if($nbplat>1){ $pluriel = "s"; }

  		$res=$res.'
      <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
     	 <img src="images/originales/'.$listeResto[$nb].'">
      	<div class="caption">
        <h3>'.$resto->__get('nom').'</h3>
        <p>'.$resto->__get('description').'</p>
        <p><a href="plat.php?a=list&theme='.$theme.'&restaurant='.$resto->__get('nom').'&id='.$resto->__get("id"). '" class="btn btn-primary" role="button">'.$nbplat.' plat'.$pluriel.'</a> <button class="btn btn-default" data-toggle="modal" data-target="#contact" >Contact</button> 
<button class="btn btn-default" data-toggle="modal" data-target="#plan" >Plan</button> 
      </div>
    	</div>
      </div>


        <!-- Modal Contact -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="#">
                
                <div class="input-group ">
                  <span class="input-group-addon ">Sujet</span>
                    <input type="text" name="sujet" class="form-control " maxlength="150" placeholder="Entrer ici le sujet du message">     
                  </div>
                              
                
                <br />
                <textarea class="form-control" name="contenu" rows="10"  placeholder="Entrer ici le contenu du message"></textarea>
               
                
                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Envoyer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






<!-- Modal Carte -->
<div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Carte</h4>
      </div>
      <div class="modal-body">
              '.($carte).'
              
              </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
';
  		}
   		$res=$res.'</div>

      <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
          <script type="text/javascript" src="bootstrap/js/jquery.js"></script>';
   		vue::affichage($res);
	}
}

?>