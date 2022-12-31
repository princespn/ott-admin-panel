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
        <li><a href="<?= site_url(CUSTOMDICE); ?>"><?= $breadhead; ?></a></li>
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
                  <label>Name<span class="text-danger"> * </span><span id="errdiceName" class="text-danger"><?php echo form_error('diceName'); ?></span></label>
                  <input type="text" class="form-control" name="diceName" id="diceName" placeholder="Enter Name" value="<?= $diceName; ?>"  autocomplete="Off">
                </div>

                <div class="form-group col-md-6">
                  <label>Price<span class="text-danger"> * </span><span id="errdicePrice" class="text-danger"><?php echo form_error('dicePrice'); ?></span></label>
                  <input type="text" class="form-control" name="dicePrice" id="dicePrice" placeholder="Enter Price" value="<?= $dicePrice; ?>"  onkeypress="only_number(event)" autocomplete="Off">
                </div>


                 <div class="form-group col-md-6">
                  <label>Counter<span class="text-danger"> * </span><span id="errcounter" class="text-danger"><?php echo form_error('counter'); ?></span></label>
                  <input type="text" class="form-control" name="counter" id="counter" placeholder="Enter counter" value="<?= $counter; ?>"  onkeypress="only_number(event)" autocomplete="Off">
                </div>


                <div class="form-group col-md-12" style="margin-top: 10px;">
                  <input type="hidden" name="button" value="<?= $button; ?>">
                  <input type="hidden" name="id" value="<?= $id; ?>">
                  <button type="submit" class="btn btn-primary" onclick="return validateCustomDice();"><?= $button; ?></button>&nbsp;
                  <a href="<?= site_url(CUSTOMDICE); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
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
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/custom_dice.js"></script>