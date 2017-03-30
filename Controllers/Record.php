<?php
class Record{
	public static function CreateRecord($record){
		//echo $record;
		//echo "Shit";
		
		$record = json_decode($record);
		$emp_id = Database::escape_data($record->emp_id);
		$type = Database::escape_data($record->type);
		$date = date('Y-m-d H:i:s');
		$date = date('Y-m-d H:i:s');
		if($exists = Database::select("Select * from employees where id =".$emp_id)){
			if(Database::modify("Insert into records (emp_id,type,check_in) Values (".$emp_id.",'".$type."','".$date."');")){
				echo "Success";
			} else{
				echo "Error: Insert data failed";
			}
			//echo "Insert into records (emp_id,type,check_in) Values (".$emp_id.",'".$type."','".$date."');";
		} else {
			echo "Employee not found";
		}
	}
}
?>