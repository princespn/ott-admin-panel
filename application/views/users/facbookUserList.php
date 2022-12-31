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
			<div class="col-md-12" style="padding:10px;">
				<a href="<?= site_url(USEREXPORT); ?>" class="btn btn-default">Excel Export</a>&nbsp;
				<!-- <a href="javascript:void(0)" class="btn btn-default">Pdf Export</a> -->
          <form>
              <div class="col-md-10">
                <div class="col-md-4 pull-right paddRight">
                  <input type="text" class="form-control datepicker filter_search_data1" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
                </div>
                <div class="col-md-4 pull-right paddRight">
                  <input type="text" class="form-control datepicker filter_search_data" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
                </div>
              </div>
              <div class="col-md-1">
                <button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
              </div>
          </form>
			</div> 
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped display" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Mobile</th>
                  <th>Game Played</th>
                  <th>Wallet</th>
                  <!-- <th>Win Wallet</th> -->
                  <th>Reg Date</th>
                  <th>Last Login</th>
                  <th>Block Users</th>
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
  <!-- /.content-wrapper -->

<script type="text/javascript">
	var url = '<?= site_url("Users/ajax_manage_page/"); ?>';
	var actioncolumn=9;
	var pageLength='';
</script>


<!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  function blockuserChange(id)
  { 
    $("#Statusmodal").modal('show');
    $("#statusSuccBtn").click(function(){
    var site_url = $("#site_url").val();
    var url = site_url+"/Users/blockUserChange";
      var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
      $.post(url,datastring,function(data){
        $("#Statusmodal").modal('hide');
        $("#Statusmodal").load(location.href+" #Statusmodal>*","");
        var obj = JSON.parse(data);
        csrfName = obj.csrfName;
        csrfHash = obj.csrfHash;
        table.draw();
        $("#msgData").val(obj.msg);
        $("#toast-fade").click();
      });
    });
  }
</script>

<script type="text/javascript">
  function change_status(id)
  { 
    $("#Statusmodal").modal('show');
    $("#statusSuccBtn").click(function(){
    var site_url = $("#site_url").val();
    var url = site_url+"/Users/change_status";
      var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
      $.post(url,datastring,function(data){
        $("#Statusmodal").modal('hide');
        $("#Statusmodal").load(location.href+" #Statusmodal>*","");
        var obj = JSON.parse(data);
        csrfName = obj.csrfName;
        csrfHash = obj.csrfHash;
        table.draw();
        $("#msgData").val(obj.msg);
        $("#toast-fade").click();
      });
    });
  }
</script>

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


function deleteUser(id) {
    $("#Deletemodal").modal('show');
    $("#deleteSuccBtn").click(function(){
      var site_url   = $("#site_url").val();
      var url        =  site_url+"/<?= DELUSER; ?>";
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
