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
							<?= form_open(WITHDRAWALCOMPREQEXPORT) ?>
								<div class="col-md-3">
								</div>
								<div class="col-md-2">
									<select class="form-control filter_search_data2" name="payment_type" id="payment_type">
										<option id="paytm" value="">Select Payment Mode</option>
										<option id="paytm" value="paytm">Paytm</option>
										<option id="bank" value="bank">Bank Transfer</option>
									</select>
									<span id="errMode" style="font-size: 15px; text-align: center;"></span>
								</div>
								<div class="col-md-5">
									<div class="col-md-6 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data1" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
									</div>
									<div class="col-md-6 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
									</div>
								</div>
								<div class="col-md-1">
									<button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
								</div>
								<div class="col-md-1">
									<button type="submit" class="btn btn-success pull-right" onClick="exportSubmit()">Export</button>
								</div>
							<?= form_close() ?>
						</div>
						
						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
								<thead>
								<tr>
									<th>#</th>
									<th>User Name</th>
									<th>Mobile</th>
									<th>Order Id</th>
									<th>Amount (Rs)</th>
									<th>Payment Mode</th>
									<th>Request On</th>
									<th>Completed On</th>
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
	var url = '<?= site_url(WITHDRAWALCOMPREQLIST); ?>';
	var actioncolumn=8;
	var pageLength='';
</script>

	<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#example_datatable').DataTable();
	} );
</script>
<script type="text/javascript">
	function exportSubmit(){
		setTimeout(function(){
			table.draw();			
		},100)
	}
</script>