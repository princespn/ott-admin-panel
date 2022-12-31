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
   <input type="hidden" name="id" value="<?= $getdata->id; ?>">
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
                     <div class="col-md-6"> 
                        <label for="title">Site Title<span class="text-danger"> * </span><span id="errsite_title" class="text-danger"><?= strip_tags(form_error('site_title'));?></span></label>
                        <input type="text" class="form-control" id="sitetitle" name="site_title" value="<?php if(!empty($getdata)){ echo $getdata->site_title;}?>"/>
                     </div>
                     <div class="col-md-6"> 
                        <label for="title">Company Name<span class="text-danger"> * </span><span id="errcompanyName" class="text-danger"><?= strip_tags(form_error('companyName'));?></span></label>
                        <input type="text" class="form-control" id="companyName" name="companyName" value="<?php if(!empty($getdata)){ echo $getdata->companyName;}?>"/>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="col-md-6">
                        <label for="title">Address<span class="text-danger"> * </span><span id="erraddress" class="text-danger"><?= strip_tags(form_error('address'));?></span></label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php if(!empty($getdata)){ echo $getdata->address;}?>"/>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="title">Email1<span class="text-danger"> * </span><span id="erremail1" class="text-danger"><?= strip_tags(form_error('email1'));?></span></label>
                        <input type="text" class="form-control" id="email1" name="email1" value="<?php if(!empty($getdata)){ echo $getdata->email1;}?>"/>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Email2</label><br/>    
                        <input type="text" class="form-control" id="email2" name="email2" value="<?php if(!empty($getdata)) { echo $getdata->email2;}?>"/> 
                     </div>
                     <div class="form-group col-md-6">
                        <label for="title">Phone</label>
                        <input type="text" maxlength="10" class="form-control" id="phone" name="phone" value="<?php if(!empty($getdata)){ echo $getdata->phone;}?>" onkeypress="only_number(event)"/>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Apk <span id="errapk" class="text-danger"><?= strip_tags(form_error('apk'));?></span><br/>
                        <small class="text text-info">Only apk file will be allow</small></label><br/>    
                        <input type="file" id="apk" name="apk" onclick="gamefileapk();" />
                        <?php if(isset($getdata->apk) && !empty($getdata->apk)) {  ?>
                        <input type="hidden" name="apk_old" value="<?= $getdata->apk ?>" />
                        <a  download class="btn btn-info"  href="<?= base_url('uploads/apkfiles/'.$getdata->apk); ?>" style="margin: 5px;">Download</a>
                        <?php }  ?>
                     </div>
                     <div class="col-md-6"> 
                        <label for="title">Version<span class="text-danger"> * </span><span id="errversion" class="text-danger"><?= strip_tags(form_error('version'));?></span></label>
                        <input type="text" class="form-control" id="version" name="version" value="<?php if(!empty($getdata)){ echo $getdata->version;}?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Contact Us<span class="text-danger"> * </span><span id="errcontact_us" class="text-danger"><?= strip_tags(form_error('contact_us_desc'));?></span></label><br/>    
                        <input type="text" class="form-control" id="contact_us" name="contact_us_desc" value="<?php if(!empty($getdata)){ echo $getdata->contact_us_desc;}?>"/>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="title">Copyright<span class="text-danger"> * </span><span id="errcopyright" class="text-danger"><?= strip_tags(form_error('copyright'));?></span></label>
                        <input type="text" class="form-control" id="copyright" name="copyright" value="<?php if(!empty($getdata)){ echo $getdata->copyright;}?>"/>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Website<span class="text-danger"> * </span><span id="errwebsite" class="text-danger"><?= strip_tags(form_error('website'));?></span></label>
                        <input type="url" class="form-control" id="website" name="website" value="<?php if(!empty($getdata)) { echo $getdata->website;}?>"/>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="title">Top Player Limit<span class="text-danger"> * </span><span id="errtopPlayerLimit" class="text-danger"><?= strip_tags(form_error('topPlayerLimit'));?></span></label>
                        <input type="text" class="form-control" id="topPlayerLimit"  name="topPlayerLimit" value="<?php if(!empty($getdata)) { echo $getdata->topPlayerLimit;}?>" onkeypress="only_number(event)"/>
                     </div>
                  </div>
                  <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Admin Percentage (For User Redeem) (%) With 5% Paytm Tax<!-- <span class="text-danger"> * </span> --><span id="erradminPercent" class="text-danger"></span></label>
                        <input type="text" class="form-control" id="adminPercent"  name="adminPercent" value="<?php if(!empty($getdata)) { echo $getdata->adminPercent;}?>" onkeypress="only_number(event)"/>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="baseUrl">Base Url<span class="text-danger"> * </span><span id="errbaseUrl" class="text-danger"><?= strip_tags(form_error('baseUrl'));?></span></label>
                        <input type="text" class="form-control" id="baseUrl"  name="baseUrl" value="<?php if(!empty($getdata->baseUrl)){
                           echo $getdata->baseUrl;
                           }?>" autocomplete="off"/>
                     </div>
                  </div>
                   <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Referral Bonus<span class="text-danger"> * </span><span id="errreferralBonus" class="text-danger"><?= strip_tags(form_error('referralBonus'));?></span></label>
                        <input type="text" class="form-control" id="referralBonus"  name="referralBonus" value="<?php if(!empty($getdata->referralBonus)) { echo $getdata->referralBonus;}?>" onkeypress="only_number(event)"/>
                     </div>
                  </div>

                  <div class="form-group col-md-12">
                     <div class="form-group col-md-6">
                        <label for="title">Logo</label><br/>    
                        <input type="file" class="form-control" name="logo" id="logo" onclick="return logoFile()"/>
                        <span><img src="<?php if(!empty($getdata)){echo base_url('uploads/settings/'.$getdata->logo);}?>" width="50px"/></span> 
                        <input type="hidden" name="old_photo" value="<?php if(!empty($getdata)){echo $getdata->logo;}?>">
                        <span class="error" id="err_logo"></span><br/>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Home Page Video Url</label> <span class="text-danger"> * </span> <span class="error" id="err_videoUrl"></span><br/>    
                        <input type="file" class="form-control" name="videoUrl" id="videoUrl" onclick="return homeVideoFile()"/>
                        <span class="text text-info">Note : Select type like mp4, avi, wmv video</span><br/>    
                        <span>
                           <video width="150" height="100" controls>
                              <source src="<?php if(!empty($getdata)){echo base_url('uploads/settings/'.$getdata->videoUrl);}?>" type="video/mp4">
                              <source src="movie.ogg" type="video/ogg">
                           </video>
                        </span>
                        <input type="hidden" name="old_videoUrl" value="<?php if(!empty($getdata)){ echo $getdata->videoUrl; }?>">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.box-body -->  
      <div class="box-footer bShow">
         <button type="submit" onclick="return valid();" class="btn btn-primary">Update</button>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Load common footer -->
<?php $this->load->view('common/footer.php');?>
<script type="text/javascript" src="<?= base_url();?>/assets/custom_js/settings.js"></script>