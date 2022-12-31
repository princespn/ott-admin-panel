<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>

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
						<?= form_open(BANKWITHDRAWALEXPORT) ?>
						<div class="box-header col-md-12">
							<div class="col-md-4 box-title paddLeft"><?= $heading; ?></div>
								<!-- <form> -->
								<!-- <div class="col-md-3">
										<select class="form-control filter_search_data2" name="payment_type" id="payment_type">
											<option id="paytm" value="">Select Payment Type</option>
											<option id="paytm" value="paytm">Paytm</option>
											<option id="bank" value="bank">Bank Transfer</option>
										</select>
								</div> -->
								<div class="col-md-6">
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
									<button type="submit" class="btn btn-success">Export</button>
								</div>
								
								<input type="hidden" name="allRowIds" id="allRowIds">
								<input type="hidden" name="withdrawl_id" id="withdrawl_id" class=" " style="display: block;">

									<!-- -->
							<!-- </form> -->
						</div>
						<div class="box-header col-md-12">
							<div class="col-md-4 pull-left">
								<input type="hidden" name="checkid" id="checkid" class=" " style="display: block;">
              					<input type="hidden" name="check_allrecords[]" class="check_records" id="check_allrecords" value=""/>
								<a class="btn btn-sm btn-success pull-left" style="margin-left:7px" onclick="return multipleSelectAccept()">Accept Selected</a>
								<!-- <a class="btn btn-sm btn-success pull-left" style="margin-left:7px" >Accept Selected</a> -->
								<button type="button" class="btn btn-sm btn-danger pull-left" style="margin-left:7px" onclick="return multipleSelectReject()" >Reject Selected</button>
								
							</div>
							<div class="col-md-1 paddRight pull-right">
											
							</div>
						</div>
						<?= form_close() ?>
						<!-- /.box-header -->
							<div id="noSelect" style="font-size: 15px; text-align: center;"></div>
						<div class="box-body">
								<table class="table table-bordered table-striped" id="bankExpWithdraw_datatable" style="width: 100%;">
									<thead>
									<tr>
										<th>
											<input type="checkbox" name="select_all" id="select_all" onclick="return checkAll()" data-to-table="tasks" >
											<!-- <input type="checkbox" name="select_all" id="select_all" type='checkbox'   value='' data-to-table="tasks"> -->
											<!-- <input type="checkbox" name="checkAll" id="checkAll" onclick="checkAll('chk')" data-to-table="tasks"> --><!--  <?= $checkAll ?> -->
										</th>
										<th>Sr. No.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Withdraw Amount</th>
										<th>Admin Amount</th>
										<th>User Amount</th>
										<th>Balance Amount</th>
										<th>Date of Request</th>
										<!-- <th>Transaction Id</th> -->
										<th>status</th>
										<th>Action</th>
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
	var url = '<?= site_url("BankExpWithdrawRequest/ajax_manage_page"); ?>';
	var actioncolumn=9;
	var pageLength='';
</script>

	<!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
	/*function multipleSelectAccept()
	{
		check_count=0;
		rowid=[];
		$(".checkid").each(function(){
			if($(this).is(":checked")==true)
			{//console.log(check_count);return false;
					check_count++;
					rowid.push($(this).val());
			}
		});
		//console.log(rowid)

		 if(check_count=='')
		{
				//console.log(check_count);
				$("#noSelect").fadeIn().html("<span style='color:red; '>Please select atleast one checkbox.</span>");
				setTimeout(function(){$("#noSelect").fadeOut();},6000)
				return false;
		}else{

				var url = '<?= site_url('BankExpWithdrawRequest/bankAcceptedRedem');?>';
				var dataJson = { [csrfName]: csrfHash, id: rowid};

				$.ajax({
					type:"post",
					url:url,
					data:dataJson,
					success:function(result){
				//console.log(result);return false;
						var obj = JSON.parse(result);
							csrfName = obj.csrfName;
							csrfHash = obj.csrfHash;
							table.draw();
							$("#msgData").val(obj.msg);
							$("#toast-fade").click();
					}
				});
		}
	}

	function multipleSelectReject()
	{
		check_count=0;
		rowid=[];
		$(".checkid").each(function(){
			if($(this).is(":checked")==true)
			{//console.log(check_count);return false;
					check_count++;
					rowid.push($(this).val());
			}
		});
		//console.log(rowid)

		 if(check_count=='')
		{
				//console.log(check_count);
				$("#noSelect").fadeIn().html("<span style='color:red; '>Please select atleast one checkbox.</span>");
				setTimeout(function(){$("#noSelect").fadeOut();},6000)
				return false;
		}else{

				var url = '<?= site_url('BankExpWithdrawRequest/bankRejectedRedem');?>';
				var dataJson = { [csrfName]: csrfHash, id: rowid};

				$.ajax({
					type:"post",
					url:url,
					data:dataJson,
					success:function(result){
				//console.log(result);return false;
						var obj = JSON.parse(result);
							csrfName = obj.csrfName;
							csrfHash = obj.csrfHash;
							table.draw();
							$("#msgData").val(obj.msg);
							$("#toast-fade").click();
					}
				});
		}
	}
*/
	
	function multipleSelectAccept()
	{
		var  check_count =$("#allRowIds").val();

		if(check_count=='')
		{
				//console.log(check_count);
				$("#noSelect").fadeIn().html("<span style='color:red; '>Please select atleast one checkbox.</span>");
				setTimeout(function(){$("#noSelect").fadeOut();},6000)
				return false;
		}else{

				var url = '<?= site_url('BankExpWithdrawRequest/bankAcceptedRedem');?>';
				var dataJson = { [csrfName]: csrfHash, id: check_count};

				$.ajax({
					type:"post",
					url:url,
					data:dataJson,
					success:function(result){
				//console.log(result);return false;
						var obj = JSON.parse(result);
							csrfName = obj.csrfName;
							csrfHash = obj.csrfHash;
							table.draw();
							$("#msgData").val(obj.msg);
							$("#toast-fade").click();
					}
				});
		}
	}
	
	function multipleSelectReject()
	{
		var  check_count = $("#allRowIds").val();

		 if(check_count=='')
		{
				//console.log(check_count);
				$("#noSelect").fadeIn().html("<span style='color:red; '>Please select atleast one checkbox.</span>");
				setTimeout(function(){$("#noSelect").fadeOut();},6000)
				return false;
		}else{

				var url = '<?= site_url('BankExpWithdrawRequest/bankRejectedRedem');?>';
				var dataJson = { [csrfName]: csrfHash, id: check_count};

				$.ajax({
					type:"post",
					url:url,
					data:dataJson,
					success:function(result){
				//console.log(result);return false;
						var obj = JSON.parse(result);
							csrfName = obj.csrfName;
							csrfHash = obj.csrfHash;
							table.draw();
							$("#msgData").val(obj.msg);
							$("#toast-fade").click();
					}
				});
		}
	}
	
 
</script>
<script type="text/javascript">
	var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>'
	var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
	var table = $('#bankExpWithdraw_datatable').DataTable({
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
				d.SearchData2 = $(".filter_search_data2").val();
				d.SearchData1 = $(".filter_search_data1").val();
				d.SearchData = $(".filter_search_data").val();
				d[csrfName] = csrfHash;
				d.FormData = $(".filter_data_form").serializeArray();
				d.select_all = $("#allRowIds").val();
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
		"rowCallback": function ( row, data, start, end, display )  {
			var api = this.api(), data; 
			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
					return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
									i : 0;
			};


			// Total over all pages
			amount = api 
					.column( 4 )
					.data()
					.reduce( function (a, b) {
							return intVal(a) + intVal(b);
					}, 0 );

			//Update footer
			$( api.column( 0 ).footer() ).html('Total');
			$( api.column( 4).footer() ).html(amount.toFixed(2));
		},
		"columnDefs": [
			 { 
				 "targets": [ 0,actioncolumn ], //first column / numbering column
				 "orderable": false, //set not orderable
			 },
		],

	})
	$(".filter_search_data1").change(function(){
		table.draw();
	});

	$(".filter_search_data").change(function(){
		table.draw();
	});

	$(".filter_search_data2").change(function(){
		table.draw();
	});

	$(".resetBtn").click(function(){
		setTimeout(function(){
			table.draw();
		},20)
	});
</script>


<!-- FOR CHECK UNCHEK FUNCTIONALITY DONE BY PIYUSH -->
<script type="text/javascript">
	
	function checkAll()
	{
		var check = $("#select_all").prop('checked');

		if(check==true) {
			var payment_type = $("#payment_type").val();
			var from_date = $("#fromDate").val();
			var to_date = $("#toDate").val();
			// var searchValue = $("#searchValue").val();
			var searchValue = $('.dataTables_filter input').val();
			// console.log(searchValue)

			$.ajax({
				url: $("#site_url").val() +'/BankExpWithdrawRequest/CheckAllids/',
				type:'POST',
				data: { searchValue:searchValue, payment_type:payment_type, fromDate:from_date, toDate:to_date, [csrfName]: csrfHash },
				success:function(returndata){
					var obj = JSON.parse(returndata);
					$("#allRowIds").val(obj.id);
					csrfName = obj.csrfName;
					csrfHash = obj.csrfHash;
				},
				error: function (response) {

				}
			});
		} else {
			$("#allRowIds").val("");
		}
	}

	$(document).ready(function() {
		$('#select_all').change(function () {
			// console.log("INSIDE")
			var selectall=  $('#select_all').is(":checked");
			var select_chk =$("#withdrawl_id").val();
			// console.log(select_chk)
			if(selectall== true) {
				$("#allRowIds").val("");
				$("#withdrawl_id").val("");
			}

			$('.checkid').each(function(){ 
				var id = $(this).val();
				if(selectall== true) {
					$("#checkid_"+id).prop('checked' , true);
				} else { 
					$("#checkid_"+id).prop('checked' , false);
				}
				selectSingle(id);
			});
		});
	});

	function selectSingle(id) {
		var myarray = new Array();
		myarray.push($("#withdrawl_id").val());
		var checkbox_all = $("#checkid_"+id).is(":checked");

		if(checkbox_all==true) {
			if(myarray=='') {
				myarray[0]=($("#checkid_"+id).val());
			} else {
				myarray.push($("#checkid_"+id).val());
			}
			$("#checkid_"+id).attr('name', 'users[]');  
		} else {
			var remove_val = $("#checkid_"+id).val();
			var new_arr = remove_data(remove_val);
			//alert(new_arr);return false;
			myarray = new_arr;
			$("#checkid_"+id).attr('name', 'YeNhiJayega');  
			$("#checkid_"+id).attr('name', 'YeNhiJayega');

			var select =$("#checkid_"+id).is(":checked");
			if(select == false) {
				$("#select_all").prop('checked', false);
			} 
		}
		$("#allRowIds").val(myarray);
		$("#withdrawl_id").val(myarray);
	}

	function remove_data(remove_val) {		
		var array_val1 = $("#withdrawl_id").val();
		var array_val1 = $("#allRowIds").val();
		var difference = [];
		var array_val = array_val1.split(",");
	 
		for( var i = 0; i < array_val.length; i++ ) { //console.log(remove_val);
			if(array_val[i] != remove_val) {
				difference.push(array_val[i]);
			}
		}
		return difference;
	}
</script>
<!-- FOR CHECK UNCHEK FUNCTIONALITY DONE BY PIYUSH -->
