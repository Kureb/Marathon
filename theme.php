<?php

	include_once 'vue.php';
	include_once 'themeController.php';

	$t = new themeController();
	$t->callAction($_GET);

?>