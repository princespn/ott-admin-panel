<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	 <h1><?= $heading; ?></h1>
</section>

<!-- Main content -->
<section class="content">
      <div class="row">
         <div class="col-md-12">
            <!-- User Profile -->        
            <div class="box" style="border-top:2px solid Blue;">
               <div class="box-body box-profile">
                  
                  <h3 class="profile-username text-center"><?php if(!empty($getUserData->name)){ echo $getUserData->name;}else{ echo 'NA';}?></h3>

                  <a class="users-list-name text-left" href="javascript:void(0)">Movie Name: <?= !empty($getUserData->name) ? $getUserData->name : 'NA'; ?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Description: <?= !empty($getUserData->details) ? $getUserData->details : 'NA'; ?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)"><?= !empty($getUserData->link) ? $getUserData->link : 'NA'; ?>
				  
				  <!-- <?php if(!empty($getUserData->is_emailVerified=="Yes")) {  ?>
                  <span class="" style="color:green;">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></span>
                  <?php }else { ?>
                  <span class="" style="color:red;">&nbsp;<i class="fa fa-close" aria-hidden="true"></i></span>
                  <?php } ?> -->
                  </a>
                  <!-- <?php if(!empty($getUserData->is_emailVerified=="No")) {  ?>
				  
					<center><span class="btn btn-success btn-xs" id="emailBtn" onclick="return verifyEmail('<?= $getUserData->id; ?>')">Verify Email </span></center> <?php } ?> -->
               </div>
               <div class="box-header with-border"></div>
               <div class="box-header with-border">
                  <strong><i class="margin-r-5"></i> Mobile</strong>
                  <!-- <?php if(!empty($getUserData->is_mobileVerified=="Yes")) {  ?>
                  <span class="pull-right" style="color:green;">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></span>
                  <?php }else { ?>
                  <span class="pull-right" style="color:red;">&nbsp;<i class="fa fa-close" aria-hidden="true"></i></span>
                  <?php } ?>-->
                  <span class="text-muted pull-right"> 
                  <?php if(!empty($getUserData->phone)){ echo $getUserData->phone;}else{ echo 'NA';}?>
                  </span>
               </div>
               <div class="box-header with-border">
                  <strong><i class="margin-r-5"></i>Status</strong>
                  <span class="text-muted pull-right">
                  <?php  
                     if(!empty($getUserData->status) && $getUserData->status=='Active' ){ 
                         echo '<a class="btn btn-xs btn-success">'.ucfirst($getUserData->status).'</a>'; 
                     }  elseif($getUserData->status=='Inactive'){ 
                         echo '<a class="btn btn-xs btn-danger">'.ucfirst($getUserData->status).'</a>'; 
                     }else{
                         echo 'NA';
                     }
                     ?>
                  </span>
               </div>
               <div class="box-header with-border">
                  <strong><i class="margin-r-5"></i>Subscription Type</strong>
                  <span class="text-muted pull-right">

                  <?php  if(!empty($getUserData->subscriptionType)) { echo $getUserData->subscriptionType;} else {echo 'NA';} ?>
                  </span>
               </div>
               <!-- <div class="box-header with-border">
                  <strong><i class="margin-r-5"></i> Verification</strong>
                  <span class="text-muted pull-right"> 
                  </span>
                  </div>-->
               <!-- <div class="box-header with-border" id="mainWallet">
                  <strong><i class="margin-r-5"></i>Main Wallet</strong>
                  <span class="text-muted">
                  <span class="text-muted pull-right"><?= !empty($getUserData->mainWallet) ? number_format($getUserData->mainWallet,2) : '0'; ?></span>
                  </span>
               </div>
               <div class="box-header with-border" id="winWallet">
                  <strong><i class="margin-r-5"></i> Win Wallet</strong>
                  <span class="text-muted pull-right"><?= !empty($getUserData->winWallet) ? number_format($getUserData->winWallet,2) : '0'; ?></span>
               </div>
               
               <div class="box-header with-border" id="refBtn">
                  <!-- <?php  if(!empty($getUserData->status) && $getUserData->status=='Active' ) { ?>
                  <button type="button" class="btn btn-block btn-danger" onclick="return change_status(<?php echo $getUserData->id; ?>)">Deactivate</button>
                  <?php } else { ?>
                  <button type="button" class="btn btn-block btn-success" onclick="return change_status(<?php echo $getUserData->id; ?>)">Activate</button>
                  <?php } ?> -->
                  <!-- <button type="button" class="btn btn-block btn-info"  onclick="addMoney('<?= $getUserData->id; ?>')">Add Money</button>
                  <button type="button" class="btn btn-block btn-danger" onclick="deductMoney('<?= $getUserData->id; ?>')" >Deduct Money</button> -->
                  <!-- <button type="button" class="btn btn-block btn-warning" data-toggle="modal" data-target="#" onclick="return ChngPass('<?= $getUserData->id; ?>')">Change Password</button> -->
               </div> 
            </div>
            
         </div>
         <!-- <div class="col-md-9">
            <div class="row">
               <div class="col-md-12" style="padding-left: 3px !important;">
                  <div class="nav-tabs-custom" style="border-top:2px solid gray; margin:0px 0px 15px 0; padding:0 10px 0 10px;">
                     <div class="col-md-2" style="float:right;margin-top:5px;">
                        <a href="<?= site_url(USERGAMEPLAYEDEXPORT.'/'.base64_encode($getUserData->id)); ?>" style="float:right;" class="btn btn-success">Export</a>&nbsp;
                     </div>
                     <div class="" id="gamePlayed">
                        <h4>Game Played</h4>
                        <!-- <a href="javascript:void(0)" class="btn btn-default">Excel</a>&nbsp;
                           <a href="javascript:void(0)"class="btn btn-default">CSV</a>&nbsp;
                           <a href="javascript:void(0)" class="btn btn-default">PDF</a> -->
                        <!-- <div class="table-responsive">
                           <table class="table table-bordered table-striped" id="example_datatable" width="100%">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Room Id</th>
                                    <th>Bet Amount</th>
                                    <th>Winning Amount</th>
                                    <th>Is Win</th>
                                    <th>Main Wallet</th>
                                    <th>Win Wallet</th>
                                    <th>Coins Wallet</th>
                                    <th>Loss Wallet</th>
                                    <th>Admin Commission</th>
                                    <th>isTournament</th>
                                    <th>Date & Time</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div>
           
            <!-- <div class="row">
               <div class="col-md-6" style="padding-right: 7px !important; padding-left: 3px !important;">
                  <div class="nav-tabs-custom" style="border-top:2px solid green; margin:0px 0px 15px 0; padding:0 10px 0 10px;">
                     <div style="float:right;margin-top:5px;">
                        <a href="<?= site_url(USERREFERALBONUSEXPORT.'/'.base64_encode($getUserData->id)); ?>" style="float:right;" class="btn btn-success">Export</a>&nbsp;
                     </div>
                     <div class="" id="withdraw">
                         // <h4>Game play Bonus</h4>
                       //   <a href="javascript:void(0)" class="btn btn-default">Excel</a>&nbsp;
                        //   <a href="javascript:void(0)"class="btn btn-default">CSV</a>&nbsp;
                        //   <a href="javascript:void(0)" class="btn btn-default">PDF</a> 
                        <h4>Register Referral Bonus</h4>
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped" id="bonus_datatable" width="100%">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Referral User</th>
                                    <th>Bonus Amount</th>
                                    <th>Type</th>
                                    <th>Date & Time</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6" style="padding-left: 7px !important;">
                  <div class="nav-tabs-custom" style="border-top:2px solid orange; margin:0px 0px 15px 0; padding:0 10px 0 10px;">
                     <div style="float:right;margin-top:5px;">
                        <a href="<?= site_url(USEGAMEPLAYBONUSEXPORT.'/'.base64_encode($getUserData->id)); ?>" style="float:right;" class="btn btn-success">Export</a>&nbsp;
                     </div>
                     <div class="" id="withdraw">
                       // <h4>Game play Bonus</h4>
                       //   <a href="javascript:void(0)" class="btn btn-default">Excel</a>&nbsp;
                        //   <a href="javascript:void(0)"class="btn btn-default">CSV</a>&nbsp;
                        //   <a href="javascript:void(0)" class="btn btn-default">PDF</a> 
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped" id="playGame_datatable" width="100%">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Referral User</th>
                                    <th>Bonus Amount</th>
                                    <th>Type</th>
                                    <th>Matches</th>
                                    <th>Date & Time</th>
                                 </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div> -->
         </div> 
      </div>

      <!-- STATUS CHANGE  Modal END -->
      <input type="hidden" id="site_url" value="<?php echo site_url(); ?>">
      <input type="hidden" id="url" value="<?php echo site_url('Users/addMoney'); ?>">
      <input type="hidden" id="deductAmtUrl" value="<?php echo site_url('Users/deductMoney'); ?>">
   </section>

</div>
<?php $this->load->view('common/footer.php'); ?>
