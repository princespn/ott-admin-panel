<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tournaments extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('Common_helper');
		$this->load->model('Users_model');
		$this->load->library('Custom');
		$this->load->model('Crud_model');
		$this->load->model('Admin_model');
	}

	public function index($flag = "")
	{

		 $cond = "";
		 $tournament_data = $this->Crud_model->GetDataAll("tournaments", $cond);
		
		$data = array(
			'heading' => "Tournaments",
			'bread' => "Tournaments",
			'flag' => $flag,
			'tournament_data'=>$tournament_data
		);
		$this->load->view('tournaments/list.php', $data);

	}

	public function addTournament(){
		$condition = "";
		$name = $this->input->post('name');
		$winningAmt = $this->input->post('winningAmt');
		$buyAmt = $this->input->post('buyAmt');
		$startTime = $this->input->post('startTime');
		$endTime = $this->input->post('endTime');
		$maxPlayerCount = $this->input->post('maxPlayerCount');
		$minPlayerCount = $this->input->post('minPlayerCount');
		$firstPosition = $this->input->post('firstPosition');
		$firstWinningAmount = $this->input->post('firstWinningAmount');
		$secondPosition = $this->input->post('secondPosition');
		$secondWinningAmount = $this->input->post('secondWinningAmount');
		$thirdPosition = $this->input->post('thirdPosition');
		$thirdWinningAmount = $this->input->post('thirdWinningAmount');


		$sumPlayerCount = $firstPosition + $secondPosition  +  $thirdPosition ;

		if($sumPlayerCount > $maxPlayerCount){
			 $this->session->set_flashdata('message', 'Player count is greater than max Player count in tournament. Try again!!');
		    redirect(site_url(TOURNAMENT));
		}else{
			$data = array(

			'name' => $name,
			'buyAmt' => $buyAmt,
			'startTime' => $startTime,
			'endTime' => $endTime,
			'ticketId' =>'TIC'.rand(0000,9999),
			'maxPlayerCount' => $maxPlayerCount,
			'minPlayerCount' => $minPlayerCount,
			'firstPosition' => $firstPosition,
			'firstWinningAmount' => $firstWinningAmount,
			'secondPosition' => $secondPosition,
			'secondWinningAmount' => $secondWinningAmount,
			'thirdPosition' => $thirdPosition,
			'thirdWinningAmount' => $thirdWinningAmount,
			'adminCommision' => 0,
			'status' => 'active'
		);

		$this->Crud_model->SaveData("tournaments", $data, $condition);
		$this->session->set_flashdata('message', 'Tournaments added successfully');
		
			redirect(site_url(TOURNAMENT));
		}
				
	}
	
	public function deleteTournament(){

		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$res=$this->Crud_model->DeleteData("tournaments","id='".$id."'",'');
			
			$msg = 'Record has been deleted successfully';
		}else{

			$msg = 'No record found User';
		}
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);

	}

	public function getTournamentDetails(){

		$id = $this->input->post('id',TRUE);
		$cond = "tournaments.id = '".$id."'";
			if(!empty($id)){
				$res=$this->Crud_model->GetDataArr("tournaments", '', $cond, '', '', '', '1');
				echo json_encode($res);
			}
	}

	public function editTournament(){
		$id = $this->input->post('editId');
		$condition = "tournaments.id = '" .$id. "'";
		$sumPlayerCount =$_POST['editfirstPosition'] + $_POST['editsecondPosition']  +  $_POST['editthirdPosition']; ;

		if($sumPlayerCount > $_POST['editmaxPlayerCount'] ){
			 $this->session->set_flashdata('message', 'Player count is greater than max Player count in tournament. Try again!!');
		    redirect(site_url(TOURNAMENT));
		}else{
				$data = array(

				'name' => isset($_POST['editName']),
				'buyAmt' => isset($_POST['editbuyAmt']),
				'startTime' => isset($_POST['editstartTime']),
				'endTime' => isset($_POST['editendTime']),
				'maxPlayerCount' => isset($_POST['editmaxPlayerCount']),
				'minPlayerCount' => isset($_POST['editminPlayerCount']),
				'firstPosition' => isset($_POST['editfirstPosition']),
				'firstWinningAmount' => isset($_POST['editfirstWinningAmount']),
				'secondPosition' => isset($_POST['editsecondPosition']),
				'secondWinningAmount' => isset($_POST['editsecondWinningAmount']),
				'thirdPosition' => isset($_POST['editthirdPosition']),
				'thirdWinningAmount' => isset($_POST['editthirdWinningAmount'])
			);

			$this->Crud_model->SaveData("tournaments", $data, $condition);
			$this->session->set_flashdata('message', 'Tournaments updated successfully');
			
			redirect(site_url(TOURNAMENT));
		}
	}
	
	public function addQuestion(){
		$condition = "";
		
		$level1 = 1 ;
		$level2 = 2;
		$level3 = 3;
		$tournamentId = $this->input->post('tournamentId');

		$question1 = $this->input->post('question1');	
		$correctAnswer1 = $this->input->post('correctAnswer1');
		$option1_1 = $this->input->post('option1_1');
		$option1_2 = $this->input->post('option1_2');
		$option1_3 = $this->input->post('option1_3');
		$option1_4 = $this->input->post('option1_4');
		$options1 = "['$correctAnswer1','$option1_2','$option1_3','$option1_4']";

		$data1 = array(
			'question' => $question1,
			'correctAnswer' => $correctAnswer1,
			'options' => $options1,
			'level' => $level1,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data1, $condition);

		$question2 = $this->input->post('question2');	
		$correctAnswer2 = $this->input->post('correctAnswer2');
		$option2_1 = $this->input->post('option2_1');
		$option2_2 = $this->input->post('option2_2');
		$option2_3 = $this->input->post('option2_3');
		$option2_4 = $this->input->post('option2_4');
		$options2 = "['$correctAnswer2','$option2_2','$option2_3','$option2_4']";

		$data2 = array(
			'question' => $question2,
			'correctAnswer' => $correctAnswer2,
			'options' => $options2,
			'level' => $level1,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data2, $condition);

		$question3 = $this->input->post('question3');	
		$correctAnswer3 = $this->input->post('correctAnswer3');
		$option3_1 = $this->input->post('option3_1');
		$option3_2 = $this->input->post('option3_2');
		$option3_3 = $this->input->post('option3_3');
		$option3_4 = $this->input->post('option3_4');
		$options3 = "['$correctAnswer3','$option3_2','$option3_3','$option3_4']";

		$data3 = array(
			'question' => $question3,
			'correctAnswer' => $correctAnswer3,
			'options' => $options3,
			'level' => $level1,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data3, $condition);


		$question4 = $this->input->post('question4');	
		$correctAnswer4 = $this->input->post('correctAnswer4');
		$option4_1 = $this->input->post('option4_1');
		$option4_2 = $this->input->post('option4_2');
		$option4_3 = $this->input->post('option4_3');
		$option4_4 = $this->input->post('option4_4');
		$level = $this->input->post('level');
		$options4 = "['$correctAnswer4','$option4_2','$option4_3','$option4_4']";

		$data4 = array(
			'question' => $question4,
			'correctAnswer' => $correctAnswer4,
			'options' => $options4,
			'level' => $level1,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data4, $condition);


		$question5 = $this->input->post('question5');	
		$correctAnswer5 = $this->input->post('correctAnswer5');
		$option5_1 = $this->input->post('option5_1');
		$option5_2 = $this->input->post('option5_2');
		$option5_3 = $this->input->post('option5_3');
		$option5_4 = $this->input->post('option5_4');
		$level = $this->input->post('level');
		$options5 = "['$correctAnswer5','$option5_2','$option5_3','$option5_4']";

		$data5 = array(
			'question' => $question5,
			'correctAnswer' => $correctAnswer5,
			'options' => $options5,
			'level' => $level1,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data5, $condition);


		$question6 = $this->input->post('question6');	
		$correctAnswer6 = $this->input->post('correctAnswer6');
		$option6_1 = $this->input->post('option6_1');
		$option6_2 = $this->input->post('option6_2');
		$option6_3 = $this->input->post('option6_3');
		$option6_4 = $this->input->post('option6_4');
		$level = $this->input->post('level');
		$options6 = "['$correctAnswer6','$option6_2','$option6_3','$option6_4']";

		$data6 = array(
			'question' => $question6,
			'correctAnswer' => $correctAnswer6,
			'options' => $options6,
			'level' => $level2,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data6, $condition);

		$question7 = $this->input->post('question7');	
		$correctAnswer7 = $this->input->post('correctAnswer7');
		$option7_1 = $this->input->post('option7_1');
		$option7_2 = $this->input->post('option7_2');
		$option7_3 = $this->input->post('option7_3');
		$option7_4 = $this->input->post('option7_4');
		$level = $this->input->post('level');
		$options7 = "['$correctAnswer7','$option7_2','$option7_3','$option7_4']";

		$data7 = array(
			'question' => $question7,
			'correctAnswer' => $correctAnswer7,
			'options' => $options7,
			'level' => $level2,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data7, $condition);

		$question8 = $this->input->post('question8');	
		$correctAnswer8 = $this->input->post('correctAnswer8');
		$option8_1 = $this->input->post('option8_1');
		$option8_2 = $this->input->post('option8_2');
		$option8_3 = $this->input->post('option8_3');
		$option8_4 = $this->input->post('option8_4');
		$level = $this->input->post('level');
		$options8 = "['$correctAnswer8','$option8_2','$option8_3','$option8_4']";

		$data8 = array(
			'question' => $question8,
			'correctAnswer' => $correctAnswer8,
			'options' => $options8,
			'level' => $level2,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data8, $condition);


		$question9 = $this->input->post('question9');	
		$correctAnswer9 = $this->input->post('correctAnswer9');
		$option9_1 = $this->input->post('option9_1');
		$option9_2 = $this->input->post('option9_2');
		$option9_3 = $this->input->post('option9_3');
		$option9_4 = $this->input->post('option9_4');
		$level = $this->input->post('level');
		$options9 = "['$correctAnswer9','$option9_2','$option9_3','$option9_4']";

		$data9 = array(
			'question' => $question9,
			'correctAnswer' => $correctAnswer9,
			'options' => $options9,
			'level' => $level2,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data9, $condition);


		$question10 = $this->input->post('question10');	
		$correctAnswer10 = $this->input->post('correctAnswer10');
		$option10_1 = $this->input->post('option10_1');
		$option10_2 = $this->input->post('option10_2');
		$option10_3 = $this->input->post('option10_3');
		$option10_4 = $this->input->post('option10_4');
		$level = $this->input->post('level');
		$options10 = "['$correctAnswer10','$option10_2','$option10_3','$option10_4']";

		$data10 = array(
			'question' => $question10,
			'correctAnswer' => $correctAnswer10,
			'options' => $options10,
			'level' => $level2,
			'tournamentId' => $tournamentId
		);

		$this->Crud_model->SaveData("questions", $data10, $condition);


		$question11 = $this->input->post('question11');	
		$correctAnswer11 = $this->input->post('correctAnswer11');
		$option11_1 = $this->input->post('option11_1');
		$option11_2 = $this->input->post('option11_2');
		$option11_3 = $this->input->post('option11_3');
		$option11_4 = $this->input->post('option11_4');
		$level = $this->input->post('level');
		$options11 = "['$correctAnswer11','$option11_2','$option11_3','$option11_4']";

		$data11 = array(
			'question' => $question11,
			'correctAnswer' => $correctAnswer11,
			'options' => $options11,
			'level' => $level3,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data11, $condition);

		$question12 = $this->input->post('question12');	
		$correctAnswer12 = $this->input->post('correctAnswer12');
		$option12_1 = $this->input->post('option12_1');
		$option12_2 = $this->input->post('option12_2');
		$option12_3 = $this->input->post('option12_3');
		$option12_4 = $this->input->post('option12_4');
		$level = $this->input->post('level');
		$options12 = "['$correctAnswer12','$option12_2','$option12_3','$option12_4']";

		$data12 = array(
			'question' => $question12,
			'correctAnswer' => $correctAnswer12,
			'options' => $options12,
			'level' => $level3,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data12, $condition);


		$question13 = $this->input->post('question13');	
		$correctAnswer13 = $this->input->post('correctAnswer13');
		$option13_1 = $this->input->post('option13_1');
		$option13_2 = $this->input->post('option13_2');
		$option13_3 = $this->input->post('option13_3');
		$option13_4 = $this->input->post('option13_4');
		$level = $this->input->post('level');
		$options13 = "['$correctAnswer13','$option13_2','$option13_3','$option13_4']";

		$data13 = array(
			'question' => $question13,
			'correctAnswer' => $correctAnswer13,
			'options' => $options13,
			'level' => $level3,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data13, $condition);


		$question14 = $this->input->post('question14');	
		$correctAnswer14 = $this->input->post('correctAnswer14');
		$option14_1 = $this->input->post('option14_1');
		$option14_2 = $this->input->post('option14_2');
		$option14_3 = $this->input->post('option14_3');
		$option14_4 = $this->input->post('option14_4');
		$level = $this->input->post('level');
		$options14 = "['$correctAnswer14','$option14_2','$option14_3','$option14_4']";

		$data14 = array(
			'question' => $question14,
			'correctAnswer' => $correctAnswer14,
			'options' => $options14,
			'level' => $level3,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data14, $condition);


		$question15 = $this->input->post('question15');	
		$correctAnswer15 = $this->input->post('correctAnswer15');
		$option15_1 = $this->input->post('option15_1');
		$option15_2 = $this->input->post('option15_2');
		$option15_3 = $this->input->post('option15_3');
		$option15_4 = $this->input->post('option15_4');
		$level = $this->input->post('level');
		$options15 = "['$correctAnswer15','$option15_2','$option15_3','$option15_4']";

		$data15 = array(
			'question' => $question15,
			'correctAnswer' => $correctAnswer15,
			'options' => $options15,
			'level' => $level3,			
			'tournamentId' => $tournamentId
		);

		$this->Crud_model->SaveData("questions", $data15, $condition);		
		$this->session->set_flashdata('message', 'Question added successfully');
		
		redirect(site_url(TOURNAMENT));
	}

	public function getQuestionDetails(){

		$id = $this->input->post('id',TRUE);
		//print_r(" id ".$id."");
		$cond = "questions.tournamentId = '".$id."'";
			if(!empty($id)){
					
				$data=$this->Crud_model->GetDataAll("questions", $cond, '', '', '', '');
				//print_r("data ".$data." ");
				if(sizeof($data) == 0){
					$res = array (
						'data'=>0
					);
					echo json_encode($res);
				} else {
					$res = array(
						 $data
					);
					echo json_encode($data);
				}				
			}
 	}

	public function editQuestions(){

		
		$tournamentId = $this->input->post('edittournamentId');

		$id1 = $this->input->post('editId1');		
		$question1 = $this->input->post('editquestion1');	
		$correctAnswer1 = $this->input->post('editcorrectAnswer1');
		$option1_2 = $this->input->post('editoption1_2');
		$option1_3 = $this->input->post('editoption1_3');
		$option1_4 = $this->input->post('editoption1_4');
		$options1 = "['$correctAnswer1','$option1_2','$option1_3','$option1_4']";
		$condition1 = "questions.id = " .$id1. "";

		$data1 = array(
			'question' => $question1,
			'correctAnswer' => $correctAnswer1,
			'options' => $options1,
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data1, $condition1);

		$id2 = $this->input->post('editId2');		
		$question2 = $this->input->post('editquestion2');	
		$correctAnswer2 = $this->input->post('editcorrectAnswer2');
		$option2_2 = $this->input->post('editoption2_2');
		$option2_3 = $this->input->post('editoption2_3');
		$option2_4 = $this->input->post('editoption2_4');
		$options2 = "['$correctAnswer2','$option2_2','$option2_3','$option2_4']";
		$condition2 = "questions.id = " .$id2. "";

		$data2 = array(
			'question' => $question2,
			'correctAnswer' => $correctAnswer2,
			'options' => $options2,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data2, $condition2);
	
		$id3 = $this->input->post('editId3');		
		$condition3 = "questions.id = " .$id3. "";
		$question3 = $this->input->post('editquestion3');	
		$correctAnswer3 = $this->input->post('editcorrectAnswer3');
		$option3_2 = $this->input->post('editoption3_2');
		$option3_3 = $this->input->post('editoption3_3');
		$option3_4 = $this->input->post('editoption3_4');
		$options3 = "['$correctAnswer3','$option3_2','$option3_3','$option3_4']";

		$data3 = array(
			'question' => $question3,
			'correctAnswer' => $correctAnswer3,
			'options' => $options3,
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data3, $condition3);



		$id4 = $this->input->post('editId4');		
		$condition4 = "questions.id = " .$id4. "";
		$question4 = $this->input->post('editquestion4');	
		$correctAnswer4 = $this->input->post('editcorrectAnswer4');
		$option4_2 = $this->input->post('editoption4_2');
		$option4_3 = $this->input->post('editoption4_3');
		$option4_4 = $this->input->post('editoption4_4');		
		$options4 = "['$correctAnswer4','$option4_2','$option4_3','$option4_4']";

		$data4 = array(
			'question' => $question4,
			'correctAnswer' => $correctAnswer4,
			'options' => $options4,	
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data4, $condition4);


		$id5 = $this->input->post('editId5');		
		$condition5 = "questions.id = " .$id5. "";
		$question5 = $this->input->post('editquestion5');	
		$correctAnswer5 = $this->input->post('editcorrectAnswer5');
		$option5_2 = $this->input->post('editoption5_2');
		$option5_3 = $this->input->post('editoption5_3');
		$option5_4 = $this->input->post('editoption5_4');
		$options5 = "['$correctAnswer5','$option5_2','$option5_3','$option5_4']";

		$data5 = array(
			'question' => $question5,
			'correctAnswer' => $correctAnswer5,
			'options' => $options5,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data5, $condition5);

		$id6 = $this->input->post('editId6');		
		$condition6 = "questions.id = " .$id6. "";
		$question6 = $this->input->post('editquestion6');	
		$correctAnswer6 = $this->input->post('editcorrectAnswer6');
		$option6_2 = $this->input->post('editoption6_2');
		$option6_3 = $this->input->post('editoption6_3');
		$option6_4 = $this->input->post('editoption6_4');
		$options6 = "['$correctAnswer6','$option6_2','$option6_3','$option6_4']";

		$data6 = array(
			'question' => $question6,
			'correctAnswer' => $correctAnswer6,
			'options' => $options6,
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data6, $condition6);

		$id7 = $this->input->post('editId7');		
		$condition7 = "questions.id = " .$id7. "";
		$question7 = $this->input->post('editquestion7');	
		$correctAnswer7 = $this->input->post('editcorrectAnswer7');		
		$option7_2 = $this->input->post('editoption7_2');
		$option7_3 = $this->input->post('editoption7_3');
		$option7_4 = $this->input->post('editoption7_4');
		$options7 = "['$correctAnswer7','$option7_2','$option7_3','$option7_4']";

		$data7 = array(
			'question' => $question7,
			'correctAnswer' => $correctAnswer7,
			'options' => $options7,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data7, $condition7);

		$id8 = $this->input->post('editId8');		
		$condition8 = "questions.id = " .$id8. "";
		$question8 = $this->input->post('editquestion8');	
		$correctAnswer8 = $this->input->post('editcorrectAnswer8');
		$option8_2 = $this->input->post('editoption8_2');
		$option8_3 = $this->input->post('editoption8_3');
		$option8_4 = $this->input->post('editoption8_4');
		$options8 = "['$correctAnswer8','$option8_2','$option8_3','$option8_4']";

		$data8 = array(
			'question' => $question8,
			'correctAnswer' => $correctAnswer8,
			'options' => $options8,
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data8, $condition8);


		$id9 = $this->input->post('editId9');		
		$condition9 = "questions.id = " .$id9. "";
		$question9 = $this->input->post('editquestion9');	
		$correctAnswer9 = $this->input->post('editcorrectAnswer9');
		$option9_2 = $this->input->post('editoption9_2');
		$option9_3 = $this->input->post('editoption9_3');
		$option9_4 = $this->input->post('editoption9_4');
		$options9 = "['$correctAnswer9','$option9_2','$option9_3','$option9_4']";

		$data9 = array(
			'question' => $question9,
			'correctAnswer' => $correctAnswer9,
			'options' => $options9,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data9, $condition9);

		$id10 = $this->input->post('editId10');		
		$condition10 = "questions.id = " .$id10. "";
		$question10 = $this->input->post('editquestion10');	
		$correctAnswer10 = $this->input->post('editcorrectAnswer10');
		$option10_2 = $this->input->post('editoption10_2');
		$option10_3 = $this->input->post('editoption10_3');
		$option10_4 = $this->input->post('editoption10_4');
		$options10 = "['$correctAnswer10','$option10_2','$option10_3','$option10_4']";

		$data10 = array(
			'question' => $question10,
			'correctAnswer' => $correctAnswer10,
			'options' => $options10,
			'tournamentId' => $tournamentId
		);

		$this->Crud_model->SaveData("questions", $data10, $condition10);

		$id11 = $this->input->post('editId11');		
		$condition11 = "questions.id = " .$id11. "";
		$question11 = $this->input->post('editquestion11');	
		$correctAnswer11 = $this->input->post('editcorrectAnswer11');
		$option11_2 = $this->input->post('editoption11_2');
		$option11_3 = $this->input->post('editoption11_3');
		$option11_4 = $this->input->post('editoption11_4');
		$options11 = "['$correctAnswer11','$option11_2','$option11_3','$option11_4']";

		$data11 = array(
			'question' => $question11,
			'correctAnswer' => $correctAnswer11,
			'options' => $options11,
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data11, $condition11);

		$id12 = $this->input->post('editId12');		
		$condition12 = "questions.id = " .$id12. "";
		$question12 = $this->input->post('editquestion12');	
		$correctAnswer12 = $this->input->post('editcorrectAnswer12');
		$option12_2 = $this->input->post('editoption12_2');
		$option12_3 = $this->input->post('editoption12_3');
		$option12_4 = $this->input->post('editoption12_4');
		$options12 = "['$correctAnswer12','$option12_2','$option12_3','$option12_4']";

		$data12 = array(
			'question' => $question12,
			'correctAnswer' => $correctAnswer12,
			'options' => $options12,
			'tournamentId' => $tournamentId		
		);

		$this->Crud_model->SaveData("questions", $data12, $condition12);


		$id13 = $this->input->post('editId13');		
		$condition13 = "questions.id = " .$id13. "";
		$question13 = $this->input->post('editquestion13');	
		$correctAnswer13 = $this->input->post('editcorrectAnswer13');
		$option13_2 = $this->input->post('editoption13_2');
		$option13_3 = $this->input->post('editoption13_3');
		$option13_4 = $this->input->post('editoption13_4');
		$options13 = "['$correctAnswer13','$option13_2','$option13_3','$option13_4']";

		$data13 = array(
			'question' => $question13,
			'correctAnswer' => $correctAnswer13,
			'options' => $options13,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data13, $condition13);

		$id14 = $this->input->post('editId14');		
		$condition14 = "questions.id = " .$id14. "";
		$question14 = $this->input->post('editquestion14');	
		$correctAnswer14 = $this->input->post('editcorrectAnswer14');
		$option14_2 = $this->input->post('editoption14_2');
		$option14_3 = $this->input->post('editoption14_3');
		$option14_4 = $this->input->post('editoption14_4');
		$options14 = "['$correctAnswer14','$option14_2','$option14_3','$option14_4']";

		$data14 = array(
			'question' => $question14,
			'correctAnswer' => $correctAnswer14,
			'options' => $options14,
			'tournamentId' => $tournamentId			
		);

		$this->Crud_model->SaveData("questions", $data14, $condition14);


		$id15 = $this->input->post('editId15');		
		$condition15 = "questions.id = " .$id15. "";
		$question15 = $this->input->post('editquestion15');	
		$correctAnswer15 = $this->input->post('editcorrectAnswer15');
		$option15_2 = $this->input->post('editoption15_2');
		$option15_3 = $this->input->post('editoption15_3');
		$option15_4 = $this->input->post('editoption15_4');
		$level = $this->input->post('level');
		$options15 = "['$correctAnswer15','$option15_2','$option15_3','$option15_4']";

		$data15 = array(
			'question' => $question15,
			'correctAnswer' => $correctAnswer15,
			'options' => $options15,
			'tournamentId' => $tournamentId
		);

		$this->Crud_model->SaveData("questions", $data15, $condition15);		

		
		$this->session->set_flashdata('message', 'questions updated successfully');
		
		redirect(site_url(TOURNAMENT));
	}
}
