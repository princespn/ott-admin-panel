$(document).on('keypress',function(e) {
    if(e.which == 13) {
        login_validate();
    }
});

function login_validate()
{
	console.log('alalal');
	var email = $("#email").val();
	var password = $("#password").val();
	var email_filter = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;
	var loginAction = $("#loginAction").val();
	var dashboard = $("#dashboard").val();

	if(email.trim() == '')
	{
		$("#errmsg").addClass('error');
        $("#errmsg").fadeIn().html("Please enter email.");
        setTimeout(function(){ $("#errmsg").removeClass('error'); $("#errmsg").html("&nbsp;");},3000)
        $("#email").focus();
        return false; 
	}
	else if(!email_filter.test(email))
	{
		$("#errmsg").addClass('error');
        $("#errmsg").fadeIn().html("Please enter valid email.");
        setTimeout(function(){ $("#errmsg").removeClass('error'); $("#errmsg").html("&nbsp;");},3000)
        $("#email").focus();
        return false; 
	}

	if(password.trim() == '')
	{
		$("#errmsg").addClass('error');
        $("#errmsg").fadeIn().html("Please enter password.");
        setTimeout(function(){ $("#errmsg").removeClass('error'); $("#errmsg").html("&nbsp;");},3000)
        $("#password").focus();
        return false; 
	}

	var url = loginAction;
	var datastring = "email="+email+"&password="+password+"&"+csrfName+"="+csrfHash;
	
	$.post(url,datastring,function(response){
		var obj = JSON.parse(response);
		csrfName = response.csrfName;
		csrfHash = response.csrfHash;
		
		if(obj.success == 1)
		{
			window.location = dashboard; 
		}
		else if(obj.success == 2)
		{
			$("#errmsg").addClass('error');
	        $("#errmsg").fadeIn().html("Status is Inactive");
	        setTimeout(function(){ $("#errmsg").removeClass('error'); $("#errmsg").html("&nbsp;");},3000)
	        $("#email").focus();
	        return false;
		}
		else if(obj.success == 3)
		{
			$("#errmsg").addClass('error');
	        $("#errmsg").fadeIn().html("Invalid Credentials");
	        setTimeout(function(){ $("#errmsg").removeClass('error'); $("#errmsg").html("&nbsp;");},3000)
	        $("#email").focus();
	        return false;
		}
	});

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

function get_img()
{
  $("#profile_image").click();
}

function profileValidation()
{
  	var name =$("#name").val();
	var email =$("#email").val();
	var filter = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;

	if(name =='')
	{
		$("#profile_error").fadeIn().html("Please enter name");
		setTimeout(function(){$("#profile_error").html("&nbsp;");},3000)
		$("#name").focus();
		return false;       
	}
	if(email =='')
	{
		$("#profile_error").fadeIn().html("Please enter email");
		setTimeout(function(){$("#profile_error").html("&nbsp;");},3000)
		$("#email").focus();
		return false;       
	}
	else if(!filter.test(email))
	{
		$("#profile_error").fadeIn().html("Please enter valid email");
		setTimeout(function(){$("#profile_error").html("&nbsp;");},3000)
		$("#email").focus();
		return false;
	}
}

function ChangePassValidation()
{
	var currentPass = $("#currentPass").val();
	var newPass = $("#newPass").val();
	var confirmPass = $("#confirmPass").val();
	var site_url = $("#site_url").val();
	var chnpass = $("#chnpass").val();
	var dashboard = $("#dashboard").val();

	if(currentPass =='')
	{
		$("#pass_error").fadeIn().html("Please enter your current password");
		setTimeout(function(){$("#pass_error").html("&nbsp;");},3000)
		$("#currentPass").focus();
		return false;       
	}

	if(newPass =='')
	{
		$("#pass_error").fadeIn().html("Please enter your new password");
		setTimeout(function(){$("#pass_error").html("&nbsp;");},3000)
		$("#newPass").focus();
		return false;       
	}

	if(confirmPass =='')
	{
		$("#pass_error").fadeIn().html("Please enter your confirm password");
		setTimeout(function(){$("#pass_error").html("&nbsp;");},3000)
		$("#confirmPass").focus();
		return false;       
	}

	if(newPass != confirmPass)
	{
		$("#pass_error").fadeIn().html("New password and confirm password should be same");
		setTimeout(function(){$("#pass_error").html("&nbsp;");},3000)
		$("#confirmPass").focus();
		return false;       
	}

	var url = chnpass;
	var datastring = "currentPass="+currentPass+"&newPass="+newPass+"&confirmPass="+confirmPass+"&"+csrfName+"="+csrfHash;
	$.post(url,datastring,function(response){
		var obj = JSON.parse(response);
		csrfName = response.csrfName;
		csrfHash = response.csrfHash;
		if(obj.success == 1)
		{
			window.location = dashboard;
		}
		else
		{
			$("#pass_error").fadeIn().html("Current password is not valid");
			setTimeout(function(){$("#pass_error").html("&nbsp;");},8000)
			$("#currentPass").focus();
			return false;
		}
	});
}
