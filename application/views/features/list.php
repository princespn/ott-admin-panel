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
              <div class="col-md-4 box-title paddLeft"><?= $heading;?></div>
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right paddRight">
                  <a href="<?= site_url(FEATURESCREATE);?>" class="btn btn-primary"><?php if(!empty($create_button)) {  echo  $create_button; } ?> </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Status</th>
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
     <input type="hidden" name="tournaments" id="tournaments" value="<?php echo site_url(TOURNAMENTSTATUS); ?>">
     <input type="hidden" name="deleteUrl" id="deleteUrl" value="<?php echo site_url(FEATURESDELETE); ?>">
  </div>
  <!-- /.content-wrapper -->
 <div class="modal fade" id="messageModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <h1 class="text-center"><?php echo $this->session->flashdata('message')?></h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> 
<!-- /.Modal -->

<script type="text/javascript">
  var url = '<?= site_url(FEATURESAJAX); ?>';
  var actioncolumn=4;
  var pageLength='';
    
</script>

  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="<?= base_url()?>/assets/custom_js/features.js"></script>

