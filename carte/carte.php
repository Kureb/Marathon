<?php

require('GoogleMapAPIv3.class.php');

class carte{

	private $map;

	public function lol($adresse) {
		$gmap = new GoogleMapAPI();
		$gmap->setDivId('map_google');
		$gmap->setDirectionDivId('route');
		$gmap->setMapType('PLAN');
		$gmap->setEnableWindowZoom(true);
		$gmap->setEnableAutomaticCenterZoom(true);
		$gmap->setZoom(0);
		$gmap->setClusterer(true);
		$gmap->setSize('300px','300px');


		$gmap->setInfoWindowZoom(2);
		$gmap->setLang('fr');
		$coordtab = array();
		$coordtab []= array('19 rue des cedres bleus','Chavelot', '<strong>html pas content</strong>');
		$gmap->addArrayMarkerByAddress($coordtab,'cat1');
		 

		 
		return $gmap->generate();
		
	}
	
}

?>