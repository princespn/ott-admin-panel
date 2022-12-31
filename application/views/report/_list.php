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
                <a onclick="multipleDelete();" class="btn btn-danger">Delete</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div id="noSelect" style="font-size: 15px; text-align: center;"></div>
            <div class="box-body">
              <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                <thead>
                <tr>
                  <th><input type="checkbox" name="select_all" id="select_all" type='checkbox'  value='' data-to-table="tasks"></th>
                  <th>Sr. No.</th>
                  <th>User Name</th>
                  <th>Title</th>
                  <th>Description</th>
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
          <input type="hidden" id="id">
          <label>Reply<span style="color:red;"> *</span></label>
          <span class="text-danger" id="err_reply"></span>
          <textarea class="form-control" id="reply" name="reply"></textarea>
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

<!-- /.End of modal -->

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
  var url = '<?= site_url(REPORTAJAX); ?>';
  var actioncolumn=6;
  var pageLength='';
</script>

<!-- multiple delete js-->
<script src="<?= base_url(); ?>assets/plugins/jQuery-2.1.4.min.js"></script><script type="text/javascript"></script>
<!-- /multiple delete js-->

<?php $this->load->view('common/footer.php'); ?>

<!-- multiple delete-->
<script>
  function deleteReply(id) {
     $("#Deletemodal").modal('show');
    $("#deleteSuccBtn").click(function(){
      var site_url   = $("#site_url").val();
      var url        =  site_url+"/<?= REPORTDELETEALL; ?>";
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

   function sendReplyMail(){
    var id = $("#id").val();
    var reply = $('#reply').val();
      if(reply==''){
        $("#err_reply").fadeIn().html("Please enter reply");
        setTimeout(function(){$("#err_reply").html("&nbsp;");},5000)
      $("#reply").focus();
      return false; 
      }

      var url = '<?= site_url(REPORTGETREPLY);?>';
      var datastring ="id="+id + '&reply='+reply;
       $.ajax({
            type:"post",
            url:url,
            data:datastring,
            success:function(result){
            var obj = JSON.parse(result);
            $('#detailModal').modal('hide');
             table.draw();
             $("#msgData").val(obj.msg);
             $('#reply').val('');
              $("#toast-fade").click();
            }
       });
    }


   function getReplyValues(id){
    $('#detailModal').modal('show');
      $("#id").val(id);
    }

    function getreply(id){
        var url = '<?= site_url(REPORTREPLY);?>';
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

  $("#select_all").click(function(){
    $('input[name="checkid[]"]:checkbox').not(this).prop('checked', this.checked);
  });

  function chageSelect(id)
  {
    var myarray = new Array();
    var checkbox_all = $("#checkid"+id).is(":checked");
    if(checkbox_all==true)
    {
        if(myarray=='')
        {
            myarray[0]=($("#checkid"+id).val());
        }else
        {
          myarray.push($("#checkid"+id).val());
        }
        $("#checkid"+id).attr('name', 'clients[]');  
    }
    else
    {
        var remove_val = $("#checkid"+id).val();
        var new_arr = remove_data(remove_val);
        myarray = new_arr;
        $("#checkid"+id).attr('name', 'YeNhiJayega');  
        $("#checkid"+id).attr('name', 'YeNhiJayega');  

        var select =$("#checkid"+id).is(":checked");
        if(select == false)
         {
          $("#selectall").attr('checked', false);
         } 
     }
  }

  function multipleDelete()
  {
    check_count=0;
    rowid=[];
    $(".checkid").each(function(){
      if($(this).is(":checked")==true)
      {//console.log(check_count);return false;
          check_count++;
          rowid.push($(this).val());
      }
    });
     if(check_count=='')
      {
    //console.log(check_count);
          $("#noSelect").fadeIn().html("<span style='color:red; '>Please select atleast one checkbox.</span>");
          setTimeout(function(){$("#noSelect").fadeOut();},6000)
          return false;
      }else
      {
          var url = '<?= site_url(REPORTDELETE);?>';
          var dataJson = { [csrfName]: csrfHash, id: rowid};

          $.ajax({
            type:"post",
            url:url,
            data:dataJson,
            success:function(result){
              var obj = JSON.parse(result);
                csrfName = obj.csrfName;
                csrfHash = obj.csrfHash;
                table.draw();
                $("#msgData").val(obj.msg);
                $("#toast-fade").click();
            }
          });
      }
  }
</script>
<!-- /multiple delete-->
