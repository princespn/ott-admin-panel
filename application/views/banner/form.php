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
        <li><a href="<?= site_url(BANNER); ?>"><?= $breadhead; ?></a></li>
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
             <?php echo form_open_multipart($action); ?>
                <!-- <?= form_hidden($hidden);?> -->
                <!-- <form  method="post" id="tornamntForm" action="<?= $action; ?>" > -->
                  <input type="hidden" name="id" value="<?= $id; ?>">
              <div class="box-body">
                <div class="form-group col-md-6">
                  <label for="title">Title <span class="text-danger"> * </span></label>
                  <span class="error" id="title_err"></span>
                  <?= form_error('title'); ?>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= $title; ?>" />
                </div>

                 <div class="form-group col-md-6">
                  <label for="order">Order <span class="text-danger"> * </span></label>
                  <span class="error" id="order_err"></span>
                  <?= form_error('order'); ?> 
                  <input type="text" maxlength="2" class="form-control" name="order" id="order" placeholder="Order" value="<?= $order; ?>" />  
                </div>

                 <!-- select banner ype -->
                   <?php  
                  $Image="";$Video="";  
                  if($banner_type=='Image') $Image="checked"; 
                  else if($banner_type=='Video') $Video="checked"; 
                 ?>
                <div class="form-group col-md-6">
                  <label for="banner_type">Banner Type <span class="text-danger"> * </span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <span class="error" id="status_err"></span>
                  <?=  form_error('banner_type'); ?>
                   <?= $this->session->flashdata('php_error'); ?> 
                  <br/>
                   <input type="radio" name="banner_type" id="banner_type" class="image" value='Image' <?= $Image; ?> <?php  set_radio('banner_type','Image',FALSE); ?> checked/> &nbsp;&nbsp; Image  
                   <input type="radio" name="banner_type" id="banner_type" class="video" value='Video' <?= $Video; ?> <?php  set_radio('banner_type','Video',FALSE); ?> /> &nbsp;&nbsp;Video

                   <span class="error" id="err_image"></span><br/>
                   <?php if ($button == 'Create') { $videoClass = "style='display: none'"; } else { if($banner_type=='Image') {
                    $videoClass = "style='display: none'"; } if($banner_type=='Video') { $imgClass = "style='display: none'"; }
                   } ?>
                   <span id="note_image" class="text-primary" <?php if(isset($imgClass)){ echo $imgClass; }  ?>>Note : Please select jpg, png, jpeg type of image</span>
                   <span id="note_video" class="text-primary" <?php if(isset($videoClass)){ echo $videoClass; } ?>>Note : Please select mp4, avi, wmv type of video </span>
                   <input type="file" class="form-control" name="image"  id="image" placeholder="" onclick="return imageFile()"/>
                  <small>Banner image size should be 1903*817 px.</small>
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
                </div>
              <!-- </div>   -->
                  <!-- Status end -->
                 <?php if($button == "Update") {?>

                 <div class="form-group col-md-6">
                  <?php if($banner_type == 'Image') { ?>
                    <div id="foto_image">
                      <div style="margin-top:0px;"><img src="<?= base_url(); ?>uploads/banners/<?= $image; ?>" width='230' height='100'/></div>
                      <!-- <small>Banner image size should be 1440*500 px</small> -->
                      <input type="hidden" class="form-control" value="<?php  echo $image;  ?>" name="image_old" id="image_old"/>
                    </div>
                  <?php } ?>
                  <?php if($banner_type == 'Video') { ?>
                    <div style="margin-top:0px;" id="foto_video"><video width='200' height='50' controls>
                      <source src='<?= base_url("uploads/banners/".$image); ?>'> </video></div>
                      <input type="hidden" class="form-control" value="<?php echo $image;  ?>" name="video_old" id="video_old"/>
                  <?php } ?>
                <?php } ?>
              </div>

              <div class="clearfix"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="hidden" id="button" value="<?php echo $button; ?>"/>
                 <button type="submit"  onclick="return valid();" class="btn btn-primary"><?= $button;  ?></button> 
                <a type="button" href="<?= site_url(BANNER); ?>" class="btn btn-danger">Cancel</a>
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
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  $('#startTime').timepicker({
       showInputs: false
      });
</script>

<script type="text/javascript">
  function valid()
  {
    var title = $("#title").val();
    var order = $("#order").val();
    var image = $("#image").val();
    var banner_type =$('input[name=banner_type]:checked').val(); 
    var button = $("#button").val();
    var image_old = $("#image_old").val();
    var video_old = $("#video_old").val();
    //var pattern_title = /^[A-Za-z ]{0,50}$/i;

      if($.trim(title)=='')
      { 
        
          $("#title_err").html("Required").fadeIn('1000').delay(1000).fadeOut('1000');  
          $("#title").focus();
          return false;
      }/*
      else if(!pattern_title.test(title))
      {
          $("#title_err").fadeIn().html("Enter valid title");
          setTimeout(function(){$("#title_err").fadeOut();},3000);
          $("#title").focus();
          return false;
      }*/

      if($.trim(order)=='')
      { 
          $("#order_err").html("Required").fadeIn('1000').delay(1000).fadeOut('1000');
          $("#order").focus();    
          return false;
      }

      /*if(button == 'Create' || video_old == "" )
      {*/
        if(banner_type=='Video')
        {
          if (button == 'Create') {
            if(image=="")
            {
              $("#err_image").fadeIn().html("Please select video");
              setTimeout(function(){$("#err_image").fadeOut("&nbsp");},3000)
              $("#image").focus();
              return false;
            }
          }

          if (button == 'Update') {
            if(image=="" && (video_old=="" || video_old == undefined))
            { 
              $("#err_image").fadeIn().html("Please select video");
              setTimeout(function(){$("#err_image").fadeOut("&nbsp");},3000)
              $("#image").focus();
              return false;
            }
          }
        }
        if(banner_type=='Image')
        {
          if (button == 'Create') {
            if(image=="")
            {
              $("#err_image").fadeIn().html("Please select image");
              setTimeout(function(){$("#err_image").fadeOut("&nbsp");},3000)
              $("#image").focus();
              return false;
            }
          }

          if (button == 'Update') {
            if(image=="" && (image_old=="" || image_old == undefined))
            {
              $("#err_image").fadeIn().html("Please select image");
              setTimeout(function(){$("#err_image").fadeOut("&nbsp");},3000)
              $("#image").focus();
              return false;
            }
          }
        }
  }

  function in_length(name)
{   
    if($("textarea[name="+name+"]").val().length<11) return false;
    else return true; 
}

$("#order").keypress(function (e){
  var charCode = (e.which) ? e.which : e.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
});

$(".error").delay(2000).fadeOut('1000');


  function only_number(event)
    {
      var x = event.which || event.keyCode;
      console.log(x);
      if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13)
      {
        return;
      }else{
        event.preventDefault();
      }    
    }
</script>

<script type="text/javascript">
function imageFile()
{ 
  var banner_type =$('input[name=banner_type]:checked').val();
  // alert(banner_type);
  if (banner_type == 'Image') 
  {
    $('#image').change(function () {  
      var files = this.files;   
      var reader = new FileReader();
      image=this.value;  
      //validation for photo upload type    
      var filetype = image.split(".");
      ext = filetype[filetype.length-1];  //alert(ext);return false;
      //alert(ext);return false;
      if(!(ext=='jpg') && !(ext=='png') && !(ext=='PNG') && !(ext=='jpeg') && !(ext=='img') && !(ext=='JPEG') && !(ext=='JPG'))
      { 
        $("#err_image").fadeIn().html("Please select proper type like jpg, png, jpeg image");   
        setTimeout(function(){$("#err_image").html("&nbsp;")},3000);
        $("#image").val("");
        return false;
      }

         reader.onload = function (e) { 
          var image = new Image();   
          image.src = e.target.result;
          image.onload = function () {
          var height = this.height;
          var width = this.width;//alert
          var size = parseFloat($('#image')[0].files[0].size / 1024).toFixed(2);

          if((height < '817' || height > '817') || (width < '1903' || width > '1903')) 
          {
            $("#err_image").html("Please upload 1903 X 817 px dimension image.").fadeIn();
            setTimeout(function(){$("#err_image").html("&nbsp;").fadeOut();},3000);
            $("#image").val("");
            return false; 
          } 
        }
    };
    reader.readAsDataURL(files[0]);
    });
  }
 
  if (banner_type=='Video') {
    $('#image').change(function () {  
      var files = this.files;   
      var reader = new FileReader();
      image=this.value;  
      //validation for photo upload type    
      var filetype = image.split(".");
      ext = filetype[filetype.length-1];  //alert(ext);return false;
      //alert(ext);return false;
      if(!(ext=='mp4') && !(ext=='avi') && !(ext=='mkv') && !(ext=='wmv'))
      { 
        $("#err_image").fadeIn().html("Please select proper type like mp4, avi, wmv video");   
        setTimeout(function(){$("#err_image").html("&nbsp;")},3000);
        $("#image").val("");
        return false;
      }
      reader.readAsDataURL(files[0]);
    });
  }
}

$('input[type="radio"]').on('click change', function(e) {
  var banner_type =$('input[name=banner_type]:checked').val();
  
  if (banner_type == 'Image') {
    $("#foto_video").hide();
    $("#foto_image").show();
    $("#note_video").hide();
    $("#note_image").show();
  }

  if (banner_type == 'Video') {
    $("#foto_image").hide();
    $("#foto_video").show(); 
    $("#note_image").hide(); 
    $("#note_video").show();
  }
    
});
</script>

<script src="<?php echo base_url();?>assets/datepicker/jquery-ui.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/tournament.js"></script>