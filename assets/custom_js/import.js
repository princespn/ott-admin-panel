 function validations()
  {
    var excel_file = $("#excel_file").val().trim();
    var ext = excel_file.substring(excel_file.lastIndexOf('.') + 1);
    if(excel_file.trim()=="")
    {
      // alert('hi');
       $("#err_excel_file").fadeIn().html("Required");
       setTimeout(function(){$("#err_excel_file").fadeOut("&nbsp");},3000)
       $("#excel_file").focus();
       return false;
    }
    if(!(ext=='xlsx'))
     {
        $("#err_excel_file").fadeIn().html("Please select valid xlsx format.");
        $("#excel_file").css("border-color", "red");
                  
        setTimeout(function(){$("#err_excel_file").fadeOut();},3000);
        $("#excel_file").focus();
        return false; 
     } 
  }