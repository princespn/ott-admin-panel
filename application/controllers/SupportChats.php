<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupportChats extends CI_Controller 
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
		$this->load->view('support/listChat',$data);
	}
   
   public function getuserlist(){
   $getSupport=$this->Support_model->getUserName();
   $data2 = array(
			    'created'     =>date("M d",strtotime($getSupport[0]->created)),
		 	    'getSupport'  =>$getSupport,
		 );
		echo json_encode($data2);
   }

   public function getuserName(){
   	 $condition="userId='".$this->input->post('id')."' and isRead='No' and type='User'";
        $dataIsRead=array(
        	      'isRead'=>'Yes'
        );
        $this->Support_model->SaveData('support_logs',$dataIsRead,$condition);
   	$con="userId='".$this->input->post('id')."'";
   	 $getUserChat=$this->Support_model->getChat($con);
   	 $data3 = array(
			    "time"         =>date("h:i A",strtotime($getUserChat[0]->created))." | ".date("F d",strtotime($getUserChat[0]->created)),
                'getUserChat'  =>$getUserChat,
		 );
   	 echo json_encode($data3);
   }

   public function getuserChat(){
   	$cond="userId='".$this->input->post('id')."'";
	$message=$this->input->post('message');
	$saveData=array(
		     'userId'   =>$this->input->post('id'),
		     'type'     =>$this->input->post('Admin'),
		     'message'  =>$message,
	);
	$getReplyChat=$this->Support_model->SaveData('support_logs',$saveData);
   	$insert_id=$this->db->insert_id(); 
    $getdata=$this->Support_model->GetData('support_logs','',"supportLogId='".$insert_id."'",'','','','','1');
    $data4 = array(
                 "time"       =>date("h:i A",strtotime($getdata[0]->created))." | ".date("F d",strtotime($getdata[0]->created)),
			    "insert_id"  =>$insert_id,
                "getdata"    =>$getdata,
		    );

		echo json_encode($data4);
   }
}