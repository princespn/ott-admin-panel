function Validate()
{
  var player = $("#player").val().trim();
  var id = $("#id").val();
  var button = $("#button").val();
  var site_url = $("#site_url").val();
  if(player == '')
  {
    $("#errPlayer").fadeIn().html("Please enter player");
    setTimeout(function(){$("#errPlayer").html("&nbsp;");},5000)
    $("#player").focus();
    return false; 
  }

  if(player == 0)
  {
    $("#errPlayer").fadeIn().html("Please enter valid player");
    setTimeout(function(){$("#errPlayer").html("&nbsp;");},5000)
    $("#player").focus();
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
    var url = site_url+"/Players/statusChange";
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
    var url = site_url+"/Players/deleteAction";
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