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
        <li><a href="<?= site_url('Dashboard'); ?>">Dashboard</a></li>
        <li><a href="<?= site_url('Settings'); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-4 box-title"><?= $heading; ?></div>
              <div class="col-md-4" id="msgHide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></div>
              <div class="col-md-4 text-right text-danger">* Fields are required</div>
            </div>
            <!-- /.box-header -->
            <form role="form" method="post" action="<?= $action ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-md-12">
                  <label>Site Title<span class="text-danger"> * </span><span id="errSiteTitle" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="site_title" id="site_title" placeholder="Enter site title" value="<?= $site_title; ?>">
                </div>

                <div class="form-group col-md-12">
                  <label>Tag Line<span class="text-danger"> * </span><span id="errTagLine" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="tag_line" id="tag_line" placeholder="Enter tag line" value="<?= $tag_line; ?>">
                </div>

                <div class="form-group col-md-12">
                  <label>Address<span class="text-danger"> * </span><span id="errAddress" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="Enter address" value="<?= $address; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Email<span class="text-danger"> * </span><span id="errEmail" class="text-danger"></span></label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?= $email; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Email1<span class="text-danger"> * </span><span id="errEmail1" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="email1" id="email1" placeholder="Enter email1" value="<?= $email1; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Phone<span class="text-danger"> * </span><span id="errPhone" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" value="<?= $phone; ?>" onkeypress="return only_number(event)" maxlength="10" />
                </div>

                <div class="form-group col-md-6">
                  <label>Phone1<span class="text-danger"> * </span><span id="errPhone1" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="phone2" id="phone2" placeholder="Enter phone1" value="<?= $phone2; ?>" onkeypress="return only_number(event)" maxlength="10">
                </div>

                <div class="form-group col-md-6">
                  <label>Coins<span class="text-danger"> * </span><span id="errCoins" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="coins" id="coins" placeholder="Enter coins" value="<?= $coins; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Share Points<span class="text-danger"> * </span><span id="errSharePoints" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="points_share" id="points_share" placeholder="Enter share points" value="<?= $points_share; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Reviews Points<span class="text-danger"> * </span><span id="errReviewPoints" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="points_reviews" id="points_reviews" placeholder="Enter reviews points" value="<?= $points_reviews; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Website<span class="text-danger"> * </span><span id="errWebsite" class="text-danger"></span></label>
                  <input type="text" class="form-control" name="website" id="website" placeholder="Enter website" value="<?= $website; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label>Background Image<span class="text-danger"> * </span><span id="errBgImage" class="text-danger"></span></label>
                  <input type="file" class="form-control" name="bg_image" id="bg_image" placeholder="Enter background image" value="<?= $bg_image; ?>" onclick="return imageFile()">

                  <input type="hidden" class="form-control" name="old_bg_image" id="old_bg_image" placeholder="Enter background image" value="<?= $bg_image; ?>">
                  <div>
                     <?php 
                      $background_image = $bg_image;
                      $path= "assets/images/settings/";
                      $file =FCPATH.$path.$background_image;

                      if((file_exists($file)) && !empty($background_image))
                       { 
                        $bg_img = base_url().$path.$background_image;
                       } else {
                        $bg_img = base_url().$path."defaultbanner.png";
                       } ?>
                      <img src="<?php echo $bg_img; ?>" style="width: 80px; height: 80px; margin-top: 5px;">
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label>Logo Image<span class="text-danger"> * </span><span id="errLogo" class="text-danger"></span></label>
                  <input type="file" class="form-control" name="logo" id="logo" placeholder="Enter logo image" value="<?= $logo; ?>" onclick="return imageFile1()">

                  <input type="hidden" class="form-control" name="old_logo" id="old_logo" placeholder="Enter logo image" value="<?= $logo; ?>">
                  <div>
                    <?php 
                      $logo_image = $logo;
                      $path= "assets/images/settings/";
                      $file =FCPATH.$path.$logo_image;

                      if((file_exists($file)) && !empty($logo_image))
                       { 
                        $logo_img = base_url().$path.$logo_image;
                       } else {
                        $logo_img = base_url().$path."defaultbanner.png";
                       } ?>

                      <img src="<?php echo $logo_img; ?>" style="width: 80px; height: 80px; margin-top: 5px;">
                  </div>
                </div>

                <div class="form-group col-md-12" style="margin-top: 10px;">
                  <input type="hidden" name="button" value="<?= $button; ?>">
                  <input type="hidden" name="id" value="<?= $id; ?>">
                  <button type="submit" class="btn btn-primary" onclick="return SettingValidate();"><?= $button; ?></button>&nbsp;
                  <a href="<?= site_url('Settings'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
              </div>
              <!-- /.box-body -->
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
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/setting.js"></script>
