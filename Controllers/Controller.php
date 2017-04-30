<?php 

class Controller{
	public static function CreateView($viewName, $parameter){
      if($_SESSION["authenticated"]){
		require_once('Views/'.$viewName.'.php');
      } else {
        require_once('Views/login.php');
      }
	}
}
?>