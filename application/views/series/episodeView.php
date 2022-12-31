<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	 <h1><?= $heading; ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- User Profile -->        
            <div class="box" style="border-top:2px solid Blue;">
               <div class="box-body box-profile">
    
                  <a class="users-list-name text-left" href="javascript:void(0)">Series Name: <?= !empty($seriesData->seriesName) ? $seriesData->seriesName : 'NA'; ?> </a>

				  <a class="users-list-name text-left" href="javascript:void(0)">Description: <?= !empty($seriesData->seriesShortDescription) ? $seriesData->seriesShortDescription : 'NA'; ?> </a>
				  
				  <a class="users-list-name text-left" href="javascript:void(0)">Season No: <?= !empty($season->seasonNo) ? $season->seasonNo : 'NA'; ?> </a>

				  <a class="users-list-name text-left" href="javascript:void(0)">Episode No: <?= !empty($episodeData->episodeNo) ? $episodeData->episodeNo : 'NA'; ?> </a>

                  <!-- <h1 class="users-list-name text-left" href="javascript:void(0)">Video Link<?= !empty($getMovieData->videoLink) ? $getMovieData->videoLink : 'NA'; ?> -->

                     <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editVideo">Edit Details</button>

				    
               </div>
               <div class="box-header with-border">
			   <strong><i class="margin-r-5"></i> Video Link</strong>
					   
			  		 <?php if(!empty($episodeData->videoLink==0)) {  ?>
                  	<span title="ADD" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addVideo">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php }else { ?>
						
                  	<span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $getVideoLink->videoLink?></span>
                     <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteEPVideo( '<?php echo $episodeData->id; ?>')"><i class='fa fa-trash-o'></i></button>

                  	<?php } ?>
			   </div>
			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Thumbnail Image</strong>					   
			  		 <?php if(!empty($episodeData->thumbnailImage==0)) {  ?>
                  	<span title="ADD thumbnailImage" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addThumbnail">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php }else { ?>
						<img src="<?php echo $getEpisodeThumbnail->thumbnailLink?>" alt="Girl in a jacket" width="50" height="60">
                  	<img class="" style="color:green;">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i></img>
                     <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteEPThumb( '<?php echo $episodeData->id; ?>')"><i class='fa fa-trash-o'></i></button>

                  	<?php } ?>
			   </div>
			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Subtitles</strong><br>	   	
					  <?php $index=1; foreach ($subtitleFiles as $subtitle) {?>
						<strong><i class="margin-r-5"></i><?echo $index++; ?> <?php echo $subtitle->name?></strong>
						<?php if($subtitle->subtitle_fileLink == null) {?>		
					<form class="form-horizontal form-label-left margin-r-5" method="post" action="<?php echo site_url();?>/Series/uploadEpisodeSubtitles" enctype="multipart/form-data"/>					 
						<div class="form-group">
						<input type="hidden" class="form-control has-feedback-left"  name="episodeId" id="episodeId" value="<?php echo $episodeData->episodeId?>">
						<input type="hidden" class="form-control has-feedback-left"  name="language" id="language" value="<?php echo $subtitle->language?>">
						<input type="hidden" class="form-control has-feedback-left"  name="name" id="name" value="<?php echo $subtitle->name?>">
							<!-- <label class="control-label has-feedback-left">Upload <?php echo $subtitle->name; ?> Subtitle</label> -->
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input type="file" class="form-control has-feedback-left margin-r-5" name="<?php echo $subtitle->name;?>" id="<?php echo $subtitle->name;?>" required>
								</div>
								<button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
							</div>	
						</div>					
					 </form>	
					 	<?php } else {  ?>
							<span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $subtitle->subtitle_fileLink?></span><br>						
						<?php }}?>
			   </div>
			   <div class="box-header with-border">
			   <strong><i class="margin-r-5"></i> Audio Files</strong><br>				   
			   <?php $index=1; foreach ($audioFiles as $audio) {?>
						<strong><i class="margin-r-5"></i><?echo $index++; ?> <?php echo $audio->name?></strong>
						<?php if($audio->audioFileLink == null) {?>		
					<form class="form-horizontal " method="post" action="<?php echo site_url();?>/Movies/uploadAudioFile" enctype="multipart/form-data"/>					 
						<div class="form-group">
						<input type="hidden" class="form-control has-feedback-left"  name="episodeId" id="episodeId" value="<?php echo $episodeData->episodeId?>">
						<input type="hidden" class="form-control has-feedback-left"  name="language" id="language" value="<?php echo $audio->language?>">
						<input type="hidden" class="form-control has-feedback-left"  name="name" id="name" value="<?php echo $audio->name?>">
							<!-- <label class="control-label has-feedback-left">Upload <?php echo $audio->name; ?> Subtitle</label> -->
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-8">
									<input type="file" class="form-control has-feedback-left margin-r-5" name="<?php echo $audio->name;?>" id="<?php echo $audio->name;?>" required>
								</div>
								<button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
							</div>	
						</div>					
					 </form>	
					 	<?php } else {  ?>
							<span class="" style="color:green;">&nbsp;<i class="fa fa-file-audio-o" aria-hidden="true"></i><?php echo $audio->audioFileLink?></span><br>						
						<?php }}?>
							
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
<div class="modal fade" id="addVideo" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/uploadEpisodeVideo" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Episode Video</h4>
            </div>
            <div class="modal-body">	
              	<div class="form-group">
				  <input type="hidden" class="form-control has-feedback-left"  name="episodeId" id="episodeId" value="<?php echo $episodeData->episodeId?>"> 
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload Video</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="video_file" id="video_file" required>
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
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/uploadEpisodeThumbnail" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Episode Thumbnail Image</h4>
            </div>
            <div class="modal-body">	

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="episodeId" id="episodeId" value="<?php echo $episodeData->episodeId?>"> 
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

<div class="modal fade" id="addSubtitles" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/uploadSubtitle" enctype="multipart/form-data"/>
					 
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Movie Subtitles File</h4>
            </div>
            <div class="modal-body">
			<?php $index=1; if(!empty($getLanguageData))   { foreach ($getLanguageData as $language) {  ?>		 
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload <?php echo $language->name; ?> Subtitle</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="subtitle_<?php echo $language->name;?>" id="subtitle_<?php echo $language->name;?>" required>
                    </div>
                </div>
				<?php } } ?>   
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
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Movies/uploadAudioFile" enctype="multipart/form-data"/>  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Audio Files</h4>
            </div>
            <div class="modal-body">	
			<?php $index=1; if(!empty($getLanguageData))   { foreach ($getLanguageData as $language) {  ?>		 

				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Upload <?php echo $language->name; ?> Audio</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="file" class="form-control has-feedback-left" name="audio_<?php echo $language->name; ?>" id="audio_<?php echo $language->name; ?>" required>
                    </div>
                </div>
				<?php } } ?>   
     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="checkadminmail">Add</button>
            </div>
        </div>
    	</form>
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
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Episode No </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden" class="form-control has-feedback-left" name="seriesId" id="seriesId" value="<?=!empty($seriesData->seriesId) ? $seriesData->seriesId : 'NA';?>">
                   
                        <input type="text" class="form-control has-feedback-left" name="name" id="name" value="<?=!empty($seriesData->seriesName) ? $seriesData->seriesName : 'NA';?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Episode Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="director" id="director" value="<?=!empty($seriesData->director) ? $seriesData->director : 'NA';?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Episode Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea class="form-control has-feedback-left" name="seriesLongDescription" id="seriesLongDescription" rows="4" cols="50"><?=!empty($seriesData->seriesLongDescription) ? $seriesData->seriesLongDescription : 'NA';?></textarea>
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

</div>
<?php $this->load->view('common/footer.php'); ?>

<script type="text/javascript">

function deleteEPVideo(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETEPVIDEOS; ?>";
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

function deleteEPThumb(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETEPTHUMB; ?>";
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
