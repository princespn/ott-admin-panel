 <?php foreach($getUser as $row) { ?>
    <div class="bg-default chat_list inactiveClass" id="userActive<?php echo $row->userId;?>"  onclick="getUserName('<?php echo $row->userId;?>');">
      <div class="chat_people">
      <div class="chat_img"> 
        <?php if(!empty($row)) { ?>
          <img class="img-circle" src="<?php if(!empty($row)){echo base_url('uploads/userProfileImages/'.$row->profile_img);}?>" alt="sunil"> 
        <?php }else{ ?>
        <img src="<?= base_url('uploads/chatImage.png'); ?>" width="80px">
         <?php }?>
      </div>
      <div class="chat_ib">
        <h5><?php echo $row->user_name; ?><span class="chat_date"><?php echo date("M h:i A",strtotime($row->created));?></span></h5>
        <p><?php echo $row->message; ?></p>
      </div>
      </div>
    </div>
   <?php } ?>


  
