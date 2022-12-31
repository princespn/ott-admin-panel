<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>

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
						<div class="box-header col-md-12">
							<!-- <div align="center" class="box-header col-md-12">
							<select name="users" > 
									<option value="0">Search Users</option>
									<?php if(!empty($getUsers)) { foreach ($getUsers as $users) { ?>
									<option value="<?= $users->id; ?>"><?= $users->user_name; ?></option>
								<?php } } ?>
							</select>
							</div> -->
							<div class="col-md-3">
							 </div>
							 <form>
								<div class="col-md-6">
									<div class="col-md-6 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data1" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
									</div>
									<div class="col-md-6 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
									</div>
								</div>
								<div class="col-md-3">
									<div class="col-md-6">
										<button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
									</div>
									<div class="col-md-6 paddRight">
										<a href="<?= site_url(WITHDRAWALREJECTREQEXPORT); ?>" style="float:right;" class="btn btn-success">Excel Export</a>&nbsp;
									</div>
								</div>
							</form>
						</div>
					 
						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
								<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th>Amount(RS)</th>
									<th>Payment Mode </th>
									<th>Request On</th>
									<th>Completed On </th>
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
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
		 
		
	</div>
	<!-- /.content-wrapper -->

<script type="text/javascript">
	var url = '<?= site_url(WITHDRAWALREJECTREQLIST); ?>';
	var actioncolumn=4;
	var pageLength='';
		
</script>
	<!-- Load common footer -->

<script type="text/javascript">
	
</script>
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#example_datatable').DataTable();
	} );
</script>