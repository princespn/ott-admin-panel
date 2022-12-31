<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	 <h1><?= $heading; ?></h1>
</section>
<!-- Main content -->
<section class="content">
	 <div class="row">
			<div class="col-xs-12">
				
					 <div class="box bShow">
						 <div class="box-header">
							 <input type="hidden" class="filter_search_data">
							 &nbsp;
							 <button type="button" id="activeAll" class="btn btn-primary col-xs-1 inactiveClass" onclick="getStatus('All');">All</button>
							 &nbsp;
							 <button type="button" id="activecustom" class="btn btn-default col-xs-1 inactiveClass" onclick="getStatus('custom');">Custom</button>
							 &nbsp;
							 <button type="button" id="activefacebook" class="btn btn-default col-xs-1 inactiveClass" onclick="getStatus('facebook');">Facebook</button>
							 &nbsp;
						 </div>
					 </div>

					 <!--  <div class="col-md-12" style="padding:10px;">
							 <a href="<?= site_url(USEREXPORT); ?>" class="btn btn-default">Excel Export</a>&nbsp;
							 <form>
									<div class="col-md-10">
										 <div class="col-md-4 pull-right paddRight">
												<input type="text" class="form-control datepicker filter_search_data1" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
										 </div>
										 <div class="col-md-4 pull-right paddRight">
												<input type="text" class="form-control datepicker filter_search_data" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
										 </div>
									</div>
									<div class="col-md-1">
										 <button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
									</div>
							 </form>
						</div> -->
						<!-- /.box-header -->
						<div class="box bShow">
							 <div class="box-header col-md-12">
									<form>
										<!-- <div class="col-md-2 box-title paddLeft"><?= $heading; ?></div> -->

										<div class="col-md-3" id="msgHide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></div>
										<div class="col-md-7">
											 <div class="col-md-4 pull-right paddRight">
													<input type="text" class="form-control datepicker filter_search_data2" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
											 </div>
											 <div class="col-md-4 pull-right paddRight">
													<input type="text" class="form-control datepicker filter_search_data3" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
											 </div>
										</div>
										<div class="col-md-1">
											 <button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
										</div>
										<div class="col-md-1 box-title paddLeft"> <a href="<?= site_url(USEREXPORT); ?>" class="btn btn-success">Export</a>&nbsp;</div>
									</form>
									<!--   <div class="col-md-4 text-right paddRight"> -->
									<!--   </div> -->
							 </div>
							 <!-- /.box-header -->
							 <div class="box-body">
								<input type="hidden" name="flag" id="flag" value="<?= $flag; ?>">
									<table class="table table-bordered table-striped display" id="example_datatable" style="width: 100%;">
										 <thead>
												<tr>
													 <th>#</th>
													 <th>Username</th>
													 <th>Mobile</th>
													 <th>Email</th>
													 <th>Subscription Type</th>
													 <th>Country</th>
													 <th>SignUp Date</th>
													 <th>Last Login</th>
													 <th>Login Status</th>
													 <th>Block Users</th>
													 <th>Status</th>
													 <th>Action</th>
												</tr>
										 </thead>
										 <tbody>
										 </tbody>
									</table>
							 </div>
							 <!-- /.box-body -->
						</div>
						<!-- /.box -->
				 
				 <!-- /.col -->
			</div>
			<!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="editPlanModel" role="dialog">
    <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Users/editUser" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">User Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
					<input type="hidden" class="form-control has-feedback-left"  name="editId" id="editId">
                        <input type="text" class="form-control has-feedback-left" name="editUsername" id="editUsername" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">User E-mail</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
					 <input type="text" class="form-control has-feedback-left" name="editUseremail" id="editUseremail" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">User Phone</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
						
                        <input type="text" class="form-control has-feedback-left" name="editUserphone" id="editUserphone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Country</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control has-feedback-left" name="editUsercountry" id="editUsercountry" required>
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

</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
	 var url = '<?= site_url("Users/ajax_manage_page/"); ?>';
	 var actioncolumn=10;
	 var pageLength='';
</script>

<script type="text/javascript">
	$(function() {
		var flag =$("#flag").val();
		if(flag != ''){
			setTimeout(function(){
				getStatus(flag);				
			},70)
		}
	});


	function getStatus(status)
	{
		$('.filter_search_data').val(status);
		$('.inactiveClass').removeClass("btn-default btn-primary");
		$('.inactiveClass').addClass("btn-default");
		$('#active'+status).removeClass("btn-default").addClass("btn-primary");
		table.draw();
	}    


	 function blockuserChange(id)
	 { 
		 $("#Statusmodal").modal('show');
		 $("#statusSuccBtn").click(function(){
		 var site_url = $("#site_url").val();
		 var url = site_url+"/Users/blockUserChange";
			 var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
			 $.post(url,datastring,function(data){
				 $("#Statusmodal").modal('hide');
				 $("#Statusmodal").load(location.href+" #Statusmodal>*","");
				 var obj = JSON.parse(data);
				 csrfName = obj.csrfName;
				 csrfHash = obj.csrfHash;
				 table.draw();
				 $("#msgData").val(obj.msg);
				 $("#toast-fade").click();
			 });
		 });
	 }

	 function change_status(id)
	 { 
		 $("#Statusmodal").modal('show');
		 $("#statusSuccBtn").click(function(){
		 var site_url = $("#site_url").val();
		 var url = site_url+"/Users/change_status";
			 var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
			 $.post(url,datastring,function(data){
				 $("#Statusmodal").modal('hide');
				 $("#Statusmodal").load(location.href+" #Statusmodal>*","");
				 var obj = JSON.parse(data);
				 csrfName = obj.csrfName;
				 csrfHash = obj.csrfHash;
				 table.draw();
				 $("#msgData").val(obj.msg);
				 $("#toast-fade").click();
			 });
		 });
	 }

	 function change_islogin_status(id,loginStatus)
	 { 
		 $("#Statusmodal").modal('show');
		 $("#statusSuccBtn").click(function(){
		 var site_url = $("#site_url").val();
		 var url = site_url+"/Users/change_islogin_status";
			 var datastring = "id="+id+"&isLogin="+loginStatus+"&"+csrfName+"="+csrfHash;
			 $.post(url,datastring,function(data){
				 $("#Statusmodal").modal('hide');
				 $("#Statusmodal").load(location.href+" #Statusmodal>*","");
				 var obj = JSON.parse(data);
				 csrfName = obj.csrfName;
				 csrfHash = obj.csrfHash;
				 table.draw();
				 $("#msgData").val(obj.msg);
				 $("#toast-fade").click();
			 });
		 });
	 }

	 function User_Validation()
	 { 
		 var import_user = $("#import_user").val(); 
		 if(import_user == "")
		 {  
			 $("#errorUser").html("<span style='color:red;'>Please upload excel</span>").fadeIn();
			 setTimeout(function(){$("#errorUser").fadeOut()},3000);
			 return false; 
		 }
	 }
	 
	 
	 function deleteUser(id) {

			 $("#Deletemodal").modal('show');
			 $("#deleteSuccBtn").click(function(){
				 var site_url   = $("#site_url").val();
				 var url        =  site_url+"/<?= DELUSER; ?>";
				 var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
				 $.post(url,datastring,function(response){
					$("#Deletemodal").load(location.href+" #Deletemodal>*","");
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
</script>

<script type="text/javascript">

function EditUser(id) {

		var editId = "";

		var editUsername ="";
		var editUseremail ="";
		var editUserphone ="";
		var editUsercountry ="";

		var site_url   = $("#site_url").val();
		var url        =  site_url+"/<?=USERDETAILS;?>";
		var datastring =  'id='+id;

		$.post(url,datastring,function(response){
		//console.log("response ",response, "Hi")
			var str = JSON.parse(response);
		
			editId = str.id;
			editUsername = str.user_name;
			editUseremail = str.email;
			editUserphone = str.phone;
			editUsercountry = str.countryName;			
			$("#editPlanModel").modal("show");
			$("#editId").val(editId);
			$("#editUsername").val(editUsername);
			$("#editUseremail").val(editUseremail);
			$("#editUserphone").val(editUserphone);
			$("#editUsercountry").val(editUsercountry);
			console.log(editId)


		});

	}

</script>

<!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>