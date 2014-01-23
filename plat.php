<?php

	include_once 'vue.php';
	include_once 'platController.php';


	$t = new platController();
	if(empty($_GET)){
		header('Location: plat.php?a=list'); 
	}
	$t->callAction($_GET);

?>