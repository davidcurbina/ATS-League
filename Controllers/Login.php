<?php
class Login extends Controller{
	public static function ValidateUser($username, $password){
      //Sanatizing input
      $username = Database::escape_data($username);
      $password = Database::escape_data($password);

      //Validating User
      if($users = Database::select("Select * from users where username ='".$username. "' and password = ".$password)){
        $_SESSION["authenticated"] = true;
      } else {
        $_SESSION["authenticated"] = false;
      }
      Main::CreateView('main','');
	}
}
?>