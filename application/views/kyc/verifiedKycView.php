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
        <li><a href="<?= site_url(VERIFIEDKYC); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-8 box-title paddLeft">User Details</div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(VERIFIEDKYC); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
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
                      <label class="label label-danger"><i class="fa fa-check"></i></label>
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
                    if(empty($getKycData)) { ?>
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
                      <td>
                        <div style="word-wrap: break-word; height:auto" id="verifyAadhar">
                          <?php if($getKycData->is_bankVerified == 'Verified'){ ?>
                            <label class="btn btn-sm btn-success"><b>Verified</b></label>
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
                            <label class="btn btn-sm btn-success" ><b>Verified</b></label>
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
                      <td>
                        <div style="word-wrap: break-word; height:auto" id="verifyPan">
                          <?php if($getKycData->is_panVerified == 'Verified'){ ?>
                            <label class="btn btn-sm btn-success" ><b>Verified</b></label>
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