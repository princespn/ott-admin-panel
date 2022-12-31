  $("#message").keypress(function (e) {
    if (e.which == 13) {
       replychat('Admin');
        return false;
    }
});

 function  replychat(Admin){
     var message =$('#message').val();
     var userId =$('#user_id').val();
     var site_url= $('#site_url').val();
     var userReply = $("input[name=userReply]").val();
     var url =site_url+userReply;
      if(userId==''){
            $("#errmessage").fadeIn().html("Please select users conversation.");
            setTimeout(function(){$("#errmessage").html("&nbsp;");},3000)
            $("#message").focus();
            return false;
      }
    if(message.trim() == '') {
        $("#errmessage").fadeIn().html("Please type a message.");
        setTimeout(function(){$("#errmessage").html("&nbsp;");},3000)
        $("#message").focus();
        return false;
    }
    if(userId!=''){
      $.ajax({
          type:"post",
          url:url,
           data:{userId,message,Admin:Admin},
          success:function(returndata){
          var myObj = JSON.parse(returndata);
          //$("#userChat").append(returndata);
          $("#userChat").append(myObj.div);
          $('#message').val('');
          var hash ='#chatBlank'+myObj.lastId;
          $('#userChat').animate({
              scrollTop: $(hash).offset().top
            }, 1000, function(){
              window.location.hash = hash;
            });
            //$("#chatBlank"+lastId).focus();
          }
      });
   }
}

  $(function(){
    getuserlist();
  });
  function getuserlist(){
    var site_url= $('#site_url').val();
    var getuserlist = $("input[name=getuserlist]").val();
    var url =site_url+getuserlist;
   
      $.ajax({
          type:"post",
          url:url,
          success:function(returndata){
          $("#userMsg").html(returndata);
          }
      });
  }

  function getUserName(userId){
     $('#countIdHide'+userId).hide();
  	 $('.inactiveClass').removeClass('active_chat').addClass('bg-default');
  	 $('#userActive'+userId).addClass('active_chat').removeClass('bg-default');
     var site_url= $('#site_url').val();
     var userChat = $("input[name=userChat]").val();
     var url =site_url+userChat;
     var datastring ="userId="+userId;
       $("#user_id").val(userId);
          $.ajax({
              type:"post",
              url:url,
              data:datastring,
              success:function(returndata){
              var myObj = JSON.parse(returndata);
                $("#userChat").html(myObj.div);
                var hash ='#chatBlank'+myObj.lastId;
                $('#userChat').animate({
                scrollTop: $(hash).offset().top
                }, 1000, function(){
                window.location.hash = hash;
            }); 
        }
    });
}
