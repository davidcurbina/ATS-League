<?php
class Location{
  public static function CreateLocation($record){
    $record = json_decode($record);
    $name = Database::escape_data($record->name);
    $description = Database::escape_data($record->description);
    
    if($exists = Database::modify("Insert into locations (name,description) Values ('".$name."','".$description."');")){
        echo json_encode($exists);
    } else {
        echo "Error creating location";
    }
  }
}
?>