
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

                            <button type="button" class="btn btn-primary" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addTournament">Add Tournament</button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Buy Amount</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Ticket Id</th>
                                    <th>Max Player Count</th>
                                    <th>Min Player Count</th>
                                    <th>First  Prize Players</th>
                                    <th>First Winning Amount</th>
                                    <th>Second Prize  Players</th>
                                    <th>Second Winning Amount</th>
                                    <th>Third Prize Players</th>
                                    <th>Third Winning Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
									<th>Questions</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $index=1; if(!empty($tournament_data))   { foreach ($tournament_data as $tournament) { ?>
                                   <tr>
                                      <td><?php echo $index++; ?></td>
                                      <td><?php echo  $tournament->name;?></td>
                                      <td><?php echo  $tournament->buyAmt;?></td>
                                      <td><?php echo  $tournament->startTime;?></td>
                                      <td><?php echo  $tournament->endTime;?></td>
                                      <td><?php echo  $tournament->ticketId;?></td>
                                      <td><?php echo $tournament->maxPlayerCount; ?></td>
                                      <td><?php echo $tournament->minPlayerCount; ?></td>
                                      <td><?php echo $tournament->firstPosition; ?></td>
                                      <td><?php echo $tournament->firstWinningAmount; ?></td>
                                      <td><?php echo $tournament->secondPosition; ?></td>
                                      <td><?php echo $tournament->secondWinningAmount; ?></td>
                                      <td><?php echo $tournament->thirdPosition; ?></td>
                                      <td><?php echo $tournament->thirdWinningAmount; ?></td>
                                      <td><?php echo  $tournament->status;?></td>
                                      <td>
                                         <span title="View" class="btn btn-primary btn-xs"  data-placement="right"
                                         onclick="edit_tournament('<?php echo $tournament->id;?>')"><i class="fa fa-edit"></i></span>
                                        &nbsp;|&nbsp;
                                        <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteTournament( '<?php echo $tournament->id;?>')"><i class='fa fa-trash-o'></i></button>
                                      </td>
									  <td>							
											<span title="Edit" class="btn btn-success btn-xs"  data-placement="right" 
											onclick="edit_question('<?php echo $tournament->id;?>')"><i class="fa fa-edit">Edit</i></span>									
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

<div class="modal fade" id="addTournament" role="dialog">
    <div class="modal-dialog">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Tournaments/addTournament" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Tournament</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Tournament Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="name" id="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Buy Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="buyAmt" id="buyAmt" pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
              <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Start Time</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="datetime-local" class="form-control has-feedback-left" name="startTime" id="startTime" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">End Time</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="datetime-local" class="form-control has-feedback-left" name="endTime" id="endTime" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Max Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="maxPlayerCount" id="maxPlayerCount"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Min Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <abbr title="Tournament will be cancled if Player count is less than minimum player count">
                      <input type="text" class="form-control has-feedback-left" name="minPlayerCount" id="minPlayerCount"  pattern="^0|[1-9]\d*$" required></abbr>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">first Prize Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control has-feedback-left" name="firstPosition" id="firstPosition"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">First Winning Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="firstWinningAmount" id="firstWinningAmount"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Secont Prize Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" name="secondPosition" id="secondPosition"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Second Winning Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" name="secondWinningAmount" id="secondWinningAmount"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Third Prize Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" name="thirdPosition" id="thirdPosition"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Third Winning Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control has-feedback-left" name="thirdWinningAmount" id="thirdWinningAmount"  pattern="^0|[1-9]\d*$" required>
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

<div class="modal fade" id="editTournamentModel" role="dialog">
    <div class="modal-dialog">
        
        <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Tournaments/editTournament" enctype="multipart/form-data"/>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Tournament</h4>
            </div>
            <div class="modal-body">
               
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Tournament Name</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                         <input type="hidden" class="form-control has-feedback-left"  name="editId" id="editId">
                        <input type="text"  class="form-control has-feedback-left" name="editName" id="editName">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Buy Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" class="form-control has-feedback-left"  name="editbuyAmt" id="editbuyAmt">
                    </div>
                </div>
               <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">Start Time</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="datetime-local" class="form-control has-feedback-left" name="editstartTime" id="editstartTime">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback">End Time</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="datetime-local" class="form-control has-feedback-left" name="editendTime" id="editendTime">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Max Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="number" class="form-control has-feedback-left" name="editmaxPlayerCount" id="editmaxPlayerCount">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Min Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <abbr title="Tournament will be cancled if Player count is less than minimum player count">
                      <input type="text" class="form-control has-feedback-left" name="editminPlayerCount" id="editminPlayerCount"  pattern="^0|[1-9]\d*$" required></abbr>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">first Prize Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control has-feedback-left" name="editfirstPosition" id="editfirstPosition"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">First Winning Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editfirstWinningAmount" id="editfirstWinningAmount"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Secont Prize Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" name="editsecondPosition" id="editsecondPosition"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Second Winning Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" name="editsecondWinningAmount" id="editsecondWinningAmount"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Third Prize Player Count</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" name="editthirdPosition" id="editthirdPosition"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Third Winning Amount</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" class="form-control has-feedback-left" name="editthirdWinningAmount" id="editthirdWinningAmount"  pattern="^0|[1-9]\d*$" required>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </form>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addQuestionModel" role="dialog">
    <div class="modal-dialog modal-lg">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Tournaments/addQuestion" enctype="multipart/form-data">
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Question</h4>
            </div>
            <div class="modal-body">
			<input type="hidden" class="form-control has-feedback-left"  name="tournamentId" id="tournamentId">                
			<div class="form-group">
					<div class="row">
					<label class="control-label col-md-7 col-sm-8 col-xs-12 has-feedback " style="font-size: large;">Level 1</label>
					</div>
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 1</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
					
                        <input type="text" class="form-control has-feedback-left" name="question1" id="question1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer1" id="correctAnswer1" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option1_2" id="option1_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option1_3" id="option1_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option1_4" id="option1_4" required>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Level</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="number" class="form-control has-feedback-left" name="level1" id="level1" required>
                    </div>
				</div> -->
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;" >Question 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question2" id="question2" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer2" id="correctAnswer2" required>
                    </div>
                </div>
        
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option2_2" id="option2_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option2_3" id="option2_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option2_4" id="option2_4"  required>
                    </div>
                </div>
				
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question3" id="question3" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer3" id="correctAnswer3" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option3_2" id="option3_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option3_3" id="option3_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option3_4" id="option3_4"  required>
                    </div>
                </div>
					
					<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question4" id="question4" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer4" id="correctAnswer4" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option4_2" id="option4_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option4_3" id="option4_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option4_4" id="option4_4"  required>
                    </div>
                </div>
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 5</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question5" id="question5" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer5" id="correctAnswer5" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option5_2" id="option5_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option5_3" id="option5_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option5_4" id="option5_4" required>
                    </div>
                </div>
                	
				<div class="form-group">
					<div class="row">
					<label class="control-label col-md-7 col-sm- col-xs-12 has-feedback " style="font-size: large;">Level 2</label>
					</div>
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 6</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question6" id="question6" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer6" id="correctAnswer6" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option6_2" id="option6_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option6_3" id="option6_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option6_4" id="option6_4"  required>
                    </div>
                </div>
        		
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 7</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question7" id="question7" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer7" id="correctAnswer7" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option7_2" id="option7_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option7_3" id="option7_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option7_4" id="option7_4"   required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 8</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question8" id="question8" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer8" id="correctAnswer8" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option8_2" id="option8_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option8_3" id="option8_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option8_4" id="option8_4"  required>
                    </div>
                </div>
        
				<div class="form-group">
				
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 9</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question9" id="question9" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer9" id="correctAnswer9" required>
                    </div>
                </div>
							   
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option9_2" id="option9_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option9_3" id="option9_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option9_4" id="option9_4" required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 10</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question10" id="question10" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer10" id="correctAnswer10" required>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option10_2" id="option10_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option10_3" id="option10_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option10_4" id="option10_4"  required>
                    </div>
                </div>
                
				
				<div class="form-group">
					<div class="row">
					<label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="font-size: large;">Level 3</label>
					</div>
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 11</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question11" id="question11" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer11" id="correctAnswer11" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option11_2" id="option11_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option11_3" id="option11_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option11_4" id="option11_4"  required>
                    </div>
                </div>
            
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 12</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question12" id="question12" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;"> Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer12" id="correctAnswer12" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option12_2" id="option12_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option12_3" id="option12_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option12_4" id="option12_4" required>
                    </div>
                </div>
                
				<div class="form-group">
				
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 13</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question13" id="question13" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer13" id="correctAnswer13" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option13_2" id="option13_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option13_3" id="option13_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option13_4" id="option13_4" required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 14</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question14" id="question14" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer14" id="correctAnswer14" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option14_2" id="option14_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option14_3" id="option14_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option14_4" id="option14_4"  required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 15</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="question15" id="question15" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="correctAnswer15" id="correctAnswer15" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option15_2" id="option15_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="option15_3" id="option15_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="option15_4" id="option15_4"  required>
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

<div class="modal fade bd-example-modal-lg" id="editQuestionModel" role="dialog">
    <div class="modal-dialog modal-lg">
          <form class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>/Tournaments/editQuestions" enctype="multipart/form-data"/>
      
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Question</h4>
            </div>
            <div class="modal-body">
			<input type="hidden" class="form-control has-feedback-left"  name="edittournamentId" id="edittournamentId">                
			<input type="hidden" class="form-control has-feedback-left"  name="editId1" id="editId1">
			<input type="hidden" class="form-control has-feedback-left"  name="editId2" id="editId2">
			<input type="hidden" class="form-control has-feedback-left"  name="editId3" id="editId3">
			<input type="hidden" class="form-control has-feedback-left"  name="editId4" id="editId4">
			<input type="hidden" class="form-control has-feedback-left"  name="editId5" id="editId5">
			<input type="hidden" class="form-control has-feedback-left"  name="editId6" id="editId6">
			<input type="hidden" class="form-control has-feedback-left"  name="editId7" id="editId7">
			<input type="hidden" class="form-control has-feedback-left"  name="editId8" id="editId8">
			<input type="hidden" class="form-control has-feedback-left"  name="editId9" id="editId9">
			<input type="hidden" class="form-control has-feedback-left"  name="editId10" id="editId10">
			<input type="hidden" class="form-control has-feedback-left"  name="editId11" id="editId11">
			<input type="hidden" class="form-control has-feedback-left"  name="editId12" id="editId12">
			<input type="hidden" class="form-control has-feedback-left"  name="editId13" id="editId13">
			<input type="hidden" class="form-control has-feedback-left"  name="editId14" id="editId14">
			<input type="hidden" class="form-control has-feedback-left"  name="editId15" id="editId15">
			
			<div class="form-group">				
					<div class="row">
					<label class="control-label col-md-7 col-sm-8 col-xs-12 has-feedback " style="font-size: large;">Level 1</label>
					</div>
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 1</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion1" id="editquestion1" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer1" id="editcorrectAnswer1" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption1_2" id="editoption1_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption1_3" id="editoption1_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption1_4" id="editoption1_4" required>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="control-label col-md-4 col-sm- col-xs-12 has-feedback ">Level</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="number" class="form-control has-feedback-left" name="level1" id="level1" required>
                    </div>
				</div> -->
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;" >Question 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion2" id="editquestion2" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer2" id="editcorrectAnswer2" required>
                    </div>
                </div>
        
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption2_2" id="editoption2_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption2_3" id="editoption2_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption2_4" id="editoption2_4"  required>
                    </div>
                </div>
				
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion3" id="editquestion3" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer3" id="editcorrectAnswer3" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption3_2" id="editoption3_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption3_3" id="editoption3_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption3_4" id="editoption3_4"  required>
                    </div>
                </div>
					
					<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion4" id="editquestion4" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer4" id="editcorrectAnswer4" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption4_2" id="editoption4_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption4_3" id="editoption4_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption4_4" id="editoption4_4"  required>
                    </div>
                </div>
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 5</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion5" id="editquestion5" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer5" id="editcorrectAnswer5" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption5_2" id="editoption5_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption5_3" id="editoption5_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption5_4" id="editoption5_4" required>
                    </div>
                </div>
                	
				<div class="form-group">
					<div class="row">
					<label class="control-label col-md-7 col-sm- col-xs-12 has-feedback " style="font-size: large;">Level 2</label>
					</div>
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 6</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion6" id="editquestion6" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer6" id="editcorrectAnswer6" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption6_2" id="editoption6_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption6_3" id="editoption6_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption6_4" id="editoption6_4"  required>
                    </div>
                </div>
        		
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 7</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion7" id="editquestion7" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer7" id="editcorrectAnswer7" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption7_2" id="editoption7_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption7_3" id="editoption7_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption7_4" id="editoption7_4"   required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 8</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion8" id="editquestion8" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer8" id="editcorrectAnswer8" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption8_2" id="editoption8_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption8_3" id="editoption8_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption8_4" id="editoption8_4"  required>
                    </div>
                </div>
        
				<div class="form-group">
				
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 9</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion9" id="editquestion9" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer9" id="editcorrectAnswer9" required>
                    </div>
                </div>
							   
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption9_2" id="editoption9_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption9_3" id="editoption9_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption9_4" id="editoption9_4" required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 10</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion10" id="editquestion10" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer10" id="editcorrectAnswer10" required>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption10_2" id="editoption10_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption10_3" id="editoption10_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption10_4" id="editoption10_4"  required>
                    </div>
                </div>
                
				
				<div class="form-group">
					<div class="row">
					<label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="font-size: large;">Level 3</label>
					</div>
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 11</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion11" id="editquestion11" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer11" id="editcorrectAnswer11" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption11_2" id="editoption11_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption11_3" id="editoption11_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption11_4" id="editoption11_4"  required>
                    </div>
                </div>
            
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 12</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion12" id="editquestion12" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;"> Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer12" id="editcorrectAnswer12" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption12_2" id="editoption12_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption12_3" id="editoption12_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption12_4" id="editoption12_4" required>
                    </div>
                </div>
                
				<div class="form-group">
				
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 13</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion13" id="editquestion13" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer13" id="editcorrectAnswer13" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption13_2" id="editoption13_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption13_3" id="editoption13_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption13_4" id="editoption13_4" required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 14</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion14" id="editquestion14" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer14" id="editcorrectAnswer14" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption14_2" id="editoption14_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption14_3" id="editoption14_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption14_4" id="editoption14_4"  required>
                    </div>
                </div>
                
				<div class="form-group">
					
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color:red;">Question 15</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editquestion15" id="editquestion15" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback " style="color: green;">Correct Answer</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editcorrectAnswer15" id="editcorrectAnswer15" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 2</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption15_2" id="editoption15_2" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm- col-xs-12 has-feedback">Option 3</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="editoption15_3" id="editoption15_3" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12 has-feedback ">Option 4</label>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                      <input type="text" class="form-control has-feedback-left" name="editoption15_4" id="editoption15_4"  required>
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
<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>

<script type="text/javascript">
	$(document).on("click", ".open-addQuestionDialog", function(){
		var tournamentId = $(this).data('id');
		$(".modal-body #tournamentId").val(tournamentId);
	});
    function deleteTournament(id) {
         $("#Deletemodal").modal('show');
         $("#deleteSuccBtn").click(function(){
             var site_url   = $("#site_url").val();
             var url        =  site_url+"/<?= DELETETOURNAMENT; ?>";
             var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
             $.post(url,datastring,function(response){
                 $("#Deletemodal").modal('hide');
                 $("#Deletemodal").load(location.href+" #Deletemodal>*","");
                     var obj   = JSON.parse(response);
                     csrfName = obj.csrfName;
                     csrfHash = obj.csrfHash;
                     table.draw();
                     $("#msgData").val(obj.msg);
                     $("#toast-fade").click();
                 });
         });
    }

    function edit_tournament(id) {

         var editId = "";
         var editName = "";
         var editbuyAmt = "";
        var editstartTime = "";
         var editendTime = "";
         var editmaxPlayerCount ="";
         var editminPlayerCount = "";
         var editfirstPosition ="";
         var editfirstWinningAmount ="";
         var editsecondPosition ="";
         var editsecondWinningAmount ="";
         var editthirdPosition ="";
         var editthirdWinningAmount="";

          var site_url   = $("#site_url").val();
         var url        =  site_url+"/<?= TOURNAMETDETAILS; ?>";
         var datastring =  'id='+id;

        
        $.post(url,datastring,function(response){
          
             var str = JSON.parse(response);
              editId  = str.id;
              editName  = str.name;
              editbuyAmt = str.buyAmt;
              editstartTime = str.startTime;
              editendTime   = str.endTime;
              editmaxPlayerCount = str.maxPlayerCount;
              editminPlayerCount = str.minPlayerCount;
              editfirstPosition = str.firstPosition;
              editfirstWinningAmount = str.firstWinningAmount;
              editsecondPosition = str.secondPosition;
              editsecondWinningAmount = str.secondWinningAmount;
              editthirdPosition = str.thirdPosition;
              editthirdWinningAmount = str.thirdWinningAmount;

               $("#editTournamentModel").modal("show");
               $("#editId").val(editId);
               $("#editName").val(editName);
               $("#editbuyAmt").val(editbuyAmt);
               $("#editstartTime").val(editstartTime);
               $("#editendTime").val(editendTime);
               $("#editmaxPlayerCount").val(editmaxPlayerCount);
               $("#editminPlayerCount").val(editminPlayerCount);
               $("#editfirstPosition").val(editfirstPosition);
               $("#editfirstWinningAmount").val(editfirstWinningAmount);
               $("#editsecondPosition").val(editsecondPosition);
               $("#editsecondWinningAmount").val(editsecondWinningAmount);
               $("#editthirdPosition").val(editthirdPosition);
               $("#editthirdWinningAmount").val(editthirdWinningAmount);
               
        });   

	}
	function edit_question(id) {
		var edittournamentId = "";

		var editId1 = "";	
		var editquestion1 = "";
		var editcorrectAnswer1 = "";
		var editoption1_2 = "";
		var editoption1_2 = "";
		var editoption1_3 = "";
		var editoption1_4 ="";

		var editId2 = "";	
		var editquestion2 = "";
		var editcorrectAnswer2 = "";
		var editoption2_1 = "";
		var editoption2_2 = "";
		var editoption2_3 = "";
		var editoption2_4 ="";

		var editId3 = "";	
		var editquestion3 = "";
		var editcorrectAnswer3 = "";
		var editoption3_1 = "";
		var editoption3_2 = "";
		var editoption3_3 = "";
		var editoption3_4 ="";

		var editId4 = "";	
		var editquestion4 = "";
		var editcorrectAnswer4 = "";
		var editoption4_1 = "";
		var editoption4_2 = "";
		var editoption4_3 = "";
		var editoption4_4 ="";

		var editId5 = "";	
		var editquestion5 = "";
		var editcorrectAnswer5 = "";
		var editoption5_1 = "";
		var editoption5_2 = "";
		var editoption5_3 = "";
		var editoption5_4 ="";

		var editId6 = "";	
		var editquestion6 = "";
		var editcorrectAnswer6 = "";
		var editoption6_1 = "";
		var editoption6_2 = "";
		var editoption6_3 = "";
		var editoption6_4 ="";

		var editId7 = "";	
		var editquestion7 = "";
		var editcorrectAnswer7 = "";
		var editoption7_1 = "";
		var editoption7_2 = "";
		var editoption7_3 = "";
		var editoption7_4 ="";

		var editId8 = "";	
		var editquestion8 = "";
		var editcorrectAnswer8 = "";
		var editoption8_1 = "";
		var editoption8_2 = "";
		var editoption8_3 = "";
		var editoption8_4 ="";

		var editId9 = "";	
		var editquestion9 = "";
		var editcorrectAnswer9 = "";
		var editoption9_1 = "";
		var editoption9_2 = "";
		var editoption9_3 = "";
		var editoption9_4 ="";

		var editId10 = "";	
		var editquestion10 = "";
		var editcorrectAnswer10 = "";
		var editoption10_1 = "";
		var editoption10_2 = "";
		var editoption10_3 = "";
		var editoption10_4 ="";

		var editId11 = "";	
		var editquestion11 = "";
		var editcorrectAnswer11 = "";
		var editoption11_1 = "";
		var editoption11_2 = "";
		var editoption11_3 = "";
		var editoption11_4 ="";

		var editId12 = "";	
		var editquestion12 = "";
		var editcorrectAnswer12 = "";
		var editoption12_1 = "";
		var editoption12_2 = "";
		var editoption12_3 = "";
		var editoption12_4 ="";

		var editId13 = "";	
		var editquestion13 = "";
		var editcorrectAnswer13 = "";
		var editoption13_1 = "";
		var editoption13_2 = "";
		var editoption13_3 = "";
		var editoption13_4 ="";

		var editId14 = "";	
		var editquestion14 = "";
		var editcorrectAnswer14 = "";
		var editoption14_1 = "";
		var editoption14_2 = "";
		var editoption14_3 = "";
		var editoption14_4 ="";

		var editId15 = "";	
		var editquestion15 = "";
		var editcorrectAnswer15 = "";
		var editoption15_1 = "";
		var editoption15_2 = "";
		var editoption15_3 = "";
		var editoption15_4 ="";


		var site_url   = $("#site_url").val();
		var url        =  site_url+"/<?= QUESTIONDETAILS; ?>";
		var datastring =  'id='+id;

		$.post(url,datastring,function(response){
		//console.log("response ",response, "Hi")
		var str = JSON.parse(response);
		console.log("str ",str)
		if(str.data == 0){
			console.log(id)
			$("#addQuestionModel").modal("show");
			$("#tournamentId").val(id)
		} else {
			
			editId1  = str[0].id;
			editquestion1  = str[0].question;
			editcorrectAnswer1 = str[0].correctAnswer;
			var opt = (str[0].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption1_2 = options[1];
			editoption1_3 = options[2];
			editoption1_4 = options[3];

			editId2  = str[1].id;
			editquestion2  = str[1].question;
			editcorrectAnswer2 = str[1].correctAnswer;
			var opt = (str[1].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption2_2 = options[1];
			editoption2_3 = options[2];
			editoption2_4 = options[3];
			
			editId3  = str[2].id;
			editquestion3  = str[2].question;
			editcorrectAnswer3 = str[2].correctAnswer;
			var opt = (str[2].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption3_2 = options[1];
			editoption3_3 = options[2];
			editoption3_4 = options[3];
			
			editId4  = str[3].id;
			editquestion4  = str[3].question;
			editcorrectAnswer4 = str[3].correctAnswer;
			var opt = (str[3].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption4_2 = options[1];
			editoption4_3 = options[2];
			editoption4_4 = options[3];
			
			editId5  = str[4].id;
			editquestion5  = str[4].question;
			editcorrectAnswer5 = str[4].correctAnswer;
			var opt = (str[4].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption5_2 = options[1];
			editoption5_3 = options[2];
			editoption5_4 = options[3];
			
			editId6 = str[5].id;
			editquestion6  = str[5].question;
			editcorrectAnswer6 = str[5].correctAnswer;
			var opt = (str[5].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption6_2 = options[1];
			editoption6_3 = options[2];
			editoption6_4 = options[3];
			
			editId7  = str[6].id;
			editquestion7  = str[6].question;
			editcorrectAnswer7 = str[6].correctAnswer;
			var opt = (str[6].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption7_2 = options[1];
			editoption7_3 = options[2];
			editoption7_4 = options[3];
			
			editId8  = str[7].id;
			editquestion8  = str[7].question;
			editcorrectAnswer8 = str[7].correctAnswer;
			var opt = (str[7].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption8_2 = options[1];
			editoption8_3 = options[2];
			editoption8_4 = options[3];
			
			editId9  = str[8].id;
			editquestion9  = str[8].question;
			editcorrectAnswer9 = str[8].correctAnswer;
			var opt = (str[8].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption9_2 = options[1];
			editoption9_3 = options[2];
			editoption9_4 = options[3];
			
			editId10  = str[9].id;
			editquestion10  = str[9].question;
			editcorrectAnswer10 = str[9].correctAnswer;
			var opt = (str[9].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption10_2 = options[1];
			editoption10_3 = options[2];
			editoption10_4 = options[3];
			
			editId11  = str[10].id;
			editquestion11  = str[10].question;
			editcorrectAnswer11 = str[10].correctAnswer;
			var opt = (str[10].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption11_2 = options[1];
			editoption11_3 = options[2];
			editoption11_4 = options[3];
			
			editId12  = str[11].id;
			editquestion12  = str[11].question;
			editcorrectAnswer12 = str[11].correctAnswer;
			var opt = (str[11].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption12_2 = options[1];
			editoption12_3 = options[2];
			editoption12_4 = options[3];
			
			editId13  = str[12].id;
			editquestion13  = str[12].question;
			editcorrectAnswer13 = str[12].correctAnswer;
			var opt = (str[12].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption13_2 = options[1];
			editoption13_3 = options[2];
			editoption13_4 = options[3];
			
			editId14  = str[13].id;
			editquestion14  = str[13].question;
			editcorrectAnswer14 = str[13].correctAnswer;
			var opt = (str[13].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption14_2 = options[1];
			editoption14_3 = options[2];
			editoption14_4 = options[3];
			
			editId15  = str[14].id;
			editquestion15  = str[14].question;
			editcorrectAnswer15 = str[14].correctAnswer;
			var opt = (str[14].options).replace(/'/g,`"`)
			var options = JSON.parse(opt);
			editoption15_2 = options[1];
			editoption15_3 = options[2];
			editoption15_4 = options[3];
			
			tournamentId = str[0].tournamentId

			$("#editQuestionModel").modal("show");
			
			$("#edittournamentId").val(tournamentId)

			$("#editId1").val(editId1);	
			$("#editquestion1").val(editquestion1);
			$("#editcorrectAnswer1").val(editcorrectAnswer1);				
			$("#editoption1_2").val(editoption1_2);
			$("#editoption1_3").val(editoption1_3);
			$("#editoption1_4").val(editoption1_4);
			
			$("#editId2").val(editId2);
			$("#editquestion2").val(editquestion2);
			$("#editcorrectAnswer2").val(editcorrectAnswer2);
			$("#editoption2_2").val(editoption2_2);
			$("#editoption2_3").val(editoption2_3);
			$("#editoption2_4").val(editoption2_4);
			
			$("#editId3").val(editId3);
			$("#editquestion3").val(editquestion3);
			$("#editcorrectAnswer3").val(editcorrectAnswer3);				
			$("#editoption3_2").val(editoption3_2);
			$("#editoption3_3").val(editoption3_3);
			$("#editoption3_4").val(editoption3_4);
			
			$("#editId4").val(editId4);				
			$("#editquestion4").val(editquestion4);
			$("#editcorrectAnswer4").val(editcorrectAnswer4);				
			$("#editoption4_2").val(editoption4_2);
			$("#editoption4_3").val(editoption4_3);
			$("#editoption4_4").val(editoption4_4);

			$("#editId4").val(editId4);				
			$("#editquestion4").val(editquestion4);
			$("#editcorrectAnswer4").val(editcorrectAnswer4);				
			$("#editoption4_2").val(editoption4_2);
			$("#editoption4_3").val(editoption4_3);
			$("#editoption4_4").val(editoption4_4);
			
			$("#editId5").val(editId5);				
			$("#editquestion5").val(editquestion5);
			$("#editcorrectAnswer5").val(editcorrectAnswer5);				
			$("#editoption5_2").val(editoption5_2);
			$("#editoption5_3").val(editoption5_3);
			$("#editoption5_4").val(editoption5_4);
			
			$("#editId6").val(editId6);				
			$("#editquestion6").val(editquestion6);
			$("#editcorrectAnswer6").val(editcorrectAnswer6);			
			$("#editoption6_2").val(editoption6_2);
			$("#editoption6_3").val(editoption6_3);
			$("#editoption6_4").val(editoption6_4);
			
			$("#editId7").val(editId7);				
			$("#editquestion7").val(editquestion7);
			$("#editcorrectAnswer7").val(editcorrectAnswer7);				
			$("#editoption7_2").val(editoption7_2);
			$("#editoption7_3").val(editoption7_3);
			$("#editoption7_4").val(editoption7_4);

			$("#editId8").val(editId8);				
			$("#editquestion8").val(editquestion8);
			$("#editcorrectAnswer8").val(editcorrectAnswer8);				
			$("#editoption8_2").val(editoption8_2);
			$("#editoption8_3").val(editoption8_3);
			$("#editoption8_4").val(editoption8_4);

			$("#editId9").val(editId9);				
			$("#editquestion9").val(editquestion9);
			$("#editcorrectAnswer9").val(editcorrectAnswer9);				
			$("#editoption9_2").val(editoption9_2);
			$("#editoption9_3").val(editoption9_3);
			$("#editoption9_4").val(editoption9_4);

			$("#editId10").val(editId10);			
			$("#editquestion10").val(editquestion10);
			$("#editcorrectAnswer10").val(editcorrectAnswer10);				
			$("#editoption10_2").val(editoption10_2);
			$("#editoption10_3").val(editoption10_3);
			$("#editoption10_4").val(editoption10_4);
		
			$("#editId11").val(editId11);				
			$("#editquestion11").val(editquestion11);
			$("#editcorrectAnswer11").val(editcorrectAnswer11);				
			$("#editoption11_2").val(editoption11_2);
			$("#editoption11_3").val(editoption11_3);
			$("#editoption11_4").val(editoption11_4);
		
			$("#editId12").val(editId12);				
			$("#editquestion12").val(editquestion12);
			$("#editcorrectAnswer12").val(editcorrectAnswer12);				
			$("#editoption12_2").val(editoption12_2);
			$("#editoption12_3").val(editoption12_3);
			$("#editoption12_4").val(editoption12_4);
			
			$("#editId13").val(editId13);				
			$("#editquestion13").val(editquestion13);
			$("#editcorrectAnswer13").val(editcorrectAnswer13);	
			$("#editoption13_2").val(editoption13_2);
			$("#editoption13_3").val(editoption13_3);
			$("#editoption13_4").val(editoption13_4);
			
			$("#editId14").val(editId14);				
			$("#editquestion14").val(editquestion14);
			$("#editcorrectAnswer14").val(editcorrectAnswer14);				
			$("#editoption14_2").val(editoption14_2);
			$("#editoption14_3").val(editoption14_3);
			$("#editoption14_4").val(editoption14_4);
			
			$("#editId15").val(editId15);				
			$("#editquestion15").val(editquestion15);
			$("#editcorrectAnswer15").val(editcorrectAnswer15);				
			$("#editoption15_2").val(editoption15_2);
			$("#editoption15_3").val(editoption15_3);
			$("#editoption15_4").val(editoption15_4);

		}	
		});

	}   
</script>


