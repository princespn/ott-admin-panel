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
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header col-md-12">
              <div class="col-md-2 box-title paddLeft"><?= $heading; ?></div>
              <div class="col-md-3" id="msgHide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></div>
              <div class="col-md-7">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
             <!--  <input type="text" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> --> 
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Betting Prize</th>
                  <th>No. of Players</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                      <th>1</th>
                      <th>100</th>
                      <th>2</th>
                    </tr>

                    <tr>
                      <th>2</th>
                      <th>200</th>
                      <th>2</th>
                    </tr>

                    <tr>
                      <th>3</th>
                      <th>300</th>
                      <th>3</th>
                    </tr>

                    <tr>
                      <th>4</th>
                      <th>400</th>
                      <th>4</th>
                    </tr>

                    <tr>
                      <th>5</th>
                      <th>500</th>
                      <th>5</th>
                    </tr>
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