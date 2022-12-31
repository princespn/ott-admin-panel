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
        <li><a href="<?= site_url('Dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(ITEMS); ?>"><?= $breadhead; ?></a></li>
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
                <div class="form-group col-md-6">
                  <label>Name<span class="text-danger"> * </span><span id="erritemName" class="text-danger"><?php echo form_error('itemName'); ?></span></label>
                  <input type="text" class="form-control" name="itemName" id="itemName" placeholder="Enter Name" value="<?= $itemName; ?>"  autocomplete="Off">
                </div>

                <div class="form-group col-md-6">
                  <label>Price<span class="text-danger"> * </span><span id="erritemPrice" class="text-danger"><?php echo form_error('itemPrice'); ?></span></label>
                  <input type="text" class="form-control" name="itemPrice" id="itemPrice" placeholder="Enter Price" value="<?= $itemPrice; ?>"  onkeypress="only_number(event)" autocomplete="Off">
                </div>


                <div class="form-group col-md-12" style="margin-top: 10px;">
                  <input type="hidden" name="button" value="<?= $button; ?>">
                  <input type="hidden" name="id" value="<?= $id; ?>">
                  <button type="submit" class="btn btn-primary" onclick="return validateItem();"><?= $button; ?></button>&nbsp;
                  <a href="<?= site_url(ITEMS); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/item.js"></script>