<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(MATCHHISTORY); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-8 box-title paddLeft">View Match Played History</div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(MATCHHISTORY); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped table-bordered zeroConfDatatable" width="100%">
                <thead>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>User Mobile</th>
                  <th>User Type</th>
                  <th>Is Win</th>
                  <th>Win/Loss Coins</th>
                  <th>Admin Commission</th>
                  <th>Admin Amount</th>
                </thead>
                <tbody>
                <?php if(!empty($matchesHistory))   { foreach ($matchesHistory as $matches) { ?>
                <tr>
                  <td><?= $matches->user_name; ?></td>
                  <td><?= $matches->email_id; ?></td>
                  <td><?= $matches->mobile; ?></td>
                  <td><?= $matches->playerType; ?></td>
                  <?php if($matches->isWin=='Win') {
                    $sign = '+ ';
                  }else{
                    $sign = '- ';
                  } ?>
                  <?php if($matches->playerType=='Real' && $matches->isWin=='Win'){
                    $coins = $matches->coins + $matches->adminAmount;
                  }else{
                    $coins = $matches->coins;
                  }?>
                  
                  <td><?= $matches->isWin; ?></td>
                  <td><?= $sign."".$coins; ?></td>
                  <td><?= $matches->adminCommition.'%'; ?></td>
                  <td><?= $matches->adminAmount; ?></td>
                </tr>
                <?php } } ?>
                </tbody>
              </table>
            </div>

          
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

