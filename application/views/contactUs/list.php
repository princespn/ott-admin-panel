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
                  <th>Mobile </th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Reply</th>
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


<div class="modal fade" id="detailModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="title1">Send Reply</h4>
        </div>

        <div class="modal-body" id="panBody">
          <input type="hidden" id="replyId" >
          <label>Reply<span style="color:red;"> *</span></label>
          <span class="text-danger" id="replyMsgErr"></span>
          <textarea class="form-control" id="replyMsg" name="reply"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info pull-left" onclick="sendReplyMail();">Send</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


 <!--Enquiry Modal -->
<div class="modal fade" id="myreplyModalBody">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Reply</h4>
        <span style="word-wrap: break-word;"><a href="" target="_blank"></a></span>
      </div>

      <div class="modal-body" id="replyBody" style="height: 250px;overflow: auto;">
      
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
  var url = '<?= site_url(CONTACTAJAXLIST); ?>';
  var actioncolumn=7;
  var pageLength='';
    
</script>
  <!-- Load common footer -->

<script type="text/javascript">
  function Reply(id)
  {
    $('#detailModal').modal('show');
    $('#replyId').val(id);
  }

  function sendReplyMail()
  {
    var replyId = $('#replyId').val();
    var replyMsg = $('#replyMsg').val();

    if(replyMsg.trim()=='')
    {
       $("#replyMsgErr").fadeIn().html("Please enter reply.");
      setTimeout(function(){$("#replyMsgErr").html("&nbsp;");},3000);
      $("#replyMsg").focus();
      return false;
    }

    var url = '<?= site_url(SENDREPLY); ?>';
    $.ajax({
      type:"post",
      url:url,
      data:{replyId:replyId,replyMsg:replyMsg},
      success:function(result){
        var obj = JSON.parse(result);
        $('#detailModal').modal('hide');
        table.draw();
        $("#msgData").val(obj.msg);
        $('#replyMsg').val('');
        $("#toast-fade").click();
      }
    });
  }

      function getreply(id){
        var url = '<?= site_url(GETSENDREPLY);?>';
         var datastring ="id="+id; 
           $.ajax({
            type:"post",
            url:url,
            data:datastring,
            success:function(result){
             $("#replyBody").html(result);
            }
       });
    }

    function deleteContact(id) {
     $("#Deletemodal").modal('show');
    $("#deleteSuccBtn").click(function(){
      var site_url   = $("#site_url").val();
      var url        =  site_url+"/<?= CONTACTDELETE; ?>";
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
<?php $this->load->view('common/footer.php'); ?>