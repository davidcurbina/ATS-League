	
<?php

interface TeamProvider
{
  public function SaveTeam();
  public static function GetTeams();
  public static function CreateTeam($iTeamLocation,$iTeamName, $iTeamURL);
}

class Team implements TeamProvider
{
    private $teamName;
    private $teamLocation;
    private $teamURL;
     
    public function SetTeamName($teamName)
    {
        $this-> teamName = $teamName;
    }
     
    public function GetTeamName()
    { 
        return $this->teamName;
    }
     
    public function SetTeamLocation($teamLocation)
    {
        $this->teamLocation = $teamLocation;
    }
     
    public function GetTeamLocation()
    {
        return $this->teamLocation;
    }
     
    public function SetTeamURL($teamURL){
    
        $this->teamURL = $teamURL;
    }
     
    public function GetTeamURL() 
    {
        return $this->teamURL;
    }
  
    public static function CreateTeam($iTeamName,$iTeamLocation, $iTeamURL){
      $team = new Team();
      $team->SetTeamName($iTeamName);
      $team->SetTeamLocation($iTeamLocation);
      $team->SetTeamURL($iTeamURL);

      echo($team->getTeamURL());
      
      return $team;
    }
  
    public static function GetTeams(){
      $array = array("*");
      $teams = Database::select( $array, "teams",array() ,array());
      return $teams;
    }
  
    public function SaveTeam(){
      $name = $this->teamName;
      $location = $this->teamLocation;
      $url = $this->teamURL;

      $sParams = array(
        "name" => $name,
        "location" => $location
      );
      
      $iParams = array(
        "name" => $name,
        "location" => $location,
        "url" => $url 
      );


      $exists =  Database::select(array("*"), "teams",$sParams,array());
      echo "Count:".count($exists);
      if(count($exists) == 0){
        if($exists = Database::modify("INSERT","teams",$iParams,array())){
            echo json_encode($exists);
        } else {
            echo "Error creating team";
        }
      } else {
        if(Database::modify("UPDATE","teams",$iParams,$sParams)){
              echo "Success";
          } else{
              echo "Error updating team";
        }
      }
    }
}
?>