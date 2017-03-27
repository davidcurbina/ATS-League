<?php

Route::set('login', function(){
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		Login::ValidateUser($_POST['email'],$_POST['password']);
	} else {
		Login::CreateView('login');
	}
});

Route::set('main', function(){
	echo "Main Page";
});
?>