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
        <li><a href="<?= site_url(KYC); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <div class="col-md-8 box-title paddLeft">User Details</div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(KYC); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped table-bordered">
                <tbody>
                   <tr>
                      <td class="text_view text-info" colspan="6"><h4><b>Personal : </b><h4></td>
                    </tr>
                    <tr>
                  <th>E-mail</th>
                  <td><?php if(!empty($getKycData->email_id)){ echo $getKycData->email_id; }else{ echo "NA"; } ?><?php if($getKycData->is_emailVerified =='Yes'){ ?>
                    <label class="label label-success"><i class="fa fa-check"></i></label>
                    <?php } else { ?>
                      <label class="label label-danger"><i class="fa fa-close"></i></label>
                    <?php } ?>
                  </td> 
                </tr>
                <tr>
                  <th>Mobile</th>
                  <td><?php if(!empty($getKycData->mobile)){ echo $getKycData->mobile; }else{ echo "NA"; } ?></td> 
                </tr>
                <tr>
                  <th>Username</th>
                  <td><?php if(!empty($getKycData->user_name)){ echo $getKycData->user_name; }else{ echo "NA"; } ?></td> 
                </tr>
                <tr>
                </tbody>
              </table>
            </div>

            <div class="box-body">
              <table class="table table-striped table-bordered">
                <input type="hidden" name="userId" id="userId" value="<?= $getKycData->id; ?>">
                <tr>
                    <td class="text_view text-info" colspan="6"><h4><b>Bank Details: </b><h4></td>
                </tr>
                <thead>
                  <thead>
                    <tr>
                      <th>Bank Name</th>
                      <th>Acc. Holder Name</th>
                      <th>AC/no</th>
                      <th>IFSC code</th>
                      <?php if(!empty($getKycData->is_bankVerified) && $getKycData->is_bankVerified == 'Rejected') { ?>
                      <th>Bank Rejected Reason</th>
                      <?php } ?>
                      <th>Is Verified</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(empty($getKycData->acc_holderName) && empty($getKycData->bank_name) && empty($getKycData->accno) && empty($getKycData->ifsc)) { ?>
                    <tr>
                        <td colspan="6">
                            <center>No Bank Details Available </center>
                        </td>
                    </tr>
                  <?php  }else{ ?>
                    <tr>
                      <td><?= $getKycData->bank_name ; ?></td>
                      <td><?= $getKycData->acc_holderName; ?></td>
                      <td><?= $getKycData->accno; ?></td>
                      <td><?= $getKycData->ifsc;   ?></td>
                      <?php if(!empty($getKycData->is_bankVerified) && $getKycData->is_bankVerified == 'Rejected') { ?>
                        <th><?= $getKycData->bankRejectionReason; ?></th>
                      <?php } ?>
                      <td>
                        <div style="word-wrap: break-word; height:auto" id="verifyAadhar">
                          <?php if($getKycData->is_bankVerified == 'Verified'){ ?>
                            <label class="btn btn-sm btn-success" onClick="return statusChange('<?= $getKycData->is_bankVerified; ?>');"><b>Verified</b></label>
                          <?php }else if($getKycData->is_bankVerified == 'Pending') { ?> 
                            <label class="btn btn-sm btn-warning" onClick="return statusChange('<?= $getKycData->is_bankVerified; ?>');"><b>Pending</b></label>
                          <?php } else if($getKycData->is_bankVerified == 'Rejected'){ ?>
                            <label class="btn btn-sm btn-danger" onClick="return statusChange('<?= $getKycData->is_bankVerified; ?>');"><b>Rejected</b></label>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </thead>
              </table>
            </div>

            <div class="box-body">
              <table class="table table-striped table-bordered">
                <tr>
                    <td class="text_view text-info" colspan="6"><h4><b>Aadhar Card Details: </b><h4></td>
                </tr>
                <thead>
                  <thead>
                    <tr>
                      <th>Aadhar No.</th>
                      <th>Aadhar Front Image</th>
                      <th>Aadhar Back Image</th>
                      <?php if(!empty($getKycData->is_aadharVerified) && $getKycData->is_aadharVerified == 'Rejected') { ?>
                      <th>Aadhar Rejected Reason</th>
                      <?php } ?>
                      <th>Is Verified</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(empty($getKycData->adharCard_no) && empty($getKycData->adharFron_img) && empty($getKycData->adharBack_img)) { ?>
                    <tr>
                        <td colspan="6">
                            <center>No Aadhar Card Details Available </center>
                        </td>
                    </tr>
                  <?php  }else{ ?>
                    <tr>
                      <td><?= $getKycData->adharCard_no ; ?></td>
                     <!--  <td><?= $getKycData->adharFron_img; ?></td>
                      <td><?= $getKycData->adharBack_img; ?></td> -->
                      <td>
                         <a href="#aadhar_image"  data-toggle="modal" alt="<?php echo $getKycData->adharFron_img;?>" onclick='return set_aadhar_image("<?= $getKycData->adharFron_img ?>");' ><i class="fa fa-picture-o"></i></a>
                      </td>
                      <td>
                         <a href="#aadhar_image"  data-toggle="modal" alt="<?php echo $getKycData->adharBack_img;?>" onclick='return set_aadhar_image("<?= $getKycData->adharBack_img ?>");' ><i class="fa fa-picture-o"></i></a>
                      </td>

                      <?php if(!empty($getKycData->is_aadharVerified) && $getKycData->is_aadharVerified == 'Rejected') { ?>
                        <th><?= $getKycData->aadharRejectionReason; ?></th>
                      <?php } ?>
                      <td>
                        <div style="word-wrap: break-word; height:auto" id="verifyAadhar">
                          <?php if($getKycData->is_aadharVerified == 'Verified'){ ?>
                            <label class="btn btn-sm btn-success" onClick="return aadharStatusChange('<?= $getKycData->is_aadharVerified; ?>');"><b>Verified</b></label>
                          <?php }else if($getKycData->is_aadharVerified == 'Pending') { ?> 
                            <label class="btn btn-sm btn-warning" onClick="return aadharStatusChange('<?= $getKycData->is_aadharVerified; ?>');"><b>Pending</b></label>
                          <?php } else if($getKycData->is_aadharVerified == 'Rejected'){ ?>
                            <label class="btn btn-sm btn-danger" onClick="return aadharStatusChange('<?= $getKycData->is_aadharVerified; ?>');"><b>Rejected</b></label>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </thead>
              </table>
            </div>

            <div class="box-body">
              <table class="table table-striped table-bordered">
                <tr>
                    <td class="text_view text-info" colspan="6"><h4><b>Pan Card Details: </b><h4></td>
                </tr>
                <thead>
                  <thead>
                    <tr>
                      <th>Pan No.</th>
                      <th>Pan Image</th>
                      <?php if(!empty($getKycData->is_panVerified) && $getKycData->is_panVerified == 'Rejected') { ?>
                      <th>Pan Rejected Reason</th>
                      <?php } ?>
                      <th>Is Verified</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(empty($getKycData->panCard_no) && empty($getKycData->pan_img)) { ?>
                    <tr>
                        <td colspan="6">
                            <center>No Pan Card Details Available </center>
                        </td>
                    </tr>
                  <?php  }else{ ?>
                    <tr>
                      <td><?= $getKycData->panCard_no ; ?></td>
                      <!-- <td><?= $getKycData->pan_img; ?></td> -->
                      <td>
                        <a href="#pan_image"  data-toggle="modal" alt="<?php echo $getKycData->pan_img;?>" onclick='return set_image("<?= $getKycData->pan_img ?>");' ><i class="fa fa-picture-o"></i></a>
                      </td>
                      <?php if(!empty($getKycData->is_panVerified) && $getKycData->is_panVerified == 'Rejected') { ?>
                        <th><?= $getKycData->panRejectionReason; ?></th>
                      <?php } ?>
                      <td>
                        <div style="word-wrap: break-word; height:auto" id="verifyPan">
                          <?php if($getKycData->is_panVerified == 'Verified'){ ?>
                            <label class="btn btn-sm btn-success" onClick="return panStatusChange('<?= $getKycData->is_panVerified; ?>');"><b>Verified</b></label>
                          <?php }else if($getKycData->is_panVerified == 'Pending') { ?> 
                            <label class="btn btn-sm btn-warning" onClick="return panStatusChange('<?= $getKycData->is_panVerified; ?>');"><b>Pending</b></label>
                          <?php } else if($getKycData->is_panVerified == 'Rejected'){ ?>
                            <label class="btn btn-sm btn-danger" onClick="return panStatusChange('<?= $getKycData->is_panVerified; ?>');"><b>Rejected</b></label>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </thead>
              </table>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

  <!-- Bank verifry Modal  -->
    <div class="modal fade" id="bankVerifyModal" data-modal-color="teal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">  
              <div class="modal-header row">
                <div class="col-md-9"><h4 class="modal-title">Bank Verification Status</h4></div>
                <div class="col-md-3 text-danger">* Required Fields</div>
              </div>     
                  <!-- <form id="updateCpForm" action="<?= site_url('Clients/index') ?>" style="margin-bottom: 0px;"> -->
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 modal-height">
                          <div class="form-group">
                            <label>Change Bank Status</label> <span class="text-danger">*</span> <span id="errisbankStatusVerify"></span>
                            <select class="form-control" id="isbankStatusVerify" onchange="return changeBankStatus(this.value);">
                            </select>

                          </div>
                          <div class="form-group" id="bankRejectStatus" style="display:none;">
                            <label>Rejection Reason</label> <span class="text-danger">*</span> <span id="errbankRejectionReason"></span>
                            <textarea class="form-control" name="bankRejectionReason" id="bankRejectionReason"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                     
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="return updateBankStatus();">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
  <!-- /.Modal -->

  <!-- Aadhar verify Modal -->
    <div class="modal fade" id="aadharVerifyModal" data-modal-color="teal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">  
              <div class="modal-header row">
                <div class="col-md-9"><h4 class="modal-title">Aadhar Verification Status</h4></div>
                <div class="col-md-3 text-danger">* Required Fields</div>
              </div>     
                  <!-- <form id="updateCpForm" action="<?= site_url('Clients/index') ?>" style="margin-bottom: 0px;"> -->
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 modal-height">
                          <div class="form-group">
                            <label>Change Aadhar Status</label> <span class="text-danger">*</span> <span id="errisAadharStatusVerify"></span>
                            <select class="form-control" id="isAadharStatusVerify" onchange="return changeAadharStatus(this.value);">
                            </select>

                          </div>
                          <div class="form-group" id="aadharRejectStatus" style="display:none;">
                            <label>Aadhar Rejection Reason</label> <span class="text-danger">*</span> <span id="erraadharRejectionReason"></span>
                            <textarea class="form-control" name="aadharRejectionReason" id="aadharRejectionReason"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                     
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="return updateAadharStatus();">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
  <!-- /.Modal -->


   <!-- Pan verify Modal -->
    <div class="modal fade" id="panVerifyModal" data-modal-color="teal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">  
              <div class="modal-header row">
                <div class="col-md-9"><h4 class="modal-title">Pan Verification Status</h4></div>
                <div class="col-md-3 text-danger">* Required Fields</div>
              </div>     
                  <!-- <form id="updateCpForm" action="<?= site_url('Clients/index') ?>" style="margin-bottom: 0px;"> -->
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 modal-height">
                          <div class="form-group">
                            <label>Change Pan Status</label> <span class="text-danger">*</span> <span id="errisPanStatusVerify"></span>
                            <select class="form-control" id="isPanStatusVerify" onchange="return changePanStatus(this.value);">
                            </select>

                          </div>
                          <div class="form-group" id="panRejectStatus" style="display:none;">
                            <label>Pan Rejection Reason</label> <span class="text-danger">*</span> <span id="errpanRejectionReason"></span>
                            <textarea class="form-control" name="panRejectionReason" id="panRejectionReason"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                     
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="return updatePanStatus();">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <!-- /.Modal -->

    <!-- For Pan Image -->
      <div class="modal fade" id="pan_image">
          <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kyc -  <span> Pan Card</span> </h4>
                </div>
                  <div class="modal-body">  
                    <center><img id="pan_modal_image"  width='100%'  height="100%" /></center>    
                  </div> 
              </div>
              <!-- /.modal-content --> 
          </div> 
      </div>
    <!-- / -->
     <!-- For Aadhar Image -->
    <div class="modal fade" id="aadhar_image">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Kyc -  <span> Aadhar Card</span> </h4>
              </div>
                <div class="modal-body">  
                  <center><img id="aadhar_modal_image"  width='100%'  height="100%" /></center>    
                </div> 
            </div>
            <!-- /.modal-content --> 
        </div> 
    </div>
     <!-- / -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>

<script type="text/javascript">
  function statusChange(statusVal){
    /*$("#bankStatus").val(statusVal);*/
    if(statusVal == 'Pending'){
    //alert("rer");return false;
      $("#bankVerifyModal").modal();
      $("#isbankStatusVerify").html('<option value="">select bank status</option><option value="Verified">Verified</option><option value="Rejected">Rejected</option>');
    }else if(statusVal == 'Verified'){
     $("#bankVerifyModal").modal();
      $("#isbankStatusVerify").html('<option value="">select bank status</option><option value="Pending">Pending</option><option value="Rejected">Rejected</option>');
    }else{
      $("#bankVerifyModal").modal();
      $("#isbankStatusVerify").html('<option value="">select bank status</option><option value="Verified">Verified</option><option value="Pending">Pending</option>');
    }
  }
   
  function changeBankStatus(bankStatus){
    if(bankStatus == 'Rejected'){
      $("#bankRejectStatus").fadeIn();
    }else{
      $("#bankRejectStatus").fadeOut(); 
    }
  }

  function updateBankStatus(){
    var isbankStatusVerify =  $("#isbankStatusVerify").val();
    var bankRejectionReason =  $("#bankRejectionReason").val();
    var userId =  $("#userId").val();

    if(isbankStatusVerify.trim() == '')
    {
      $("#errisbankStatusVerify").fadeIn().html("Please select status").addClass('text-danger');
      setTimeout(function(){$("#errisbankStatusVerify").html("&nbsp;");},5000)
      $("#isbankStatusVerify").focus();
      return false; 
    }

    if(isbankStatusVerify == 'Rejected'){
      if(bankRejectionReason.trim() == '')
      {
        $("#errbankRejectionReason").fadeIn().html("Please enter rejected status reason").addClass('text-danger');
        setTimeout(function(){$("#errbankRejectionReason").html("&nbsp;");},5000)
        $("#bankRejectionReason").focus();
        return false; 
      }
    }
    
    var site_url = $("#site_url").val();
    var url = site_url+"/Kyc/updateBankStatus";
    var datastring = "isbankStatusVerify="+isbankStatusVerify+"&bankRejectionReason="+bankRejectionReason+"&userId="+userId;
    $.ajax({
      method: "POST",
      url: url,
      data: datastring,
      catche: false,
      success:function(returndata)
      { 
        //alert(returndata);return false;
        if(returndata == 1){
          $("#bankVerifyModal").modal('hide');
          location.reload(); 
        }
      }
    });

  }

  function aadharStatusChange(statusVal){
    /*$("#docStatus").val(statusVal);*/
    if(statusVal == 'Pending'){
      $("#aadharVerifyModal").modal();
      $("#isAadharStatusVerify").html('<option value="">select document status</option><option value="Verified">Verified</option><option value="Rejected">Rejected</option>');
    }else if(statusVal == 'Verified'){
      $("#aadharVerifyModal").modal();
      $("#isAadharStatusVerify").html('<option value="">select document status</option><option value="Pending">Pending</option><option value="Rejected">Rejected</option>');
    }else{
      $("#aadharVerifyModal").modal();
      $("#isAadharStatusVerify").html('<option value="">select document status</option><option value="Verified">Verified</option><option value="Pending">Pending</option>');
    }
  }

  function changeAadharStatus(docStatus){
    if(docStatus == 'Rejected'){
      $("#aadharRejectStatus").fadeIn();
    }else{
      $("#aadharRejectStatus").fadeOut(); 
    }
  }

  function updateAadharStatus(){
    var isAadharStatusVerify =  $("#isAadharStatusVerify").val();
    var aadharRejectionReason =  $("#aadharRejectionReason").val();
    var userId =  $("#userId").val();

    if(isAadharStatusVerify.trim() == '')
    {
      $("#errisAadharStatusVerify").fadeIn().html("Please select status").addClass('text-danger');
      setTimeout(function(){$("#errisAadharStatusVerify").html("&nbsp;");},5000)
      $("#isAadharStatusVerify").focus();
      return false; 
    }

    if(isAadharStatusVerify == 'Rejected'){
      if(aadharRejectionReason.trim() == '')
      {
        $("#erraadharRejectionReason").fadeIn().html("Please enter rejected status reason").addClass('text-danger');
        setTimeout(function(){$("#erraadharRejectionReason").html("&nbsp;");},5000)
        $("#aadharRejectionReason").focus();
        return false; 
      }
    }
    

    var site_url = $("#site_url").val();
    var url = site_url+"/Kyc/updateAadharStatus";
    var datastring = "isAadharStatusVerify="+isAadharStatusVerify+"&aadharRejectionReason="+aadharRejectionReason+"&userId="+userId;
    $.ajax({
      method: "POST",
      url: url,
      data: datastring,
      catche: false,
      success:function(returndata)
      {  
        if(returndata == 1){
          $("#aadharVerifyModal").modal('hide');
          location.reload(); 
        }
      }
    });

  }

  function panStatusChange(statusVal){
    /*$("#docStatus").val(statusVal);*/
    if(statusVal == 'Pending'){
      $("#panVerifyModal").modal();
      $("#isPanStatusVerify").html('<option value="">select document status</option><option value="Verified">Verified</option><option value="Rejected">Rejected</option>');
    }else if(statusVal == 'Verified'){
      $("#panVerifyModal").modal();
      $("#isPanStatusVerify").html('<option value="">select document status</option><option value="Pending">Pending</option><option value="Rejected">Rejected</option>');
    }else{
      $("#panVerifyModal").modal();
      $("#isPanStatusVerify").html('<option value="">select document status</option><option value="Verified">Verified</option><option value="Pending">Pending</option>');
    }
  }

  function changePanStatus(docStatus){
    if(docStatus == 'Rejected'){
      $("#panRejectStatus").fadeIn();
    }else{
      $("#panRejectStatus").fadeOut(); 
    }
  }

  function updatePanStatus(){
    var isPanStatusVerify =  $("#isPanStatusVerify").val();
    var panRejectionReason =  $("#panRejectionReason").val();
    var userId =  $("#userId").val();

    if(isPanStatusVerify.trim() == '')
    {
      $("#errisPanStatusVerify").fadeIn().html("Please select status").addClass('text-danger');
      setTimeout(function(){$("#errisPanStatusVerify").html("&nbsp;");},5000)
      $("#isPanStatusVerify").focus();
      return false; 
    }

    if(isPanStatusVerify == 'Rejected'){
      if(panRejectionReason.trim() == '')
      {
        $("#errpanRejectionReason").fadeIn().html("Please enter rejected status reason").addClass('text-danger');
        setTimeout(function(){$("#errpanRejectionReason").html("&nbsp;");},5000)
        $("#panRejectionReason").focus();
        return false; 
      }
    }
    

    var site_url = $("#site_url").val();
    var url = site_url+"/Kyc/updatePanStatus";
    var datastring = "isPanStatusVerify="+isPanStatusVerify+"&panRejectionReason="+panRejectionReason+"&userId="+userId;
    $.ajax({
      method: "POST",
      url: url,
      data: datastring,
      catche: false,
      success:function(returndata)
      {  
        if(returndata == 1){
          $("#panVerifyModal").modal('hide');
          location.reload(); 
        }
      }
    });

  }


  function set_image(img)
  {
    //alert(img);return false;
    $("#pan_modal_image").attr("src","<?= base_url('uploads/kycImgs/pan'); ?>"+"/"+img);
    return true;
  }

  function set_aadhar_image(aadharImg)
  {
   // alert(aadharImg);return false;
    $("#aadhar_modal_image").attr("src","<?= base_url('uploads/kycImgs/aadhar'); ?>"+"/"+aadharImg);
    return true;
  }
</script>