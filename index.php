<?php
require('routes.php');

//Function to AutoLoad all classes and controllers
function __autoload($file_name){
	if(file_exists('app/Classes/'.$file_name.'.php')){
		require_once('app/Classes/'.$file_name.'.php');
		echo "Files Loaded";
	} else if (file_exists('./Controllers/'.$file_name.'.php')){
		require_once('/Controllers/'.$file_name.'.php');
	} else {
		echo "Could not find app/Classes";
	}
}
?>
Hello World