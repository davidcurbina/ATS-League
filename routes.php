<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
Route::set('login', function(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		Login::ValidateUser($_POST['email'],$_POST['password']);
	} else {
		Login::CreateView('login',$_GET['var']);
	}
});

Route::set('main', function(){
	Main::CreateView('main','');
});

Route::set('create_record', function(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		Record::CreateRecord(file_get_contents('php://input'));
	}
});
?>