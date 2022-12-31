 
   function valid(){
    var user_name = $("#user_name").val().trim();
    var country_name = $("#country_name").val();
    var balance = $("#balance").val();
    var profile_img = $("#profile_img").val();
    var button = $('#button').val();

    if(user_name == '')
    {
      $("#user_name_err").fadeIn().html("Please enter user name.");
      setTimeout(function(){$("#user_name_err").html("&nbsp;");},3000);
      $("#user_name").focus();
      return false;
    }

    if(country_name == '')
    {
      $("#country_name_err").fadeIn().html("Please enter country name.");
      setTimeout(function(){$("#country_name_err").html("&nbsp;");},3000);
      $("#country_name").focus();
      return false;
    }

    if(balance == '')
    {
      $("#balance_err").fadeIn().html("Please enter balance.");
      setTimeout(function(){$("#balance_err").html("&nbsp;");},3000);
      $("#balance").focus();
      return false;
    }

    if (button== 'Create') {
    if(profile_img == '')
    {
      $("#profile_img_err").html("Please select profile image.").fadeIn('1000').delay(1000).fadeOut('1000');  
      $("#profile_img").focus();
      return false;
    }
  }

  }

    function only_number(event)
{
  var x = event.which || event.keyCode;
  console.log(x);
  if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13)
  {
    return;
  }else{
    event.preventDefault();
  }    
}
 

   function ImageFile(){

  $('#profile_img').change(function () {  
      var files = this.files;   
      var reader = new FileReader();
      profile_img=this.value;  
      //validation for photo upload type    
      var filetype = profile_img.split(".");
      ext = filetype[filetype.length-1];  //alert(ext);return false;
      //alert(ext);return false;
      if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG') && !(ext=='JPG'))
      { 
        $("#profile_img_err").html("Please select proper type like jpg, png, jpeg image.").fadeIn('1000').delay(1000).fadeOut('1000');  
        $("#profile_img").focus();
        $("#profile_img").val("");
        return false;
      }
    reader.readAsDataURL(files[0]);
    });

  }  
