	
<?php

interface PickProvider
{
  public   function SavePick();
  public static function GetPicks();
  public static function CreatePick($iUserID, $iGameID, $iChoice);
}

class Pick implements PickProvider
{
    private $userID;
    private $gameID;
    private $choice;
    private $date;
    
     
    public function SetUserID($userID)
    {
        $this->userID = $userID;
    }
     
    public function GetUserID()
    { 
        return $this->userID;
    }
     
    public function SetGameID($gameID)
    {
        $this->gameID = $gameID;
    }
     
    public function GetGameID()
    {
        return $this->gameID;
    }
     
    public function SetChoice($choice){
    
        $this->choice = $choice;
    }
     
    public function GetChoice() 
    {
        return $this->choice;
    }
  
    public function SetDate($date){
    
        $this->date = $date;
    }
     
    public function GetDate() 
    {
        return $this->date;
    }
  
    public static function CreatePick($iUserID, $iGameID, $iChoice){
      $pick = new Pick();
      $pick->SetUserID($iUserID);
      $pick->SetGameID($iGameID);
      $pick->SetChoice($iChoice);
      $pick->SetDate(date("Y-m-d"));
      
      return $pick;
    }
  
    public static function GetPicks(){
      
      $array = array("*");
      $teams = Database::select( $array, "picks pic, games game",array()," Where game_id = game.id And choice is not null");
      return $teams;
    }
  
    public function SavePick(){
      $iUserID = $this->userID;
      $iGameID = $this->gameID;
      $iChoice = $this->choice;
      $date = $this->date;
      
      $iParams = array(
        "user_id" => $iUserID,
        "game_id" => $iGameID,
        "choice" => $iChoice,
        "date" => $date
      );
      
      $oParams = " where user_id = ".$iUserID." and game_id = ".$iGameID;

      $exists =  Database::select(array("*"), "picks",array(),$oParams);
      if(count($exists) == 0){
        if($exists = Database::modify("INSERT","picks",$iParams,array(), "  ")){
            echo json_encode($exists);
        } else {
            echo "Error creating game";
        }
      } else {
        if(Database::modify("UPDATE","picks",$iParams,array(), $oParams)){
              //echo "Success";
          } else{
              echo "Error updating game";
        }
      }
    }
}
?>