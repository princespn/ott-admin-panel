<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supports extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('Support_model');
	}

	public function index(){
		$data = array(
		  'heading'=>'Manage Supports',
		  'bread'=>'Manage Supports',
		);
		$this->load->view('support/list',$data);
	}

	public function getuserlist(){
	    $getUser=$this->Support_model->getUserName();
	   // print_r($this->db->last_query());exit();
		$data = array(
			'getUser'=>$getUser,
		);
		$this->load->view('support/usersMsgList',$data);
	}

	public function getChat(){
		
		$condition="isRead='No' and userId='".$this->input->post('userId')."' and type='User'";

		$dataIsRead = array(
			'isRead'=>'Yes'
		);
		//print_r($dataIsRead);exit();
		$this->Support_model->SaveData('support_logs',$dataIsRead,$condition);
		//print_r($this->db->last_query());exit();
		$cond="userId='".$this->input->post('userId')."'";
		 $getUserChat=$this->Support_model->getChat($cond);
		$data = array(
			'getUserChat'=>$getUserChat
		);
		$this->load->view('support/userChatList',$data);
	}

	public function replychat(){
      $cond="supportLogId='".$this->input->post('userId')."'";
      $message =$this->input->post('message');
      $data=array(
      	'message'=>$message,
      	'userId'=>$this->input->post('userId'),
      	'type'=>$this->input->post('Admin'),
      );
		$this->Support_model->SaveData('support_logs',$data);
		$insert_id=$this->db->insert_id(); 
		$getdata=$this->Support_model->GetData('support_logs','',"supportLogId='".$insert_id."'",'','','','','1');
		$div = '<div class="outgoing_msg"><div class="sent_msg"><p>'.$message.'</p><span class="time_date">
		 '.date("h:i A",strtotime($getdata[0]->created)).'  |   '.date("F d",strtotime($getdata[0]->created)).'</span></div></div>';
		echo $div;
	}

 
}