<?php $this->load->view('common/header'); ?>
<?php $this->load->view('common/left_panel'); ?>

<style type="text/css">
	#container {
    height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
.highcharts-credits{
	display: none !important;
}


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Dashboard
         <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Info boxes -->
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-yellow"><i class="fa fa-users" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                  <a href="<?php if(!empty($getUserCount)) { ?><?= site_url(USERS); ?><?php } else { echo "javascript:void(0)"; } ?>">
                  <span class="info-box-text">ALL USERS</span>
                  <span class="info-box-number"><?php if(!empty($getUserCount)){  echo $getUserCount; } else { echo "0"; } ?></span>
                  </a>
               </div>
            </div>
         </div>
         <!-- <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-blue"><i class="fa fa-facebook" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                  <a href="<?php if(!empty($getFacebookUsersCount)) { ?><?= site_url(USERS.'/facebook'); ?><?php } else { echo "javascript:void(0)"; } ?>">
                  <span class="info-box-text">USERS</span>
                  <span class="info-box-number"><?php if(!empty($getFacebookUsersCount)){ echo $getFacebookUsersCount; } else { echo "0"; } ?></span>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-purple"><i class="fa fa-gamepad" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                   <a href="<?php if(!empty($getTotalGameCount)) { ?><?= site_url(MATCHHISTORY); ?><?php } else { echo "javascript:void(0)"; } ?>">
                  <span class="info-box-text">NO. OF GAME PLAYED</span>
                  <span class="info-box-number"><?php if(!empty($getTotalGameCount)){ echo $getTotalGameCount; } else { echo "0"; } ?></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-red"><i class="fa fa-arrow-down" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                  <a href="<?php if(!empty($getDepositCount)) { ?><?= site_url(DEPOSIT); ?><?php } else { echo "javascript:void(0)"; } ?>">
                    <span class="info-box-text">TOTAL DEPOSIT</span>
                    <span class="info-box-number"><?php if(!empty($getDepositCount)){ echo $getDepositCount; }else{ echo '0';}?></span>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-green"><i class="fa fa-arrow-up" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                <?php if(!empty($getWithdrawCount)) { ?>
                  <a href="<?= site_url(WITHDRAWALCOMPREQ); ?>">
                <?php } else { ?>
                  <a href="javascript:void(0)">
                <?php } ?>
                  <span class="info-box-text">TOTAL WITHDRAWAL</span>
                  <span class="info-box-number"><?php if(!empty($getWithdrawCount)){ echo $getWithdrawCount; }else{ echo '0';}?></span>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-maroon"><i class="fa fa-handshake-o" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                  <?php if(!empty($getTotalReferalCount)) { ?>
                    <a href="<?= site_url(REFERRAL); ?>">
                  <?php } else { ?>
                    <a href="javascript:void(0)">
                  <?php } ?>
                  <span class="info-box-text">TOTAL REFERRAL</span>
                  <span class="info-box-number"><?php if(!empty($getTotalReferalCount)){ echo $getTotalReferalCount; }else{ echo '0';}?></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-yellow"><i class="fa fa-money" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                <?php if(!empty($getTodayDepositCount) && $getTodayDepositCount!='0') { ?>
                  <a href="<?= site_url(TODAYSDEPOSIT); ?>">
                  <?php }else{  ?>
                  <a href="javascript:void(0)">
                  <?php } ?>
                  <span class="info-box-text">TODAY'S DEPOSIT</span>
                  <span class="info-box-number"><?php if(!empty($getTodayDepositCount) && $getTodayDepositCount!='0'){ echo $getTodayDepositCount; }else{ echo "0"; }?></span>
                  </a>
               </div>
            </div>
         </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-aqua"><i class="fa fa-money" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                <?php if(!empty($getTodayWithdrawalCount) && $getTodayWithdrawalCount!='0') { ?>
                  <a href="<?= site_url(WITHDRAWAL.'/today-with'); ?>">
                  <?php }else{  ?>
                  <a href="javascript:void(0)">
                  <?php } ?>
                  <span class="info-box-text">TODAY'S WITHDRAWAL HISTORY</span>
                  <span class="info-box-number"><?php if(!empty($getTodayWithdrawalCount) && $getTodayWithdrawalCount!='0'){ echo $getTodayWithdrawalCount; }else{ echo "0"; }?></span>
                  </a>
               </div>
            </div>
         </div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-purple"><i class="fa fa-money" style="margin-top: 25px;"></i></span>
               <div class="info-box-content">
                <?php if(!empty($getTodayTotalBonus) && $getTodayTotalBonus!='0') { ?>
                  <a href="<?= site_url(TODAYBONUS); ?>">
                  <?php }else{  ?>
                  <a href="javascript:void(0)">
                  <?php } ?>
                  <span class="info-box-text">TODAY'S TOTAL BONUS</span>
                  <span class="info-box-number"><?php if(!empty($getTodayTotalBonus) && $getTodayTotalBonus!='0'){ echo $getTodayTotalBonus; }else{ echo "0"; }?></span>
                  </a>
               </div>
            </div>
         </div> -->

      </div>

       <!-- Main row -->
      <div class="row">

      	<!-- Left Block -->
      	<div class="col-md-8"> 
      		<br/>
            <div class="box box-success">
              <div class="box-header with-border">
                <h2 class="box-title">Monthly statistic</h2>
              </div>
              <div class="box-body">
                <div class="tab-content">
					        <figure class="highcharts-figure">
					          <div id="container"></div>
					        </figure>
                </div>
              </div>
            </div>
      	</div>

      	<!-- Right Block -->
        <?php if(!empty($getSelectedUser)) { ?>
      	 <div class="col-md-4"> 
          <br/>
          <div class="box box-danger">
            <div class="box-header with-border">
              <h2 class="box-title">Latest Users</h2>
            </div>
            <div class="box-body">
              <div class="card">
                <div class="card-body p-0">
                  <?php $i=1; foreach($getSelectedUser as $rows) { ?>
                    <?php if($i==1 || $i%4==0) { ?>
                    <ul class="users-list clearfix">
                    <?php } ?>
                    <li>
                      <?php if(!empty($rows->profile_img)) { ?>
                        <img src="<?= base_url('uploads/userProfileImages/'.$rows->profile_img); ?>" alt="User Image">
                      <?php } else { ?>
                        <img src="<?= base_url('uploads/default.png'); ?>" alt="User Image">
                        <?php } ?>
                      <a class="users-list-name" href="javascript:void(0)"><?php if(!empty($rows->user_name)) {  echo ucfirst($rows->user_name); }else { echo "NA"; } ?></a>
                      <span class="users-list-date"><?php if(!empty($rows->last_login) && $rows->last_login !="0000-00-00 00:00:00"){  echo " ".date('d M Y', strtotime($rows->last_login)); } else {  echo ""; } ?></span>
                      <span class="users-list-date"><?php if(!empty($rows->last_login) && $rows->last_login !="0000-00-00 00:00:00") { echo " ".date('h:i  A', strtotime($rows->last_login)); } else { echo "";} ?></span>
                    </li>
                    <?php if($i%4==0) { ?>
                    </ul>
                    <?php } $i = $i+1; ?>
                  <?php } ?>
                  <!-- /.users-list -->
                </div>
                <!-- /.card-body -->
                 <div class="card-footer text-center">
                  <a href="<?= site_url(USERS); ?>">View All Users</a>
                </div>
                <!-- /.card-footer -->
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
      <!-- /Main row -->
   </section>
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('common/footer'); ?>

<script src="<?= base_url(); ?>/assets/highchart/highcharts.js"></script>
<script src="<?= base_url(); ?>/assets/highchart/exporting.js"></script>
<script src="<?= base_url(); ?>/assets/highchart/export-data.js"></script>
<script src="<?= base_url(); ?>/assets/highchart/accessibility.js"></script>

<script type="text/javascript">
	Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?php foreach($months as $m){ ?>"<?= $m; ?>",<?php } ?>],
        //categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Billions'
        },
        labels: {
            formatter: function () {
                return this.value / 1000;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ' users'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [<?php foreach($months as $m){ ?>{
        name: '<?= $m; ?>',
        data: [<?php foreach($total_users as $users){ ?><?= $users; ?>,<?php } ?>]
        ///data: [502, 635, 809, 947, 1402, 3634, 5268]
    },<?php } ?>] 
});
</script>
