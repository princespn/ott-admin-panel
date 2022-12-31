function validateCustomDice()
{
  var diceName = $("#diceName").val().trim();
  var dicePrice = $("#dicePrice").val().trim();
  var counter = $("#counter").val().trim();
  var id = $("#id").val();
  var button = $("#button").val();
  var site_url = $("#site_url").val();

  if(diceName == '')
  {
    $("#errdiceName").fadeIn().html("Please enter name.");
    setTimeout(function(){$("#errdiceName").html("&nbsp;");},5000)
    $("#diceName").focus();
    return false; 
  }

  if(dicePrice == '')
  {
    $("#errdicePrice").fadeIn().html("Please enter price");
    setTimeout(function(){$("#errdicePrice").html("&nbsp;");},5000)
    $("#dicePrice").focus();
    return false; 
  }

  if(dicePrice == 0)
  {
    $("#errdicePrice").fadeIn().html("Please enter valid Price");
    setTimeout(function(){$("#errdicePrice").html("&nbsp;");},5000)
    $("#dicePrice").focus();
    return false; 
  }

  if(counter == '')
  {
    $("#errcounter").fadeIn().html("Please enter counter.");
    setTimeout(function(){$("#errcounter").html("&nbsp;");},5000)
    $("#counter").focus();
    return false; 
  }


}

function only_number(event)
{ 
    var x = event.which || event.keyCode;
    if((x >= 48 ) && (x <= 57 ) || x == 46 || x == 8 || x == 9 || x == 13 )
    {
        return;
    }
    else
    {
        event.preventDefault();
    }

}

function statusChange($id)
{ 
  $("#Statusmodal").modal('show');
  $("#statusSuccBtn").click(function(){
    var site_url = $("#site_url").val();
    var url = site_url+"/CustomDice/statusChange";
    var datastring = "id="+$id+"&"+csrfName+"="+csrfHash;
    $.post(url,datastring,function(response){
      $("#Statusmodal").modal('hide');
      $("#Statusmodal").load(location.href+" #Statusmodal>*","");
      var obj   = JSON.parse(response);
      csrfName = obj.csrfName;
      csrfHash = obj.csrfHash;
      table.draw();
      $("#msgData").val(obj.msg);
      $("#toast-fade").click();
    });
  });
}

function deleteRow($id)
{
  $("#Deletemodal").modal('show');
  $("#deleteSuccBtn").click(function(){
    var site_url = $("#site_url").val();
    var url = site_url+"/CustomDice/deleteAction";
    var datastring = "id="+$id+"&"+csrfName+"="+csrfHash;
    $.post(url,datastring,function(response){
      $("#Deletemodal").modal('hide');
      $("#Deletemodal").load(location.href+" #Deletemodal>*","");
      var obj   = JSON.parse(response);
      csrfName = obj.csrfName;
      csrfHash = obj.csrfHash;
      table.draw();
      $("#msgData").val(obj.msg);
      $("#toast-fade").click();
    });
  });
}