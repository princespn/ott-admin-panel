function Validate()
{
  var value = $("#value").val().trim();

  if(value == '')
  {
    $("#errValue").fadeIn().html("Please enter value");
    setTimeout(function(){$("#errValue").html("&nbsp;");},3000)
    $("#value").focus();
    return false; 
  }

  if(value == 0)
  {
    $("#errValue").fadeIn().html("Please enter valid value");
    setTimeout(function(){$("#errValue").html("&nbsp;");},3000)
    $("#value").focus();
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
    var url = site_url+"/Values/statusChange";
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
    var url = site_url+"/Values/deleteAction";
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