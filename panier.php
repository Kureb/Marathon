<?php
	include_once 'modele_panier.php';
	include_once 'vue.php';
	include_once 'panierController.php';

	$p = new panierController();
	if(empty($_GET)){
		header('Location: theme.php?a=list'); 
	}
	$p->callAction($_GET);

?>