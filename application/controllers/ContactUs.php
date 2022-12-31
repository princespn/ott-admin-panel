<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('ContactUs_model');
	    $this->load->library('email');
        $this->load->library('Custom');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
	} 

	public function index()
	{
		$data=array(
			'heading'=>"Manage Contact Us",
			'bread'=>"Manage Contact Us",

			);
		$this->load->view('contactUs/list',$data);
	}

	public function ajax_manage_page()
	{
		$getContact = $this->ContactUs_model->get_datatables('contact_us c');

		if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
		$data = array();
         		  
		foreach ($getContact as $contactData) 
		{
			
			$btn = '';
			
     		if(empty($contactData->reply))
			{
         		$btn = '&nbsp;&nbsp;'.'<button title="Reply" class="btn btn-primary btn-xs" data-target="#myModalbrand" data-toggle="modal" onclick="return Reply('.$contactData->id.');"><i class="fa fa-reply"></i></button>';
         	

         		$btn .="&nbsp;|&nbsp;". "<button title='Delete' class='btn btn-danger btn-xs' onclick='return deleteContact(".$contactData->id.");'><i class='fa fa-trash-o'></i></button>";
        	}
        	else
        	{
        		$btn .="&nbsp;&nbsp;". "<button title='Delete' class='btn btn-danger btn-xs' onclick='return deleteContact(".$contactData->id.");'><i class='fa fa-trash-o'></i></button>";
        	}
        	

        	if(strlen($contactData->reply) > 30)
        	{
           		$reply = substr($contactData->reply, 0,30).'....'.'<a href="#myreplyModalBody" data-toggle="modal" class="word-break" onclick="return getreply('.$contactData->id.')">View more</a>';
          	}else{
           		$reply = $contactData->reply;
          	}

			$no++;
			$nestedData = array();
		    $nestedData[] = $no;
		    $nestedData[] = ucfirst($contactData->name);
         	$nestedData[] = $contactData->email;
		    $nestedData[] = $contactData->mobile;
		    $nestedData[] = $contactData->subject;
		    $nestedData[] = $contactData->message;
		    $nestedData[] = $reply;
            $nestedData[] = $btn;
		    
		    $data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->ContactUs_model->count_all('contact_us c'),
					"recordsFiltered" => $this->ContactUs_model->count_filtered('contact_us c'),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	public function sendReplyMail()
	{
		$con = "id='".$this->input->post('replyId')."'";
		$getContactData = $this->Crud_model->GetData('contact_us','',$con,'','','','1');
		if(!empty($getContactData)){
			$data = array(
				'reply'=>$this->input->post('replyMsg'),
				'type'=>'Contact',
				'from_id'=>$this->input->post('replyId')
			);
			$this->Crud_model->SaveData('reply_logs',$data);
			  $data2=array(
		            'reply'=>ucfirst($this->input->post('replyMsg',TRUE)),
		        );
            $cond="id='".$this->input->post('replyId')."'";
	        $this->Crud_model->SaveData('contact_us',$data2,$cond);
	        $success =1;
	    	    $msg ="Reply Send Successfully.";
     
			 $smsBody = $this->Crud_model->GetData('mst_sms_body','',"smsType='contactus_reply'",'','','','1');
			 $getContact = $this->Crud_model->GetData('contact_us','',$con,'','','','1');
			if(!empty($smsBody) && ISLIVE=='YES')
			{
				$smsBody->smsBody=str_replace("{user_name}",$getContactData->name,$smsBody->smsBody);
		        $smsBody->smsBody=str_replace("{message}",$getContact->reply,$smsBody->smsBody);
		        $body=$smsBody->smsBody;
		        $mobileNo=$getContact->mobile;
		        $this->custom->sendSms($mobileNo,$body);
			}
		}else{
			 $success =0;
		    $msg = "No Data Found";
		}
		 $data = array(
    		'success'=>$success,
    		'msg'=>$msg,
    	);
	echo json_encode($data);exit;
	}


	public function getReply(){
		$con = "id='".$this->input->post('id')."'";
		$getContactData = $this->Crud_model->GetData('contact_us','',$con,'','','','1');
		 if(!empty($getContactData)){
       	   echo $getContactData->reply;
       }else{
		    
		   echo  "No Data Found";
		}
	}

	 public function delete(){
    	$id = $this->input->post('id',TRUE);
	    if(!empty($id))
	    {
	        $this->Crud_model->DeleteData("contact_us","id='".$id."'",'');
	        $msg = 'Record has been deleted successfully';
	    }
	    else
	    {
	    	$msg = 'No record found User';
	    }
	    $response = array(
	    	'csrfName' => $this->security->get_csrf_token_name(),
	    	'csrfHash' => $this->security->get_csrf_hash(),
	    	'msg'      => $msg
	    );
	    echo json_encode($response);exit;
    }

}
