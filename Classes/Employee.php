<?php
class Employee{
  public static function CreateEmployee($record){
    $record = json_decode($record);
    $fname = Database::escape_data($record->first_name);
    $lname = Database::escape_data($record->last_name);
    $department_id = Database::escape_data($record->department_id);
    
    if($exists = Database::modify("Insert into employees (first_name,last_name,department) Values ('".$fname."','".$lname."',".$department_id.");")){
        echo json_encode($exists);
    } else {
        echo "Error creating employee";
    }
  }
  
  public static function getClocked($record){
    if($exists = Database::select("Select * from records where clocked_out is null =")){
        //echo "Insert into records (emp_id,type,check_in) Values (".$emp_id.",'".$type."','".$date."');";
    } else {
        echo "Employees not found";
    }
  }
  
  public static function GetEmployees(){
    if($exists = Database::select("Select id from employees")){
        echo json_encode($exists);
    } else {
        echo "Employee not found";
    }
  }
  public static function GetClockedIn(){
    if($exists = Database::select("
    Select emp.id id, first_name, last_name, dep.name dep_name, loc.name loc_name,type, check_in, check_out
    From emp_dept ed, loc_dept ld, employees emp, records rec, locations loc, departments dep
    Where ed.dep_loc_id = ld.id
    And ed.emp_id = emp.id
    And rec.emp_id = ed.emp_id
    And loc.id = ld.loc_id
    And dep.id = ld.dep_id
    And check_out is null")){
        return $exists;
    } else {
        echo "Employee not found";
    }
  }
  
  public static function GetFullReport(){
    if($exists = Database::select("
      select a.emp_id, OT, paid, dep_name, loc_name
    from (
    select emp_id, (sum(worked) - 40 * 0.5) OT, sum(paid) paid
    from general
    group by emp_id) as a,
    (Select emp.id emp_id, first_name, last_name, dep.name dep_name, loc.name loc_name,type, check_in, check_out
        From emp_dept ed, loc_dept ld, employees emp, records rec, locations loc, departments dep
        Where ed.dep_loc_id = ld.id
        And ed.emp_id = emp.id
        And rec.emp_id = ed.emp_id
        And loc.id = ld.loc_id
        And dep.id = ld.dep_id) as b
        where b.emp_id = a.emp_id
    group by a.emp_id, OT, paid, dep_name, loc_name")){
        return $exists;
    } else {
        echo "Employee not found";
    }
  }
  public static function GetBriefReport(){
    if($exists = Database::select("
      select  OT, paid, dep_name, loc_name
    from (
    select emp_id, (sum(worked) - 40 * 0.5) OT, sum(paid) paid
    from general
    ) as a,
    (Select emp.id emp_id, first_name, last_name, dep.name dep_name, loc.name loc_name,type, check_in, check_out
        From emp_dept ed, loc_dept ld, employees emp, records rec, locations loc, departments dep
        Where ed.dep_loc_id = ld.id
        And ed.emp_id = emp.id
        And rec.emp_id = ed.emp_id
        And loc.id = ld.loc_id
        And dep.id = ld.dep_id) as b
        where b.emp_id = a.emp_id
    group by OT, paid, dep_name, loc_name")){
        return $exists;
    } else {
        echo "Employee not found";
    }
  }
  
  
  public static function GetEmployeeReport(){
    if($exists = Database::select("
      Select emp.id emp_id, first_name, last_name, dep.name dep_name, loc.name loc_name
        From emp_dept ed, loc_dept ld, employees emp, locations loc, departments dep
        Where ed.dep_loc_id = ld.id
        And ed.emp_id = emp.id
        And loc.id = ld.loc_id
        And dep.id = ld.dep_id")){
        return $exists;
    } else {
        echo "Employee not found";
    }
  }
  
  public static function GetTimeCardReport(){
    if($exists = Database::select("
      select * 
from general;")){
        return $exists;
    } else {
        echo "Employee not found";
    }
  }
}
?>