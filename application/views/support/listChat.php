<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
    <!-- Load common left panel -->
    <?php $this->load->view('common/left_panel'); ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/custom_css/supportChat.css">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1><?= $heading; ?></h1>
                <ol class="breadcrumb">
                    <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li>
                        <?= $bread; ?>
                    </li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="messaging ">
                            <div class="inbox_msg bShow">
                                <div class="inbox_people ">
                                    <div class="headind_srch">
                                        <div class="recent_heading">
                                            <h4>Recent</h4>
                                        </div>
                                        <!--  <div class="srch_bar">
                                 <div class="stylish-input-group">
                                 <input type="text" class="search-bar"  placeholder="Search" >
                                 </div>
                                 </div> -->
                                    </div>
                                    <div class="inbox_chat scroll cursor" id="userList">

                                    </div>
                                </div>
                                <div class="mesgs bShow">
                                    <div class="msg_history" id="userChat">

                                        <!-- <div class="incoming_msg">
                                 <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                 <div class="received_msg">
                                    <div class="received_withd_msg">
                                       <p>Test which is a new approach to have all
                                          solutions
                                       </p>
                                       <span class="time_date"> 11:01 AM    |    June 9</span>
                                    </div>
                                 </div>
                              </div>  -->

                                        <!--   <div class="outgoing_msg">
                                 <div class="sent_msg">
                                    <p>Test which is a new approach to have all
                                       solutions
                                    </p>
                                    <span class="time_date"> 11:01 AM    |    June 9</span> 
                                 </div>
                              </div> -->

                                    </div>
                                    <span id="errmessage" class="text-danger"><?php echo form_error('message'); ?></span>
                                    <div class="type_msg">
                                        <div class="input_msg_write">
                                            <input type="hidden" id="user_id">
                                            <input type="text" class="write_msg" id="message" name="message" placeholder="Type a message" />
                                            <button class="msg_send_btn" type="button" onclick=" replychat('Admin');"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Load common footer -->
        <?php $this->load->view('common/footer'); ?>

  <script type="text/javascript">
     $("#message").keypress(function (e) {
       if (e.which == 13) {
          replychat('Admin');
           return false;
       }
     });
  </script>
  <script type="text/javascript">
      $(function(){
    getuserlist();

  });
  function getuserlist(){
    var site_url= $('#site_url').val();
    var url =site_url+"/SupportChats/getuserlist";
      $.ajax({
          type:"post",
          url:url,
          success:function(returndata){
          var obj = JSON.parse(returndata);

          var div = "";
             if(obj.getSupport){   
              for (i = 0; i < obj.getSupport.length; i++) {
                        div += '<div class="chat_list inactiveClass" id="userActive' + obj.getSupport[i].userId + '" onclick="getUserName(' + obj.getSupport[i].userId + ')"><div class="chat_people"><div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="chat_ib"><h5>' + obj.getSupport[i].user_name + '<span class="chat_date">' + obj.created + '&nbsp;&nbsp;';
                        if(obj.getSupport[i].userTotalMessage!=0)
                        {
                          div +='<span class="badge badge-light" id="userCountHide'+obj.getSupport[i].userId+'">'+obj.getSupport[i].userTotalMessage+'</span>';
                        }
                          div+='</span></h5><p>' + obj.getSupport[i].message + '</p></div></div> </div>';
                    }
               }
              $("#userList").html(div);
          }
      });
  }

 function getUserName(userId){
    $('#userCountHide'+userId).hide();
    $(".inactiveClass").removeClass("active_chat").addClass("bg-default");
    $("#userActive" + userId).addClass("active_chat").removeClass("bg-default");

    var site_url = $("#site_url").val();
    var url = site_url + "/SupportChats/getuserName";
    $("#user_id").val(userId);
      $.ajax({
            type:"post",
            url:url,
            data:{id: userId},
            success:function(returndata){
          var obj = JSON.parse(returndata);
           var div = "";
            if (obj.getUserChat) {
                    for (i = 0; i < obj.getUserChat.length; i++) {
                      lastId = obj.getUserChat[i].supportLogId;
                          if (obj.getUserChat[i].type == 'User') {
                              div += '<div class="incoming_msg"> <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div><div class="received_msg"><div class="received_withd_msg"> <p>' + obj.getUserChat[i].message + '</p> <span class="time_date"> ' + obj.time + '</span></div><span id="chatBlank'+lastId+'"></span> </div></div>&nbsp;&nbsp;&nbsp;';
                          } else {
                              div += ' <div class="outgoing_msg"><div class="sent_msg"> <p>' + obj.getUserChat[i].message + '</p> <span class="time_date"> ' + obj.time + '</span> <span id="chatBlank'+lastId+'"></span>   </div> </div>';
                          }
                    }
                 }else{
                   div += '<cenetr><h4> No Record Found</h4></cenetr>';
                 }  
                 $("#userChat").html(div);  
                  var hash ='#chatBlank'+lastId;
                   $('#userChat').animate({
                   scrollTop: $(hash).offset().top
                  }, 1000, function(){
                   window.location.hash = hash;
                  });
        }
    });
 }

  function replychat(Admin) { 
    var user_id = $("#user_id").val();
    var message = $("#message").val();
    var site_url = $("#site_url").val();

    var url = site_url + "/SupportChats/getuserChat";
    if(user_id ==""){
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

    $.ajax({
            type: 'post',
            url: url,
            data:{id: user_id, Admin: Admin, message: message },
            success: function(response) {
           var obj = JSON.parse(response);

           div = ' <div class="outgoing_msg"><div class="sent_msg"> <p>' + obj.getdata[0].message + '</p> <span class="time_date"> '+ obj.time+'</span><span id="chatBlank' + obj.insert_id + '"></span>  </div> </div>';
          $("#userChat").append(div);
           $("#message").val('');
                      var hash ='#chatBlank'+obj.insert_id;
                       $('#userChat').animate({
                       scrollTop: $(hash).offset().top
                       }, 1000, function(){
                       window.location.hash = hash;
                       });
              }
         });
   }
  </script>

   
 

