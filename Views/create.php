<div class="bootstrap-iso">
    <div class="form-group col-md-6">
      <label for="homeTeam">Home Team</label>
      <select class="form-control" id="homeTeam">
        <?php 
            $result = Team::GetTeams();
              foreach($result as $obj){
                echo "<option>".$obj['name']."</option>";
              }
        ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="awayTeam">Away Team</label>
      <select class="form-control" id="awayTeam">
        <?php 
            $result = Team::GetTeams();
              foreach($result as $obj){
                echo "<option>".$obj['name']."</option>";
              }
        ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="favored col-md-6">Favored Team</label>
      <select class="form-control" id="pWinner">
        <?php 
            $result = Team::GetTeams();
              foreach($result as $obj){
                echo "<option>".$obj['name']."</option>";
              }
        ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="spread">Spread</label>
      <input type="number" class="form-control" id="spread" aria-describedby="Enter Spread" placeholder="Enter Spread">
    </div>
    <div class="form-group col-md-4">
      <label for="weekday">Weekday</label>
      <select class="form-control" id="weekday">
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
        <option>Sunday</option>
        <option>Monday</option>
      </select>
    </div>
    
    <div class="form-group col-md-2">
      <label for="date">
       Date
      </label>
      <div>
       <div class="input-group">
        <input class="form-control" id="date" id="date" placeholder="MM/DD/YYYY" type="text"/>
       </div>
      </div>
     </div>
    
    <div class="form-group col-md-3">
      <label for="spread">Time</label>
      <input type="text" class="form-control" id="time" aria-describedby="Enter Time" placeholder="Enter Time">
    </div>
    
    <div class="form-group col-md-12">
      <label for="spread">Week Number</label>
      <input type="number" class="form-control" id="week" aria-describedby="Enter Week Number" placeholder="Enter Week Number">
    </div>
    <div class="col-md-12">
      <button onClick="saveGame()" class="btn btn-primary">Submit</button>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'mm/dd/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>