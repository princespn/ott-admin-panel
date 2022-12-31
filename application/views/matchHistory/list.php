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
				<li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><?= $bread; ?></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">

					<div class="box bShow">
						<div class="box-header col-md-12">

							<div class="col-md-3 box-title paddLeft"><?= $heading; ?></div>
							<form>
								<div class="col-md-7">
									<div class="col-md-3 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data9" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
									</div>
									<div class="col-md-3 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data8" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
									</div>
								</div>
								<div class="col-md-1">
									<button type="reset" class="btn btn-warning resetBtnMatchHis" name="reset" id="reset">Reset</button>
								</div>
							</form> 
							<div class="col-md-1 pull-right">
								<a href="<?= site_url(MACTHHISTORYEXPORT); ?>" style="float:right;" class="btn btn-success">Export</a>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered table-striped" id="matchHis_datatable" style="width: 100%;">
								<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Table Id</th>
									<th>Game Type</th>
									<th>Bet Value</th>
									<th>Date</th>
									<th>Remark</th>
								</tr>
								</thead>
								<tbody>

								</tbody>
								<tfoot>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tfoot>
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
	var url = '<?= site_url('MatchHistory/ajax_manage_page'); ?>';
	var actioncolumn=5;
	var pageLength='';
		
</script>
	<!-- Load common footer -->

<script type="text/javascript">
	
</script>
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>'
		var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var table = $('#matchHis_datatable').DataTable({
				"oLanguage": { 
				"sProcessing": "<img src='<?= base_url()?>assets/images/loader.gif'>" 
			 },
		
				 //"scrollX":false,
					"scrollX":true,
					"processing": false, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"stateSave": true,
					 "order": [], //Initial no order.
					 "lengthMenu" : [[10,25, 100,200,500,1000,2000], [10,25, 100,200,500,1000,2000 ]],"pageLength" : 10,
					 
					 "ajax": {
							 "url": url,
							 "type": "POST",
							
								"data": function(d) {
											d.Foo = 'gmm';
											d.SearchData8 = $(".filter_search_data8").val();
											d.SearchData9 = $(".filter_search_data9").val();
											d[csrfName] = csrfHash;
											d.FormData = $(".filter_data_form").serializeArray();
									 },
										"error": function(){
										 console.log("hiii");
										$.ajax({
										url: $("#site_url").val()+"/Csrfdata",
										type: "GET",
										success: function(response) {
											$("#csrf_token").val(response);
												}
											});
										}
							},
						"fnDrawCallback": function( ) {
								var api = this.api();
								var json = api.ajax.json();
								csrfName =json.csrfName;
								csrfHash =json.csrfHash;
							},
							"rowCallback": function ( row, data, start, end, display ) 
			{
						var api = this.api(), data; 
						// Remove the formatting to get integer data for summation
						var intVal = function ( i ) {
								return typeof i === 'string' ?
										i.replace(/[\$,]/g, '')*1 :
										typeof i === 'number' ?
												i : 0;
						};
 

						// Total over all pages
						betValue = api 
								.column( 3 )
								.data()
								.reduce( function (a, b) {
										return intVal(a) + intVal(b);
								}, 0 );
 
						//Update footer
						$( api.column( 0 ).footer() ).html('Total');
						$( api.column( 3).footer() ).html(betValue.toFixed(2));
				},
					 "columnDefs": [
					 { 
							 "targets": [ 0,actioncolumn ], //first column / numbering column
							 "orderable": false, //set not orderable
					 },
					 ],
			
	 
			 })
		 $(".filter_search_data8").change(function(){
					table.draw();
				});

				$(".filter_search_data9").change(function(){
					table.draw();
				});

			 

				$(".resetBtnMatchHis").click(function(){
					setTimeout(function(){
						table.draw();
					},20)
				});
</script>