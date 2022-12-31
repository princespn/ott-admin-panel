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
        <li><a href="<?= site_url(FEATURES); ?>"><?= $breadhead; ?></a></li>
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
            <!-- <form action="<?php echo $action?>" method="post" enctype="multipart/form-data"> -->
              <?= form_open_multipart($action); ?>
                  <input type="hidden" name="id" value="<?= $id; ?>">
              <div class="box-body">

              <div class="form-group col-md-12">  
                <div class="form-group col-md-6">
                  <label  for="title">Title <span class="text-danger" id="errtitle"> *</span> <span class="text-danger"> <?php echo form_error('title')?></span></label>
                  <span class="error" id="title_err"></span>
                  <!-- <?= form_error('title'); ?> -->
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= $title?>" />
                </div>
                  <!-- <div class="row"> 
                    <div class="col-md-6"> 
                      <div class="form-group">
                            <label for="image">Image <span class="text-danger">*</span>(235 X 163)  
                              <span class="text-primary">Note : Please select jpg, png, jpeg type of image</span><br>
                              <span class="text-danger" id='errimage'><?php echo form_error('image'); ?></span></label>
                            <input  type="file" class="form-control" name="image" id="image" placeholder="Image" onclick="return ImageFile()"/>
                            <?php   if(!empty($image_old) && file_exists(getcwd().'/uploads/features/'.$image_old)){  ?> 
                            <input type="hidden" name="image_old" id="image_old" value="<?php if(isset($image_old))echo $image_old; ?>" />
                            <div id="foto_profile">
                                <img width='100' height="100" src="<?= base_url("uploads/features/".$image_old); ?>" />
                            </div>
                            <?php  }   ?>
                      </div>
                    </div> 
                  </div> -->

                  <?php if($button=="Create"){ ?>
                  <div class="form-group col-md-6">
                    <label for="banner_type">Features Type <span class="text-danger" id="errimage">*  <span class="text-danger"><?php echo form_error('image')?></span></span></label>
                    
                     <input type="file" class="form-control" name="image"  id="image" onclick="return ImageFile();"/>
                      <span class="text-primary">Note : Please select jpg, png, jpeg type of image</span>
                  </div>
                  <?php } ?>

                  <?php if($button=="Update"){ ?>
                  <div class="form-group col-md-6">
                    <label for="banner_type">Features Type <span class="text-danger"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <span class="text-primary">Note : Please select jpg, png, jpeg type of image</span>
                     <input type="file" class="form-control" name="image"  id="image"/>
                    <!--    <small>Features image size shoddduld be 1440*500 px.</small> -->
                    <div><img src="<?= base_url('uploads/features/'.$image);?>" width="50px"></div>
                    <input type="hidden" name="old_photo" id="old_photo" value="<?=$image;?>">
                  </div>
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
                      <div class="text-danger" id="errstatus"><?php echo form_error('status')?></div>
                </div>
              <!-- </div>   -->
              <div class="clearfix"></div>
              </form>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="hidden" id="button" value="<?= $button?>"/>
                 <button type="submit"  onclick="return valid();" class="btn btn-primary"><?= $button;  ?></button> 
                <a type="button" href="<?= site_url(FEATURES); ?>" class="btn btn-danger">Cancel</a>
              </div> 
            <!-- </form> -->
            <?= form_close(); ?>
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
<?php $this->load->view('common/footer');?>
<script type="text/javascript" src="<?= base_url();?>/assets/custom_js/features.js"></script>