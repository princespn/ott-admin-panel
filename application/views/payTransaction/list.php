<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header col-md-12">
    				  <!-- <div align="center" class="box-header col-md-12">
        				<select name="users" class="filter_search_data"> 
                  <option value="0">Search Users</option>
                  <?php if(!empty($getUsers)) { foreach ($getUsers as $users) { ?>
        					<option value="<?= $users->user_name; ?>"><?= $users->user_name; ?></option>
                <?php } } ?>
        				</select>
    				  </div> -->
              <div class="col-md-4">
               </div>
               <form>
                <div class="col-md-6">
                  <div class="col-md-6 pull-right paddRight">
                    <input type="text" class="form-control datepicker filter_search_data1" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
                  </div>
                  <div class="col-md-6 pull-right paddRight">
                    <input type="text" class="form-control datepicker filter_search_data" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-1">
                  <button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
                </div>
                 <div class="col-md-1 paddRight">
                   <!--  <a href="<?= site_url(); ?>" style="float:right;" class="btn btn-success">Excel Export</a>&nbsp; -->
                </div> 
              </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  
                  <th>Sr.No.</th>
                  <th>OrderId</th>
                  <th>Username</th>
                  <th>Mobile</th>
                  <th>Txn Amount(Rs)</th>
                  <th>Win Wallet (Rs)</th>
                  <th>Main Wallet (Rs)</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Payment Mode</th>
                  <th>Status</th>
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

<!-- Modal -->
<div class="modal fade" id="userImportModal" data-modal-color="teal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
      <form method="post" action="<?php echo site_url('Users/importUsers'); ?>" enctype="multipart/form-data">
        <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" id="closeCpModal">&times;</button> -->
          <h4 class="modal-title">Import Users
          <a href="<?php echo base_url('assets/import/Import_users_format.xlsx'); ?>"><span class="btn btn-success btn-sm btn-small pull-right" style="margin-right: 5px;">Download Format</span></a>  
          </h4>
        </div>     
        <div class="modal-body">
          <div class="row">
            <label class="col-md-4 control-label" for="inputLabel">Please select file : </label>
            <div class="col-md-4">   
              <input id="import_user" type="file"  placeholder="Upload Users" type="file" name="import_user">
            </div>
            <div class="col-md-4">
              <span id="errorUser"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" onclick="return User_Validation();">Upload</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </form>  
        </div>
    </div>
</div>

<!-- /.Modal -->
<script type="text/javascript">
   var url = '<?= site_url("PaymentTransaction/ajaxList"); ?>';
   var actioncolumn=10;
   var pageLength='';
</script>

<!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">  
function User_Validation()
{ 
  var import_user = $("#import_user").val(); 
  if(import_user == "")
  {  
    $("#errorUser").html("<span style='color:red;'>Please upload excel</span>").fadeIn();
    setTimeout(function(){$("#errorUser").fadeOut()},3000);
    return false; 
  }
}
</script>
