<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>
<style type="text/css">
  
  .mB{
    margin-bottom: 20px;
  }
</style>
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
            <div class="box-header col-md-12 mB">
              <div class="col-md-2 box-title paddLeft"><?= $heading; ?></div>
              <div class="col-md-3" id="msgHide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></div>
              <div class="col-md-7">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12 row mB"> 
                <form  method="post" autocomplete="off">
                  <div class="col-md-2"><h4><b>Enter Notification:</b></h4></div>
                  <div class="col-md-8"><textarea class="form-control" name="notification" id="notification" placeholder="Enter Notification"></textarea></div>
                  <div class="col-md-2"><button type="button" class="form-control btn btn-success text-center" onclick="return submitNotification();">Submit</button></div>
                </form>
              </div>

              <h3 class="text text-info"><b>Sent Notifications</b></h3>
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Notification</th>
                    <th>Date</th>
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

  <!-- Modal -->
  <div class="modal fade" id="myModalNotify">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">View Notification</h4>
          <span style="word-wrap: break-word;"><a href="" target="_blank"></a></span>
        </div>

        <div class="modal-body" id="notifyBody" style="height: 150px;overflow: auto;">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- /.content-wrapper -->
<script type="text/javascript">
  var url = '<?= site_url(NOTIFICATIONSAJAX); ?>';
  var actioncolumn=2;
  var pageLength='';
</script>
  <!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript" src="<?= base_url(); ?>/assets/custom_js/notification.js"></script>