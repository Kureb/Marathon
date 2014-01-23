<?php 


include_once 'base.php';

class modele_theme {

	private $id;	
	private $nom;	
	private $description;
	private $photo;


	public function __get($attr_name) {
		
			return $this->$attr_name;
		
		
	}




	public function __set($attr_name, $attr_val) {
		if(property_exists(__CLASS__, $attr_name)) {
			$this->$attr_name = $attr_val;
		}
		$emess = __CLASS__ . ": unknow member $attr_name (set)";
		throw new Exception($emess, 45);
	}


	public static function insert(){
		$nb = 0;
		$query = "INSERT INTO theme VALUES(null,'".$this->nom."', '".$this->description."', '".$this->photo."')";
		$c = base::getConnection();
		$nb = $c->exec($query);
		$this->__set("id", $c->LastInsertId());
		return $nb;
	}


	public static function delete(){
		$nb = 0;
		if(isset($this->id)){
			$query = "DELETE FROM theme WHERE id = " . $this->id;
			$c = base::getConnection();
			$nb = $c->exec($query);
		}
		return $nb;
	}


	public function update(){
		$c = Base::getConnection();

		$query = $c->prepare ("update theme set nom= ?, description= ?,	photo= ? where id= ?");

		$query->bindParam (1, $this->nom, PDO::PARAM_STR);
		$query->bindParam (2, $this->description, PDO::PARAM_STR);
		$query->bindParam (3, $this->photo, PDO::PARAM_STR);
		$query->bindParam (4, $this->id, PDO::PARAM_STR);

		return $query->execute();
	}
	public static function findAll() {

     $c = base::getConnection();
      $query = $c->prepare("select * from theme ORDER BY nom");
      $dbres = $query->execute();
      $d = $query->fetchAll();
      $tab = array();
      foreach ($d as $key => $value) {
      	$a = new modele_theme();
      	$a->id = $value['id'];
      	$a->nom = $value['nom'];
     	$a->description = $value['description'];
        $a->photo = $value['photo'];
     	$tab[] = $a;
      }
      return $tab;
    }



	public static function findById($id) {
		$c = base::getConnection();
		$query = 'select * from theme where id= :id';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':id', $id);
		$dbres->execute();
		$plat = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d!=false)
		{
			$theme =  new modele_plat();
			$theme->__set("id", $d->id);
			$theme->__set("nom", $d->nom);
			$theme->__set("description", $d->description);

		}
		return $theme;
	}


	public static function findByNom($nom) {
		$c = base::getConnection();
		$query = 'select * from theme where nom= :nom';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':nom', $nom);
		$dbres->execute();
		$plat = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d!=false)
		{
			$theme =  new modele_theme();
			$theme->__set("id", $d->id);
			$theme->__set("nom", $d->nom);
			$theme->__set("description", $d->description);
			$theme->__set("photo", $d->photo);
		
		}
		return $theme;
	}


	
	







}

?>