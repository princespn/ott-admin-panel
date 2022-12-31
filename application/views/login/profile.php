<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Admin Profile</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
       <!--  <form class="form-horizontal" method="post" action="<?= $action?>" enctype="multipart/form-data"> -->
       	<?= form_open_multipart($action,'class="form-horizontal"'); ?>
        <div class="col-md-3">
          <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                   <div style="margin-bottom: 1px">
                    <span class="select_logo_img"> 
                          <button class="btn btn-minier btn-success btn-sm" type="button" onclick="get_img()" >
                          <i class="ace-icon fa fa-cloud-upload "></i>
                          Upload
                          </button>
                    </span>
                    <span class="delete_img" style="display: none"> 
                          <button class="btn btn-minier btn-danger btn-sm" type="button" onclick="remove_img()">
                          <i class="ace-icon fa fa-trash-o "></i>
                          Remove
                          </button>
                    </span>
                  </div>
                   <input type="file" class="form-control profile_image1" name="profile_image" id="profile_image" style="display:none" />
                     <?php
                      /*base_url() not get in file_exists*/
                        $images = $image;
                        $path= "assets/images/profile/";
                        $file =FCPATH.$path.$images;

                        if((file_exists($file)) && !empty($images))
                         { 
                          $img = base_url().$path.$images;
                         } else {
                          $img = base_url().$path."profile.png";
                         } ?>
                    
                  <img class="profile-user-img img-responsive " id="pre_img" src="<?php echo $img; ?>" alt="profile picture">
                  <input type="hidden" name="val_img" id="val_img" value="0">
                  <input type="hidden" name="old_img" id="old_img" value="<?php echo $images; ?>"/>
                  &nbsp;<span class="error" ></span><span id="image_errormsg" style="color: red"></span>
                  <h3 class="profile-username text-center"><?= ucfirst($name) ?></h3>

                  <ul class="list-group list-group-unbordered">
                   
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#timeline" data-toggle="tab">Change Password</a></li>
               <li><a href="#notification" data-toggle="tab">Change Notification Access Key</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="profile">
                <!-- Post -->
                  <div class="text-danger " id="profile_error">&nbsp;</div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name<span class="text text-danger"> *</span></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Please enter your name" value="<?= $name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email<span class="text text-danger"> *</span></label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email" value="<?= $email; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" onclick="return profileValidation();">Update</button>
                    <a href="<?= site_url(DASHBOARD); ?>"> <button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
                  <?= form_close(); ?>
              <!--   </form> -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <div class="text-danger " id="pass_error">&nbsp;</div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Current Password<span class="text text-danger"> *</span></label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="currentPass" name="currentPass" placeholder="Please enter your current password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">New Password<span class="text text-danger"> *</span></label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Please enter your new password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputMoible" class="col-sm-2 control-label">Confirm Password<span class="text text-danger"> *</span></label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Please enter your confirm password">
                    </div>
                  </div>
                  <input type="hidden" name="chnpass" id="chnpass" value="<?= site_url(CHNGPASSWORD); ?>">
                  <input type="hidden" name="dashboard" id="dashboard" value="<?= site_url(DASHBOARD); ?>">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary" onclick="return ChangePassValidation();">Submit</button>
                    <a href="<?= site_url(DASHBOARD); ?>"> <button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                  </div>
              </div>
              <!-- /.tab-pane -->
               <!-- /.tab-pane -->
              <div class="tab-pane" id="notification">
                <div class="text-danger " id="pass_error">&nbsp;</div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Access Key<span class="text text-danger"> *</span></label>

                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="currentKey" name="currentKey" placeholder="Please enter Access Key">
                    </div>
                  </div>
                 
                  
                <input type="hidden" name="chnpass" id="chnpass" value=""> 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="keyBtn" class="btn btn-primary" onclick="return ChangeKey();">Update</button>
                   
                    </div>
                  </div>
              </div>
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/login.js"></script>
<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>'
  var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script type="text/javascript">
  
$('.profile_image1').change(function () {                    
var files = this.files;   
var reader = new FileReader();
name=this.value;    
//validation for photo upload type    
var filetype = name.split(".");
ext = filetype[filetype.length-1];  //alert(ext);
if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='gif') && !(ext=='img')){   
  $("#image_errormsg").html("please select proper image type");
setTimeout(function(){$("#image_errormsg").html("")},9000);
return false; }else{    
reader.onload = function (e) { 

  var image = new Image(); 
        image.src = e.target.result;
        $("#val_img").val(0);
           
       
  $(".delete_img").fadeIn();

  $("#pre_img").attr('src',e.target.result);

};
}
reader.readAsDataURL(files[0]);               
});

function remove_img()
{
  var img = $("#old_img").val();
  var path= "assets/images/profile/";
  
  $("#pre_img").attr('src','<?php echo base_url(); ?>/'+path+img);
  $("#val_img").val(0);
  $("#image_errormsg").fadeOut();
  $(". ").fadeOut();
}

function ChangeKey(id){   

     $("#keyBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?=CHANGEKEY;?>";
             var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
             $.post(url,datastring,function(response){
                      $
                         location.reload();
                         var obj   = JSON.parse(response);
                         csrfName = obj.csrfName;
                         csrfHash = obj.csrfHash;
                         table.draw();
                         $("#msgData").val(obj.msg);
                         $("#toast-fade").click();
                     });
             });
         }
</script> 
