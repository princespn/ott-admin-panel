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
            <!-- Series Profile -->        
            <div class="box" style="border-top:2px solid Blue;">
               <div class="box-body box-profile">
    
                  <a class="users-list-name text-left" href="javascript:void(0)">Series Name: <?= !empty($seriesData->seriesName) ? $seriesData->seriesName : 'NA'; ?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Description: <?= !empty($seriesData->seriesShortDescription) ? $seriesData->seriesShortDescription : 'NA'; ?> </a>

                  <!-- <h1 class="users-list-name text-left" href="javascript:void(0)">Video Link<?= !empty($getMovieData->videoLink) ? $getMovieData->videoLink : 'NA'; ?> -->
				  
                  <!-- <?php if(!empty($getUserData->is_emailVerified=="No")) {  ?>
				  
					<center><span class="btn btn-success btn-xs" id="emailBtn" onclick="return verifyEmail('<?= $getUserData->id; ?>')">Verify Email </span></center> <?php } ?> -->
               </div>			   
            </div>            
        </div> 
	</div>
	<div class="row">
        <div class="col-md-12">
            <!-- Series Profile -->        
            <div class="box" style="border-top:2px solid Blue;">
               <div class="box-body box-profile">
    
                  <a class="users-list-name text-left" href="javascript:void(0)">Season Number: <?= !empty($season->seasonNo) ? $season->seasonNo : 'NA'; ?> </a>

                  <a class="users-list-name text-left" href="javascript:void(0)">Season Description: <?= !empty($season->seasonDetails) ? $season->seasonDetails : 'NA'; ?> </a>



                  <!-- <h1 class="users-list-name text-left" href="javascript:void(0)">Video Link<?= !empty($getMovieData->videoLink) ? $getMovieData->videoLink : 'NA'; ?> -->
				  
                   <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editVideo">Edit Details</button>

                  <!-- <?php if(!empty($getUserData->is_emailVerified=="No")) {  ?>
				  
					<center><span class="btn btn-success btn-xs" id="emailBtn" onclick="return verifyEmail('<?= $getUserData->id; ?>')">Verify Email </span></center> <?php } ?> -->
               </div>

                <div class="box-header with-border">
                    <strong><i class="margin-r-5"></i> Trailer Video</strong>                      
                     <?php if(!empty($season->trailer==0)) {  ?>
                    <span title="Add trailer" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addTrailer">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
                      <?php }else { ?>
                        <span class="" style="color:green;">&nbsp;<i class="fa fa-file-video-o" aria-hidden="true"></i><?php echo $getSeriesTrailer->trailerLink?></span>
                    <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteSEVideo( '<?php echo $season->id; ?>')"><i class='fa fa-trash-o'></i></button>                        
                    <?php } ?>
               </div>
               
			   <div class="box-header with-border">
			   		<strong><i class="margin-r-5"></i> Thumbnail Image</strong>					   
			  		 <?php if(!empty($season->thumbnail==0)) {  ?>
                  	<span title="ADD thumbnailImage" class="btn btn-warning btn" style="color:black;" data-toggle="modal" data-target="#addThumbnail">&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span>
					  <?php }else { ?>
					<img src="<?php echo $getSeasonThumbnail->thumbnailLink?>" alt="Girl in a jacket" width="80" height="60" />
                  	<!-- <img class="" style="color:green;">&nbsp;<i class="fa fa-check-circle" aria-hidden="true"></i><?php // echo $getSeasonThumbnail->imageLink ?></img> -->
                      <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteSEThumb( '<?php echo $season->id; ?>')"><i class='fa fa-trash-o'></i></button>

                  	<?php } ?>
			   </div>
			   
            </div>            
        </div> 
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box bShow">
				<div class="box-header with-border">
				<div class="col-md-4 box-title paddLeft"><?= $episodeHearing; ?></div>
				<div class="col-md-4"></div>
                <div class="col-md-4 text-right paddRight">
                    <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addSeason">Add Episode</button>
                </div>
				<div class="box-body">
                    <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Episode No</th>
								<th>Episode Details</th>		
								<th>Added On</th>
								<th>Release Date</th>
								<th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $index=1; if(!empty($episodeData))   { foreach ($episodeData as $episode) { ?>
                                <tr>
                                  <td><?php echo $index++; ?></td>
                                  <td><?php echo  $episode->episodeNo;?></td>
                                  <td><?php echo  $episode->episodeDetails;?></td>
								  <td><?php echo  $episode->addedOn;?></td>
								  <td><?php echo  $episode->releaseDate;?></td>
                                  <td>
                                     <span title="View" class="btn btn-primary btn-xs"  data-placement="right"
                                     onclick="location.href='<?php echo site_url(EPISODEVIEW.'/'.base64_encode($episode->episodeId));?>'"><i class="fa fa-eye"></i></span>
                                        &nbsp;|&nbsp;
                                        <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteEPISODE('<?php echo $episode->id;?>')"><i class='fa fa-trash-o'></i></button>
                                      </td>
                                  </tr>
                                   <?php } } ?>
                               
                            </tbody>
                        </table>
                    </div>		

				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="addTrailer" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/uploadSeasonTrailer" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Trailer</h4>
            </div>
            <div class="modal-body">    

                <div class="form-group">
                <input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $season->seasonId?>"> 
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

<div class="modal fade" id="addSeason" role="dialog">
    <div class="modal-dialog">
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/addEpisode" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Episode</h4>
            </div>
            <div class="modal-body">	
              	<div class="form-group">
				  <input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $seriesData->seriesId?>"> 
				  <input type="hidden" class="form-control has-feedback-left"  name="seasonId" id="seasonId" value="<?php echo $season->seasonId?>"> 
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Episode Number</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left" name="episodeNo" id="episodeNo" required>
                    </div>
				</div>
				<div class="form-group">
				    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Episode Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="episodeName" id="episodeName" required>
                    </div>
				</div>  
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Episode Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <!-- <input type="textarea" class="form-control has-feedback-left" name="details" id="details"> -->
						<textarea class= "form-control has-feedback-left" name="details" id="details" required>Enter text here...</textarea>

					</div>
				</div>
				<div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Release Date</label>
					<input type="hidden" class="form-control has-feedback-left"  name="seasonId" id="seasonId" value="<?php echo $season->seasonId?>"> 
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
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Series/uploadSeasonThumbnail" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Season Thumbnail Image</h4>
            </div>
            <div class="modal-body">	

				<div class="form-group">
				<input type="hidden" class="form-control has-feedback-left"  name="seasonId" id="seasonId" value="<?php echo $season->seasonId?>"> 				
				<input type="hidden" class="form-control has-feedback-left"  name="seriesId" id="seriesId" value="<?php echo $seriesData->seriesId?>"> 
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
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Movies/uploadSubtitle" enctype="multipart/form-data"/>
					 
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
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Season Number</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden" class="form-control has-feedback-left" name="seriesId" id="seriesId" value="<?=!empty($seriesData->seriesId) ? $seriesData->seriesId : 'NA';?>">
                   
                        <input type="text" class="form-control has-feedback-left" name="name" id="name" value="<?=!empty($seriesData->seriesName) ? $seriesData->seriesName : 'NA';?>" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Season Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="director" id="director" value="<?=!empty($seriesData->director) ? $seriesData->director : 'NA';?>" required>
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Season Description</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="seriesShortDescription" id="seriesShortDescription    " value="<?=!empty($seriesData->seriesShortDescription) ? $seriesData->seriesShortDescription : 'NA';?>">
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

function deleteEPISODE(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETEEPISODE; ?>";
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

<script type="text/javascript">

function deleteSEVideo(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETSEVIDEOS; ?>";
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

function deleteSEThumb(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETSETHUMBS; ?>";
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

