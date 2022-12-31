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

          <div class="box " style="border-top:2px solid red; margin-top: 10px;">
            <div class="box-header col-md-12">
            </div> 
            <!-- /.box-header -->
            <div class="box-body" >
				 <div class="col-md-12" >
                  <div class="form-group">				
					<div class="row">
						<div class="col-md-8">
							<h4>Game Version</h4>
						</div>
						<div class="col-md-4">
							<h4><?= !empty($getSetting->version) ?  $getSetting->version : "NA"; ?></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<h4>isPAYMENTENABLE :</h4>
						</div>
						<div class="col-md-4" id="maintainance">
              <?php if(!empty($getSetting->ispaymentenable) && $getSetting->ispaymentenable=='No') { ?>
							<button type="button" class="btn btn-danger" onclick="return openMaintainance('<?= $getSetting->id; ?>','<?= $getSetting->ispaymentenable; ?>')"><?= $getSetting->ispaymentenable; ?></button>
            <?php }else{ ?>
                <button type="button" class="btn btn-success"  onclick="return openMaintainance('<?= $getSetting->id; ?>','<?= $getSetting->ispaymentenable; ?>')"><?= $getSetting->ispaymentenable; ?></button>
            <?php } ?>
						</div>
					</div>
                  </div>
                </div>
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

     <!-- Bank verifry Modal  -->
    <div class="modal fade" id="maintaiModal">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Payment Mode</h4>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="userId" id="userId">
                  <div class="form-group">
                     <label for="mode">Payment Mode<span class="text-danger"> * </span><span id="err_mode" class="text-danger"></span></label>
                     <select class="form-control" id="mode"></select>

                    <!--  <select class="form-control" name="mode" id="mode" autocomplete="off">
                        <option value="">Select Mode</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                     </select> -->
                  </div>
                  <div class="form-group">
                     <label for="maintainanceMsg">Message<span class="text-danger"> * </span><span id="err_maintainanceMsg" class="text-danger"></span></label>
                     <textarea class="form-control" name="maintainanceMsg" id="maintainanceMsg" placeholder="Enter Message" autocomplete="off"></textarea>
                  </div>
                  <div class="form-group">
                     <button type="button" class="btn btn-success" onclick="paymentmaintainance()">Submit</button>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
               </div>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
  <!-- /.Modal -->


  </div>
  <!-- /.content-wrapper -->


  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  
  function openMaintainance(id,mode){
    if(mode=='No'){
      $("#maintaiModal").modal('show');
      $("#userId").val(id);
      $("#mode").html('<option value="Yes">Yes</option>');
    }else{
      $("#maintaiModal").modal('show');
      $("#userId").val(id);
      $("#mode").html('<option value="No">No</option>');
    }
    
  }

  function paymentmaintainance()
  { 
    var userId = $("#userId").val();
    var mode = $("#mode").val();
    var maintainanceMsg = $("#maintainanceMsg").val();
    /*if(mode == '')
    {
       $("#err_mode").fadeIn().html("Please select mode.");
       setTimeout(function(){$("#err_mode").html("&nbsp;");},3000);
       $("#mode").focus();
       return false;
    }else */if(maintainanceMsg == ''){
       $("#err_maintainanceMsg").fadeIn().html("Please enter messsage.");
       setTimeout(function(){$("#err_maintainanceMsg").html("&nbsp;");},3000);
       $("#maintainanceMsg").focus();
       return false;
    }else{
      var site_url = $("#site_url").val();
      var url = site_url+"/PaymentMode/paymentmessUpdate";
      var datastring = "id="+userId+"&mode="+mode+"&paymentmsg="+maintainanceMsg+"&"+csrfName+"="+csrfHash;
      $.post(url,datastring,function(data){
        var obj = JSON.parse(data);
        csrfName = obj.csrfName;
        csrfHash = obj.csrfHash;
        $("#maintaiModal").modal('hide');
        $("#maintaiModal").load(location.href+" #maintaiModal>*","");
        $("#maintainance").load(location.href+" #maintainance>*","");
        $("#msgData").val(obj.msg);
        $("#toast-fade").click();
      });
    }
   
  }
</script>
