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

              <div class="col-md-4 box-title paddLeft"><?= $heading; ?></div>
              <div class="col-md-4" id="msgHide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></div>
              <div class="col-md-4 text-right paddRight">
                <!-- <a href="<?= site_url(KYCEXPORT); ?>" class="btn btn-success">Export</a> -->
                <!-- <a href="#userImportModal" data-toggle="modal" class="btn btn-info pull-right">Import</a> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile </th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

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

<script type="text/javascript">
  var url = '<?= site_url(USERREPORTLIST); ?>';
  var actioncolumn=4;
  var pageLength='';
    
</script>
  <!-- Load common footer -->

<script type="text/javascript">
  
</script>
<?php $this->load->view('common/footer.php'); ?>