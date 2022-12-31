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
                        <div class="col-md-4 box-title paddLeft"><?= $heading; ?></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-right paddRight">

                            <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addVideo">Add Movie</button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Movie Id</th>

                                    <th>Movie Name</th>
									<th>Movie Category</th>									
									<th>Movie Type</th>
									<th>Added On</th>
									<th>Release Date</th>
									<th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $index=1; if(!empty($movie_data))   { foreach ($movie_data as $movie) { ?>
                                   <tr>
                                      <td><?php echo $index++; ?></td>
                                     <td><?php echo  $movie->movieId;?></td>

                                      <td><?php echo  $movie->movieName;?></td>
									  <td><?php echo  $movie->movieCategory;?></td>
									  <td><?php echo  $movie->movieType;?></td>
									  <td><?php echo  $movie->addedOn;?></td>
									  <td><?php echo  $movie->releaseDate;?></td>
                                      <td>
                                         <span title="View" class="btn btn-primary btn-xs"  data-placement="right"
                                         onclick="location.href='<?php echo site_url(MOVIEVIEW.'/'.base64_encode($movie->movieId));?>'"><i class="fa fa-eye"></i></span>
                                        &nbsp;|&nbsp;
                                        <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteVideo( '<?php echo $movie->id;?>')"><i class='fa fa-trash-o'></i></button>
                                      </td>
                                  </tr>
                                   <?php } } ?>
                               
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
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Movies/addMovies" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Movie Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="name" id="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Short Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="movieShortDescription" id="movieShortDescription	">
                    </div>
				        </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Director</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="director" id="director" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Cast</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="cast" id="cast" rows="4" cols="50"></textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Long Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="movieLongDescription" id="movieLongDescription" rows="4" cols="50"></textarea>
                    </div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Select Categories</label>
					<div class="col-md-8 col-sm-8 col-xs-12">	
					<select class="form-control select2" id="categories" name="categories" onchange="this.value">
						<?php $index=1; if(!empty($categories_list))   { foreach ($categories_list as $category) { ?>
							<option class="form-control has-feedback-left" value="<?php echo $category->id ?>">
							<label><?php echo $category->categoryName ?></label>
						<?php } } ?></select>
					</div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Movie Type</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="radio" class="custom-control-input has-feedback-left" name="movieType" value="free" id="movieType">                        
						<label>Free</label>
						<input type="radio" class="custom-control-input has-feedback-left" name="movieType" value="paid" id="movieType">
						<label>Paid</label>    
                    </div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Release Date</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="datetime-local" class="form-control has-feedback-left" name="releaseDate" id="releaseDate">
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
<?php $this->load->view('common/footer.php'); ?>

<script type="text/javascript">

function deleteVideo(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETEVIDEOS; ?>";

             var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
             $.post(url,datastring,function(response){
                 $("#Deletemodal").load(location.href+" #Deletemodal>*","");
                    $("#Deletemodal").modal('hide');
                    location.reload();

                     var obj   = JSON.parse(response);
                     csrfName = obj.csrfName;
                     csrfHash = obj.csrfHash;
                    // table.draw();
                     $("#msgData").val(obj.msg);
                     $("#toast-fade").click();
                 });
         });
}


</script>
