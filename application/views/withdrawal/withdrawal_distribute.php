<!-- Load common header -->
<?php $this->load->view('common/header');
?>

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
        <li><a href="<?= site_url(WITHDRAWAL); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header with-border">
              <div class="col-md-8 box-title paddLeft"><?= $heading; ?>
                 <!-- <span class="box-title" id="msgHide">&nbsp; &nbsp;
                  <?php if(!empty($this->session->flashdata('message'))) echo  $this->session->flashdata('message'); ?> 
                  </span> -->
                </div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(WITHDRAWAL); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
            </div>
            <!-- /.box-header -->
               <div class="box-body">
                  <div class="col-xs-12">

                    <?php
                     $action1 =  site_url('Paytm/saveAllDistributerRedeem'); 
                     //$action2 =  site_url('Paytm/checkDisburseStatus/'.$getData->orderId.'/'.$getData->id.'/'.$getData->user_detail_id.'/'.$getData->amount);

                     ?>
                    
                      <form method="post" action="<?= $action1; ?>" id="showBtn">
                    
                  
                    <div class="col-xs-6" style="padding-left:0" id="myDiv">
                      <table class="table table-bordered table-responsive" border="1">
                        <tr>
                            <td width="180px"><strong>User Name</strong></td>
                            <td><?php if(!empty($getData->user_name)) { echo ucwords($getData->user_name); } else { echo "NA"; } ?> </td>
                          </tr>                
                          
                          <tr>
                            <td width="180px"><strong>Withdraw Amount</strong></td>
                            <td><?php if(!empty($getData->amount)) { echo ucwords($getData->amount); } else { echo "NA"; } ?></td>
                          </tr>
                          <tr>
                            <td width="180px"><strong>Status</strong></td>
                            <td> <?php if(!empty($getData->status)) { ?>
                              <?php if($getData->status == 'Pending') { echo '<span class="label label-warning">'.$getData->status.'</span>'; } elseif($getData->status == 'Approved'){ echo '<span class="label label-success">'.$getData->status.'</span>'; }else{ echo '<span class="label label-danger">'.$getData->status.'</span>'; }  }else{ echo "NA"; } ?></td>
                          </tr>
                      </table>
                    </div>
                  </div> 

                      <input type="hidden" name="id" id="id" value="<?php echo $getData->id; ?>">
                      <input type="hidden" name="userId" id="userId" value="<?php echo $getData->user_detail_id; ?>">
                      <input type="hidden" name="userAmt" id="userAmt" value="<?php echo $userAmt; ?>">
                      <input type="hidden" name="orderId" id="orderId" value="<?php echo $getData->orderId; ?>">
                      <!-- <input type="hidden" name="transactionId" id="transactionId" value="<?php echo $getData->transactionId; ?>">
                      <input type="hidden" name="orderId" id="orderId" value="<?php echo $getData->orderId; ?>"> -->
                      <input type="hidden" name="withAmt" id="withAmt" value="<?php echo $getData->amount; ?>">
                      <?php if($getData->status == 'Pending') { ?>
                      <div style="padding-left: 10px;" id="refRadio">
                        <input type="radio" name="aprbtn" value="manually" checked class="aprbtn" onclick="btnShow('manually')" >Manually &nbsp;&nbsp;
                        <input type="radio" name="aprbtn" value="patym" class="aprbtn" onclick="btnShow('patym')">Cashfree
                      </div>
                      <br>
                      <?php } ?>

                      <div id="patymBtns" style="display: none">
                      <?php if($getData->status == 'Pending') { ?>
                        <button type="submit" class="btn btn-success" id="approveButton" >Approve Request</button> 
                        <button type="button" class="btn btn-danger" id="rejectButton" data-toggle="modal" data-target="#myRejectModal">Rejected Request</button> 
                      <?php }  ?>
                       <?php if($getData->status == 'Process') { ?>
                        <button type="submit" class="btn btn-success" id="resendButton">Resend Request</button> 
                       <!--  <button type="button" class="btn btn-danger" id="rejectButton" data-toggle="modal" data-target="#myRejectModal">Rejected Request</button>  -->
                      <?php } ?>
                      </div>

                      <div id="manuallyBtns" style="display: none">
                      <?php if($getData->status == 'Pending') { ?>
                        <button type="button" class="btn btn-success" id="mapproveButton" onclick="AprManually('manual')">Approve Request</button> 
                        <button type="button" class="btn btn-danger" id="mrejectButton" data-toggle="modal" data-target="#myRejectModal">Rejected Request</button> 
                      <?php }  ?>
                      </div>

                      <?php if (!empty($getAdminData)) { ?>
                        <div class="col-xs-3"  style="padding:10">
                          <table class="table table-bordered table-responsive" border="1">
                            <tr>
                                <td><strong>Admin Percentage</strong></td>
                                <td><strong>Admin Amount</strong></td>
                              </tr>
                              <tr>
                                <td><?= $getAdminData->adPercent.' %'; ?></td>
                                <td><?= '&#36; '.$getAdminData->adTotalAmt; ?></td>
                              </tr>
                          </table>
                        </div>
                    <?php } ?>
               <!--  <?php if (!empty($getUserData)) { ?>
                      <div class="col-xs-2">
                          <table class="table table-bordered table-responsive" border="1">
                            <tr>
                                <td><strong>User Amount</strong></td>
                              </tr>
                              <tr>
                                <td><?= '&#36; '.$getUserData->total_amount; ?></td>
                              </tr>
                          </table>
                      </div>
                  <?php } ?> -->
                </div>
            <!-- /.box-body -->
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

          <div class="modal fade" id="myRejectModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Redeem Request Reject Reason</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rejectReason">Enter Reason <span style="color: red;"> * </span><span id="reason_err"></span></label>
                            <textarea style="max-width:100%;" type="text" class="form-control" name="rejectReason" id="rejectReason" placeholder="Enter Reason" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="return rejectRequest();">Submit</button>
                    </div>
                </div>
              </div>
                <!-- /.modal-content -->
          </div>

           <div class="modal fade" id="myApprovedModal">
              <form method="post" action="<?php echo site_url('Withdrawal/saveManuallyRedeemRequest'); ?>" id="appReqFrom">
                  <div class="modal-dialog modal-md">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Manually Approved Redeem Request</h4>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                  <label>User Amount </label><br/>
                                  <input type="text" class="form-control" name="userAmt" id="userAmt"  value="<?php echo $userAmt; ?>" autocomplete="off" readonly>
                              </div>

                              <div class="form-group">
                                  <label>Order Id <span style="color: red;"> * </span><span id="orderId_err"></span></label><br/>
                                  <input type="text" class="form-control" name="orderId" id="morderId" placeholder="Enter Order Id" value="" autocomplete="off">
                              </div>

                              <div class="form-group">
                                  <label>Transaction Id <span style="color: red;"> * </span><span id="transId_err"></span></label><br/>
                                  <input type="text" class="form-control" name="transId" id="mtransId" placeholder="Enter Transaction Id" value="" autocomplete="off">
                              </div>

                              <input type="hidden" name="id" id="id" value="<?php echo $getData->id; ?>">
                              <input type="hidden" name="userId" id="userId" value="<?php echo $getData->user_detail_id; ?>">
                              <input type="hidden" name="withAmt" id="withAmt" value="<?php echo $getData->amount; ?>">
                              <input type="hidden" name="userAmt" id="userAmt" value="<?php echo $userAmt; ?>">
                              <input type="hidden" name="approvedType1" id="approvedType1" value=""> 
                          </div>
                          <div class="modal-footer">
                              <button type="submit" class="btn btn-primary btn-md" id="appReqBtn" onclick="return approvedRequest();">Approve</button>
                              <button type="button" class="btn btn-default btn-md" data-dismiss="modal" aria-label="Close">Cancel</button>
                          </div>
                      </div>
                  </div>
                  <!-- /.modal-content -->
                </form>
            </div>
          
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  $(function() {
    var aprbtn =$(".aprbtn").val();
   if(aprbtn == 'manually'){
    $("#manuallyBtns").show();
   }else{
    $("#patymBtns").show();
   } 
});

  function AprManually(approvedType){
    $("#myApprovedModal").modal('show');
    $("#approvedType1").val(approvedType);
  }


  function btnShow(value){
      if(value == 'manually'){
        $("#patymBtns").hide();
        $("#manuallyBtns").show();
      }else{
        $("#patymBtns").show();
        $("#manuallyBtns").hide();
      } 
  }

  function approvedRequest() {
    var orderId = $("#morderId").val().trim();
    var transId = $("#mtransId").val().trim();

    if(orderId == '') {
      $("#orderId_err").html("Please Enter Order Id").css("color","red");
            setTimeout(function(){$("#orderId_err").html("");},4000);
            $("#morderId").focus();
            return false;
    }

    if(transId == '') {
      $("#transId_err").html("Please Enter Transaction Id").css("color","red");
            setTimeout(function(){$("#transId_err").html("");},4000);
            $("#tmransId").focus();
            return false;
    }
  }


  function rejectRequest() {
    var rejectReason = $("#rejectReason").val().trim();
    var id = $("#id").val();
    var userId = $("#userId").val();
    var transactionId = $("#transactionId").val();
    var orderId = $("#orderId").val();
    var withAmt = $("#withAmt").val();

        if(rejectReason == "") {
            $("#reason_err").html("Please enter reason").css("color","red");
            setTimeout(function(){$("#reason_err").html("");},2000);
            $("#rejectReason").focus();
            return false;
        }

    var site_url = $("#site_url").val();
    var url = site_url+"/Withdrawal/rejectRequest";
    var datastring = "id="+id+"&userId="+userId+"&rejectReason="+rejectReason+"&transactionId="+transactionId+"&orderId="+orderId+"&withAmt="+withAmt;
    $.ajax({
      type:'post',
      url:url,
      data:datastring,
      cache:false,
      success:function(returnData){
        //alert(returnData);return false;
        $("#myRejectModal").modal('hide');
        $("#myDiv").load(location.href + " #myDiv>*");
        $("#refRadio").load(location.href + " #refRadio>*");
        $("#msgHide").fadeIn().html(returnData);
        setTimeout(function(){$("#msgHide").html("&nbsp;");},5000);
        $("#mapproveButton").hide();
        $("#mrejectButton").hide();
        $("#resendButton").hide();
      },
    });
  }
</script>