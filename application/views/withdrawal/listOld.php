<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>

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
    					<div align="center" class="box-header col-md-12">
    						<!--  <button type="button" class="btn btn-success pull-left" name="" id="reset" style="margin-left:7px">Accept Selected</button>
    						 <button type="button" class="btn btn-danger pull-left" name="" id="reset" style="margin-left:7px">Reject Selected</button>
    						 <button type="button" class="btn btn-info pull-left" name="" id="reset" style="margin-left:7px">Export Selected</button> -->
      						<select name="users" > 
                      <option value="0">Search Users</option>
                      <?php if(!empty($getUsers)) { foreach ($getUsers as $users) { ?>
                      <option value="<?= $users->id; ?>"><?= $users->user_name; ?></option>
                    <?php } } ?>
                  </select>
    						 <!-- <button type="button" class="btn btn-primary pull-right" name="" id="reset">EXPORT ALL</button> -->
    					</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                  <thead>
                  <tr>
                    <th><input type="checkbox"></th>
                    <th>#</th>
                    <th>Username</th>
                    <th>Amount(RS)</th>
                    <th>Payment Mode</th>
                    <th>Date</th>
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
  var url = '<?= site_url("WithdrawalRequest/ajax_manage_page"); ?>';
  var actioncolumn=6;
  var pageLength='';
</script>

  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example_datatable').DataTable();
	} );
</script>
<script type="text/javascript">
  
  function changeBonusStatus(id,status) {
    var site_url   = $("#site_url").val();
    var ask        = confirm('Do you really want to '+status+' this bonus');
    var url        =  site_url+"/Withdrawal/changeBonusStatus";
    var datastring =  'id='+id+'&status='+status;
    if(ask == true) {
      $.post(url,datastring,function(data){
        table.draw();
        $("#msgHide").fadeIn().html(data);
        setTimeout(function(){$("#msgHide").html("&nbsp;");},5000);
      });
    }
  }
</script>