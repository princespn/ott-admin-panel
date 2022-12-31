<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/jquery-ui.css">
<style type="text/css">
  .error
  {
    color:red;
  }
</style>
<?php $this->load->view('common/left_panel'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(CMS); ?>"><?= $breadhead; ?></a></li>
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
                 <input type="hidden" name="id" value="<?=$id;?>">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label >Title <span class="text-danger"> * </span> <span class="text-danger" id="title_err"><?= form_error('cms_title'); ?></span></label>
                
                  <input type="text" class="form-control" name="cms_title" id="title" placeholder="Enter Title" value="<?=$cms_title;?>" />
                </div>

                 <div class="col-md-6">
                  <label for="showIn">Show In<span class="text-danger"> * </span>
                   <span  id="showInerr" class="text-danger"><?= form_error('showIn[]'); ?></span></label>
                  <br/>
                   <input type="checkbox" class="showIn"  name="showIn[]"  value='Header' <?php if(in_array("Header",$showIn)){echo 'checked';}?>/>&nbsp;&nbsp;Header
                   <input type="checkbox" class="showIn"  name="showIn[]"  value='Footer' <?php if(in_array("Footer",$showIn)){echo 'checked';}?>/>&nbsp;&nbsp;Footer
                </div>

                  <div class="form-group col-md-12"></div>
                 <div class="form-group col-md-6">
                  <label for="description">Description <span class="text-danger"> * </span>
                  <span id="description_err" class="text-danger"><?= form_error('description'); ?> </span></label>
                  <textarea class="form-control ckeditor" name="description" id="description" placeholder="Enter Description"><?=$description;?></textarea>  
                </div>
                <?php  
                  $active="";$inactive="";  
                  if($status=='Inactive') $inactive="checked"; 
                  else if($status=='Active') $active="checked"; 
                 ?>
                <div class="form-group col-md-6">
                  <label for="status">Status<span class="text-danger"> * </span>
                  <span  id="type_err" class="text-danger"><?= form_error('status'); ?></span></label>
                  <?=  form_error('status'); ?>
                   <?= $this->session->flashdata('php_error'); ?> 
                  <br/>
                   <input type="radio" <?php  set_radio('status','Active',FALSE); ?>  name="status" value='active' <?php if($status=="Active"){echo 'checked';}else{ echo 'checked';}?>/>&nbsp;&nbsp;Active
                   <input type="radio" <?php set_radio('status','Inactive',FALSE); ?>  name="status" value='inactive' <?php if($status=="Inactive"){echo 'checked';}?>/>&nbsp;&nbsp;Inactive   
                </div>
                
              <!-- </div>   -->
              <div class="clearfix"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="hidden" id="button" value="<?php echo $button; ?>"/>
                 <button type="submit"  onclick="return valid();" class="btn btn-primary"><?= $button;  ?></button> 
                <a type="button" href="<?= site_url(CMS); ?>" class="btn btn-danger">Cancel</a>
              </div> 
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
    CKEDITOR.replace('#description'); 
  }) 
});
</script>
<script type="text/javascript" src="<?= base_url('assets/bower_components/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url();?>/assets/custom_js/cms.js"></script>
