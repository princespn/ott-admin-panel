
function valid(){

  var showIn = $('.showIn').is(":checked"); 
  //alert(showIn); 
  var title = $("#title").val().trim();
  var description =CKEDITOR.instances.description.getData();
  var title_filter =/^[a-zA-Z ]+$/;

    if(title.trim() ==''){ 
      $("#title_err").fadeIn().html("Please Enter Title.");
        setTimeout(function(){$("#title_err").html("&nbsp;");},3000)
        $("#title").focus();
        return false;
    }
    else if(!title_filter.test(title)){
    $("#title_err").fadeIn().html("Please Enter Valid Title.");
    setTimeout(function(){$("#title_err").html("&nbsp;");},3000)
    $("#title").focus();
    return false;
    }
     
      if(showIn == false){
        $("#showInerr").fadeIn().html("Please Enter showIn.");
        setTimeout(function(){$("#showInerr").html("");},3000);
        $(".showIn").focus();    
        return false;
  }

    if(description==''){ 
        $("#description_err").fadeIn().html("Please Enter Description.");
        setTimeout(function(){$("#description_err").html("");},3000);
        $("#description").focus();    
        return false;
    }

    
  

  
    
}

function deleteRow($id){
	$("#Deletemodal").modal('show');
	$("#deleteSuccBtn").click(function(){
		var site_url = $("#site_url").val();
		var url=site_url+"/Cms/deleteAction";
		var datastring = "id="+$id+"&"+csrfName+"="+csrfHash;
		$.post(url,datastring,function(response){
			$("#Deletemodal").modal('hide');
			$("#Deletemodal").load(location.href+" #Deletemodal>*","");
         var obj = JSON.parse(response);
         csrfName= obj.csrfName;
         csrfHash= obj.csrfHash;
         table.draw();
         $("#msgData").val(obj.msg);
         $("#toast-fade").click();
		});
	});
}