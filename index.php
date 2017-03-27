<?php
require('routes.php');


//Function to AutoLoad all classes and controllers
function __autoload($file_name){
	if(file_exists('./Classes/'.$file_name.'.php')){
		require_once('./Classes/'.$file_name.'.php');
	} else if (file_exists('./Controllers/'.$file_name.'.php')){
		require_once('./Controllers/'.$file_name.'.php');
	}
}
?>