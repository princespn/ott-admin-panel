<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/jquery-ui.css">
<?php $this->load->view('common/left_panel'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(MAIL); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <div class="col-md-8 box-title"><?= $heading; ?></div>
              <div class="col-md-4 text-right text-danger">* Fields are required</div>
            </div>
            <!-- /.box-header -->
            <?= form_open($action);?>
              <div class="box-body">
                <?php $hidden = array('id'=>$mailBodyId,'button'=>$button);
                  echo form_hidden($hidden);
                ?>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mail Type<span class="text-danger"> * </span><span id="errmailType" class="text-danger"><?= strip_tags(form_error('mailbodyType'));?></span></label>
                    <input type="text" class="form-control" name="mailbodyType" id="mailbodyType" placeholder="Mail Type" value="<?= $mailbodyType ;?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mail Subject<span class="text-danger"> * </span><span id="errSubject" class="text-danger"><?= strip_tags(form_error('subject'));?></span></label>
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Mail Subject" value="<?= $subject ;?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mail Body<span class="text-danger"> * </span><span id="errBody" class="text-danger"><?= strip_tags(form_error('body'));?></span></label>
                    <textarea type="text" class="form-control ckeditor" name="body" id="body"><?= $body;?></textarea>
                  </div>
                </div>

                <div class="col-md-12" style="margin-top: 10px;">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="return valid();"><?= $button; ?></button>&nbsp;
                    <a href="<?= site_url(MAIL); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
                </div>
                
              </div>
            <?= form_close();?>
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
<script type="text/javascript">
  $(document).ready(function(){

  $(function () {
    CKEDITOR.replace('#body'); 
  }) 
});
</script>
<script type="text/javascript" src="<?= base_url('assets/bower_components/ckeditor/ckeditor.js'); ?>">

<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/mail.js"></script>