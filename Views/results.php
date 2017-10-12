
<?php // Perform queries 
  $var = $_GET["var"];
  $result = Game::GetGames($_SESSION["userID"]);
  if($var == "makePicks"){
    if(count($result) > 0){
      echo"
      <div class=\"panel-body\">
          <div class=\"table-responsive\">
              <h3>Make Picks</h3>
              <table class=\"table table-hover table-striped\">
                  <thead>
                      <tr>
                        <th>Time</th>
                        <th class=\"home\">Home</th>
                        <th class=\"away\">Away</th>
                        <th>Weekday</th>
                      </tr>
                  </thead>
                  <tbody>";
                    foreach($result as $obj){
                      echo
                        "<tr>
                          <td>".$obj['time']."</td>
                          <td class='home'>
                            ";
                      if($obj['home'] == $obj['pwinner']){
                        echo $obj['spread'];
                      }
                      echo "    ".$obj['home']."
                            
                            <input id='home".$obj['id']."' type='checkbox' onclick=\"savePick(".$obj['id'].",'home')\">
                          </td>
                          <td class='away'>
                            <input id='away".$obj['id']."'type='checkbox' value='' onclick=\"savePick(".$obj['id'].",'away')\">".$obj['away']."
                                ";
                      if($obj['away'] == $obj['pwinner']){
                        echo $obj['spread'];
                      }
                      echo "
                          </td>
                          <td>".$obj['weekday']."</td>
                      </tr>";
                    }
      echo "
                  </tbody>
              </table>
              ";
      if(count($result)>0){
        echo "<button type=\"button\" class=\"btn btn-primary\" onClick=\"savePicks()\">Save</button>";
      }
      echo "
          </div>";
    }
    echo"
          <div class=\"table-responsive\">
              <h3>Picks Made</h3>
              <table class=\"table table-hover table-striped\">
                  <thead>
                      <tr>
                        <th>Time</th>
                        <th class=\"home\">Home</th>
                        <th class=\"away\">Away</th>
                        <th>Weekday</th>
                        <th>Choice</th>
                      </tr>
                  </thead>
                  <tbody>";
                    $result = Pick::GetPicks();
                    foreach($result as $obj){
                      echo
                        "<tr>
                          <td>".$obj['time']."</td>
                            <td class='home'>
                            ";
                      if($obj['home'] == $obj['pwinner']){
                        echo $obj['spread'];
                      }
                      echo "    ".$obj['home'].
                        "
                          </td>
                          <td class='away'>
                            ".$obj['away']."
                                ";
                      if($obj['away'] == $obj['pwinner']){
                        echo $obj['spread'];
                      }
                      echo "
                          </td>
                          <td>".$obj['weekday']."</td>
                          <td>".$obj['choice']."</td>
                      </tr>
                      ";
                    }
    echo "
                  </tbody>
              </table>
              ";
    echo "
          </div>
      </div>
    ";
    
    } else if($var == "viewTeams"){
    echo"
      <div class=\"panel-body\">
          <div class=\"table-responsive\">
              <table class=\"table table-hover table-striped\">
                  <thead>
                      <tr>
                        <th>Time</th>
                        <th class=\"home\">Home</th>
                        <th class=\"away\">Away</th>
                        <th>Spread</th>
                        <th>Weekday</th>
                      </tr>
                  </thead>
                  <tbody>";
                  
                  foreach($result as $obj){
                    echo
                      "<tr>
                        <td>".$obj['time']."</td>
                        <td class='home'>".$obj['home']." <input type='checkbox' value=''></td>

                        <td class='away'><input type='checkbox' value=''> ".$obj['away']."</td>
                        <td>".$obj['spread']."</td>
                        <td>".$obj['weekday']."</td>
                    </tr>";
                  }

    echo "
                  </tbody>
              </table>
          </div>
      </div>
    ";
    }
?>
<!-- /.container-fluid -->