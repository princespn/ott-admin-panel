function validTournament() 
{
	var name = $('#name').val();
	var betAmt = $('#betAmt').val();
	var winningAmt = $('#winningAmt').val();
	var noOfPlayers = $('#noOfPlayers').val();
	var round = $('#round').val();
	var startTime = $('#startTime').val();
	var commision = $('#commision').val();


	if(name.trim() == '')
    {
      $("#errName").fadeIn().html("Please enter name.");
      setTimeout(function(){$("#errName").html("&nbsp;");},3000)
      $("#name").focus();
      return false;
    }
   
	if(betAmt.trim() == '')
    {
      $("#errbetAmt").fadeIn().html("Please enter Bet Amount.");
      setTimeout(function(){$("#errbetAmt").html("&nbsp;");},3000)
      $("#betAmt").focus();
      return false;
    }


    if(winningAmt.trim() == '')
    {
      $("#errwinningAmt").fadeIn().html("Please enter Winning Amount.");
      setTimeout(function(){$("#errwinningAmt").html("&nbsp;");},3000)
      $("#winningAmt").focus();
      return false;
    }

    if(noOfPlayers.trim() == '')
    {
      $("#errnoOfPlayers").fadeIn().html("Please enter Players.");
      setTimeout(function(){$("#errnoOfPlayers").html("&nbsp;");},3000)
      $("#noOfPlayers").focus();
      return false;
    }

    if(round.trim() == '')
    {
      $("#errround").fadeIn().html("Please enter Round.");
      setTimeout(function(){$("#errround").html("&nbsp;");},3000)
      $("#round").focus();
      return false;
    }

     if(startTime.trim() == '')
    {
      $("#errstartTime").fadeIn().html("Please enter Start Time.");
      setTimeout(function(){$("#errstartTime").html("&nbsp;");},3000)
      $("#startTime").focus();
      return false;
    }

     if(commision.trim() == '')
    {
      $("#errcommision").fadeIn().html("Please enter Commision.");
      setTimeout(function(){$("#errcommision").html("&nbsp;");},3000)
      $("#commision").focus();
      return false;
    }


}