  function valid(){ 
   
    var logo      =$('#logo').val();
    var sitetitle = $('#sitetitle').val();
    var companyName = $('#companyName').val();
    var address = $('#address').val();
    var email   = $('#email1').val();
    // var email2  = $('#email2').val();
    var apk     = $('#apk').val();
    var version     = $('#version').val();
    var copyright =$('#copyright').val();
    var contact_us =$('#contact_us').val();
    var website =$('#website').val();
    var topPlayerLimit =$('#topPlayerLimit').val();
    //var adminPercent =$('#adminPercent').val();
    var baseUrl =$('#baseUrl').val();
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var referralBonus =$('#referralBonus').val();

    
    if(sitetitle.trim() == ''){
        $("#errsite_title").fadeIn().html("Please enter site.");
        setTimeout(function(){$("#errsite_title").html("&nbsp;");},3000)
        $("#sitetitle").focus();
        return false;
     }

    if(companyName.trim() == ''){
        $("#errcompanyName").fadeIn().html("Please enter company name.");
        setTimeout(function(){$("#errcompanyName").html("&nbsp;");},3000)
        $("#companyName").focus();
        return false;
     }
       
    if(address.trim() == ''){
        $("#erraddress").fadeIn().html("Please enter address.");
        setTimeout(function(){$("#erraddress").html("&nbsp;");},3000)
        $("#address").focus();
        return false;
    } 
       
    if(email.trim() == ''){
        $("#erremail1").fadeIn().html("Please enter email.");
        setTimeout(function(){$("#erremail1").html("&nbsp;");},3000)
        $("#email1").focus();
        return false;
    }else if(!emailPattern.test(email)){
        $("#erremail1").fadeIn().html("Please enter valid email.");
        setTimeout(function(){$("#erremail1").html("&nbsp;");},3000)
        $("#email1").focus();
        return false; 
    }

       // if(email2.trim() == ''){ 
    //     $("#erremail2").fadeIn().html("Please Enter email.");
    //     setTimeout(function(){$("#erremail2").html("&nbsp;");},3000);
    //     $("#email2").focus();    
    //     return false;

    //  }else if(!emailPattern.test(email2))
    // {
    //     $("#erremail2").fadeIn().html("Please enter valid email.");
    //     setTimeout(function(){$("#erremail2").html("&nbsp;");},3000)
    //     $("#email2").focus();
    //     return false; 
    // }


    //     if(apk.trim() == ''){
    //     $("#errapk").fadeIn().html("Please select apk file.");
    //     setTimeout(function(){$("#errapk").html("&nbsp;");},3000)
    //     $("#apk").focus();
    //     return false;
    // }

      
    if(version.trim() == ''){
        $("#errversion").fadeIn().html("Please enter version.");
        setTimeout(function(){$("#errversion").html("&nbsp;");},3000)
        $("#version").focus();
        return false;
    }

    if(contact_us.trim() == ''){
        $("#errcontact_us").fadeIn().html("Please enter contact us.");
        setTimeout(function(){$("#errcontact_us").html("&nbsp;");},3000)
        $("#contact_us").focus();
        return false;
    }


    if(copyright.trim() == ''){
        $("#errcopyright").fadeIn().html("Please enter copyright.");
        setTimeout(function(){$("#errcopyright").html("&nbsp;");},3000)
        $("#copyright").focus();
        return false;
    }

    if(website.trim() == ''){
        $("#errwebsite").fadeIn().html("Please enter website.");
        setTimeout(function(){$("#errwebsite").html("&nbsp;");},3000)
        $("#website").focus();
        return false;
    }

    if(topPlayerLimit.trim() == ''){
        $("#errtopPlayerLimit").fadeIn().html("Please enter top player limit.");
        setTimeout(function(){$("#errtopPlayerLimit").html("&nbsp;");},3000)
        $("#topPlayerLimit").focus();
        return false;

    }else if(topPlayerLimit == 0 ) {
        $("#errtopPlayerLimit").fadeIn().html("Please enter limit should be greater than zero.");
        setTimeout(function(){$("#errtopPlayerLimit").html("&nbsp;");},3000)
        $("#topPlayerLimit").focus();
        return false; 
    }

    /*if(adminPercent.trim() == ''){
        $("#erradminPercent").fadeIn().html("Please enter admin percent.");
        setTimeout(function(){$("#erradminPercent").html("&nbsp;");},3000)
        $("#adminPercent").focus();
        return false;

    }*//*else if(adminPercent == 0 ) {
        $("#erradminPercent").fadeIn().html("Please enter limit should be greater than zero.");
        setTimeout(function(){$("#erradminPercent").html("&nbsp;");},3000)
        $("#adminPercent").focus();
        return false; 
    }
*/
    if(baseUrl.trim() == ''){
        $("#errbaseUrl").fadeIn().html("Please enter base url.");
        setTimeout(function(){$("#errbaseUrl").html("&nbsp;");},3000)
        $("#baseUrl").focus();
        return false;

    }

    if(referralBonus.trim() == ''){
        $("#errreferralBonus").fadeIn().html("Please enter referral bonus.");
        setTimeout(function(){$("#errreferralBonus").html("&nbsp;");},3000)
        $("#referralBonus").focus();
        return false;
    }else if(referralBonus == 0 ) {
        $("#errreferralBonus").fadeIn().html("Please enter bonus should be greater than zero.");
        setTimeout(function(){$("#errreferralBonus").html("&nbsp;");},3000)
        $("#referralBonus").focus();
        return false; 
    }
    
}

function only_number(event)
        {
            var x = event.which || event.keyCode;
            console.log(x);
            if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13 )
            {
                return;
            }else{
                event.preventDefault();
            }    
        }

function logoFile()

{    
   $('#logo').change(function () {  
  var files = this.files;   
  var reader = new FileReader();
  name=this.value;    
  //validation for photo upload type    
  var filetype = name.split(".");
  ext = filetype[filetype.length-1];  //alert(ext);return false;
  if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG') && !(ext=='JPG'))
  { 
  $("#err_logo").html("Please select only jpg, png, jpeg image");   
  setTimeout(function(){$("#err_logo").html("&nbsp;")},3000);
  $("#logo").val("");
  return false;
  }
  reader.readAsDataURL(files[0]);
  });
}

function gamefileapk()
{
  $('#apk').change(function () { 
  var files = this.files; 
  var sizes = this.files[0].size; 
  var size = sizes/(1024*1024);   
  var reader = new FileReader();
  name=this.value;    
  //validation for photo upload type    
  var filetype = name.split(".");
  ext = filetype[filetype.length-1]; 

  if(ext!='apk')
  {
      $("#errapk").html("please select apk file only");
      setTimeout(function(){$("#errapk").html("&nbsp;")},5000);
      $("#apk").val("");
      return false;      
  }
  reader.readAsDataURL(files[0]);  
  });
}

function homeVideoFile()
{
  $('#videoUrl').change(function () {  
  var files = this.files;   
  var reader = new FileReader();
  image=this.value;  
  //validation for photo upload type    
  var filetype = image.split(".");
  ext = filetype[filetype.length-1];  //alert(ext);return false;
  //alert(ext);return false;
  if(!(ext=='mp4') && !(ext=='avi') && !(ext=='mkv') && !(ext=='wmv'))
  { 
    $("#err_videoUrl").fadeIn().html("Please select proper type like mp4, avi, wmv video");   
    setTimeout(function(){$("#err_videoUrl").html("&nbsp;")},3000);
    $("#videoUrl").val("");
    return false;
  }
  reader.readAsDataURL(files[0]);
});
}