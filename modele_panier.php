<?php

	class modele_panier {

		public function __construct(){
			if(!isset($_SESSION)){
				session_start();
			}
			if(!isset($_SESSION['panier'])){
				$_SESSION['panier'] = array();
			}
		}

		public static function add($idplat)
		{
			if(empty($_SESSION['panier'][$idplat])){
				$_SESSION['panier'][$idplat] = 1;
			}
			else{
				$_SESSION['panier'][$idplat] = $_SESSION['panier'][$idplat]+1;
			}
		}
	}

?>