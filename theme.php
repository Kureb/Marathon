<?php

	include_once 'vue.php';
	include_once 'themeController.php';

	$t = new themeController();
	if(empty($_GET)){
		header('Location: theme.php?a=list'); 
	}
	$t->callAction($_GET);

?>