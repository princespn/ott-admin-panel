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
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right paddRight">
                <!-- <?php if(!empty($import)) { ?>  
                   <?php  echo  $import; ?>
                 <?php } ?> -->
                <a href="<?= site_url(BONUSCREATE); ?>" class="btn btn-primary"><?php if(!empty($create_btn)) {  echo  $create_btn; } ?> </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <!--  <div class="table-responsive"> -->
                  <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>
                      <th>Game</th>
                      <th>Apply Bonus</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                <!-- </div> -->
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
  <!-- Excel upload modal  --> <!-- 
<div class="modal fade" id="uploadData" data-modal-color="lightblue" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">   
              <?= form_open_multipart($importAction);?>
                <div class="modal-header">
                        <span style="font-size:20px" id="error_msg" ><?= $importTitle;?></span>
                    </div>     
                <div class="modal-body" style="padding-top: 3%">
                    <input type="file" name="excel_file" id="excel_file" class="form-control">
                        &nbsp;<span style="color:red" id="err_excel_file"></span>&nbsp;
                </div>
                <div class="modal-footer">
                    <a href="<?= $importSheet;?>" class="btn btn-primary">Download Excel</a>
                    <button type="submit" class="btn btn-success" onclick="return validations()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel
                    </button>
                </div>
              <?= form_close();?>
        </div>
    </div>
</div> -->
<!-- /Excel upload modal  -->
<script type="text/javascript">
  var url = '<?= site_url(BONUSAJAX); ?>';
  var actioncolumn=3;
  var pageLength='';
</script>

  <!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
<script type="text/javascript">
  function changeBonusStatus(id,status) {
  $("#appendData").html('Do you really want to '+status+' this bonus ?');
  $("#Statusmodal").modal('show');
  $("#statusSuccBtn").click(function(){
    var site_url   = $("#site_url").val();
    var url        =  site_url+"/Bonus/changeBonusStatus";
    var datastring =  'id='+id+'&status='+status+"&"+csrfName+"="+csrfHash;
      $.post(url,datastring,function(response){
        $("#Statusmodal").modal('hide');
        $("#Statusmodal").load(location.href+" #Statusmodal>*","");
          var obj   = JSON.parse(response);
          csrfName = obj.csrfName;
          csrfHash = obj.csrfHash;
        table.draw();
        $("#msgData").val(obj.msg);
        $("#toast-fade").click();
      });
  });
}

function deleteBonus(id) {
  $("#Deletemodal").modal('show');
  $("#deleteSuccBtn").click(function(){
    var site_url   = $("#site_url").val();
    var url        =  site_url+"/Bonus/deleteBonus";
    var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
    $.post(url,datastring,function(response){
      $("#Deletemodal").modal('hide');
      $("#Deletemodal").load(location.href+" #Deletemodal>*","");
          var obj   = JSON.parse(response);
          csrfName = obj.csrfName;
          csrfHash = obj.csrfHash;
        table.draw();
        $("#msgData").val(obj.msg);
        $("#toast-fade").click();
      });
  });
}
</script>