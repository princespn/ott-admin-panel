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
              <form>
                <div class="col-md-3 box-title paddLeft"><?= $heading; ?></div>
                <div class="col-md-8">
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
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>User Name</th>
                  <th>Transaction Id</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Status</th>
                  <!-- <th>Transaction Id</th> -->
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
  var url = '<?= site_url(ORDERSLIST); ?>';
  var actioncolumn=5;
  var pageLength='';
</script>

  <!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>

<script type="text/javascript">  

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
