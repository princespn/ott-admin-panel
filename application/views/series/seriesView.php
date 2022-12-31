<!-- Load common header -->
<?php $this->load->view('common/header');?>
<!-- Load common left panel -->
<?php $this->load->view('common/left_panel');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	 <h1><?=$heading;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- User Profile -->
            <div class="box" style="border-top:2px solid Blue;">
               <div class="box-body box-profile">

                  <a class="users-list-name text-left" href="javascript:void(0)">Series Name: <?=!empty($seriesData->seriesName) ? $seriesData->seriesName : 'NA';?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Short Description: <?=!empty($seriesData->seriesShortDescription) ? $seriesData->seriesShortDescription : 'NA';?> </a>

				  <a class="users-list-name text-left" href="javascript:void(0)">Long Description: <?=!empty($seriesData->seriesLongDescription) ? $seriesData->seriesLongDescription : 'NA';?> </a>
                   <a class="users-list-name text-left" href="javascript:void(0)">Cast: <?=!empty($seriesData->cast) ? $seriesData->cast : 'NA';?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Director: <?=!empty($seriesData->director) ? $seriesData->director : 'NA';?> </a>


				  <a class="users-list-name text-left" href="javascript:void(0)">Category: <?=!empty($getCategories->categoryName) ? $getCategories->categoryName : 'NA';?> </a>
                   <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editVideo">Edit Details</button>



               </div>

			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Trailer Video</strong>
			  		 <?php if (!empty($seriesData->trailer == 0)) {?>
                  	<span title="Add trailer" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addTrailer">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>
						<span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $getSeriesTrailer->trailerLink ?></span>
                    <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteTrailVedios( '<?php echo $seriesData->seriesId; ?>')"><i class='fa fa-trash-o'></i></button>

                  	<?php }?>
			   </div>

			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Thumbnail Image</strong>
			  		 <?php if (!empty($seriesData->thumbnail == 0)) {?>
                  	<span title="ADD thumbnailImage" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addThumbnail">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>
						<img src="<?php echo $getSeriesThumbnail->imageLink ?>" alt="Girl in a jacket" width="80" height="60"></img>
                  	<button title='Delete' class='btn btn-danger btn-xs' onclick="deleteThumbnail( '<?php echo $seriesData->seriesId; ?>')"><i class='fa fa-trash-o'></i></button>

                  	<?php }?>
			   </div>

			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Banner Image</strong>
			  		 <?php if (!empty($seriesData->banner == 0)) {?>
                  	<span title="ADD Banner" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addBanner">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>
						<img src="<?php echo $getSeriesBanner->bannerLink ?>" alt="Girl in a jacket" width="80" height="60"></img>
                  <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteBanner( '<?php echo $seriesData->seriesId; ?>')"><i class='fa fa-trash-o'></i></button>

                  	<?php }?>
			   </div>

            </div>
        </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box bShow">
				<div class="box-header with-border">
				<div class="col-md-4 box-title paddLeft"><?=$seasonHeading;?></div>
				<div class="col-md-4"></div>
                <div class="col-md-4 text-right paddRight">
                    <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addSeason">Add Season</button>
                </div>
				<div class="box-body">
                    <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Season No</th>
								<th>Season Details</th>
								<th>Added On</th>
								<th>Release Date</th>
								<th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $index = 1;if (!empty($seasonData)) {foreach ($seasonData as $season) {?>
                                <tr>
                                  <td><?php echo $index++; ?></td>
                                  <td><?php echo $season->seasonNo; ?></td>
                                  <td><?php echo $season->seasonDetails; ?></td>
								  <td><?php echo $season->addedOn; ?></td>
								  <td><?php echo $season->releaseDate; ?></td>
                                  <td>
                                     <span title="View" class="btn btn-primary btn-xs"  data-placement="right"
                                     onclick="location.href='<?php echo site_url(SEASONVIEW . '/' . base64_encode($season->seasonId)); ?>'"><i class="fa fa-eye"></i></span>
                                        &nbsp;|&nbsp;
                                        <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteSeason( '<?php echo $season->id; ?>')"><i class='fa fa-trash-o'></i></button>
                                      </td>
                                  </tr>
                                   <?php }}?>

                            </tbody>
                        </table>
                    </div>

				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="addSeason" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Series/addSeason" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Season</h4>
            </div>
            <div class="modal-body">
              	<div class="form-group">
				  <input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $seriesData->seriesId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Season Number</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="seasonNo" id="seasonNo" required>
                    </div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Series Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <!-- <input type="textarea" class="form-control has-feedback-left" name="details" id="details"> -->
						<textarea class= "form-control has-feedback-left" name="details" id="details" required>Enter text here...</textarea>

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

<div class="modal fade" id="addThumbnail" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Series/uploadSeriesThumbnail" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Series Thumbnail Image</h4>
            </div>
            <div class="modal-body">

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $seriesData->seriesId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Thumbnail Image</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="thumbnail_image" id="thumbnail_image" required>
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

<div class="modal fade" id="addBanner" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Series/uploadSeriesBanner" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Banner</h4>
            </div>
            <div class="modal-body">

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $seriesData->seriesId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Banner Image</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="banner_image" id="banner_image" required>
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


<div class="modal fade" id="addTrailer" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Series/uploadSeriesTrailer" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Trailer</h4>
            </div>
            <div class="modal-body">

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $seriesData->seriesId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Trailer Video</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="trailer_file" id="trailer_file" required>
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

<div class="modal fade" id="addSubtitles" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadSubtitle" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie Subtitles File</h4>
            </div>
            <div class="modal-body">
			<?php $index = 1;if (!empty($getLanguageData)) {foreach ($getLanguageData as $language) {?>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload <?php echo $language->name; ?> Subtitle</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="subtitle_<?php echo $language->name; ?>" id="subtitle_<?php echo $language->name; ?>" required>
                    </div>
                </div>
				<?php }}?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
            </div>
        </div>
    	</form>
    </div>
</div>


<div class="modal fade" id="addAudio" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadAudioFile" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Audio Files</h4>
            </div>
            <div class="modal-body">
			<?php $index = 1;if (!empty($getLanguageData)) {foreach ($getLanguageData as $language) {?>

				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload <?php echo $language->name; ?> Audio</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="audio_<?php echo $language->name; ?>" id="audio_<?php echo $language->name; ?>" required>
                    </div>
                </div>
				<?php }}?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
            </div>
        </div>
    	</form>
    </div>
</div>

</div>

<div class="modal fade" id="editVideo" role="dialog">
    <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/EditSeries" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Series Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden" class="form-control has-feedback-left" name="seriesId" id="seriesId" value="<?=!empty($seriesData->seriesId) ? $seriesData->seriesId : 'NA';?>">
                   
                        <input type="text" class="form-control has-feedback-left" name="name" id="name" value="<?=!empty($seriesData->seriesName) ? $seriesData->seriesName : 'NA';?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Short Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="seriesShortDescription" id="seriesShortDescription    " value="<?=!empty($seriesData->seriesShortDescription) ? $seriesData->seriesShortDescription : 'NA';?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Long Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="seriesLongDescription" id="seriesLongDescription" rows="4" cols="50"><?=!empty($seriesData->seriesLongDescription) ? $seriesData->seriesLongDescription : 'NA';?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Director</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="director" id="director" value="<?=!empty($seriesData->director) ? $seriesData->director : 'NA';?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Cast</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="cast" id="cast" rows="4" cols="50"><?=!empty($seriesData->cast) ? $seriesData->cast : 'NA';?></textarea>
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
                        <input type="radio" class="custom-control-input has-feedback-left" name="seriesType" value="free" id="seriesType">                        
                        <label>Free</label>
                        <input type="radio" class="custom-control-input has-feedback-left" name="seriesType" value="paid" id="seriesType">
                        <label>Paid</label>    
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Release Date</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="datetime-local" class="form-control has-feedback-left" name="releaseDate" id="releaseDate" value="<?=!empty($getMovieData->releaseDate) ? $getMovieData->releaseDate : 'NA';?>">
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
function deleteSeason(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETESEASON; ?>";
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

function deleteTrailVedios(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETETRAILSVIDEOS; ?>";
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

function deleteThumbnail(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETESTHUMBS; ?>";
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

function deleteBanner(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETESBANNERS; ?>";
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