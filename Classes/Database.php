<?php
require_once('config.php');
class Database{
	public static $dbc;
	
	public static function connect(){
		if(self::$dbc = new mysqli(Conf::DB_HOST, Conf::DB_USERNAME,Conf::DB_PASSWORD)){
			if(!mysqli_select_db(self::$dbc,Conf::DB_NAME)){
				trigger_error("Could not connect to selected database.");
				return false;
			} else {
				//echo "Successful";
				return true;
			}
		} else {
			trigger_error("Could not connect to database.");
			return false;
			exit();
		}
	}
	
	public static function escape_data($data){
		
		if(!self::$dbc){
        	self::connect();
		}
		if(function_exists('mmysql_real_esacape_string')){
			$data = mysqli_real_escape_string(self::$dbc, trim($data));
			$data = strip_tags($data);
		} else {
			$data = mysqli_real_escape_string(self::$dbc,trim($data));
			$data = strip_tags($data);
		}
		return $data;
	}
	
	public static function query($query) {
        // Connect to the database
		if(!self::$dbc){
        	self::connect();
		}
        // Query the database
        $result = self::$dbc -> query($query);

        return $result;
    }
	
	public static function select($query) {
        $rows = array();
        $result = self::query($query);
        if($result === false) {
			//print_r("No Results found");
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
		//print_r($rows);
        return $rows;
    }
}
?>