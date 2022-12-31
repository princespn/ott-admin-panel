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

          <div class="box">
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
                  <th>Mobile</th>
                  <th>Email Verified</th>
                  <th>Aadhar Verified</th>
                  <th>Pan Verified</th>
                  <th>Bank Verified</th>
                  <th>Kyc Verified</th>
                 <!--  <th>Pan Image</th>
                  <th>Adhar Image</th>
                  <th>Bank Details</th> -->
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
<!-- Image Modal -->
<div class="modal fade" id="ImgModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" id="panBody" >
          <center id="Image"></center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="detailModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="title1"></h4>
        </div>

        <div class="modal-body" id="panBody" >
          <center id="table"></center>
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
  var url = '<?= site_url(KYCAJAXLIST); ?>';
  var actioncolumn=9;
  var pageLength='';
    
</script>
  <!-- Load common footer -->

<script type="text/javascript">
  function verifyKyc(id)
  { 
    var url = '<?php echo site_url(VERIFYKYC); ?>';

    var ask = confirm("Do you want to change this status?");
    if (ask == true)
    {  
        var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
        $.post(url,datastring,function(response){
        var obj = JSON.parse(response); 
        csrfName = obj.csrfName;
        csrfHash = obj.csrfHash;
        table.draw();
        $("#msgHide").fadeIn().html(obj.msg);
        setTimeout(function(){$("#msgHide").html("&nbsp;");},3000)
      });
    }
  }
</script>

<script>
  //get pan image
  function getImage(id,type)
  {
    var url = '<?php echo site_url(KYCIMG); ?>';

    $.ajax({
      type:"post",
      url:url,
      data:{[csrfName]:csrfHash,id:id,imgType:type},
      success:function(result){
        var obj = JSON.parse(result);
        csrfName = obj.csrfName;
        csrfHash = obj.csrfHash;
        $('#ImgModal').modal();
        $('#title').html(obj.title);
        $('#Image').html('<img id="theImg" src="'+obj.getImg+'"width="200px"/>');
      }
    });
  }

  //get bank details 
  function getBankDetails(id)
  {
    var url = '<?php echo site_url(KYCBANKDETAIL); ?>';

    $.ajax({
      type:"post",
      url:url,
      data:{[csrfName]:csrfHash,id:id},
      success:function(result){
      var obj = JSON.parse(result);
        csrfName = obj.csrfName;
        csrfHash = obj.csrfHash;
        $('#detailModal').modal();
        $('#title1').html(obj.title);
        $('#table').html(obj.getTable);
      }
    });
  }
</script>
<?php $this->load->view('common/footer.php'); ?>