function Validate()
{
  var title = $("#title").val();
  var setInOrders = $("#setInOrders").val();
  var image = $("#image").val();
  var type = $('input[name="type[]"]:checked').length > 0;
  var id = $("#id").val();
  var button = $("#button").val();
  var site_url = $("#site_url").val();
  if(title.trim() == '') {
      $("#errtitle").fadeIn().html("Please enter title");
      setTimeout(function(){$("#errtitle").html("&nbsp;");},5000)
      $("#title").focus();
      return false; 
  }

  if(setInOrders.trim() == '') {
      $("#errSetInOrders").fadeIn().html("Please set orders");
      setTimeout(function(){$("#errSetInOrders").html("&nbsp;");},5000)
      $("#setInOrders").focus();
      return false; 
  }

  if(setInOrders.trim() == 0) {
      $("#errSetInOrders").fadeIn().html("Please set valid orders");
      setTimeout(function(){$("#errSetInOrders").html("&nbsp;");},5000)
      $("#setInOrders").focus();
      return false; 
  }
  if(id=='0') {
    if(image.trim()=="")            
    {
        $("#errimage").fadeIn().html("Please select payment process image");
        setTimeout(function(){$("#errimage").html("&nbsp;");},8000)
        $("#image").focus();
        return false;
    }
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

function imageFile()
{ 
  $('#image').change(function () {  
    var files = this.files;   
    var reader = new FileReader();
    image=this.value;  
    //validation for photo upload type    
    var filetype = image.split(".");
    ext = filetype[filetype.length-1];  //alert(ext);return false;
    //alert(ext);return false;
    if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG') && !(ext=='JPG'))
    { 
      $("#errimage").fadeIn().html("Please select proper type like jpg, png, jpeg image");   
      setTimeout(function(){$("#errimage").html("&nbsp;")},3000);
      $("#image").val("");
      return false;
    }
  reader.readAsDataURL(files[0]);
  });
}

function deleteRow(id)
{
  $("#Deletemodal").modal('show');
  $("#deleteSuccBtn").click(function(){
    var site_url   = $("#site_url").val();
    var url        =  site_url+"/PaymentProcess/deleteAction";
    var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
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