<?php 


include_once 'base.php';

class modele_plat {
	
	private $id;
	private $nom;
	private $description;
	private $prix;
	private $photo;
	private $id_resto;


	public function __toString() {
		return "[".__CLASS__ . "] <br>
		id : ". $this->getAttr("id") . "<br>
		nom : ". $this->getAttr("nom") ."<br>
		description : ". $this->getAttr("description") ."<br>
		prix : ". $this->getAttr("prix") ."<br>
		photo : ". $this->getAttr("photo") . "<br>
		id_resto : ". $this->getAttr("id_resto");
	}


	public function __get($attr_name) {
		if(property_exits(__CLASS__, $attr_name)) {
			return $this->attr_name;
		}
		$emess = __CLASS__ . ": unknow member $attr_name (get)";
		throw new Exception($emess, 45);
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
		$query = "INSERT INTO plats VALUES(null,'".$this->nom."', '".$this->description."', '".$this->prix."', '".$this->photo."', '".$this->id_resto."')";
		$c = base::getConnection();
		$nb = $c->exec($query);
		$this->setAttr("id", $c->LastInsertId());
		return $nb;
	}


	public static function delete(){
		$nb = 0;
		if(isset($this->id)){
			$query = "DELETE FROM plats WHERE id = " . $this->id;
			$c = base::getConnection();
			$nb = $c->exec($query);
		}
		return $nb;
	}


	public function update(){
		$c = Base::getConnection();

		$query = $c->prepare ("update billets set nom= ?, description= ?,
			prix= ?, photo= ?, id_resto= ?
			where id= ?");

		$query->bindParam (1, $this->nom, PDO::PARAM_STR);
		$query->bindParam (2, $this->description, PDO::PARAM_STR);
		$query->bindParam (3, $this->prix, PDO::PARAM_STR);
		$query->bindParam (4, $this->photo, PDO::PARAM_STR);
		$query->bindParam (5, $this->id_resto, PDO::PARAM_STR);
		$query->bindParam (6, $this->id, PDO::PARAM_STR);

		return $query->execute();
	}



	public static function findById($id) {
		$c = base::getConnection();
		$query = 'select * from plats where id= :id';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':id', $id);
		$dbres->execute();
		$plat = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d!=false)
		{
			$plat =  new modele_plat();
			$plat->setAttr("id", $d->id);
			$plat->setAttr("nom", $d->nom);
			$plat->setAttr("description", $d->description);
			$plat->setAttr("prix", $d->prix);
			$plat->setAttr("photo", $d->photo);
			$plat->setAttr("id_resto", $d->id_resto);
		}
		return $plat;
	}


	public static function findByNom($nom) {
		$c = base::getConnection();
		$query = 'select * from plats where nom= :nom';
		$dbres = $c->prepare($query);
		$dbres->bindParam(':nom', $nom);
		$dbres->execute();
		$plat = false;
		$d = $dbres->fetch(PDO::FETCH_OBJ);
		if($d!=false)
		{
			$plat =  new modele_plat();
			$plat->__set("id", $d->id);
			$plat->__set("nom", $d->nom);
			$plat->__set("description", $d->description);
			$plat->__set("prix", $d->prix);
			$plat->__set("photo", $d->photo);
			$plat->__set("id_resto", $d->id_resto);
		}
		return $plat;
	}


	public static function findByPrix($prix) {
		$query = 'select * from plats where prix = :prix';
		$c = base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->bindParam(':prix', $prix);
		$dbres->execute();
		$d = $dbres->fetchAll();
		$tab = Array();
		if($d!=false) {
			foreach ($d as $ligne) {
				$plat = new modele_plat();
				$plat->setAttr('id', $ligne['id'] );
				$plat->setAttr('nom', $ligne['nom'] );
				$plat->setAttr('description', $ligne['description'] );
				$plat->setAttr('prix', $ligne['prix'] );
				$plat->setAttr('photo', $ligne['photo'] );
				$plat->setAttr('id_resto', $ligne['id_resto'] );
				array_push($tab, $plat);
			}
		}

		return $tab;
	}



	public static function findAll(){
		$query = "select * from plats";
		$pdo = base::getConnection();
		$dbres = $pdo->prepare($query);
		$dbres->execute();
		$d = $dbres->fetchAll();
		$tab = Array();
		foreach($d as $ligne){
			$plat = new modele_plat();
			$plat->setAttr("id", $ligne["id"]);
			$plat->setAttr("nom", $ligne["nom"]);
			$plat->setAttr("description", $ligne["description"]);
			$plat->setAttr("prix", $ligne["prix"]);
			$plat->setAttr("photo", $ligne["photo"]);
			$plat->setAttr("id_resto", $ligne["id_resto"]);
			array_push($tab, $billet);
		}

		return $tab;
	}



	public static function findByPrix($id_resto) {
		$query = 'select * from plats where id_resto = :id_resto';
		$c = base::getConnection();
		$dbres = $c->prepare($query);
		$dbres->bindParam(':id_resto', $id_resto);
		$dbres->execute();
		$d = $dbres->fetchAll();
		$tab = Array();
		if($d!=false) {
			foreach ($d as $ligne) {
				$plat = new modele_plat();
				$plat->setAttr('id', $ligne['id'] );
				$plat->setAttr('nom', $ligne['nom'] );
				$plat->setAttr('description', $ligne['description'] );
				$plat->setAttr('prix', $ligne['prix'] );
				$plat->setAttr('photo', $ligne['photo'] );
				$plat->setAttr('id_resto', $ligne['id_resto'] );
				array_push($tab, $plat);
			}
		}

		return $tab;
	}





	









}


?>