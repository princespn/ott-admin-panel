<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>

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

          <div class="box">
            <div class="box-header col-md-12">
              <div class="col-md-4 box-title paddLeft"><?= $heading; ?></div>
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right paddRight">
                <!-- <a href="<?= site_url(EMAILCREATE); ?>" class="btn btn-primary">Create</a> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Mail Type</th>
                  <th>Mail Subject</th>
                  <th>Mail Body</th>
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
  var url = '<?= site_url(MAILLIST); ?>';
  var actioncolumn=4;
  var pageLength='';
</script>

  <!-- Load common footer -->
<script type="text/javascript">
  
  function deleteEmail(id) {
    $("#Deletemodal").modal('show');
    $("#deleteSuccBtn").click(function(){
      var site_url   = $("#site_url").val();
      var url        =  site_url+"/<?= EMAILDELETE; ?>";
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
<?php $this->load->view('common/footer'); ?>

