<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>
<style type="text/css">
  .bShow{
 box-shadow: 5px 5px 5px 5px gray;

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
             <div class="box-header">
               <input type="hidden" value="All" class="btn btn-default col-xs-2 filter_search_data" > 
               <button type="button" class="btn btn-primary col-xs-2 inactive" id="activeAll" onclick="kycFilter('All');">All</button> 
               <button type="button" class="btn btn-default col-xs-2 inactive" id="activeVerified" onclick="kycFilter('Verified');">Verified</button> 
               <button type="button" class="btn btn-default col-xs-2 inactive" id="activePending" onclick="kycFilter('Pending');">Pending</button> 
              <button type="button" class="btn btn-default col-xs-2 inactive" id="activeRejected" onclick="kycFilter('Rejected');">Rejected</button> 
               &nbsp;
            <!--    <button type="button" id="Verified" value="Verified" class="btn btn-default col-xs-2 filter_search_data1">
                &nbsp;
               <button type="button" id="Pending" value="Pending" class="btn btn-default col-xs-2 filter_search_data1"> -->
             </div>

           </div>

          <div class="box bShow">
            <div class="box-header col-md-12">

              <div class="col-md-3 box-title paddLeft"><?= $heading; ?></div>
              <form>
                <div class="col-md-7 text-right paddRight">
                  <div class="col-md-3 pull-right paddRight">
                    <input type="text" class="form-control datepicker filter_search_data2" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
                  </div>
                  <div class="col-md-3 pull-right paddRight">
                    <input type="text" class="form-control datepicker filter_search_data1" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-1">
                  <button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
                </div>
                <div class="col-md-1">
                  <a href="<?= site_url(KYCEXPORT); ?>" class="btn btn-success">Export</a> 
                </div>
              </form> 
              <!--  <div class="col-md-4 text-right paddRight">
                <a href="<?= site_url(KYCEXPORT); ?>" class="btn btn-success">Export</a> 
                <a href="#userImportModal" data-toggle="modal" class="btn btn-info pull-right">Import</a> 
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <input type="hidden" name="flag" id="flag" value="<?= $flag; ?>">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile </th>
                  <th>Kyc Date </th>
                  <th>Mobile Verified</th>
                  <th>Aadhaar Verified</th>
                  <th>Pan Verified</th>
                  <!-- <th>Bank Verified</th> -->
                  <th>Kyc Verified</th>
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


  <!-- Load common footer -->
<script type="text/javascript">
  var url = '<?= site_url(KYCAJAXLIST); ?>';
  var actioncolumn=9;
  var pageLength='';
    
</script>
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
function kycFilter(value){
  $('.filter_search_data').val(value);
  $('.inactive').removeClass('btn-primary btn-default').addClass('btn-default');
  $('#active'+value).removeClass('btn-default').addClass('btn-primary');  
  table.draw();
}

$(function() {
    var flag =$("#flag").val();
    if(flag != ''){
      kycFilter(flag)
    }
});


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