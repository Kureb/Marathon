<?php 

include_once 'base.php';

class modele_restaurant{

private $id;

private $nom;

private $description;

private $adresse;

private $contact;

private $id_theme;


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
	$query = $c prepare("insert into restaurant(id,nom,description,adresse,contact,id_theme) values(:id,:nom,:description,:adresse,:contact,:id_theme)");
	$query->bindParam(':id', $this->id,PDO::PARAM_STR);
	$query->bindParam(':description', $this->description,PDO::PARAM_STR);
	$query->bindParam(':adresse', $this->adresse,PDO::PARAM_STR);
	$query->bindParam(':contact', $this->contact,PDO::PARAM_STR);
	$query->bindParam(':id_theme', $this->id_theme, PDO::PARAM_STR);
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
      return $a;


}

public static function findbyIdtheme($id_theme) {
 $query = 'select * from restaurant where id_theme = ?';
 $c = base::getConnection();
 $dbres = $c->prepare($query);
 $dbres->bindParam(':id_theme', $id_theme);
 $dbres->execute();
 $d = $dbres->fetchAll();
 $tab = Array();
 foreach($d as $ligne) {
 	$restaurant= new modele_restaurant();
 	$restaurant->setAttr('id', $ligne['id']);
 	$restaurant->setAttr('nom', $ligne['nom']);
 	$restaurant->setAttr('description', $ligne['description']);
 	$restaurant->setAttr('adresse', $ligne['adresse']);
 	$restaurant->setAttr('contact', $ligne['contact']);
 	$restaurant->setAttr('id_theme', $ligne['id_theme']);
 	array_push($tab, $restaurant);


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
 	$restaurant->setAttr('id', $ligne['id']);
 	$restaurant->setAttr('nom', $ligne['nom']);
 	$restaurant->setAttr('description', $ligne['description']);
 	$restaurant->setAttr('adresse', $ligne['adresse']);
 	$restaurant->setAttr('contact', $ligne['contact']);
 	$restaurant->setAttr('id_theme', $ligne['id_theme']);
 	array_push($tab, $restaurant);


 }
return $tab;

}


}