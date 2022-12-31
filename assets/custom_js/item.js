function validateItem()
{
  var itemName = $("#itemName").val().trim();
  var itemPrice = $("#itemPrice").val().trim();
  var id = $("#id").val();
  var button = $("#button").val();
  var site_url = $("#site_url").val();

  if(itemName == '')
  {
    $("#erritemName").fadeIn().html("Please enter name.");
    setTimeout(function(){$("#erritemName").html("&nbsp;");},5000)
    $("#itemName").focus();
    return false; 
  }

  if(itemPrice == '')
  {
    $("#erritemPrice").fadeIn().html("Please enter price");
    setTimeout(function(){$("#erritemPrice").html("&nbsp;");},5000)
    $("#itemPrice").focus();
    return false; 
  }

  if(itemPrice == 0)
  {
    $("#erritemPrice").fadeIn().html("Please enter valid Price");
    setTimeout(function(){$("#erritemPrice").html("&nbsp;");},5000)
    $("#itemPrice").focus();
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
    var url = site_url+"/Items/statusChange";
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
    var url = site_url+"/Items/deleteAction";
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