<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->library('bcrypt');
	}

	public function index()
	{	
		// $password ="1100";
		// $hash = $this->bcrypt->hash_password($password);
		//print_r($hash);exit;
		
		//get deposit count
		//$getDepositCount = $this->Crud_model->GetData("user_account","sum(betAmount) as totalDepositAmt",'','','','','1');
		//print_r($this->db->last_query());exit;
		
		//get withdraw count
		//$getWithdrawCount = $this->Crud_model->GetData("user_account","sum(betAmount) as wcount",'','','','','1');
		
		//get All User  count
		$getAllUserCount = $this->Crud_model->GetData('user_details','count(id) as allUser','','','','','1');
		//print_r($getAllUserCount);exit;


		//get Facebook User count
		//$getFacebookUsersCount = $this->Crud_model->GetData('user_details','count(id) as facebookUser','playerType="Real" and registrationType="facebook" and socialId!="" and status="Active"','','','','1');
		//print_r($this->db->last_query());exit;

		
		//get Latest Users
		$getSelectedUser = $this->Crud_model->get_multiple_record('user_details','','','id desc','','8'); //date(signup_date)="'.date("Y-m-d").'" and 

		//get todays deposit count
		// $getTodayDepositCount = $this->Crud_model->GetData("user_account","sum(betAmount) as tdcount",'date(created)="'.date('Y-m-d').'" ','','','','1');


		// //get todays deposit count
		// $getTodayWithdrawalCount = $this->Crud_model->GetData("user_account","sum(betAmount) as tdcount",'date(created)="'.date('Y-m-d').'"','','','','1');
		// // print_r($getTodayWithdrawalCount);exit;

		// //get todays total bonus
		// $getTodayTotalBonus = $this->Crud_model->GetData("referal_user_logs","sum(referalAmount) as refAmt",'date(created)="'.date('Y-m-d').'"','','','','1');
			
		// $year = date('Y');
		// $monthval = array();
		// $total_users = array();
		// for ($m=1; $m<=12; $m++) 
		// {
		//     $month = date('F', mktime(0,0,0,$m, 1, $year));
		    
		//     $user = $this->Crud_model->GetData('user_details','count(id) as total_user',"MONTHNAME(signup_date)='".$month."'","","","","1");
		    
		//     array_push($monthval, $month);

		//     array_push($total_users, $user->total_user);
	    //  }

	//    $getTotalReferalCount  =  $this->Crud_model->GetData("referal_user_logs","referLogId",'referalAmountBy="playGame"','fromUserId','','','');
		
		$data= array(
			//	'getDepositCount'=>$getDepositCount->totalDepositAmt,
			//	'getWithdrawCount'=>$getWithdrawCount->wcount,
				'getUserCount'=>$getAllUserCount->allUser,
			//	'getFacebookUsersCount'=>$getFacebookUsersCount->facebookUser,
				'getSelectedUser'=>$getSelectedUser,
			//	'getTodayDepositCount'=>$getTodayDepositCount->tdcount,
			//	'getTodayTotalBonus'=>$getTodayTotalBonus->refAmt,
		//		'months'=>$monthval,
		//		'total_users'=>$total_users,
				// 'getTotalReferalCount'=>count($getTotalReferalCount),
				// 'getTodayWithdrawalCount'=>$getTodayWithdrawalCount->tdcount
			);
		$this->load->view('dashboard/dashboard',$data);
	}
}
