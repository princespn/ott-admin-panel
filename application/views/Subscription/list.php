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

                            <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addVideo">Add SUbscription Plan</button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Plan Name</th>
                                    <th>Duration type</th>
									<th>Duration</th>
									<th>Plan Cost</th>
                                    <th>No Of Device Login </th>
									<th>Options </th>

                                </tr>
                            </thead>
                            <tbody>
                                 <?php $index = 1;if (!empty($subscription_plan_data)) {foreach ($subscription_plan_data as $subs) {?>
                                   <tr>
                                      <td><?php echo $index++; ?></td>
                                      <td><?php echo $subs->planName; ?></td>
                                      <td><?php echo $subs->durationType; ?></td>
									  <td><?php echo $subs->duration; ?></td>
									  <td><?php echo $subs->planCost; ?></td>
                                      <td><?php echo $subs->noOfDeviceLogin; ?></td>

                                      <td>
                                         <span title="Edit" class="btn btn-primary btn-xs"  data-placement="right"
                                         onclick="edit_subscription('<?php echo $subs->id; ?>')"><i class="fa fa-edit"></i></span>
                                        &nbsp;|&nbsp;
                                      <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteSubs( '<?php echo $subs->id; ?>')"><i class='fa fa-trash-o'></i></button>
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

<div class="modal fade" id="addVideo" role="dialog">
    <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Subscription/addSubs" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Plan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Plan Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="planName" id="planName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Duration Type</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="radio" class="custom-control-input has-feedback-left" name="durationType" value="days" id="durationType">
						<label>Day</label>
						<input type="radio" class="custom-control-input has-feedback-left" name="durationType" value="months" id="durationType">
						<label>Month</label>
						<input type="radio" class="custom-control-input has-feedback-left" name="durationType" value="year" id="durationType">
						<label>Year</label>

                    </div>
                </div>
              <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Duration</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="duration" id="duration" required>
                    </div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Cost</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="planCost" id="planCost">
                    </div>
				</div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">No Of Device Login</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="noOfDeviceLogin" id="noOfDeviceLogin">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea id="desc" class="form-control has-feedback-left" name="desc" rows="10" cols="50"></textarea>
                    </div>
                </div>
                


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
            </div>
        </div>
    </form>
    </div>
</div>

<div class="modal fade" id="editPlanModel" role="dialog">
    <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Subscription/editSubs" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Plan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Plan Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
						<input type="hidden" class="form-control has-feedback-left"  name="editId" id="editId">
                        <input type="text" class="form-control has-feedback-left" name="editPlanName" id="editPlanName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Duration Type</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="radio" class="custom-control-input has-feedback-left" name="editDurationType" value="days" id="editDurationType">
						<label>Day</label>
						<input type="radio" class="custom-control-input has-feedback-left" name="editDurationType" value="months" id="editDurationType">
						<label>Month</label>

						<input type="radio" class="custom-control-input has-feedback-left" name="editDurationType" value="year" id="editDurationType">
						<label>Year</label>

                    </div>
                </div>
              <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Duration</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="editDuration" id="editDuration" required>
                    </div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Cost</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="editPlanCost" id="editPlanCost">
                    </div>
				</div>


              <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">No Of Device Login</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="editNoOfDeviceLogin" id="editNoOfDeviceLogin">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea id="editPlandesc" class="form-control has-feedback-left" name="editPlandesc" rows="5" cols="20"></textarea>
                    </div>
                </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="checkadminmail">Edit</button>
            </div>
        </div>
    </form>
    </div>
</div>

<?php $this->load->view('common/footer.php');?>

<script type="text/javascript">

function deleteSubs(id) {

		 $("#Deletemodal").modal('show');

		 $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?=DELETESUBSCRIPTION;?>";
             var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
             $.post(url,datastring,function(response){
                      $("#Deletemodal").modal('hide');
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

function edit_subscription(id) {
		var edittournamentId = "";

		var editId = "";
		var editPlanName = "";
		var editDurationType = "";
		var editDuration = "";
		var editPlanCost = "";
        var editNoOfDeviceLogin = "";
        var editPlandesc = "";




		var site_url   = $("#site_url").val();
		var url        =  site_url+"/<?=SUBSCRIPTIONDETAILS;?>";
		var datastring =  'id='+id;

		$.post(url,datastring,function(response){
		//console.log("response ",response, "Hi")
			var str = JSON.parse(response);
			console.log("str ",str)
			editId = str.id;
			editPlanName = str.planName;
			editDurationType = str.durationType;
			editDuration = str.duration;
			editPlanCost = str.planCost;
            editNoOfDeviceLogin = str.noOfDeviceLogin;
            editPlandesc = str.description;


			$("#editPlanModel").modal("show");
			$("#editId").val(editId);
			$("#editPlanName").val(editPlanName);
			$("input[name=editDurationType][value="+editDurationType+"]").prop('checked',true);
			$("#editDuration").val(editDuration);
			$("#editNoOfDeviceLogin").val(editNoOfDeviceLogin);
            $("#editPlanCost").val(editPlanCost);
            $('textarea#editPlandesc').val(editPlandesc);

            CKEDITOR.instances['editPlandesc'].getData();
                       


			console.log(editPlandesc)

		});

	}



</script>
<script type="text/javascript">
        ClassicEditor
            .create( document.querySelector( '#desc' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
<script type="text/javascript">
       ClassicEditor
            .create( document.querySelector( '#editPlandesc1' ) )
            .catch( error => {
                console.error( error );
            } );
</script>



