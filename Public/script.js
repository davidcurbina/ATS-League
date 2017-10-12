$(document).ready(function() {
  var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
      format: 'mm/dd/yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
  date_input.datepicker(options);

  $(".btn-pref .btn").click(function () {
      $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
      // $(".tab").addClass("active"); // instead of this do the below 
      $(this).removeClass("btn-default").addClass("btn-primary"); 
  });

  $( "#makePicks" ).click(function() {
    localStorage.removeItem("picks");
    $.ajax({
            url: "http://"+window.location.host+"/ATS/results.php?var=makePicks"
          }).done(function(data) { // data what is sent back by the php page
           $('#mainBody').html(data); // display data
      });

    document.getElementById("headerValue").innerHTML = "Weekly Picks <small>Overview</small>";
  });

  $( "#create" ).click(function() {
    $.ajax({
        url: "http://"+window.location.host+"/ATS/create.php"
      }).done(function(data) { // data what is sent back by the php page
      $('#mainBody').html(data); // display data
    });

    document.getElementById("headerValue").innerHTML = "Admin Portal";
  });
  $( "#makePicks" ).trigger( "click" );
});

function searchGenre(genre){
     $.ajax({
              url: "http://localhost:8888/dbFinal/results.php?var=genre&count="+document.getElementById("itemsDisplayed").value+"&term="+genre
            }).done(function(data) { // data what is sent back by the php page
             $('#genreResults').html(data); // display data
            var divLoc = $('#resultText').offset();
            $('html, body').animate({scrollTop: divLoc.top}, "slow");
    });
};

function searchTerm(term){
    document.getElementById("searchTerm").value = term;
    $("#search").trigger( "click" );
};
        
function savePicks(){
  var savedPicks = JSON.parse(localStorage.getItem("picks"));
  var message = {
    data:savedPicks,
    type:"savePicks"
  };
  if(savedPicks == null){
    alert("No picks to save! Please make picks!");
  } else {
    $.ajax({
     type: "POST",
     url: "http://"+window.location.host+"/ATS/save.php",
     data: JSON.stringify(message),
     contentType: "application/json; charset=utf-8",
     dataType: "json",
    })
    .always(function() { 
      $( "#makePicks" ).trigger( "click" );
    });
  }
};

function savePick(iGameID, iChoice){
    var savedPicks = JSON.parse(localStorage.getItem("picks"));
    if(savedPicks == null){
      savedPicks = [];
    }
    var pick = {gameID:iGameID, choice:iChoice};
    var index = -1;
    for(var i=0; i < savedPicks.length; i++){
      console.log(savedPicks[i]["gameID"]);
      console.log(pick["gameID"]);
      if(savedPicks[i]["gameID"] == pick["gameID"]){
        index = i;
      }
      console.log("Found");
    }
  if(index == -1){
    savedPicks.push(pick);
  } else {
    if(savedPicks[index]["choice"] == pick["choice"]){
      savedPicks.splice(index,1);
     } else {
      var x = pick["choice"] == "home" ? "away" : "home";
      document.getElementById(x+iGameID).checked = false;
      savedPicks[index]["choice"] = pick["choice"];
     }
  }
  
  localStorage.setItem("picks", JSON.stringify(savedPicks));
};
        
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function saveGame(){
  var homeTeam = document.getElementById("homeTeam").value;
  var awayTeam = document.getElementById("awayTeam").value;
  var pWinner = document.getElementById("pWinner").value;
  var spread = document.getElementById("spread").value;
  var time = document.getElementById("time").value;
  var weekday = document.getElementById("weekday").value;
  var week = document.getElementById("week").value;
  var date = document.getElementById("date").value;

  var team = {
    homeTeam:homeTeam,
    awayTeam:awayTeam,
    pWinner:pWinner,
    spread:spread,
    time:time,
    weekday:weekday,
    week:week,
    date:date
  };

  var message = {
    data:team,
    type:"createGame"
  }; 
// AJAX Code To Submit Form.

  $.ajax({
      type: "POST",
      url: "http://"+window.location.host+"/ATS/save.php",
      data: JSON.stringify(message),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      error: function() {
        alert("Error");
      },
      success: function(data) {
        
        document.getElementById("homeTeam").value = "";
        document.getElementById("awayTeam").value = "";
        document.getElementById("pWinner").value = "";
        document.getElementById("spread").value = "";
        document.getElementById("time").value = "";
        document.getElementById("weekday").value = "";
        document.getElementById("week").value = "";
        document.getElementById("date").value = "";
        alert("Success!");
      },
  });
  
}
