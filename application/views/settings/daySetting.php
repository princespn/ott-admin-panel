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
   <div class="modal fade" id="messageModal" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
               <h1 class="text-center"><?php echo $this->session->flashdata('message')?></h1>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- Main content -->
   <?= form_open_multipart($formAction); ?>
   <!-- <input type="hidden" name="id" value="<?= $getdata->id; ?>"> -->
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-header bShow">
               <div class="box-header with-border">
                  <div class="col-md-4 box-title paddLeft"><?=$heading?></div>
               </div>
               <!-- /.box-header -->
               <!-- form start --> 
               <div class="box-body">
                  <div class="form-group col-md-12">
                     <div style="height: 23px;">
                        <span style="color:red;"> <!-- id="showError"  -->
                           <!-- <?php if(isset($errorData) && !empty($errorData)) { 
                              echo $errorData;
                            } ?> -->
                            *Note: Please enter time in 24 Hr Format.
                        </span>
                     </div>
                     <table class="table table-bordered table-striped table-bordered">
                        <thead>
                           <th>Day</th>
                           <th>From Time 1</th>
                           <th>To Time 1</th>
                           <th>From Time 2</th>
                           <th>To Time 2</th>
                           <th>Edit</th>
                        </thead>
                        <tbody>
                           <?php if(!empty($getdata)){
                              foreach($getdata as $data){ ?>
                              <tr>
                                 <td>
                                    <!-- <label for="title">Day<span class="text-danger"> * </span><span id="errsite_title" class="text-danger"><?= strip_tags(form_error('day'));?></span></label> -->
                                    <input type="text" class="form-control" disabled id="day_<?= $data->dayIndex; ?>" name="day_<?= $data->dayIndex; ?>" value="<?php if(!empty($data)){ echo $data->day;}?>"/>
                                 </td>
                                 <td>
                                    <!-- <label for="title">From Time 1<span class="text-danger"> * </span><span id="errfromTime1" class="text-danger"><?= strip_tags(form_error('fromTime1'));?></span></label> -->
                                    <input type="text" class="form-control" disabled id="fromTime1_<?= $data->dayIndex; ?>" name="fromTime1_<?= $data->dayIndex; ?>" value="<?php if(!empty($data) && $data->fromTime1!='00:00:00'){ echo $data->fromTime1;}?>"/><!-- timepicker -->
                                 </td>
                                 <td> 
                                    <!-- <label for="title">To Time 1<span class="text-danger"> * </span><span id="errtoTime1" class="text-danger"><?= strip_tags(form_error('toTime1'));?></span></label> -->
                                    <input type="text" class="form-control" disabled id="toTime1_<?= $data->dayIndex; ?>" name="toTime1_<?= $data->dayIndex; ?>" value="<?php if(!empty($data) && $data->toTime1!='00:00:00'){ echo $data->toTime1;}?>"/><!-- timepicker -->
                                 </td>
                                 <td> 
                                    <!-- <label for="title">From Time 2<span class="text-danger"> * </span><span id="errfromTime2" class="text-danger"><?= strip_tags(form_error('fromTime2'));?></span></label> -->
                                    <input type="text" class="form-control" disabled id="fromTime2_<?= $data->dayIndex; ?>" name="fromTime2_<?= $data->dayIndex; ?>" value="<?php if(!empty($data) && $data->fromTime2!='00:00:00'){ echo $data->fromTime2;}?>"/><!-- timepicker -->
                                 </td>
                                 <td> 
                                    <!-- <label for="title">To Time 2<span class="text-danger"> * </span><span id="errtoTime2" class="text-danger"><?= strip_tags(form_error('toTime2'));?></span></label> -->
                                    <input type="text" class="form-control" disabled id="toTime2_<?= $data->dayIndex; ?>" name="toTime2_<?= $data->dayIndex; ?>" value="<?php if(!empty($data) && $data->toTime2!='00:00:00'){ echo $data->toTime2;}?>"/><!-- timepicker -->
                                 </td>
                                 <td> 
                                   <button type="button" class="btn btn-primary btn-circle btn-xs" title="Edit" id="edit_<?= $data->dayIndex; ?>" onclick="return enableFields('<?= $data->dayIndex; ?>')"><i class="fa fa-pencil"></i>
                                   </button>
                                    <button type="button" class="btn btn-primary btn-circle btn-xs" title="Disable" style="display: none" id="unedit_<?= $data->dayIndex; ?>" onclick="return disableFields('<?= $data->dayIndex; ?>')"><i class="fa fa-ban"></i>
                                   </button>
                                 </td>
                              </tr>
                           <?php } } ?>
                        </tbody>
                     </table>
                     <button type="submit" class="btn btn-primary">Update</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.box-body -->  
      <!-- <div class="box-footer bShow">
         
      </div> -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Load common footer -->
<?php $this->load->view('common/footer.php');?>
<script type="text/javascript" src="<?= base_url();?>/assets/custom_js/settings.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      setTimeout(function(){ $("#showError").html(''); },6000);
   });

   function enableFields(id){
      $("#fromTime1_"+id).prop("disabled",false);
      $("#toTime1_"+id).prop("disabled",false);
      $("#fromTime2_"+id).prop("disabled",false);
      $("#toTime2_"+id).prop("disabled",false);
      $("#edit_"+id).hide();
      $("#unedit_"+id).show();
   }

   function disableFields(id){
      $("#fromTime1_"+id).prop("disabled",true);
      $("#toTime1_"+id).prop("disabled",true);
      $("#fromTime2_"+id).prop("disabled",true);
      $("#toTime2_"+id).prop("disabled",true);
      $("#edit_"+id).show();
      $("#unedit_"+id).hide();
   }
</script>