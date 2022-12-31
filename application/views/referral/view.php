<!-- Load common header -->
<?php $this->load->view('common/header');
 // print_r($getReferralUsers);exit;
 ?>

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
        <li><a href="<?= site_url(REFERRAL); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-8 box-title paddLeft">View of <?php if(!empty($getReferralUsers)){ echo $getReferralUsers[0]->referralUser; } else{ echo "";}?></div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(REFERRAL); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped table-bordered zeroConfDatatable" width="100%">
                <thead>
                  <th>Referral User</th>
                  <th>Referred Amount</th>
                  <th>Type</th>
                </thead>
                <tbody>
                  <?php  if(!empty($getReferralUsers))   { foreach ($getReferralUsers as $referredUser) { ?>
                    <tr>
                      <td><?= $referredUser->toUserName; ?></td>
                      <td><?= $referredUser->referalAmount; ?></td>
                      <td><?= $referredUser->referalAmountBy; ?></td>
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

