<?php
require('routes.php');
//Function to AutoLoad all classes and controllers
function __autoload($file_name){
	$root = $_SERVER['DOCUMENT_ROOT'];
	if(file_exists($root.'/Classes/'.$file_name.'.php')){
		require_once($root.'/Classes/'.$file_name.'.php');
		echo "Loaded classses";
	} else if (file_exists('./Controllers/'.$file_name.'.php')){
		require_once($root.'/Controllers/'.$file_name.'.php');
		echo "Loaded controllers";
	}
}
?>
Hello World