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
        <li><a href="<?= site_url(BONUS); ?>"><?= $breadhead; ?></a></li>
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
                    <label>Playe Game<span class="text-danger"></span> <span class="text-danger">* </span><span id="errplayGame" class="text-danger"><?= form_error('playGame'); ?></span></label>
                    <input type="text" class="form-control" name="playGame" id="playGame" placeholder="Game" onkeypress="return only_number(event);"  autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Apply Bonus<span class="text-danger"></span> <span class="text-danger">* </span><span id="errbonus" class="text-danger"><?= form_error('bonus'); ?></span></label>
                    <input type="text" class="form-control" name="bonus" id="bonus" placeholder="Apply Bonus" onkeypress="return only_number(event);"  autocomplete="off">
                  </div>
                </div>

                <div class="col-md-12" style="margin-top: 10px;">
                  <div class="form-group">
                    <input type="hidden" name="button" id="button" value="<?= $button; ?>">
                    <button type="submit" class="btn btn-primary" onclick="return validBonus();"><?= $button; ?></button>&nbsp;
                    <a href="<?= site_url(BONUS); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
            <?php echo form_close(); ?>
            <!-- </form> -->
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
<script type="text/javascript" src="<?= base_url(); ?>/assets/custom_js/bonus.js"></script>