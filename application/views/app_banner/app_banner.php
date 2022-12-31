<!-- Load common header -->
<?php $this->load->view('common/header');?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php');?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?=$heading;?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url(DASHBOARD);?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><?=$bread;?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

              <div class="box bShow">
             <div class="box-header">



               <a <?php if ($flag == 'series') {

	echo 'class="btn btn-default btn-default btn-primary"';

} else {
	echo 'class="btn btn-default"';
}

?>

           id="akseries" href="<?php echo site_url(BANNER); ?>/series"> Series<a>
               <a <?php if ($flag == 'movies') {

	echo 'class="btn btn-default btn-default btn-primary"';

} else {
	echo 'class="btn btn-default"';
}

?>  id="akmovie" href="<?php echo site_url(BANNER); ?>/movies">Movies </a>
               &nbsp;

               &nbsp;
             </div>
           </div>


                <div class="box bShow">
                    <div class="box-header col-md-12">
                        <div class="col-md-4 box-title paddLeft"><?=$heading;?></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-right paddRight">


                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th><?php echo $flag ?></th>
                                    <th>Banner Image</th>
                                    <th>Select as banner</th>

                                </tr>
                            </thead>
                            <tbody>
                                 <?php $index = 1;
if (!empty($banner_data)) {
	foreach ($banner_data as $banner) {
		?>
                                             <tr>
                                 <td><?php echo $index++; ?></td>
                                 <td><?php
if ($flag == 'movies') {

			echo $banner->movieId;
		} else {
			echo $banner->seriesId;

		}
		?>

                                 </td>
                                 <td>

                                  <img src="<?php echo $banner->bannerLink ?>" alt="Girl in a jacket" width="100" height="100">
                                 </td>

                                  <td>

                                      <input type="checkbox" onClick="updateAsBanner(<?php echo $banner->id; ?>,<?php echo $banner->appBanner; ?>)" name="bannerId[]" value="<?php echo $banner->id; ?> " <?php if ($banner->appBanner == 1) {
			echo 'checked="checked"';
		}?> >

                                  </td>


                                  </tr>
                                   <?php }}?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
<!-- /.content-wrapper -->

<?php $this->load->view('common/footer.php');?>

<script type="text/javascript">


function updateAsBanner(id,oldStatus){
let site_url   = $("#site_url").val();

let flag="<?=$flag?>";


$.ajax({ type: "POST", url:site_url+"/updateBanner",
  data:{'id': id,flag:flag,oldStatus},

  success: function(dataString) {
        toastr.success('successfully updated');
       console.log(dataString);
      } });

}

function deleteVideo(id) {
         /*$("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?=DELETEVIDEOS;?>";
             var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
             $.post(url,datastring,function(response){
                 $("#Deletemodal").modal('hide');
                 $("#Deletemodal").load(location.href+" #Deletemodal>*","");
                     var obj   = JSON.parse(response);
                     csrfName = obj.csrfName;
                     csrfHash = obj.csrfHash;
                     table.draw();
                     $("#msgData").val(obj.msg);
                     $("#toast-fade").click();
                 });
         });*/
}

function view_video(id){

}

  function getStatus(status)
  {

    $('.inactiveClass').removeClass("btn-default btn-primary");
    $('.inactiveClass').addClass("btn-default");
    $('#active'+status).removeClass("btn-default").addClass("btn-primary");
    $('#ak'+status).trigger("click");

  }

</script>
