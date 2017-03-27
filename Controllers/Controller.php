<?php 

class Controller{
	public static function CreateView($viewName){
		require_once('Views/'.$viewName.'.php');
		echo "Made it to the Base Controller";
	}
}

?>