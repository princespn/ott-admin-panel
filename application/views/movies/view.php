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

                  <a class="users-list-name text-left" href="javascript:void(0)">Movie Name: <?=!empty($getMovieData->movieName) ? $getMovieData->movieName : 'NA';?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Short Description : <?=!empty($getMovieData->movieShortDescription) ? $getMovieData->movieShortDescription : 'NA';?> </a>


                  <a class="users-list-name text-left" href="javascript:void(0)">Cast: <?=!empty($getMovieData->cast) ? $getMovieData->cast : 'NA';?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Director : <?=!empty($getMovieData->director) ? $getMovieData->director : 'NA';?> </a>



                  <a class="users-list-name text-left" href="javascript:void(0)">Short Description : <?=!empty($getMovieData->movieLongDescription) ? $getMovieData->movieLongDescription : 'NA';?> </a>

				  <a class="users-list-name text-left" href="javascript:void(0)">Category: <?=!empty($getCategories->categoryName) ? $getCategories->categoryName : 'NA';?> </a>
                   <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editVideo">Edit Details</button>

			   </div>
			   <div class="box-header with-border">
			   <strong><i class="margin-r-5"></i> Trailer Video Link</strong>

			  		 <?php if (!empty($getMovieData->trailer == 0)) {?>
                  	<span title="ADD" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addTrailer">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>

                  	<span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $getTrailerData->trailerLink ?></span>
                    
                    <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteTrailVedios( '<?php echo $getMovieData->movieId; ?>')"><i class='fa fa-trash-o'></i></button>
                                    
                  	<?php }?>
			   </div>
               <div class="box-header with-border">
			   <strong><i class="margin-r-5"></i> Movie Video Link</strong>

			  		 <?php if (!empty($getMovieData->video == 0)) {?>
                  	<span title="ADD" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addVideo">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>

                  	<span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $getVideoLink->videoLink ?></span>
                     <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteMoviVedios( '<?php echo $getMovieData->movieId; ?>')"><i class='fa fa-trash-o'></i></button>
                   
                  	<?php }?>
			   </div>
			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Thumbnail Image</strong>
			  		 <?php if (!empty($getMovieData->thumbnailImage == 0)) {?>
                  	<span title="Add thumbnailImage" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addThumbnail">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>
						<img src="<?php echo $getThumbnailData->imageLink ?>" alt="Girl in a jacket" width="100" height="100">
                  	<img class="" style="color:green;">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></img>
                     <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteThumbnail( '<?php echo $getMovieData->movieId; ?>')"><i class='fa fa-trash-o'></i></button>
                  	<?php }?>
			   </div>
			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Banner Image</strong>
			  		 <?php if (!empty($getMovieData->bannerImage == 0)) {?>
                  	<span title="Add banner" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addBanner">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php } else {?>
						<img src="<?php echo $getBannerData->bannerLink ?>" alt="Girl in a jacket" width="100" height="100">
                  	<img class="" style="color:green;">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></img>
                     <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteBanner( '<?php echo $getMovieData->movieId; ?>')"><i class='fa fa-trash-o'></i></button>
                  	<?php }?>
			   </div>
			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Subtitles</strong><br>
					  <?php $index = 1;foreach ($getMovieSubtitle as $subtitle) {?>
						<strong><i class="margin-r-5"></i><?echo $index++; ?> <?php echo $subtitle->name ?></strong>
						<?php if ($subtitle->subtitle_fileLink == null) {?>
					<form class="form-horizontal form-label-left margin-r-5" method="post" action="<?php echo site_url(); ?>/Movies/uploadSubtitle" enctype="multipart/form-data"/>
						<div class="form-group">
						<input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
						<input type="hidden" class="form-control has-feedback-left"  name="language" id="language" value="<?php echo $subtitle->language ?>">
						<input type="hidden" class="form-control has-feedback-left"  name="name" id="name" value="<?php echo $subtitle->name ?>">
							<!-- <label class="control-label has-feedback-left">Upload <?php echo $subtitle->name; ?> Subtitle</label> -->
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input type="file" class="form-control has-feedback-left margin-r-5" name="<?php echo $subtitle->name; ?>" id="<?php echo $subtitle->name; ?>" required>
								</div>
								<button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
							</div>
						</div>
					 </form>
					 	<?php } else {?>
							<span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $subtitle->subtitle_fileLink ?></span><br>
						<?php }}?>
			   </div>
			   <div class="box-header with-border">
			   <strong><i class="margin-r-5"></i> Audio Files</strong><br>
			   <?php $index = 1;foreach ($getMovieAudioFiles as $audio) {?>
						<strong><i class="margin-r-5"></i><?echo $index++; ?> <?php echo $audio->name ?></strong>
						<?php if ($audio->audioFileLink == null) {?>
					<form class="form-horizontal form-label-left margin-r-5" method="post" action="<?php echo site_url(); ?>/Movies/uploadAudioFile" enctype="multipart/form-data"/>
						<div class="form-group">
						<input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
						<input type="hidden" class="form-control has-feedback-left"  name="language" id="language" value="<?php echo $audio->language ?>">
						<input type="hidden" class="form-control has-feedback-left"  name="name" id="name" value="<?php echo $audio->name ?>">
							<!-- <label class="control-label has-feedback-left">Upload <?php echo $audio->name; ?> Subtitle</label> -->
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input type="file" class="form-control has-feedback-left margin-r-5" name="<?php echo $audio->name; ?>" id="<?php echo $audio->name; ?>" required>
								</div>
								<button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
							</div>
						</div>
					 </form>
					 	<?php } else {?>
							<span class="" style="color:green;">&nbsp;<i class="fa fa-file-audio-o" aria-hidden="true"></i><?php echo $audio->audioFileLink ?></span><br>
						<?php }}?>

			   </div>
               <div class="box-header with-border">
                  <strong><i class="margin-r-5"></i>Subscription Type</strong>
                  <span class="text-muted pull-right">
                  <?php if (!empty($getUserData->subscriptionType)) {echo $getUserData->subscriptionType;} else {echo 'NA';}?>
                  </span>
               </div>
               </div>
            </div>
        </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
</section>
<div class="modal fade" id="addTrailer" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadMovieTrailer" enctype="multipart/form-data"/>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Trailer Video</h4>
            </div>
            <div class="modal-body">
              	<div class="form-group">
				  <input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Trailer</label>
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

<div class="modal fade" id="addVideo" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadVideo" enctype="multipart/form-data" >

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie Video</h4>
            </div>
            <div class="modal-body">
              	<div class="form-group">
				  <input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Video</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="video_file" id="video_file" required>
                    </div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    	</form>
    </div>
</div>

<div class="modal fade" id="addThumbnail" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadThumbnailImage" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie Thumbnail Image</h4>
            </div>
            <div class="modal-body">

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
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

<div class="modal fade" id="addThumbnail" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadBannerImage" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie Banner Image</h4>
            </div>
            <div class="modal-body">

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Banner Image</label>
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
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url(); ?>/Movies/uploadBannerImage" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie Banner Image</h4>
            </div>
            <div class="modal-body">

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="movieId" id="movieId" value="<?php echo $getMovieData->movieId ?>">
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
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Movies/EditMovies" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Movie Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden" class="form-control has-feedback-left" name="movieId" id="movieId" value="<?=!empty($getMovieData->movieId) ? $getMovieData->movieId : 'NA';?>">
                   
                        <input type="text" class="form-control has-feedback-left" name="name" id="name" value="<?=!empty($getMovieData->movieName) ? $getMovieData->movieName : 'NA';?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Short Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="movieShortDescription" id="movieShortDescription    " value="<?=!empty($getMovieData->movieShortDescription) ? $getMovieData->movieShortDescription : 'NA';?>">
                    </div>
                        </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Director</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="director" id="director" value="<?=!empty($getMovieData->director) ? $getMovieData->director : 'NA';?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Cast</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="cast" id="cast" rows="4" cols="50"><?=!empty($getMovieData->cast) ? $getMovieData->cast : 'NA';?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Long Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="movieLongDescription" id="movieLongDescription" rows="4" cols="50"><?=!empty($getMovieData->movieLongDescription) ? $getMovieData->movieLongDescription : 'NA';?></textarea>
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

function deleteTrailVedios(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETETRAILVIDEOS; ?>";
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



function deleteMoviVedios(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETEMOVIVIDEOS; ?>";
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
             var url        =  site_url+"/<?= DELETETHUMBNAIL; ?>";
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
             var url        =  site_url+"/<?= DELETEBANNER; ?>";
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