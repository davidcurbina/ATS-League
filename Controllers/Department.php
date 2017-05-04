<?php
class Department{
  public static function CreateDepartment($record){
    $record = json_decode($record);
    $name = Database::escape_data($record->name);
    $description = Database::escape_data($record->description);
    $location_id = Database::escape_data($record->location_id);
    
    if($exists = Database::modify("Insert into departments (name,description,location_id) Values ('".$name."','".$description."',".$location_id.");")){
        echo json_encode($exists);
    } else {
        echo "Error creating department";
    }
  }
}
?>