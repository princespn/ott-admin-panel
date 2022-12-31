<!-- Common Modal -->
	<!--  STATUS CHANGE Modal START -->
	<div class="modal fade" id="Statusmodal" tabindex="-1" role="dialog" aria-labelledby="statusmodal" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header bg-info">
						<div class="col-md-6 paddLeft">
							<h5 id="smallmodal1" class="modal-title">Status Change</h5>
						</div>
						<div class="col-md-6 paddRight">
							<button aria-label="Close" data-dismiss="modal" class="close" type="button">
								<span aria-hidden="true">×</span>
							</button>
						</div>
					</div>
					<div class="modal-body">
						<p id="appendData">Do you really want to change the status ?</p>
						<!-- <input type="hidden" name="statusId" id="statusId" value=""/> -->
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="statusSuccBtn">Yes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="noStatusBtn" onclick="return noStatus();">No</button>
					</div>
				</div>
		</div>
	</div> 
	<!-- STATUS CHANGE  Modal END -->
	<!--  DELETE RECORD Modal START -->
	<div class="modal  fade" id="Deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<div class="col-md-6 paddLeft">
						<h5 id="smallmodal1" class="modal-title">Delete Record</h5>
					</div>
					<div class="col-md-6 paddRight">
						<button aria-label="Close" data-dismiss="modal" class="close" type="button">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
				<div class="modal-body">
					<p>Do you really want to delete this record ?</p>
					<!-- <input type="hidden" id="delId"  name="delId" id="delId" value=""/> -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="deleteSuccBtn">Yes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="noDeleteBtn" onclick="return noDelete();">No</button>
				</div>
			</div>
		</div>
	</div> 
	<!-- DELETE RECORD  Modal END -->
<!-- Common Modal -->
	<footer class="main-footer">
		<input type="hidden" name="msgData" id="msgData">
		<input type="button" id="toast-fade" hidden />
		<div class="pull-right hidden-xs">
				 
		</div>
		<strong>Copyright &copy; <?= (date('Y')).'-'.(date('Y')+1) ?> <a href="<?= site_url(DASHBOARD); ?>"><?= title; ?></a>.</strong> All rights
		reserved.
	</footer>
	<!-- Add the sidebar's background. This div must be placed
			 immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Form.js -->
<script src="<?= base_url(); ?>assets/dist/js/jquery.form.js"></script>
<!-- /.Form.js -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->
<script src="<?= base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<!-- <script src="<?= base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?= base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- DataTables -->
<script src="<?= base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Select 2 -->
<script src="<?= base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- taostr js -->
<script src="<?= base_url(); ?>assets/dist/js/toastr.min.js"></script>
<!-- page specific script -->
<script src="<?= base_url(); ?>assets/dist/js/toastr.script.js"></script>

<!-- <script src="<?= base_url(); ?>assets/dist/js/jquery.datetimepicker.js"></script> -->
<!-- Jquery Datepicker JS -->
<script src="<?php echo base_url();?>assets/dist/js/jquery-ui.js"></script>
<!-- <script src="<?= base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script> -->
<script type="text/javascript">
$( function() {
	$( ".datepicker" ).datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true, 
		autoclose: true
	});
});

/*$(document).ready(function() {
	$(function() {
		$('.dateTimePick').focus(function(){
				$('.dateTimePick').datetimepicker({
				format: 'd.m.Y H:i',
			});
		 });
	});
});*/

$('.timepicker').timepicker({ 
	showInputs: false, 
	timeFormat: 'HH:mm:ss'
});

/*$('.dateTimePick').datetimepicker();*/
</script>
<script type="text/javascript">

	function showLoader()
	{
		$(".preloader").show();
	}

	function hideLoader()
	{
		$(".preloader").hide();
	}

	$(function () {
		$('.select2').select2();
	});
</script>

<!-- /.Select 2 -->
<input type="hidden" name="site_url" id="site_url" value="<?= site_url(); ?>">
	<input type="hidden" id="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>">
<script src="<?= base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>
<!--***********************SERVER SIDE DATATABLE STARTS****************************************--> 
<script type="text/javascript">
		var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>'
		var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		var table = $('#example_datatable').DataTable({
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
					 
					 "columnDefs": [
					 { 
							 "targets": [ 0,actioncolumn ], //first column / numbering column
							 "orderable": false, //set not orderable
					 },
					 ],
			dom: 'lBfrtip',
					buttons: [
										'excel', 'pdf'
								],
								/* buttons: [
										{
												extend: 'excelHtml5',
												title: 'Excel',
												text:'Export to excel'
												Columns to export
												exportOptions: {
													 columns: [0, 1, 2, 3,4,5,6]
											 }
										},
										{
												extend: 'pdfHtml5',
												title: 'PDF',
												text: 'Export to PDF'
												//Columns to export
												exportOptions: {
													 columns: [0, 1, 2, 3, 4, 5, 6]
											 }
										}
								],*/
			// buttons: [
			// 	 'csv', 'excel', 'pdf'
			// 	],
			 //"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
								//dom: 'Bfrtip',
							 /* buttons: [
										{
												extend: 'excelHtml5',
												title: 'Excel',
												text:'Export to excel'
												//Columns to export
												exportOptions: {
													 columns: [0, 1, 2, 3,4,5,6]
											 }
										},
										{
												extend: 'pdfHtml5',
												title: 'PDF',
												text: 'Export to PDF'
												//Columns to export
												exportOptions: {
													 columns: [0, 1, 2, 3, 4, 5, 6]
											 }
										}
								],*/
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


<!--***********************SERVER SIDE DATATABLE ENDS****************************************--> 
<!-- FadeOut Session Message -->
<script type="text/javascript">
	$(document).ready(function(){
 setTimeout(function(){$("#msgHide").html("&nbsp;");},3000);
});
</script>
<!-- For Toaster Message -->
<script type="text/javascript">

	$(document).ready(function(){
		var sessionMsg = '<?php echo $this->session->userdata('message');?>';
		if(sessionMsg != '') {
			$("#msgData").val(sessionMsg);
			$("#toast-fade").click();
		}
	});

	function noStatus() {
		$("#Statusmodal").load(location.href+" #Statusmodal>*","");
	}

	function noDelete() {
		$("#Deletemodal").load(location.href+" #Deletemodal>*","");
	}
</script>
<script type="text/javascript">
$(document).ready(function() {
		$('.zeroConfDatatable').DataTable();
} );
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.1/classic/ckeditor.js"></script>

</body>
</html>