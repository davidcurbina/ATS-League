<?php
require('routes.php');

//Function to AutoLoad all classes and controllers
function __autoload($file_name){
	echo $file_name."</br>";
	if(file_exists('Classes/'.$file_name.'.php')){
		require_once('Classes/'.$file_name.'.php');
		echo "Class Files Loaded";
	} else if (file_exists('Controllers/'.$file_name.'.php')){
		require_once('Controllers/'.$file_name.'.php');
		echo "Controller Files Loaded";
	} else {
		echo "Could not find file";
	}
}
?>
Hello World