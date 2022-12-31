function only_number(event)
{
  var x = event.which || event.keyCode;
  console.log(x);
  if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 || x== 46)
  {
    return;
  }else{
    event.preventDefault();
  }    
}
function validate()
{
    var button   = $('#button').val();
    var isPrivate   = $('#isPrivate').val();
    var mode      = $('#mode').val();
    var room           = $('#room').val();
    var players       = $('#players').val();
    var commision      = $('#commision').val();
    // var betValue       = $('#betValue').val();
    var entryFee       = $('#entryFee').val();
    var startRoundTime = $('#startRoundTime').val();
    var tokenMoveTime  = $('#tokenMoveTime').val();
    var rollDiceTime   = $('#rollDiceTime').val();
    var minimum   = $('#minimum').val();
    var maximum   = $('#maximum').val();


    if(isPrivate == '')
    {
      $("#errisPrivate").fadeIn().html("Please select isPrivate.");
      setTimeout(function(){$("#errisPrivate").html("&nbsp;");},3000);
      $("#isPrivate").focus();
      return false;
    }

    if(isPrivate=='No'){
      if(mode == '')
      {
        $("#errMode").fadeIn().html("Please select mode.");
        setTimeout(function(){$("#errMode").html("&nbsp;");},3000);
        $("#mode").focus();
        return false;
      }
    }

    

    if(room.trim() == '')
    {
      $("#errRoom").fadeIn().html("Please enter room.");
      setTimeout(function(){$("#errRoom").html("&nbsp;");},3000);
      $("#room").focus();
      return false;
    }

     if(players == '')
    {
      $("#errplayers").html("Please select playerss.");
      setTimeout(function(){$("#errplayers").html("&nbsp;");},3000);
      $("#players").focus();
      return false;
    }

    if(commision.trim() == '')
    {
      $("#errComm").fadeIn().html("Please enter commission.");
      setTimeout(function(){$("#errComm").html("&nbsp;");},3000);
      $("#commision").focus();
      return false; 
    }

   
    if(entryFee.trim() == '')
    {
      $("#errentryFee").fadeIn().html("Please enter entry fee.");
      setTimeout(function(){$("#errentryFee").html("&nbsp;");},3000);
      $("#entryFee").focus();
      return false; 
    }
   

    if(startRoundTime.trim() == '')
    {
      $("#errstartRoundTime").fadeIn().html("Please enter start round time.");
      setTimeout(function(){$("#errstartRoundTime").html("&nbsp;");},3000);
      $("#startRoundTime").focus();
      return false; 
    }

    if(startRoundTime > 60)
    {
      $("#errstartRoundTime").fadeIn().html("Please enter start round time between 0 to 60.");
      setTimeout(function(){$("#errstartRoundTime").html("&nbsp;");},3000);
      $("#startRoundTime").focus();
      return false; 
    }

    if(tokenMoveTime.trim() == '')
    {
      $("#errtokenMoveTime").fadeIn().html("Please enter token move time.");
      setTimeout(function(){$("#errtokenMoveTime").html("&nbsp;");},3000);
      $("#tokenMoveTime").focus();
      return false; 
    }

    if(tokenMoveTime > 60)
    {
      $("#errtokenMoveTime").fadeIn().html("Please enter token move time between 0 to 60.");
      setTimeout(function(){$("#errtokenMoveTime").html("&nbsp;");},3000);
      $("#tokenMoveTime").focus();
      return false; 
    }

    if(rollDiceTime.trim() == '')
    {
      $("#errrollDiceTime").fadeIn().html("Please enter token move time.");
      setTimeout(function(){$("#errrollDiceTime").html("&nbsp;");},3000);
      $("#rollDiceTime").focus();
      return false; 
    }

    if(rollDiceTime > 60)
    {
      $("#errrollDiceTime").fadeIn().html("Please enter token move time between 0 to 60.");
      setTimeout(function(){$("#errrollDiceTime").html("&nbsp;");},3000);
      $("#rollDiceTime").focus();
      return false; 
    }
}
