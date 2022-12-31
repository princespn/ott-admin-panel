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

                            <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addVideo">Add Category</button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" >
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Category Name</th>
                                    <th></th>
									<th>Options <th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $index = 1;if (!empty($subscription_plan_data)) {foreach ($subscription_plan_data as $subs) {?>
                                   <tr>
                                      <td><?php echo $index++; ?></td>
                                      <td><?php echo $subs->categoryName; ?></td>
                                      <td></td>
                                     <td>
                                         <span title="Edit" class="btn btn-primary btn-xs"  data-placement="right"
                                         onclick="edit_subscription('<?php echo $subs->id; ?>')"><i class="fa fa-edit"></i></span>
                                        &nbsp;|&nbsp;
                                        <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteSubs( '<?php  echo $subs->id; ?>')"><i class='fa fa-trash-o'></i></button>
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
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Category/addCategory" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Category</h4>
            </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Category</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="categoryName" id="categoryName" required>
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
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Category/editCategory" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Plan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Category Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
						<input type="hidden" class="form-control has-feedback-left"  name="editId" id="editId">
                        <input type="text" class="form-control has-feedback-left" name="editcategoryName" id="editcategoryName" required>
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
             var url        =  site_url+"/<?=DELETECATEGORY;?>";
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


function edit_subscription(id) {
		var edittournamentId = "";

		var editId = "";

		var editcategoryName="";

		var site_url   = $("#site_url").val();
		var url        =  site_url+"/<?=CATEGORYDETAILS;?>";
		var datastring =  'id='+id;

		$.post(url,datastring,function(response){
		//console.log("response ",response, "Hi")
			var str = JSON.parse(response);
			console.log("str ",str)
			editId = str.id;
			editcategoryName = str.categoryName;

			$("#editPlanModel").modal("show");
			$("#editId").val(editId);
			$("#editcategoryName").val(editcategoryName);
			console.log(editId)

		});

	}



</script>
