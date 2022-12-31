

   <?php foreach($getUserChat as $row) { ?>
      <?php if($row->type=='User') { ?>
  <div class="incoming_msg">
    <div class="incoming_msg_img"> 
        <?php if(!empty($row)) { ?>
          <img class="img-circle" src="<?php if(!empty($row)){echo base_url('uploads/userProfileImages/'.$row->profile_img);}?>" alt="sunil"> 
       <?php }else{ ?>
          <img src="<?= base_url('uploads/chatImage.png'); ?>" width="80px">
       <?php }?>
    </div>
      <div class="received_msg">
      <div class="received_withd_msg">
        <p> <?php echo  $row->message; ?></p>
        <span class="time_date"> <?php echo date("h:i A",strtotime($row->created));?>   |    <?php echo date("M d",strtotime($row->created));?></span></div>
      </div>
  </div> 
  <?php } else { ?>
     <div class="outgoing_msg">
      <div class="sent_msg">
      <p><?php echo  $row->message; ?></p>
      <span class="time_date"> <?php echo date("h:i A",strtotime($row->created));?>    |    <?php echo date("M d",strtotime($row->created));?></span> </div>
    </div>
  <?php } } ?>