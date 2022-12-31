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
										<select class="form-control filter_search_data2" name="isWinLoss" id="isWinLoss">
											<option value="">Win/Loss</option>
											<option value="Win" <?php if($isWinLoss=='today-win'){ echo "selected";} ?>>Win</option>
											<option value="Loss" <?php if($isWinLoss=='today-loss'){ echo "selected";} ?>>Loss</option>
										</select>
									</div>
									<div class="col-md-3 pull-right paddRight">
										<select class="form-control filter_search_data3" name="gameType" id="gameType">
											<option value="">All Games</option>
											<?php if(!empty($getGameType)){
												foreach($getGameType as $gemeType){?>
													<option value="<?= $gemeType->roomTitle?>"><?= $gemeType->roomTitle?></option>
											<?php } }?>
										</select>
									</div>
									<div class="col-md-3 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data1" name="toDate" id="toDate" placeholder="Select To Date" autocomplete="off">
									</div>
									<div class="col-md-3 pull-right paddRight">
										<input type="text" class="form-control datepicker filter_search_data" name="fromDate" id="fromDate" placeholder="Select From Date" autocomplete="off">
									</div>
								</div>
								<div class="col-md-1">
									<button type="reset" class="btn btn-warning resetBtn" name="reset" id="reset">Reset</button>
								</div>
							</form>
							<div class="col-md-1" style="float:right;">
								<a href="<?= site_url(USERREPORTEXPORT); ?>" style="float:right;" class="btn btn-success">Export</a>&nbsp;<!--  -->
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-bordered table-striped" id="report_datatable" style="width: 100%;">
								<thead>
								<tr>
									<th>Sr. No.</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<th>User Type</th>
									<th>Table Id</th>
									<th>Game</th>
									<th>Game Type </th>
									<th>Bet Value</th>
									<th>Is Win</th>
									<th>Win/Loss Coins</th>
									<th>Main Wallet</th>
									<th>Win Wallet</th>
									<th>Admin Commission</th>
									<th>Admin Amount</th>
									<th>Date</th>
								</tr>
								</thead>
								<tbody>

								</tbody>
								<tfoot align="right">
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
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
//  var url = '<?= site_url(USERREPORTLIST.'/'.$isWinLoss); ?>';
	var url = '<?= site_url('UserReport/ajax_manage_page/'.$isWinLoss); ?>';
	var actioncolumn=14;
	var pageLength='';
		
</script>
	<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>
<script type="text/javascript">
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>'
		var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

		var table = $('#report_datatable').DataTable({
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
											d.SearchData = $(".filter_search_data").val();
											d.SearchData1 = $(".filter_search_data1").val();
											d.SearchData2 = $(".filter_search_data2").val();
											d.SearchData3 = $(".filter_search_data3").val();
											d.SearchData4 = $(".filter_search_data4").val();
											d.SearchData5 = $(".filter_search_data5").val();
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
					var   betValue = api 
								.column( 7 )
								.data()
								.reduce( function (a, b) {
										return intVal(a) + intVal(b);
								}, 0 );
					var   adminAmount = api 
								.column( 13 )
								.data()
								.reduce( function (a, b) {
										return intVal(a) + intVal(b);
								}, 0 );

						// Total over this page
						// pageTotal = api 
						//     .column( 7 , { page: 'current'})
						//     .data()
						//     .reduce( function (a, b) {
						//         return intVal(a) + intVal(b);
						//     }, 0 );

						//Update footer
						/*$( api.column( 7 ).footer() ).html( 
								 'Total Bet Value ('+ betValue.toFixed(2) +')'
						);*/

						$( api.column( 0 ).footer() ).html('Total');
						$( api.column( 7 ).footer() ).html(betValue.toFixed(2));
						$( api.column( 11 ).footer() ).html(adminAmount.toFixed(2));
				},
					 "columnDefs": [
					 { 
							 "targets": [ 0,actioncolumn ], //first column / numbering column
							 "orderable": false, //set not orderable
					 },
					 ],
			
	 
			 })
		
				$(".filter_search_data").change(function(){
					table.draw();
				});

				$(".filter_search_data1").change(function(){
					table.draw();
				});

				$(".filter_search_data2").change(function(){
					table.draw();
				});
				$(".filter_search_data3").change(function(){
					table.draw();
				});

				$(".filter_search_data4").change(function(){
					table.draw();
				});
				$(".filter_search_data5").change(function(){
					table.draw();
				});

				$(".resetBtn").click(function(){
					setTimeout(function(){
						table.draw();
					},20)
				});
</script>
