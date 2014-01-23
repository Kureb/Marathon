<?php




include_once 'carte.php';


 
$gmap = new GoogleMapAPI();
$gmap->setDivId('map_google');
$gmap->setDirectionDivId('route');
$gmap->setMapType('PLAN');
//$gmap->setCenter('Paris France');
$gmap->setEnableWindowZoom(true);
$gmap->setEnableAutomaticCenterZoom(true);
//$gmap->setDisplayDirectionFields(false);
//$gmap->disableZoomEncompass();
$gmap->setZoom(0);
$gmap->setClusterer(true);
$gmap->setSize('300px','300px');

var_dump($gmap);

$gmap->setInfoWindowZoom(2);
$gmap->setLang('fr');
//$gmap->setDefaultHideMarker(true);
$coordtab = array();
$coordtab []= array('19 rue des cedres bleus','Chavelot', '<strong>html pas content</strong>');
$gmap->addArrayMarkerByAddress($coordtab,'cat1');
 

 
$gmap->generate();
echo $gmap->getGoogleMap();




$map = new carte();
$mapg= $map->lol($coordtab);
echo $mapg;
var_dump($map);
?>


