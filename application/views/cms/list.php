<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?=$heading?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><?=$bread?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="reloader" style="display: none;"></div>
          <div class="box bShow">
            <div class="box-header col-md-12">
              <div class="col-md-4 box-title paddLeft"><?=$heading?></div>
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right paddRight">
                <!-- <?php if(!empty($import)) { ?>  
                   <?php  echo  $import; ?>
                 <?php } ?> -->
                <a href="<?= site_url(CMSCREATE); ?>" class="btn btn-primary"><?php if(!empty($create_btn)) {  echo  $create_btn; } ?> </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>ShowIn</th>
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
  </div>
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

<!-- Modal -->
<div class="modal fade" id="myModalDesc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Description</h4>
        <span style="word-wrap: break-word;"><a href="" target="_blank"></a></span>
      </div>

      <div class="modal-body" id="descBody" style="height: 250px;overflow: auto;">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  var url = '<?= site_url(CMSAJAX); ?>';
  var actioncolumn=5;
  var pageLength='';
</script>
<script type="text/javascript">
 
  
  function getDesc(id){
    $(".reloader").show();
    var site_url = $('#site_url').val();
    var url = site_url+"/Cms/getDesc";
    var datastring = "id="+id;
   $.post(url,datastring,function(returndata){ 
      $(".reloader").hide();
      $("#descBody").html(returndata);
    });
  }
</script>

  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript" src="<?= base_url();?>/assets/custom_js/cms.js"></script>