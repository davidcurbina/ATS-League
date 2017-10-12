<?php
class Login extends Controller{
	public static function ValidateUser($username, $password){
      //Sanatizing input
      $username = Database::escape_data($username);
      $password = Database::escape_data($password);

      //Validating User
      $wParams = array(
        "password" => $password,
        "username" => $username
      );
      
      if($users = Database::select(array("*"), "users", $wParams,"")){
        $_SESSION["authenticated"] = true;
        foreach($users as $obj){
          $_SESSION["userID"] = $obj["id"];
        }
      } else {
        $_SESSION["authenticated"] = false;
      }
      Main::CreateView('main','');
	}
}
?>