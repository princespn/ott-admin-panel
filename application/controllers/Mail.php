<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('Mail_model');
	}

	public function index()
	{
		$data = array(
			'heading'=>'Manage Mail',
			'bread'=>'Manage Mail',
		);
		$this->load->view('mail/list',$data);
	}

	public function ajax_manage_page()
	{
		$getMailBody = $this->Mail_model->get_datatables('mst_mail_body mb');

		if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
		$data = array();
         		  
		foreach ($getMailBody as $Data) 
		{
			$btn = '';
			$btn .= '&nbsp;&nbsp;'.anchor(site_url(MAILUPDATE.'/'.base64_encode($Data->mailBodyId)),'<span title="Update" class="btn btn-success btn-circle btn-xs"  data-placement="right" title="Update"><i class="fa fa-pencil"></i> UPDATE</span>');

			if(!empty($Data->mailbodyType)){ $mailbodyType = $Data->mailbodyType; }else{ $mailbodyType = 'NA'; }

			if(!empty($Data->subject)){ $subject = $Data->subject; }else{ $subject = 'NA'; }

			if(!empty($Data->body)){ $body = $Data->body; }else{ $body = 'NA'; }



			$no++;
			$nestedData = array();
		    $nestedData[] = $no;
         	$nestedData[] = $mailbodyType;
		    $nestedData[] = $subject;
         	$nestedData[] = $body;
         	$nestedData[] = $btn;
		    
		    $data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->Mail_model->count_all('mst_mail_body mb'),
					"recordsFiltered" => $this->Mail_model->count_filtered('mst_mail_body mb'),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	function update($mailId)
	{
		$cond = "mailBodyId = '".base64_decode($mailId)."'";
     	$getdata=$this->Mail_model->GetData('mst_mail_body','',$cond,'','','','1');

     	$data=array(
     	    'heading' => 'Update Mail',
			'breadhead' => 'Manage Mail',
			'bread' => 'Update ',
		    'action' => site_url(MAILACTION),
            'button' => 'UPDATE',
		    'mailBodyId' => set_value('mailBodyId',$getdata->mailBodyId),
		    'mailbodyType' => set_value('mailbodyType',$getdata->mailbodyType),
		    'subject'=>set_value('subject',$getdata->subject),
		    'body'=>set_value('body',$getdata->body),
     	);
		$this->load->view('mail/create',$data);
	}

	public function updateAction()
	{
     	$mailBodyId=$this->input->post('id');
     	$this->set_rules($mailBodyId);
		if($this->form_validation->run()==false)
		{
			$this->update(base64_encode($mailBodyId));
		}
		else
		{
	     	$data=array(
	            'mailbodyType'   =>$this->input->post('mailbodyType',TRUE),
	            'subject'=>$this->input->post('subject',TRUE),
	            'body'     =>$this->input->post('body',TRUE),
	     	);
	     	$this->Mail_model->SaveData('mst_mail_body',$data,"mailBodyId='".$mailBodyId."'");
	        $this->session->set_flashdata('message', 'Mail has been updated successfully');  
	        redirect(MAIL);
        }
    }

    public function set_rules($mailBodyId)
    {
     	
	    $this->form_validation->set_rules('mailbodyType','mail body type','required|trim|xss_clean',
	     array(
	           'required'=>'Please enter %s',
	    ));
        $this->form_validation->set_rules('subject','mail subject','required|trim|xss_clean',
        array(
              'required'=>'Please enter %s',
        ));
        $this->form_validation->set_rules('body','mail body','required|trim|xss_clean',
        array(
              'required'=>'Please enter %s',
        ));
     }

}