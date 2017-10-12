<?php
$message = json_decode(file_get_contents('php://input'),false);

if($message->type == "savePicks"){
  foreach($message->data as $obj){
    $pick = Pick::CreatePick($_SESSION["userID"], $obj->gameID, $obj->choice);
    $pick->SavePick();
  }
} else if ($message->type == "createGame"){
  $obj = $message->data;
  $game = Game::CreateGame($obj->homeTeam,
                           $obj->awayTeam, 
                           $obj->pWinner, 
                           $obj->spread, 
                           $obj->weekday, 
                           $obj->week, 
                           $obj->date, 
                           $obj->time);
  
  if($game->saveGame()){
    echo "{\"response\": \"success\"}";
  } else {
    echo "{\"response\": \"error\"}";
  }
}
?>
