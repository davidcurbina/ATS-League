<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$routes=['login','main','results','save','create'];
$valid = false;
foreach($routes as $route){
  $valid = true;
  if( $_GET['url'] == $route.".php"){
    Route::set('login', function(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          Login::ValidateUser($_POST['email'],$_POST['password']);
      } else {
        if(!$_SESSION["authenticated"]){
            Login::CreateView('login',$_GET['var']);
        } else {
          Main::CreateView('main','');
        }
      }
    });
    
    if($_SESSION["authenticated"]) {
      
      Route::set('main', function(){
          Main::CreateView('main','');
      });

      Route::set('results', function(){
          Main::CreateView('results','');
      });

      Route::set('save', function(){
          Main::CreateView('save','');
      });

      Route::set('create', function(){
          Main::CreateView('create','');
      });
    }
  }
}

if(!$valid || !$_SESSION["authenticated"]){
  Main::CreateView('login','');
}

?>