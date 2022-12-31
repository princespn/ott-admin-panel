<?php if(!empty($getMsgData)){
   foreach ($getMsgData as $msg) {
   if($msg->type=="User"){?>
      <input type="hidden" id="chatId" value="<?= $msg->userId; ?>">
      <div class="incoming_msg">
         <div class="incoming_msg_img"> 
            <?php if(!empty($user->profile_img)){ ?>
               <img src="<?= base_url();?>uploads/chatImage.png" alt="image"> 
          <?php }else{?>
               <img src="<?= base_url();?>uploads/chatImage.png" alt="image"> 
          <?php } ?> 
         </div>
         <div class="received_msg">
            <div class="received_withd_msg">
               <p><?= $msg->message;?></p>
               <span class="time_date"> <?= date("g:i a",strtotime($msg->created));?>    |    <?= date("F j",strtotime($msg->created));?></span>
            </div>
         </div>
      </div>
      <?php }else{?>
         <div class="outgoing_msg">
            <div class="sent_msg">
               <p><?= $msg->message;?></p>
               <span class="time_date"> <?= date("g:i a",strtotime($msg->created));?>    |    <?= date("F j",strtotime($msg->created));?></span> 
            </div>
         </div>
<?php } } }else{?>
    <center><h4>No Record Found.</h4></center>
<?php }?>