<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/jquery-ui.css">
<?php $this->load->view('common/left_panel.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(GAMEPLAY); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-10 box-title"><?= $heading; ?></div>
              <div class="col-md-2 text-right text-danger">* Fields are required</div>
            </div>
            <!-- /.box-header -->
            <!-- <form  method="post" id="tornamntForm" action="<?= $action; ?>" enctype="multipart/form-data"> -->
            <?= form_open(GAMEPLAYACTION);?>
              <div class="box-body">
                <input type="hidden" class="form-control" name="roomId" id="roomId" value="<?= $roomId; ?>" autocomplete="off">
                <input type="hidden" name="isPrivate" id="private" value="No">

               <!--  <div class="col-md-6">
                    <label>Is Private<span class="text-danger"> * </span><span id="errisPrivate" class="text-danger"><?= strip_tags(form_error('isPrivate'));?></span></label>
                     
                    <select class="form-control" name="isPrivate" id="isPrivate" onclick="selectIsprivate()">
                        <option value="No" <?php if($isPrivate=="No"){ echo "selected";}?>>No</option>
                        <option value="Yes" <?php if($isPrivate=="Yes"){ echo "selected";}?>>Yes</option>
                    </select>
                </div> -->

              
                  <div class="col-md-6" id="hideShow">
                    <label>Mode<span class="text-danger"> * </span><span id="errMode" class="text-danger"><?= strip_tags(form_error('mode'));?></span></label>
                    <select class="form-control" name="mode" id="mode">
                          <option value="" >Select Mode</option>
                          <option value="Quick" <?php if($mode=="Quick"){ echo "selected";}?>>Quick</option>
                          <option value="Classic" <?php if($mode=="Classic"){ echo "selected";}?>>Classic</option>
                      </select>
                  </div>
              

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Room<span class="text-danger"> * </span><span id="errRoom" class="text-danger"><?= strip_tags(form_error('roomTitle'));?></span></label>
                    <input type="text" class="form-control" name="roomTitle" id="room" placeholder="Room" value="<?= $roomTitle;?>" autocomplete="off">
                  </div>
                </div>

                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>players<span class="text-danger"> * </span><span id="errplayers" class="text-danger"><?= strip_tags(form_error('players'));?></span></label>
                    <input type="text" class="form-control" name="players" id="players" placeholder="players" value="<?= $players;?>" autocomplete="off" onkeypress="only_number(event)">
                  </div>
                </div>
               

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Commision <span class="text-danger"> * </span><span id="errComm" class="text-danger"><?= strip_tags(form_error('commision'));?></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="commision" id="commision" placeholder="commision" value="<?= $commision;?>" autocomplete="off">
                  </div>
                </div>               
               
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Entry Fee <span class="text-danger"> * </span><span id="errentryFee" class="text-danger"><?= strip_tags(form_error('entryFee'));?></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="entryFee" id="entryFee" placeholder="Enter Entry Fee" value="<?= $entryFee;?>" autocomplete="off" maxlength="4">
                  </div>
                </div>
              

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Start Round Time (in second)<span class="text-danger"> * </span><span id="errstartRoundTime" class="text-danger"><?= strip_tags(form_error('startRoundTime'));?></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="startRoundTime" id="startRoundTime" placeholder="Enter start round time (in second)" value="<?= $startRoundTime; ?>" autocomplete="off" maxlenght='2'>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Token Move Time (in second)<span class="text-danger"> * </span><span id="errtokenMoveTime" class="text-danger"><?= strip_tags(form_error('tokenMoveTime'));?></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="tokenMoveTime" id="tokenMoveTime" placeholder="Enter token move time (in second)" value="<?= $tokenMoveTime; ?>" autocomplete="off" maxlenght='2'>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Roll Dice Time (in second)<span class="text-danger"> * </span><span id="errrollDiceTime" class="text-danger"><?= strip_tags(form_error('rollDiceTime'));?></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="rollDiceTime" id="rollDiceTime" placeholder="Enter roll dice time (in second)" value="<?= $rollDiceTime; ?>" autocomplete="off" maxlenght='2'>
                  </div>
                </div>

               
                <div class="col-md-6">
                    <label>Is Bot Connect<span class="text-danger"> * </span><span id="errisBotConnect" class="text-danger"><?= strip_tags(form_error('isBotConnect'));?></span></label>
                     
                    <select class="form-control" name="isBotConnect" id="isBotConnect">
                        <option value="Yes" <?php if($isBotConnect=="Yes"){ echo "selected";}?>>Yes</option>
                        <option value="No" <?php if($isBotConnect=="No"){ echo "selected";}?>>No</option>
                    
                    </select>
                </div>

                <div class="col-md-12" style="margin-top: 10px;">
                  <div class="form-group">
                    <input type="hidden" name="button" id="button" value="<?= $button; ?>">
                    <button type="submit" class="btn btn-primary" onclick="return validate();"><?= $button; ?></button>&nbsp;
                    <a href="<?= site_url(GAMEPLAY); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
                </div>
                
                
              </div>
            <?= form_close();?>
            <!-- /.box-body -->
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
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
  $( document ).ready(function() {
       var isPrivate= $("#isPrivate").val();
        if(isPrivate == 'Yes'){
          $("#hideShow").hide();
        }else{
          $("#hideShow").show();
        }
    });


  function selectIsprivate(){
      var isPrivate= $("#isPrivate").val();
      if(isPrivate == 'Yes'){
        $("#hideShow").hide();
      }else{
        $("#hideShow").show();
      }
  }
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/gamePlay.js"></script>