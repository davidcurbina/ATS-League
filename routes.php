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

Route::set('create_location', function(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		Location::CreateLocation(file_get_contents('php://input'));
	}
});

Route::set('create_department', function(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		Department::CreateDepartment(file_get_contents('php://input'));
	}
});

Route::set('create_employee', function(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		Employee::CreateEmployee(file_get_contents('php://input'));
	}
});

Route::set('employee_list', function(){
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
      Employee::GetEmployees();
	}
});

Route::set('query', function(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $request = json_decode(file_get_contents('php://input'));
      $type = Database::escape_data($request->type);
      $params = Database::escape_data($request->params);
      
      if($type == "get_clocked_in"){
        Employee::GetClockedIn($params);
      }
	}
});
?>