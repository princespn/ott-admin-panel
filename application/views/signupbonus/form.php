<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<?php $this->load->view('common/left_panel.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(SIGNUPBONUS); ?>"><?= $breadhead; ?></a></li>
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
            <?php echo form_open($action); ?>

              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title<span class="text-danger"></span> <span class="text-danger">* </span><span id="errtitle" class="text-danger"><?= form_error('title'); ?></span></label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= $title; ?>" placeholder="Enter Title" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Amount (Rs.)<span class="text-danger"></span> <span class="text-danger">* </span><span id="errbonusAmount" class="text-danger"><?= form_error('bonusAmount'); ?></span></label>
                    <input type="text" class="form-control" name="bonusAmount" id="bonusAmount" value="<?= $bonusAmount; ?>" placeholder="Enter Amount" onkeypress="return only_number(event);" maxlength="4" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>From Date<span class="text-danger"></span> <span class="text-danger">* </span><span id="errfromDate" class="text-danger"><?= form_error('fromDate'); ?></span></label>
                    <input type="text" class="form-control datePick" name="fromDate" id="fromDate" value="<?= $fromDate; ?>" placeholder="Select From Date" autocomplete="off" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>From Time<span class="text-danger"></span> <span class="text-danger">* </span><span id="errfromTime" class="text-danger"><?= form_error('fromTime'); ?></span></label>
                    <input type="text" class="form-control timePick" name="fromTime" id="fromTime" value="<?= $fromTime; ?>" placeholder="Select From Time" autocomplete="off" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>To Date<span class="text-danger"></span> <span class="text-danger">* </span><span id="errtoDate" class="text-danger"><?= form_error('toDate'); ?></span></label>
                    <input type="text" class="form-control datePick" name="toDate" id="toDate" value="<?= $toDate; ?>" placeholder="Select To Date" autocomplete="off" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>To Time<span class="text-danger"></span> <span class="text-danger">* </span><span id="errtoTime" class="text-danger"><?= form_error('toTime'); ?></span></label>
                    <input type="text" class="form-control timePick" name="toTime" id="toTime" value="<?= $toTime; ?>" placeholder="Select To Time" autocomplete="off" readonly>
                  </div>
                </div>

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

                <div class="col-md-12" style="margin-top: 10px;">
                  <div class="form-group">
                    <input type="hidden" name="id" name="id" value="<?= $id;?>">
                    <button type="submit" class="btn btn-primary" onclick="return validSignUpBonus();"><?= $button; ?></button>&nbsp;
                    <a href="<?= site_url(SIGNUPBONUS); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
            <?php echo form_close(); ?>
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
<script src="jquery.datetimepicker.js"></script>
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript" src="<?= base_url(); ?>/assets/custom_js/signupbonus.js"></script>