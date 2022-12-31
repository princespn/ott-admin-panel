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
                    <div class="box-header col-md-12">
                        <div class="col-md-4 box-title paddLeft"><?=$heading;?></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-right paddRight">

                            <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sendNoti">Send Notification</button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Title</th>
                  									<th>Message</th>
                                    <th>User Type</th>
                  									<th>Date</th>


                                </tr>
                            </thead>
                            <tbody>
                                 <?php $index = 1;if (!empty($notification_log)) {foreach ($notification_log as $noti) {?>
                                   <tr>
                                      <td><?php echo $index++; ?></td>
                                      <td><?php echo $noti->title; ?></td>

									                    <td><?php echo $noti->message; ?></td>
                                      <td><?php echo $noti->user_type; ?></td>
                                      <td><?php echo $noti->created; ?></td>

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

<div class="modal fade" id="sendNoti" role="dialog">
    <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Notification/sendNotification" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Notification</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Title</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="title" id="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback "> Notification</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="message" id="message">
                    </div>
        				</div>


				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">User Type</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="radio" class="custom-control-input has-feedback-left" name="user_type" value="free" id="user_type" checked>
						<label>Free</label>
						<input type="radio" class="custom-control-input has-feedback-left" name="user_type" value="paid" id="user_type">
						<label>Paid</label>

            <input type="radio" class="custom-control-input has-feedback-left" name="user_type" value="all" id="user_type">
            <label>All</label>
                    </div>
				</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Send</button>
            </div>
        </div>
    </form>
    </div>
</div>
<?php $this->load->view('common/footer.php');?>

<script type="text/javascript">

function deleteVideo(id) {
         $("#Deletemodal").modal('show');
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
         });
}

function view_video(id){

}

</script>
