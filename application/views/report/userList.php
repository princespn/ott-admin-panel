<?php if(!empty($getUser)){
	foreach($getUser as $user){?>
	<div class="chat_list bg-default inactiveClass" id="activeClass<?= $user->userId;?>" onclick="getSupportMsg(<?= $user->userId;?>);">
		<input type="hidden" id="userId" value="<?= $user->userId;?>">
	   <div class="chat_people">
	      <div class="chat_img">
	       <?php if(!empty($user->profile_img)){ ?>
	       	   <img src="<?= base_url();?>uploads/chatImage.png" alt="image"> 
	       <?php }else{?>
	       	   <img src="<?= base_url();?>uploads/chatImage.png" alt="image"> 
	       <?php } ?>
	      </div>
	      <div class="chat_ib">
	         <h5><?= $user->user_name;?><span class="chat_date"><?= date("F j",strtotime($user->created));?></span></h5>
	         <p><?= $user->message;?></p>
	      </div>
	   </div>
	</div>
<?php } }else{?>
    <center><h4>No Record Found.</h4></center>
<?php }?>

<script type="text/javascript">
	function getSupportMsg(userId)
	{
		$('.inactiveClass').removeClass('active_chat').addClass('bg-default');
		$('#activeClass'+userId).addClass('active_chat');
		var site_url = $('#site_url').val();
	    var location = site_url+'/Report/getUserSupportMsg';

	    $.ajax({
	      type:"post",
	      url:location,
	      data:{userId:userId},
	      success:function(result){
	      	$('#msgUppend').html(result);
	      }
	    });
	}
</script>