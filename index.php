<?php
require('routes.php');

//Function to AutoLoad all classes and controllers
function __autoload($file_name){
	if(file_exists('./app/Classes/'.$file_name.'.php')){
		require_once('./app/Classes/'.$file_name.'.php');
	} else if (file_exists('./app/Controllers/'.$file_name.'.php')){
		require_once('./app/Controllers/'.$file_name.'.php');
	}
}
?>
Hello World