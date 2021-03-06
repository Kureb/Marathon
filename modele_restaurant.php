<?php 

include_once 'base.php';

class modele_restaurant{

// ALTER TABLE `restaurant`
// ADD COLUMN `photo` VARCHAR(256);

private $id;

private $nom;

private $description;

private $adresse;

private $contact;

private $id_theme;

private $photo;

private $map;


public function __construct(){}

public function __get($attr_name) {

	if(property_exists(__CLASS__, $attr_name)) {
		return $this->$attr_name;
	}
	$emess = __CLASS__. ": unknown member $attr_name (getAttr)";
	throw new Exception($emess, 45);
}

public function __set($attr_name, $attr_val) {
	if (property_exists(__CLASS__, $attr_name)) {
		$this->$attr_name =$attr_val;

	}
	$emess = __CLASS__ . ": unknown member $attr_name (setAttr)";

}

  public function delete() {
	    $c = base::getConnection();
	    $query = $c->prepare("delete from restaurant where id=?");
	    $query->bindParam (1,$this->id, PDO::PARAM_INT);
	    $query->execute();

	
 	}


public function insert() {
	
	$c = base::getConnection();
	$query = $c->prepare("insert into restaurant(id,nom,description,adresse,contact,id_theme,photo,map) values(:id,:nom,:description,:adresse,:contact,:id_theme,:photo,:map)");
	$query->bindParam(':id', $this->id,PDO::PARAM_STR);
	$query->bindParam(':description', $this->description,PDO::PARAM_STR);
	$query->bindParam(':adresse', $this->adresse,PDO::PARAM_STR);
	$query->bindParam(':contact', $this->contact,PDO::PARAM_STR);
	$query->bindParam(':id_theme', $this->id_theme, PDO::PARAM_STR);
      $query->bindParam(':map', $this->map, PDO::PARAM_STR);
	$query->execute();
	$this->id = $c->LastInsertID('restaurant');


}


public static function findById($id) {
  $c = base::getConnection();
      $query = $c->prepare("select * from restaurant where id=?") ;
      $query->bindParam(1, $id, PDO::PARAM_INT);
      $dbres = $query->execute();
      $d = $query->fetch(PDO::FETCH_BOTH);
      $a = new modele_restaurant();
      $a->id = $d['id'];
      $a->nom = $d['nom'];
      $a->description = $d['description'];
      $a->adresse = $d['adresse'];
      $a->contact = $d['contact'];
      $a->id_theme =$d['id_theme'];
      $a->map = $d['map'];

      return $a;
    }

public static function findByAdresse($adresse){

	 $c = base::getConnection();
      $query = $c->prepare("select * from restaurant where adresse=?") ;
      $query->bindParam(1, $adresse, PDO::PARAM_INT);
      $dbres = $query->execute();
      $d = $query->fetch(PDO::FETCH_BOTH);
      $a = new modele_restaurant();
      $a->id = $d['id'];
      $a->nom = $d['nom'];
      $a->description = $d['description'];
      $a->adresse = $d['adresse'];
      $a->contact = $d['contact'];
      $a->id_theme =$d['id_theme'];
      $a->map = $d['map'];
      return $a;

}

public static function findByNom($nom) {
	 $c = base::getConnection();
      $query = $c->prepare("select * from restaurant where nom=?") ;
      $query->bindParam(1, $nom, PDO::PARAM_INT);
      $dbres = $query->execute();
      $d = $query->fetch(PDO::FETCH_BOTH);
      $a = new modele_restaurant();
      $a->id = $d['id'];
      $a->nom = $d['nom'];
      $a->description = $d['description'];
      $a->adresse = $d['adresse'];
      $a->contact = $d['contact'];
      $a->id_theme =$d['id_theme'];
      $a->map = $d['map'];
      return $a;


}

public static function findByIdtheme($id){
      $c = Base::getConnection();
      $query = $c->prepare("select * from restaurant where id_theme=?") ;
      $query->bindParam(1, $id, PDO::PARAM_STR);
      $dbres = $query->execute();
      $d = $query->fetchAll();
      $tab = array();
      foreach ($d as $key => $value) {
      $a = new modele_restaurant();
      $a->id = $value['id'];
      $a->nom = $value['nom'];
      $a->description = $value['description'];
      $a->adresse = $value['adresse'];
      $a->contact = $value['contact'];
      $a->id_theme = $value['id_theme'];
      $a->map = $value['map'];
      $tab[] = $a;
      }
      return $tab;
    }

 


public static function findAll() {
 $query = 'select * from restaurant ORDER BY nom';
 $c = base::getConnection();
 $dbres = $c->prepare($query);
 $dbres->execute();
 $d = $dbres->fetchAll();
 $tab = Array();
 foreach($d as $ligne) {
 	$restaurant= new modele_restaurant();
 	$restaurant->__set('id', $ligne['id']);
 	$restaurant->__set('nom', $ligne['nom']);
 	$restaurant->__set('description', $ligne['description']);
 	$restaurant->__set('adresse', $ligne['adresse']);
 	$restaurant->__set('contact', $ligne['contact']);
 	$restaurant->__set('id_theme', $ligne['id_theme']);
      $restaurant->__set('map', $ligne['map']);
 	array_push($tab, $restaurant);


 }
return $tab;

}


public static function findAllImage($id_resto) {
      $c = Base::getConnection();
      $query = $c->prepare("select photo as phot from plats where `id_resto` = ?");
      $query->bindParam(1, $id_resto, PDO::PARAM_STR);
      $dbres = $query->execute();
      
      $tab = array();
      while($d = $query->fetch(PDO::FETCH_BOTH)){
            $tab[] = $d['phot'];
      }
      return $tab;
    }

public static function nbPlat($restaurant)
{
      $c = base::getConnection();
      $query = $c->prepare('SELECT count(nom) as nbplat FROM plats WHERE id_resto=?');
      $query->bindParam(1, $restaurant, PDO::PARAM_INT);

      $dbres = $query->execute();

      $d = $query->fetch(PDO::FETCH_BOTH);

      return $d['nbplat'];
}


public static function donneCarte($id) {
      $c = base::getConnection();
      $query = $c->prepare('select map from restaurant where id=?');
      $query->bindParam(1, $id, PDO::PARAM_INT);
      $dbres = $query->execute();
      $d = $query->fetch(PDO::FETCH_BOTH);
      return $d;
}



}