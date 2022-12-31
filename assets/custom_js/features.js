function valid()
  {
    var title = $('#title').val();
    var image = $('#image').val();
    var old_photo = $('#old_photo').val();
    var button = $('#button').val();
   
	if(title.trim() == '')
	{
		$("#errtitle").fadeIn().html("Please enter Title.");
		setTimeout(function(){$("#title").html("&nbsp;");},3000)
		$("#title").focus();
		return false;
	}
	if (button== 'Create') {
		if(image == '')
		{
			$("#errimage").fadeIn().html("Please Select Image.");
			setTimeout(function(){$("#image").html("&nbsp;");},3000)
			$("#image").focus();
			return false;
		}
	}

	// if (button == 'Update') {
 //            if(image=="" && (old_photo=="" || old_photo == undefined))
 //            {
 //              $("#err_image").fadeIn().html("Please select image");
 //              setTimeout(function(){$("#err_image").fadeOut("&nbsp");},3000)
 //              $("#image").focus();
 //              return false;
 //            }
 //          }
  }

  function ImageFile(){

  $('#image').change(function () { 
  var files = this.files;   
  var reader = new FileReader();
  name=this.value;    
  //validation for photo upload type    
  var filetype = name.split(".");
  ext = filetype[filetype.length-1];  //alert(ext);return false;
  if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG') && !(ext=='JPG'))
  { 
  $("#errimage").html("Please select only jpg, png, jpeg image");   
  setTimeout(function(){$("#errimage").html("&nbsp;")},3000);
  $("#image").val("");
  return false;
  }
  reader.readAsDataURL(files[0]);
  });

  }  

function deleteRow($id){
	$("#Deletemodal").modal('show');
	$("#deleteSuccBtn").click(function(){
		var site_url = $("#deleteUrl").val();
		var url=site_url;
		var datastring = "id="+$id+"&"+csrfName+"="+csrfHash;
		$.post(url,datastring,function(response){
			$("#Deletemodal").modal('hide');
			$("#Deletemodal").load(location.href+" #Deletemodal>*","");
         var obj =JSON.parse(response);
         csrfName=obj.csrfName;
         csrfHash=obj.csrfHash;
         table.draw();
         $("#msgData").val(obj.msg);
         $("#toast-fade").click();
		});
	});
}