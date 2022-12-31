<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WithdrawalRequest extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	    $this->load->library('image_lib');
	    $this->load->model('WithdrawalRequest_model');
	} 

	public function index()
	{
		$dataRead = array('isReadNotification'=>'Yes');
        $this->Crud_model->SaveData("user_account",$dataRead,'isReadNotification="No"');
		$getUsers = $this->Crud_model->GetData('user_details','','playerType="Real" and status="Active"');
		$data=array(
			'heading'=>"Withdrawal Request",
			'bread'=>"Manage Withdrawal Request",
			'getUsers'=>$getUsers,
			);
		$this->load->view('withdrawal/list',$data);
	}


	public function ajax_manage_page()
	{
		
		$condition = "ua.type='Withdraw' and ua.status='Pending'";
		$getPenWith = $this->WithdrawalRequest_model->get_datatables('user_account ua',$condition);

		if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
		$data = array();
         		  
		foreach ($getPenWith as $PendingWithd) 
		{
		
			$btn = '';

         	$btn .= ''.'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View">View</span>';
         	$btn .= '&nbsp;&nbsp;'.'<span title="View" class="btn btn-success btn-circle btn-xs"  data-placement="right" title="Accept">Accept</span>';
         	$btn .= '&nbsp;&nbsp;'.'<span title="View" class="btn btn-danger btn-circle btn-xs"  data-placement="right" title="Reject">Reject</span>';


			if(!empty($PendingWithd->user_name)){ $user_name = $PendingWithd->user_name; }else{ $user_name = 'NA'; }

			if(!empty($PendingWithd->amount)){ $amount = $PendingWithd->amount; }else{ $amount = 'NA'; }

			if(!empty($PendingWithd->paymentMode)){ $paymentMode = $PendingWithd->paymentMode; }else{ $paymentMode = 'NA'; }

			if(!empty($PendingWithd->created) && $PendingWithd->created !="0000-00-00 00:00:00"){ $created = date('d M Y H:i A', strtotime($PendingWithd->created)); }else{ $created = 'NA'; }
		 
			$no++;
			$nestedData = array();
		    $nestedData[] = '<input type="checkbox">';
		    $nestedData[] = $no;
		    $nestedData[] = ucfirst($user_name);
         	$nestedData[] = $amount;
		    $nestedData[] = $paymentMode;
         	$nestedData[] = $created;
            $nestedData[] = $btn;
		    
		    $data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->WithdrawalRequest_model->count_all('user_account ua',$condition),
					"recordsFiltered" => $this->WithdrawalRequest_model->count_filtered('user_account ua',$condition),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

}