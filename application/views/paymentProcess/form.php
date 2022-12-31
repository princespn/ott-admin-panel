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
        <li><a href="<?= site_url(PAYMENTPROCESS); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-10 box-title"><?= $heading; ?></div>
              <div class="col-md-2 text-right text-danger">* Fields are required</div>
            </div>
            <!-- /.box-header -->
            <form  method="post" id="roomForm" action="<?= $action; ?>" enctype="multipart/form-data" autocomplete="off">
            <div class="box-body">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Title<span class="text-danger"> * </span><span id="errtitle" class="text-danger"><?php echo form_error('title'); ?></span></label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="<?= $title; ?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Set Order<span class="text-danger"> * </span><span id="errSetInOrders" class="text-danger"><?php echo form_error('setInOrders'); ?></span></label>
                  <input type="text" class="form-control" name="setInOrders" id="setInOrders" placeholder="Enter set orders" value="<?= $setInOrders; ?>" onkeypress="return only_number(event);">
                </div>
              </div>

              <div class="form-group col-md-6">
                <label for="question">Image<span class="text-danger">*</span> <span class="text-danger" id="errimage"></span></label><br/>
               <!--  <small class="text-primary">Note  :  Please upload 115px x 75px dimension image.</small> -->
                <?= form_error('image'); ?>  
                <input type="file" class="form-control" name="image" id="image" placeholder="Please select Image" value="<?= $image; ?>"  onclick="return imageFile()" accept="image/*"/>
                  <?php
                    $img = $image;
                    $Path= "uploads/payment-process/";
                    $File =FCPATH.$Path.$img;

                    if((file_exists($File)) && !empty($img))
                    { 
                      $myImg = base_url().$Path.$img;
                    } else {
                      $myImg = base_url().$Path."default.png";
                    } ?>
                 <?php if($button == "Update") { ?>
                  <img src="<?= $myImg; ?>" style="height: 40px; width: 70px; margin: 5px;" onclick="return imageFile()" accept="image/*">
                  <input type="hidden" name="old_image" id="old_image" value="<?= $image; ?>">
                <?php } ?> 
              </div>  

              <!-- status start -->
                   <?php  
                  $active="";$inactive="";  
                  if($status=='Inactive') $inactive="checked"; 
                  else if($status=='Active') $active="checked"; 
                 ?>
                <div class="form-group col-md-6">
                  <label for="status">Status&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <span class="error" id="type_err"></span>
                  <?=  form_error('status'); ?>
                   <?= $this->session->flashdata('php_error'); ?> 
                  <br/>
                   <input type="radio" <?= $active; ?> <?php  set_radio('status','Active',FALSE); ?>  name="status" value='active' checked/>&nbsp;&nbsp;Active
                   <input type="radio" <?= $inactive; ?> <?php set_radio('status','Inactive',FALSE); ?>  name="status" value='inactive' />&nbsp;&nbsp;Inactive   
                </div>

              <div class="clearfix"></div>
              <div class="col-md-12" style="margin-top: 10px;">
                <div class="form-group">
                  <input type="hidden" name="button" id="button" value="<?= $button; ?>">
                  <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                  <button type="submit" class="btn btn-primary" onclick="return Validate()"><?= $button; ?></button>&nbsp;
                  <a href="<?= site_url('PaymentProcess'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
              </div>

            </div>
          </form>
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
  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/PaymentProcess.js"></script>