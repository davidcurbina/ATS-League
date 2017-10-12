	
<?php

interface GameProvider
{
  public   function SaveGame();
  public static function GetGames($userID);
  public static function CreateGame($iHomeTeam,$iAwayTeam, $iPWinner, $iSpread, $iWeekday, $iWeek, $iDate, $iTime);
}

class Game implements GameProvider
{
    private $homeTeam;
    private $awayTeam;
    private $spread;
    private $pWinner;
    private $winner;
    private $time;
    private $date;
    private $weekday;
    private $week;
    
     
    public function SetHomeTeam($homeTeam)
    {
        $this-> homeTeam = $homeTeam;
    }
     
    public function GetHomeTeam()
    { 
        return $this->homeTeam;
    }
     
    public function SetAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }
     
    public function GetAwayTeam()
    {
        return $this->awayTeam;
    }
     
    public function SetSpread($spread){
    
        $this->spread = $spread;
    }
     
    public function GetSpread() 
    {
        return $this->spread;
    }
  
    public function SetPWinner($pWinner){
    
        $this->pWinner = $pWinner;
    }
     
    public function GetPWinner() 
    {
        return $this->pWinner;
    }
  
    public function SetWinner($winner){
    
        $this->winner = $winner;
    }
     
    public function GetWinner() 
    {
        return $this->winner;
    }
  
    public function SetTime($time){
    
        $this->time = $time;
    }
     
    public function GetTime() 
    {
        return $this->time;
    }
  
    public function SetDate($date){
    
        $this->date = $date;
    }
     
    public function GetDate() 
    {
        return $this->$date;
    }
  
    public function SetWeekday($weekday){
    
        $this->weekday = $weekday;
    }
     
    public function GetWeekday() 
    {
        return $this->$weekday;
    }
  
    public function SetWeek($week){
    
        $this->week = $week;
    }
     
    public function GetWeek() 
    {
        return $this->$week;
    }
  
    public static function CreateGame($iHomeTeam,$iAwayTeam, $iPWinner, $iSpread, $iWeekday, $iWeek, $iDate, $iTime){
      $game = new Game();
      $game->SetHomeTeam($iHomeTeam);
      $game->SetAwayTeam($iAwayTeam);
      $game->SetPWinner($iPWinner);
      $game->SetSpread($iSpread);
      $game->SetWeekday($iWeekday);
      $game->SetWeek($iWeek);
      $game->SetDate($iDate);
      $game->SetTime($iTime);
      
      return $game;
    }
  
    public static function GetGames($userID){
      $array = array("*");
      
      $teams = Database::select( $array, "games", array(), " Where id not in (select game_id from picks where user_id = ".$userID.")");
      return $teams;
    }
  
    public function SaveGame(){
      
      $homeTeam = $this->homeTeam;
      $awayTeam = $this->awayTeam;
      $date = $this->date;
      $pWinner = $this->pWinner;
      $spread = $this->spread;
      $weekday = $this->weekday;
      $week = $this->week;
      $time = $this->time;
      

      $sParams = array(
        "home" => $homeTeam,
        "away" => $awayTeam,
        "week" => $week
      );
      
      $iParams = array(
        "home" => $homeTeam,
        "away" => $awayTeam,
        "week" => $week,
        "spread" => $spread,
        "pwinner" => $pWinner,
        "weekday" => $weekday,
        "date" => $date,
        "time" => $time
      );


      $exists =  Database::select(array("*"), "games",$sParams,array());
      if(count($exists) == 0){
        if($exists = Database::modify("INSERT","games",$iParams,array(),"")){
            return true;
        } else {
            return false;
        }
      } else {
        if(Database::modify("UPDATE","games",$iParams,$sParams,"")){
            return true;
          } else{
            return false;
        }
      }
    }
}
?>