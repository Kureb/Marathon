<?php
abstract class controller {
        public $tab;
	public function callAction($a){
        if($this->tab[$a['a']]){
        	$m=$this->tab[$a['a']];
        	$this->$m($a);
        }
        else{
        	$this->defaultAction($tab);
        }
        }

	//public abstract defaultAction($t);
}



?>