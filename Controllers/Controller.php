<?php 

class Controller{
	public static function CreateView($viewName, $parameter){
		require_once('Views/'.$viewName.'.php');
	}
}
?>