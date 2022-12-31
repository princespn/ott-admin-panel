function only_number(event)
{
  var x = event.which || event.keyCode;
  if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13)
  {
    return;
  }else{
    event.preventDefault();
  }    
}

function validBonus() {
	var playGame      = $('#playGame').val().trim();
	var bonus = $('#bonus').val().trim();
	if(playGame == '') {
		$("#errplayGame").html('Please enter game');
		setTimeout(function(){ $("#errplayGame").html(''); },3000);
		$('#playGame').focus();
		return false;
	}else if (playGame == 0) {
		$("#errplayGame").html('Enter game can not set to zero');
		setTimeout(function(){ $("#errplayGame").html(''); },3000);
		$('#playGame').focus();
		return false;
	}
	
	if(bonus == '') {
		$("#errbonus").html('Please enter apply bonus');
		setTimeout(function(){ $("#errbonus").html(''); },3000);
		$('#bonus').focus();
		return false;
	}else if(bonus == 0) {
		$("#errbonus").html('Apply bonus can not set to zero');
		setTimeout(function(){ $("#errbonus").html(''); },3000);
		$('#bonus').focus();
		return false;
	}
}

