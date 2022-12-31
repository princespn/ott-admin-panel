function submitNotification() {
  var notification = $("#notification").val();
  var site_url = $("#site_url").val();

  if(notification == '') {
    $("#msgHide").html('Please enter notification').css('color','red');
    setTimeout(function(){ $("#msgHide").html(''); },3000);
    $("#notification").focus();
    return false;
  }

  var url = site_url+'/Notifications/createNotification';
  var datastring = 'notification='+notification+"&"+csrfName+"="+csrfHash;
  $.ajax({
    type    : 'post',
    url     : url,
    data    : datastring,
    catche  : false,
    success : function(returnData) {
      $("#notification").val('');
      var obj = JSON.parse(returnData);
      csrfName = obj.csrfName;
      csrfHash = obj.csrfHash;
      table.draw();
      $("#msgData").val(obj.msg);
      $("#toast-fade").click();
    }
  });
}

function getNotify(id){
  var site_url = $('#site_url').val();
  var url = site_url+"/Notifications/getNotify";
  var dataString = "id="+id+"&"+csrfName+"="+csrfHash;
  $.post(url,dataString,function(returndata)
  { 
    var obj = JSON.parse(returndata);
    csrfName = obj.csrfName;
    csrfHash = obj.csrfHash;
    $("#notifyBody").html(obj.returnhtml);
  });
}