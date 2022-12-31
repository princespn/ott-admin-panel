
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepositWithdraw extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->library('Custom');
		$this->load->model('Crud_model');
	}

	public function index(){

		
		$fields = "ud.user_name, udw.*";
		$joincon = "udw.userId = ud.user_id";
		$getWithdrawalRecords = $this->Crud_model->result_getall("user_deposit_withdraw udw", $fields, "user_details ud", $joincon, "left","DESC");


		$data=array(
				'heading'=>"Withdrawal Status",
				'bread'=>"Withdrawal Status",
				'getWithdrawalRecords'=>$getWithdrawalRecords
			);
		$this->load->view('deposite_withdrawal/request_list',$data);
	}

	public function changeStatus(){

		$condition = "id='" . $_POST['id'] . "'";
		$getWithdrawalStatus = $this->Crud_model->GetData("user_deposit_withdraw",'',$condition,'','','','1');

		if($getWithdrawalStatus->status != 'Approved')
		{
			$data=array(
						'status'=>"Approved",
						);
			$msg='Withdrawal request has been approved successfully';
		}
		else
		{
			$data=array(
						'status'=>"Rejected",
						);
			$msg='Withdrawal request has been rejected successfully';
		}

		$this->Crud_model->SaveData("user_deposit_withdraw", $data, $condition);

		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}
}
?>