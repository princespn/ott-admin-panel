<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(USERREPORT); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box bShow">
            <div class="box-body box-profile">
              <?php if(!empty($getUserData->profile_img)){?>
                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" alt="picture"/>
              <?php }else{ ?>
                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" alt="picture"/>
              <?php } ?>
              <h3 class="profile-username text-center"><?= $getUserData->user_name;?></h3>
            </div>

          </div>
        
          <div class="box bShow">

            <div class="box-header with-border">
              <h3 class="box-title">About User</h3>
              <div class="pull-right"><a href="<?= site_url(USERREPORT); ?>" class="btn btn-danger btn-xs">BACK</a></div>
            </div>

            <div class="box-header with-border">
              <strong><i class="fa fa-hand-o-right margin-r-5"></i> Email  : </strong>
              <span class="text-muted">
                <?= $getUserData->email_id;?>
              </span>
            </div>

            <div class="box-header with-border">
              <strong><i class="fa fa-hand-o-right margin-r-5"></i> Phone No.  : </strong>
              <span class="text-muted">
                <?= $getUserData->mobile;?>
              </span>
            </div>

            <div class="box-header with-border">
              <strong><i class="fa fa-hand-o-right margin-r-5"></i> Coins  : </strong>
              <span class="text-muted">
               <?= $getUserData->balance;?>
              </span>
            </div>

          </div>
        </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom bShow" >
            <ul class="nav nav-tabs">
              <li class="active"><a href="#deposite" data-toggle="tab">Deposite</a></li>
              <li class=""><a href="#withdraw" data-toggle="tab">Withdraw</a></li>
              <li class=""><a href="#coinDeductHistory" data-toggle="tab">Coins Deduct History</a></li>
            </ul>
            <div class="tab-content">

              <!-- Tab for Participants Fav Games -->
              <div class="tab-pane active" id="deposite">
                <h4>Deposite</h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped zeroConfDatatable" width="100%">
                    <thead>  
                      <tr>
                        <th>Sr. No.</th>
                        <th>Order Id</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>  
                    <tbody> 
                      <?php if(!empty($getDeposite)){ 
                        $sr = 1;
                        foreach ($getDeposite as $deposite) {
                      ?>
                      <tr>
                        <td><?= !empty($sr) ? $sr : 'NA'; ?></td>
                        <td><?= !empty($deposite->orderId) ? ucfirst($deposite->orderId) : 'NA'; ?></td>
                        <td><?= !empty($deposite->amount) ? ucfirst($deposite->amount) : 'NA'; ?></td>
                        <td><?= !empty($deposite->status) ? ucfirst($deposite->status) : 'NA'; ?></td>
                      </tr>
                      <?php $sr++; } } ?>
                      
                    </tbody> 
                  </table> 
                </div>
              </div>

              <!-- Tab for Participants Fav Teams -->
              <div class="tab-pane" id="withdraw">
                <h4>Withdraw</h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped zeroConfDatatable" width="100%">
                    <thead>  
                      <tr>
                        <th>Sr. No.</th>
                        <th>Order Id</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>  
                    <tbody> 
                      <?php if(!empty($getWithdraw)){ 
                        $sr = 1;
                        foreach ($getWithdraw as $withdraw) {
                      ?>
                      <tr>
                        <td><?= !empty($sr) ? $sr : 'NA'; ?></td>
                        <td><?= !empty($withdraw->orderId) ? ucfirst($withdraw->orderId) : 'NA'; ?></td>
                        <td><?= !empty($withdraw->amount) ? ucfirst($withdraw->amount) : 'NA'; ?></td>
                        <td><?= !empty($withdraw->status) ? ucfirst($withdraw->status) : 'NA'; ?></td>
                        
                      </tr>
                      <?php $sr++; } } ?>
                      
                    </tbody> 
                  </table> 
                </div>
              </div>

               <!-- Tab for Participants Fav Teams -->
              <div class="tab-pane" id="coinDeductHistory">
                <h4>Coins Deduct History</h4>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped zeroConfDatatable" width="100%">
                    <thead>  
                      <tr>
                        <th>Sr. No.</th>
                        <th>Table Id</th>
                        <th>Game</th>
                        <th>Game Type</th>
                        <th>Bet Value</th>
                        <th>Coins</th>
                        <th>Is Win</th>
                        <th>Admin Commission</th>
                      </tr>
                    </thead>  
                    <tbody> 
                      <?php if(!empty($getcoinsHistory)){ 
                        $sr = 1;
                        foreach ($getcoinsHistory as $coinHistory) {
                      ?>
                      <tr>
                        <td><?= !empty($sr) ? $sr : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->tableId) ? $coinHistory->tableId : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->game) ? $coinHistory->game : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->gameType) ? $coinHistory->gameType : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->betValue) ? $coinHistory->betValue : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->coins) ? $coinHistory->coins : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->isWin) ? $coinHistory->isWin : 'NA'; ?></td>
                        <td><?= !empty($coinHistory->adminCommition) ? $coinHistory->adminCommition : 'NA'; ?></td>
                      </tr>
                      <?php $sr++; } } ?>
                      
                    </tbody> 
                  </table> 
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
