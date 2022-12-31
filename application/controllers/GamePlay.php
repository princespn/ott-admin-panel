<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GamePlay extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('GamePlay_model');
	}

	public function index()
	{

		$import = '<a href="" class="btn btn-info" data-target="#uploadData" data-backdrop="static" data-keyboard="false" data-toggle="modal">Import</a>';

		$data = array(
			'heading'=>'Rooms',
			'bread'=>'Rooms',
			'import'=>$import,
			'importTitle'=>'Upload Rooms',
	        'importAction'=>site_url(GAMEPLAYIMPORT),
	        'importSheet'=>base_url('assets/import/GamePlay.xlsx'),
		);
		$this->load->view('gamePlay/list',$data);
	}

	public function ajax_manage_page()
	{

		$getGamePlay = $this->GamePlay_model->get_datatables('ludo_mst_rooms lmr');
		if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
		$data = array();
         		  
		foreach ($getGamePlay as $Data) 
		{
			
			$btn = '';
         	$btn = ''.anchor(site_url(GAMEPLAYUPDATE.'/'.base64_encode($Data->roomId)),'<span title="View" class="btn btn-info btn-circle btn-xs"  data-placement="right" title="Edit"><i class="fa fa-edit"></i></span>');

         	$btn .= '&nbsp;|&nbsp; <button type="button" class="btn btn-danger btn-circle btn-xs" title="Delete" onclick="return deleteRooms('.$Data->roomId.')"><i class="fa fa-trash-o"></i></button>';

            if($Data->status=='Active')
            {      
            	$status = '<a class="label label-success" onClick="return statusChange('.$Data->roomId.');">'.$Data->status.'</a>';
            }
            elseif($Data->status=='Inactive')
            {
            	$status = '<a class="label label-danger" onClick="return statusChange('.$Data->roomId.');">'.$Data->status.'</a>';
			}else{
				$status = '<a class="label label-success" >'.$Data->status.'</a>';
			}

			/*$totalAmt = $Data->betValue * $Data->players;
			$comm = ($totalAmt * $Data->commision) / 100;
			$winingAmt =  $totalAmt - $comm;*/

			$no++;
			$nestedData = array();
		    $nestedData[] = $no;
		    $nestedData[] = ucfirst($Data->roomTitle);
		    $nestedData[] = $Data->players;
         	$nestedData[] = $Data->mode;
         	// $nestedData[] = $Data->isPrivate;
         	$nestedData[] = $Data->entryFee;
         	$nestedData[] = $Data->commision;
         	$nestedData[] = $Data->startRoundTime;
         	$nestedData[] = $Data->tokenMoveTime;
         	$nestedData[] = $Data->rollDiceTime;
         	//$nestedData[] = $winingAmt;
         	$nestedData[] = $status;
            $nestedData[] = $btn;
		    
		    $data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->GamePlay_model->count_all('ludo_mst_rooms lmr'),
					"recordsFiltered" => $this->GamePlay_model->count_filtered('ludo_mst_rooms lmr'),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	public function status()
	{
		$cond = "roomId = '".$this->input->post('id')."'";
		$getData = $this->Crud_model->GetData("ludo_mst_rooms",'',$cond,'','','','1');

		if($getData->status == 'Active')
		{
			$data=array(
					'status'=>"Inactive",
				);
		}
		else if($getData->status == 'Inactive'){
			$data=array(
				'status'=>"Active",
			);
		}
		$this->Crud_model->SaveData("ludo_mst_rooms",$data,$cond);
		$msg='Status has been changed successfully';
		
		$response = array(
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'msg' => $msg
		);
		echo json_encode($response);
	}

	public function create()
	{
		$getPlayers = $this->Crud_model->GetData('players','id,player','','','','','');
		$getValues = $this->Crud_model->GetData('values','id,value','','','','','');

		$data = array(
		    'action'    => site_url(GAMEPLAYACTION),
			'heading'   => 'Create Room',
			'breadhead' => 'Rooms',
			'bread'     => 'Create',
			'button'    => 'Create',
			'isPrivate'    => 'No',
			'roomId'    => set_value('roomId',$this->input->post('roomId',TRUE)),
			'mode' 		=> set_value('mode',$this->input->post('mode',TRUE)),
			'roomTitle' => set_value('roomTitle',$this->input->post('roomTitle',TRUE)),
			'commision' => set_value('commision',$this->input->post('commision',TRUE)),
			'isBotConnect'  => set_value('isBotConnect',$this->input->post('isBotConnect',TRUE)),
			'isPrivate'  => set_value('isPrivate',$this->input->post('isPrivate',TRUE)),
			'players'   => set_value('players',$this->input->post('players',TRUE)),
			'entryFee' => set_value('entryFee',$this->input->post('entryFee',TRUE)),
			'startRoundTime' => set_value('startRoundTime',$this->input->post('startRoundTime',TRUE)),
			'tokenMoveTime' => set_value('tokenMoveTime',$this->input->post('tokenMoveTime',TRUE)),
			'rollDiceTime' => set_value('rollDiceTime',$this->input->post('rollDiceTime',TRUE)),
			'getPlayers'   => $getPlayers,
			'getValues'     => $getValues,
			
		);
		$this->load->view('gamePlay/create',$data);
	}

	public function update($id)
	{
		$cond = "roomId = '".base64_decode($id)."'";
		$getData = $this->Crud_model->GetData("ludo_mst_rooms",'',$cond,'','','','1');

		$getPlayers = $this->Crud_model->GetData('players','id,player','','','','','');
		$getValues = $this->Crud_model->GetData('values','id,value','','','','','');

		$data = array(
		    'action'=>site_url(GAMEPLAYACTION),
			'heading'=>'Update Game PLay',
			'breadhead'=>'Game PLay',
			'bread'=>'Update',
			'button'=>'Update',
			'isPrivate'    => set_value('isPrivate',$getData->isPrivate),
			'roomId'=>set_value('roomId',$getData->roomId),
			'roomTitle'=>set_value('roomTitle',$getData->roomTitle),
			'commision'=>set_value('commision',$getData->commision),
			'isBotConnect'  => set_value('isBotConnect',$getData->isBotConnect),
			'mode'=>set_value('mode',$getData->mode),
		 	'players'   => set_value('players',$getData->players),
			'entryFee' => set_value('entryFee',$getData->entryFee),
			'startRoundTime' => set_value('startRoundTime',$getData->startRoundTime),
			'tokenMoveTime' => set_value('tokenMoveTime',$getData->tokenMoveTime),
			'rollDiceTime' => set_value('rollDiceTime',$getData->rollDiceTime),
			'getPlayers'   => $getPlayers,
			'getValues'     => $getValues,
			'getData'     => $getData
		);

		/*if($getData->isPrivate=='Yes'){
        	$imp = explode('-', $getData->entryFee);
        	if(empty($imp[1])){
        		$imp[1] = 0;
        	}
        	$data['minimum']= $imp[0];
        	$data['maximum']= $imp[1];
        }*/
		$this->load->view('gamePlay/create',$data);
	}

	public function action()
	{
		//print_r($_POST);exit;
		$data = array(
			'roomTitle'     => $this->input->post('roomTitle'),
			'isPrivate'     => $this->input->post('isPrivate'),
			'players'       => $this->input->post('players'),
			'mode'     	  => $this->input->post('mode'),
			'commision'     => $this->input->post('commision'),
			'isBotConnect'     => $this->input->post('isBotConnect'),
			'entryFee'      => $this->input->post('entryFee'),
			'startRoundTime'=> $this->input->post('startRoundTime'),
			'tokenMoveTime' => $this->input->post('tokenMoveTime'),
			'rollDiceTime'  => $this->input->post('rollDiceTime'),
		);

		if($this->input->post('button')== 'Create')
		{
			$id = 0;
			$this->form_rules($id);
			if($this->form_validation->run()==false)
			{
				$this->create($id);
			}
			else
			{
				$this->Crud_model->SaveData('ludo_mst_rooms',$data);
				$msg = $this->session->set_flashdata('message', 'Room has been created successfully');
				redirect(GAMEPLAY);
		    }
		}
		else
		{
			$id = $this->input->post('roomId');

			$getRecord = $this->Crud_model->GetData("ludo_mst_rooms",'','roomId="'.$id.'"','','','','1');

			/*if($getRecord->isPrivate=='Yes'){
				$data['entryFee'] = $this->input->post('minimum').'-'.$this->input->post('maximum');
			}*/

			$this->form_rules($id);
			if($this->form_validation->run()==false)
			{
				//print_r("if");exit;
				$this->update(base64_encode($id));
			}
			else
			{
				//print_r("else");exit;
				$cond = "roomId = '".$id."'";
				$this->Crud_model->SaveData('ludo_mst_rooms',$data,$cond);
				$msg = $this->session->set_flashdata('message', 'Room has been updated successfully');
				redirect(GAMEPLAY);
			}
		}
	}

	public function form_rules($id)
	{
		$tableName = 'ludo_mst_rooms';
		$getRoomData = $this->Crud_model->GetData($tableName,"");

		if(isset($_POST['roomTitle']))
        {
            $con="roomTitle='".$_POST['roomTitle']."' and roomId!='".$id."' ";
        }else{
        	$con='';
        }
        $repeat = $this->Crud_model->GetData($tableName,"",$con);
        //print_r(count($repeat));exit;
        if(count($repeat)>0)
	    {
	        $is_unique1 = "|is_unique[ludo_mst_rooms.roomTitle]";
	    }
	    else
	    {
	        $is_unique1 ='';
	    }

		if($this->input->post('private')=='No'){
			if(isset($_POST['entryFee']))
	        {
	            $condition="players='".$_POST['players']."' and roomId!='".$id."' and mode='".$_POST['mode']."' and entryFee='".$_POST['entryFee']."'";
	        }else{
	        	$condition='';
	        }
	        $chkEntryFee = $this->Crud_model->GetData($tableName,"",$condition);
	        if(count($chkEntryFee)>0)
		    {
		        $is_uniqueFee = "|is_unique[ludo_mst_rooms.entryFee]";
		    }
		    else
		    {
		        $is_uniqueFee ='';
		    }

		}
	    
		$this->form_validation->set_rules('roomTitle', 'room', 'required|trim|xss_clean'.$is_unique1,
			  array(
			  'required'=>'Please enter %s.',
			  'is_unique' => 'This %s already exists.'
			));
		if($this->input->post('private')=='No'){
		$this->form_validation->set_rules('players', 'players', 'required|xss_clean',
		     array( 
		       'required'=>'Please select %s.',
		       //'is_unique' => 'This %s already exists.'
		    ));
		}
		if($this->input->post('private')=='No'){
			$this->form_validation->set_rules('entryFee', 'entry fee', 'required|trim|xss_clean'.$is_uniqueFee,
				  array(
				  'required'=>'Please enter %s.',
				  'is_unique' => 'This %s already exists.'
				));
		}
		$this->form_validation->set_rules('commision', 'commision', 'required|trim|xss_clean',
		      array( 
		       'required'=>'Please enter %s.',
		       
		    ));

		/*$this->form_validation->set_rules('betValue', 'bet value', 'required|xss_clean',
			  array(
			  'required'=>'Please select %s.',
			));*/
		
		$this->form_validation->set_rules('startRoundTime', 'start round time', 'required|trim|xss_clean',
			  array(
			  'required'=>'Please enter %s.',
			));
		$this->form_validation->set_rules('tokenMoveTime', 'token move time', 'required|trim|xss_clean',
			  array(
			  'required'=>'Please enter %s.',
			));
		$this->form_validation->set_rules('rollDiceTime', 'roll dice time', 'required|trim|xss_clean',
			  array(
			  'required'=>'Please enter %s.',
			));

	}

	public function import()
	{
		$file = $_FILES['excel_file']['tmp_name'];
        $this->load->library('excel');

        $objPHPExcel = PHPExcel_IOFactory::load($file);
	    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true);
	    $arrayCount = count($allDataInSheet);

	    $fields_fun =array();
	    $i = 1;
	    foreach ($allDataInSheet as $val) 
	    {
	       if ($i == 1) 
	       {
	       }else{
	            $fields_fun[] = $val;
	       }
	       $i++;
	    } 
	    if(!$fields_fun)
	    {
	        $msg = $this->session->set_flashdata('message', 'Excel sheet is blank.');
		    redirect(GAMEPLAY);
	    }
	    else
	    {
	    	$data = $fields_fun;
	    	$numMsg = 0;
	    	$duplicate = 0;
	    	foreach ($data as $val) 
	   		{
	   			if(isset($val[0]) && isset($val[1]) && isset($val[2]) && isset($val[3]) )
	       		{
	       			$getData = $this->Crud_model->GetData('ludo_mst_rooms','','roomTitle="'.$val[0].'"','','','','');

	       			$val1 = $val[1];
	       			$val2 = $val[2];
	       			$val3 = $val[3];
	       			if(!preg_match('/^[0-9]*$/', $val1) || !preg_match('/^[0-9]*$/', $val2) || !preg_match('/^[0-9]*$/', $val3))
	       			{
	       				$numMsg +=1;
	       		    }
	       		    else if(!empty($getData))
	       		    {
	       		    	$duplicate +=1;
	       		    }
	       		    else
	       		    {
	       		    	$data = array(
	       		    		'roomTitle'=>ucfirst($val[0]),
		       		    	'betValue'=>$val1,
		       		    	'players'=>$val2,
		       		    	'commision'=>$val3
	       		    	);
	       		    	$this->Crud_model->SaveData('ludo_mst_rooms',$data);
	       		    }
	       		}
	   		}
	   		$msg = "";
	   		if($numMsg!=0)
	   		{
	   			$msg .= " Invalid Record";
	   		}
	   		if($duplicate!=0)
	   		{
	   			$msg .= " Record is Duplicate";
	   		}
	   		if($numMsg==0 && $duplicate==0)
	   		{
	   			$msg = " Record is Imported Successfully.";
	   		}
	   		$this->session->set_flashdata('message', '<p>'.$msg.'</p>');
	   		redirect(GAMEPLAY);
	    }
	}


	public	function delete() {
		$cond = "roomId = '".$this->input->post('id')."' and isPrivate='No'";
		$getData = $this->Crud_model->GetData("ludo_mst_rooms",'',$cond,'','','','1');

		if($getData) {
			$this->Crud_model->DeleteData("ludo_mst_rooms",$cond,'1');
			$msg='Room has been deleted successfully.';
		}else{
			$msg='Room not deleted.';
		}

		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}
}