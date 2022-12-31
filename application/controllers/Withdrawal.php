<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->library('Custom');
		$this->load->model('Withdrawal_model');
	} 

	public function index()
	{

		$dataRead = array('isReadNotification'=>'Yes');
		$this->Crud_model->SaveData("user_account",$dataRead,'isReadNotification="No"');
		$data=array(
				'heading'=>"Manage Pending Withdrawal",
				'bread'=>"Manage Pending Withdrawal"
			);
		$this->load->view('withdrawal/list',$data);
	}

	public function ajax_manage_page() {

		$expo_select = '';
		if(!empty($_POST['select_all'])){
		  $expo_select = explode(',', $_POST['select_all']); 
		  // print_r($expo_select) ;exit;
		}else{
		  $expo_select = array();
		} 

		$no = 0;
		if($_POST['start']) {
			$no = $_POST['start'];
		}

		$cond = "d.amount != '0' and d.type = 'Withdraw' and d.status IN ('Pending','Process') and u.user_id!=''";
		if(!empty($this->input->post('SearchData')) && !empty($this->input->post('SearchData1'))) {
			$cond .= " and date(d.created) between '".date("Y-m-d",strtotime($this->input->post('SearchData')))."' and '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."' ";
		}else if(!empty($this->input->post('SearchData'))) {
			$cond .= " and d.created >= '".date("Y-m-d",strtotime($this->input->post('SearchData')))."'";
		}else if(!empty($this->input->post('SearchData1'))) {
			$cond .= " and d.created <= '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."'";
		}
		if(!empty($this->input->post('SearchData2'))) {
			$cond .= " and d.paymentType = '".$this->input->post('SearchData2')."'";
		}
		$getWithdrawData = $this->Withdrawal_model->get_datatables('user_account d',$cond);

		$data = array();

		foreach ($getWithdrawData as $listData) {

			$btn = "";
			
			if($listData->paymentType=='paytm'){

			}
				$btn ='<span class=" action-buttons"><a class="btn btn-success btn-xs" href="'.site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($listData->id)).'" title="Approve User Redeem Request"><i class="ace-icon fa fa-check-circle"></i></a></span> &nbsp;|&nbsp;';

			 $btn .= ''.anchor(site_url(USERVIEW.'/'.base64_encode($listData->user_detail_id)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>');


			if ($listData->status == 'Approved'){ 
				$status = '<span class="label label-success">'.$listData->status.'</span>'; 
			} else if ($listData->status == 'Pending') { 
				$status = '<span class="label label-warning">'.$listData->status.'</span>'; 
			} else {
			 	$status = '<span class="label label-danger">'.$listData->status.'</span>'; 
			}
			
			if($listData->paymentType =='paytm'){
            	$paymentType = '<a class="label label-success">'.ucfirst($listData->paymentType).'</a>';
			}elseif ($listData->paymentType =='bank') {
            	$paymentType = '<a class="label label-danger">'.ucfirst($listData->paymentType).'</a>';
			}
			else{
				$paymentType = '';
			}

			$adminPercent = 0;
			$adPercent = 0;
			if ($listData->status == 'Approved') {
				$getApprovPer = $this->Crud_model->GetData("admin_account_log","percent","user_account_id='".$listData->id."'",'','','','1');
				if(!empty($getApprovPer)) {
					$adminPercent += $getApprovPer->percent;
					$adPercent += $getApprovPer->percent;
				}
			} else {
				$getAdminPercent=$this->Crud_model->GetData("mst_settings","adminPercent","id='4'",'','','','1');
				if(!empty($getAdminPercent)) {
					$adminPercent += $getAdminPercent->adminPercent;
					$adPercent += $getAdminPercent->adminPercent;   
				}
			}
				
			$total_adminAmount = ($listData->amount*$adminPercent) / 100;
			$adminAmount = ($listData->amount*$adPercent) / 100;

			$main_user_rs = $listData->amount-$total_adminAmount;

			$check ='';
			if(in_array($listData->id, $expo_select))
			{
				$check = "checked";
			}else{
				$check = "";
			}
			if(!empty($listData->mobileNo)){ $mobile = $listData->mobileNo; }else{ $mobile='NA'; }


			$no++;
			$nestedData = array();
			$nestedData[] = '<input type="checkbox" '.$check.' id="checkid_'.$listData->id.'" onchange="selectSingle(this.value);" name="checkid[]" class="checkid checkid'.$listData->id.'" value="'.$listData->id.'">';
			// $nestedData[] = '<input type="checkbox" '.$check.' id="checkid'.$listData->id.'" onchange="changeSelect('.$listData->id.');" name="checkid[]" class="checkid checkid'.$listData->id.'" value="'.$listData->id.'">';
			//$nestedData[] = '<input type="checkbox" '.$check.' id="chk" onchange="changeSelect('.$listData->id.');" name="selected[]" class="chk" value="'.$listData->id.'">';

			$nestedData[] = $no;
			$nestedData[] = ucfirst($listData->user_name);
			$nestedData[] = $listData->email_id;
			$nestedData[] = $mobile;
			$nestedData[] = $listData->amount;
			$nestedData[] = $adPercent." % (&#8377; ".$adminAmount.")"; 
			$nestedData[] = "&#8377; ".$main_user_rs;  
			$nestedData[] = "&#8377; ".round($listData->balance,2);   
			$nestedData[] = date("d F Y h:i A",strtotime($listData->created));
			$nestedData[] = $paymentType;
			// $nestedData[] = $listData->transactionId;
			$nestedData[] = $status;
			$nestedData[] = $btn;

			$data[] = $nestedData;
		   
		}

		/*if(count($expo_select) == count($getWithdrawData)){
			$checkAll = "checked";
		} else {
			$checkAll = "";
		}*/

		$output = array(
			'draw'            => $_POST['draw'],
			'recordsTotal'    => $this->Withdrawal_model->count_all('user_account d',$cond),
			'recordsFiltered' => $this->Withdrawal_model->count_filtered('user_account d',$cond),
			'data'            => $data,
			"csrfHash" => $this->security->get_csrf_hash(),
			"csrfName" => $this->security->get_csrf_token_name(),
		);

		echo json_encode($output);
	}

	public function redeemDistribute($id){
		
		$cond= "d.id='".base64_decode($id)."'";
		$getData = $this->Withdrawal_model->getWithdrawalData('user_account d',$cond);
		//print_r($getData);exit;
		$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
		$admin_rs=($getData->amount*$getSettData->adminPercent)/100;
		$userAmt = $getData->amount - $admin_rs;

		$getAdminData = $this->Crud_model->GetData("admin_account_log","percent as adPercent,total_amount as adTotalAmt","user_account_id='".base64_decode($id)."'",'','','','1');

		//$getUserData = $this->Crud_model->multijoin("web_user_details_account_log ul","ul.web_user_details_id,ul.total_amount,u.user_name","ul.web_redeem_requests_id='".base64_decode($id)."'",'','','',array('user_details u'),array('u.id=ul.web_user_details_id'),array('left'),'1');
		//print_r($getUserData);exit;
		$data= array(
			'heading'=>'User Withdrawal Request View',
			'breadhead'=>'Manage Withdrawal',
			'bread'=>'User Withdrawal Request View',
			'getData'=>$getData,
			'getAdminData'=>$getAdminData,
			'userAmt'=>$userAmt,
			);
		$this->load->view('withdrawal/withdrawal_distribute',$data);
	}


	public function saveManuallyRedeemRequest(){
	   // print_r($_POST);echo "<br>";
		$userId =$this->input->post('userId');
		$userAccId =$this->input->post('id');
		$order_id =$this->input->post('orderId');
		$withAmt =$this->input->post('withAmt');
		$userData =$this->Crud_model->GetData("user_details","id,status,balance","id='".$userId."'","","","","1"); 
	   
		$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
		$admin_rs=($_POST['withAmt']*$getSettData->adminPercent)/100;
		$userAmt = $_POST['withAmt'] - $admin_rs;

		$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');

		if (!empty($getAdminData->adminBalance)) {
			$adminTotalAmt = $getAdminData->adminBalance + $admin_rs;
		} else {
			$adminTotalAmt = $admin_rs; 
		}
		$updateAdminData = array(
				'adminBalance'=>$adminTotalAmt,
			);
		$this->Crud_model->SaveData("admin_login",$updateAdminData,"id='".$_SESSION[SESSION_NAME]['id']."'");
		$saveAdminLogData = array(
				'user_account_id'=>$userAccId,
				'from_user_details_id'=>$userId,
				'to_admin_login_id'=>$getAdminData->id,
				'percent'=>$getSettData->adminPercent,
				'total_amount'=>$admin_rs,
				'type'=>'deposit',
			);
		 $this->Crud_model->SaveData("admin_account_log",$saveAdminLogData);
		/***** Admin Data *****/
		 $approveData = array(
			'orderId'=>$order_id,
			'transactionId'=>$this->input->post('transId'),
			'status'=>'Approved',
			'paymentType'=>'Manually',
			'isAdminReedem'=>'Yes',
			'modified'=>date("Y-m-d H:i:s")
		);
		 $approveDataLog = array(
			'orderId'=>$order_id,
			'user_account_id'=>$userAccId,
			'user_detail_id'=>$userId,
			'amount'=>$withAmt,
			'balance'=>$userData->balance,
			'type'=>'Withdraw',
			'transactionId'=>$this->input->post('transId'),
			'paymentType'=>'Manually',
			'status'=>'Approved',
			'created'=>date("Y-m-d H:i:s")
		);	   
		$this->Crud_model->SaveData('user_account',$approveData,'id="'.$userAccId.'"');
		$this->Crud_model->SaveData('user_account_logs',$approveDataLog);
		 redirect(site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($_POST['id'])));
	}

	public function saveAllDistributerRedeem(){
		$userData =$this->Crud_model->GetData("user_details","id,status,balance","id='".$_POST['userId']."'","","","","1"); 
		// if($userData->balance >= $_POST['withAmt'])
		// {
			$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
			$admin_rs=($_POST['withAmt']*$getSettData->adminPercent)/100;
			$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');
			
			if (!empty($getAdminData->adminBalance)) {
				$adminTotalAmt = $getAdminData->adminBalance + $admin_rs;
			} else {
				$adminTotalAmt = $admin_rs; 
			}
			$updateAdminData = array(
				'adminBalance'=>$adminTotalAmt,
			);
			$this->Crud_model->SaveData("admin_login",$updateAdminData,"id='".$_SESSION[SESSION_NAME]['id']."'");
			$saveAdminLogData = array(
					'user_account_id'=>$_POST['id'],
					'from_user_details_id'=>$_POST['userId'],
					'to_admin_login_id'=>$getAdminData->id,
					'percent'=>$getSettData->adminPercent,
					'total_amount'=>$admin_rs,
					'type'=>'deposit',
				);
			$this->Crud_model->SaveData("admin_account_log",$saveAdminLogData);
			/***** Admin Data *****/
			 $approveData = array(
				'status'=>'Approved',
				'modified'=>date("Y-m-d H:i:s")
			);
			$approveDataLog = array(
				'orderId'=>$this->input->post('orderId'),
				'user_account_id'=>$this->input->post('id'),
				'user_detail_id'=>$this->input->post('userId'),
				'transactionId'=>$this->input->post('transactionId'),
				'amount'=>$this->input->post('withAmt'),
				'type'=>'Withdraw',
				'status'=>'Approved',
				'created'=>date("Y-m-d H:i:s")
			);

		// $updateBal =  $userData->balance - $this->input->post('withAmt');
		// $updateUserBal = array(
		//     'balance'=> $updateBal,
		//     );
	   //print_r($updateBal);exit;
	   $this->Crud_model->SaveData('user_account',$approveData,'id="'.$this->input->post('id').'"');
		// $this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$this->input->post('userId').'"');
	   $this->Crud_model->SaveData('user_account_logs',$approveDataLog);
	   $this->session->set_flashdata('message', '<span>User redeem amount distribute successfully</span>'); 	
		// }else{
		// 	$this->session->set_flashdata('message', '<span >You Can not approved -- user has insufficient available balance</span>');
		// }
	   redirect(site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($_POST['id'])));
	}

	public function rejectRequest() {

		$getRedeemReqData = $this->Crud_model->GetData("user_account","id,user_detail_id,status,paymentType","id='".$_POST['id']."' and user_detail_id='".$_POST['userId']."'","","","","1"); 
		if (!empty($getRedeemReqData)) {

			$getSms = $this->Crud_model->GetData('user_details','email_id,user_name,mobile,balance,winWallet,mainWallet',"id='".$_POST['userId']."'",'','','','1');
			$updateBal =  $getSms->balance + $this->input->post('withAmt');
			$updateWinWallet =  $getSms->winWallet + $this->input->post('withAmt');
			$mainWallet =  $getSms->mainWallet;
			$updateUserBal = array(
				'balance'=> $updateBal,
				'winWallet'=> $updateWinWallet,
				);
			$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$this->input->post('userId').'"');
			
			/* Rejected Request */
			$ReqData = array(
				'status'=>'Rejected',
				'rejectedReason'=>$this->input->post("rejectReason",TRUE),
				'modified'=>date("Y-m-d H:i:s"),
			);
		   // print_r($ReqData);echo "<prev>";
			 $ReqredeemData = array(
				'status'=>'Rejected',
				'type'=>'Withdraw',
				'rejectedReason'=>$this->input->post("rejectReason",TRUE),
				'user_account_id'=>$this->input->post("id",TRUE),
				'user_detail_id'=>$this->input->post("userId",TRUE),
				//'transactionId'=>$this->input->post("transactionId",TRUE),
				//'orderId'=>$this->input->post("orderId",TRUE),
				'paymentType'=>$getRedeemReqData->paymentType,
				'amount'=>$this->input->post("withAmt",TRUE),
				'balance'=>$updateBal,
				'winWallet'=>$updateWinWallet,
				'mainWallet'=>$mainWallet,
				'created'=>date("Y-m-d H:i:s")
			);
		   // print_r($ReqredeemData);echo "<prev>";exit;
			$this->Crud_model->SaveData("user_account",$ReqData,"id='".$_POST['id']."'"); // Save in web_deposit table
			$this->Crud_model->SaveData('user_account_logs',$ReqredeemData);
			$getSetting = $this->Crud_model->GetData('mst_settings','id,site_title','','','','','1');
			/*------  Mail Code -------*/
			$siteTitle=$getSetting->site_title;
			$withdrawAmount = $this->input->post("withAmt");
			$rejectReason = $this->input->post("rejectReason");
            $mail_to=$getSms->email_id;
            $subject='Redeem on ludo fantacy';
            $mail_body ='<html>
				<head>
					<title></title>
				</head>
				<body>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
				        <tbody><tr>
				            <td valign="top" align="left">
				                <center>
				                    <table cellspacing="0" cellpadding="0" width="600">
				                        <tbody><tr>

				                            <td>

				                                <table cellspacing="0" cellpadding="0" width="100%">
				                                    <tbody><tr>
				                                       <td style="padding: 30.0px 0 10.0px 0;"><img src="http://3.20.220.191/admin/assets/images/profile/AT_8033logo.png" id="" alt="logo" width="120"><br></td>
				                                    </tr>
				                                    <tr>
				                                        <td height="150" valign="top">
				                                            <b>
				                                                <span>'.$siteTitle.'</span>
				                                            </b>
				                                            <br>
				                                            <span><small>'.$siteTitle.' is a dream game project of  Games Pvt. Ltd.</small></span>
				                                        </td>
				                                    </tr>

				                                    <tr>
				                                        <td style="height: 180.0px;width: 299.0px;">
				                                        </td>
				                                    </tr>
				                                </tbody></table>
				                            </td>

				                            <td valign="top">
				                                <table cellspacing="0" cellpadding="0" width="100%">
				                                    <tbody><tr>
				                                        <td>
				                                            <table cellspacing="0" cellpadding="0" width="100%">
				                                                <tbody><tr>
				                                                    <td>
				                                                        <table cellspacing="0" cellpadding="10" width="100%">
				                                                            <tbody><tr>
				                                                                <td>
				                                                                    <b>Dear '.$getSms->user_name.',</b>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>

				                                                        <table cellspacing="0" cellpadding="10" width="100%">
				                                                            <tbody><tr>
				                                                                <td>
				                                                                    Your withdrawal request of Rs '.$withdrawAmount.' has been Rejected by Admin due to '.$rejectReason.'. please contact us at  <a href="mailto:support@ludosf.com" target="_blank">support@ludosf.com</a>
				                                                                    <p><b>Thank you,</b></p>
				                                                                    <p><b><i>Team '.$siteTitle.'</i></b></p>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>
				                                                        
				                                                        <table cellspacing="0" cellpadding="0" width="100%">
				                                                            <tbody><tr>
				                                                                <td style="text-align: center;padding-top: 30.0px;"><img src="http://3.20.220.191/admin/uploads/settings/thank-you.png" id="" alt="signature" width="80px"><br>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>
				                                                        <table cellspacing="0" cellpadding="0" width="100%">
				                                                            <tbody><tr>
				                                                                <td>
				                                                                    <b>
				                                                                        <span>'.$siteTitle.'</span>
				                                                                    </b>
				                                                                    <br>
				                                                                    <span><small>'.$siteTitle.' is a dream game project of  Games Pvt. Ltd.</small></span>
				                                                                </td>
				                                                            </tr>
				                                                    </tbody></table></td>
				                                                </tr>
				                                            </tbody></table>
				                                        </td>
				                                    </tr>
				                                </tbody></table>
				                            </td>
				                        </tr>
				                    </tbody></table>
				                </center>
				            </td>
				        </tr>
				    </tbody></table>
				</body>
			</html>';
			//print_r($mail_body);exit;
			$this->load->library("Custom");
    		$this->custom->sendEmailSmtp($subject,$mail_body,$mail_to);
			/*------  Mail Code -------*/

			/*-----  Sms Code --------*/
				/*$sms_body=$this->Crud_model->GetData("mst_sms_body","","smsType='redeem_rejection_sms'",'','','','1');
				$sms_body->smsBody=str_replace("{user_name}",ucfirst($getSms->user_name),$sms_body->smsBody); 
				$sms_body->smsBody=str_replace("{message}",$this->input->post("rejectReason",TRUE),$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getSms->mobile;
				$this->custom->sendSms($mobileNo,$body);*/
			/*-----  /.Sms Code --------*/
			$msg = '<span class="label label-danger">User redeem amount request is reject successfully</span>';
			echo $msg; exit;
		} else {
			redirect(WITHDRAWAL);
		}
	}

	public function CheckAllids(){
		// print_r($_POST['search']);exit;
		$cond = "d.amount != '0' and d.type = 'Withdraw' and d.status IN ('Pending','Process') and u.user_id!=''";
		if(!empty($this->input->post('fromDate')) && !empty($this->input->post('toDate'))) {
			$cond .= " and date(d.created) between '".date("Y-m-d",strtotime($this->input->post('fromDate')))."' and '".date("Y-m-d",strtotime($this->input->post('toDate')))."' ";
		}else if(!empty($this->input->post('fromDate'))) {
			$cond .= " and d.created >= '".date("Y-m-d",strtotime($this->input->post('fromDate')))."'";
		}else if(!empty($this->input->post('toDate'))) {
			$cond .= " and d.created <= '".date("Y-m-d",strtotime($this->input->post('toDate')))."'";
		}
		if(!empty($this->input->post('payment_type'))) {
			$cond .= " and d.paymentType = '".$this->input->post('payment_type')."'";
		}
		if(!empty($this->input->post('searchValue'))) {
			$cond.=" and ( u.user_name  LIKE '%".trim($this->input->post('searchValue'))."%' ";
			$cond.=" OR u.email_id  LIKE '%".trim($this->input->post('searchValue'))."%' ";
			$cond.=" OR d.amount  LIKE '%".trim($this->input->post('searchValue'))."%' ";
			$cond.=" OR u.balance  LIKE '%".trim($this->input->post('searchValue'))."%' ";
			$cond.=" OR d.created  LIKE '%".trim($this->input->post('searchValue'))."%' ";
			$cond.=" OR d.status  LIKE '%".trim($this->input->post('searchValue'))."%') ";
		}
		$getWithdrawData = $this->Withdrawal_model->getExportData('user_account d',$cond);
		// print_r($this->db->last_query());exit;
		if($getWithdrawData) {
        	foreach ($getWithdrawData as $row)  {
            $allData[] = "".$row->id."";
        	}
        	$getWithdrawData = implode(',',$allData);
     	} else {
        	$getWithdrawData = '';
     	}
     	$data = array(
        	"id" => $getWithdrawData,
			"csrfHash" => $this->security->get_csrf_hash(),
			"csrfName" => $this->security->get_csrf_token_name(),
     	);
     	echo json_encode($data);
	}

	public function exportAction() {
		//print_r($_POST);exit;
		if(!empty($this->input->post('payment_type')) && $this->input->post('payment_type')!=''){
			$cond="d.amount != '0' and d.type = 'Withdraw' and d.status IN ('Pending','Process') and u.user_id!=''";
			if(!empty($this->input->post('fromDate')) && !empty($this->input->post('toDate'))) {
				$cond .= " and date(d.created) between '".date("Y-m-d",strtotime($this->input->post('fromDate')))."' and '".date("Y-m-d",strtotime($this->input->post('toDate')))."' ";
			}else if(!empty($this->input->post('fromDate'))) {
				$cond .= " and d.created >= '".date("Y-m-d",strtotime($this->input->post('fromDate')))."'";
			}else if(!empty($this->input->post('toDate'))) {
				$cond .= " and d.created <= '".date("Y-m-d",strtotime($this->input->post('toDate')))."'";
			}
			if(!empty($this->input->post('payment_type'))) {
				$cond .= " and d.paymentType = '".$this->input->post('payment_type')."'";
			}
			if(!empty($this->input->post('allRowIds'))) {
				$cond .= " and d.id in (".$this->input->post('allRowIds').")";
			}
			$getWithdrawalData = $this->Withdrawal_model->getExportData("user_account d",$cond);
			// print_r($this->db->last_query());exit;
			if(!empty($getWithdrawalData)) {
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('');
				
				if($this->input->post('payment_type')=='paytm'){
					$this->excel->getActiveSheet()->setCellValue('A2', "Withdrawal (Paytm)");
					$this->excel->getActiveSheet()->setCellValue('A4', "User's Mobile Number/Email");
					$this->excel->getActiveSheet()->setCellValue('B4', 'Amount');
					$this->excel->getActiveSheet()->setCellValue('C4', 'Beneficiary Name');
					$this->excel->getActiveSheet()->setCellValue('D4', 'Comment');
					$a=5;
					$sr=1;
					foreach ($getWithdrawalData as $report) {
						if(!empty($report->user_name)){ $user_name = $report->user_name; }else{ $user_name = 'NA'; }

						if(!empty($report->mobileNo)){ $mobile = $report->mobileNo; }else if(!empty($report->email_id)){ $mobile = $report->email_id; } else { $mobile = ""; }

						if(!empty($report->amount)){ $amount = $report->amount; }else{ $amount = '0'; }

						$this->excel->getActiveSheet()->setCellValue('A'.$a, $mobile);
						$this->excel->getActiveSheet()->setCellValue('B'.$a, $amount);
						$this->excel->getActiveSheet()->setCellValue('C'.$a, ucfirst($user_name));
						$this->excel->getActiveSheet()->setCellValue('D'.$a, $statusMessage);

						$this->excel->getActiveSheet()->getStyle('A'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('B'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 

						$sr++;

					   $a++;
					}

					//change the font size
					$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

					//set each column width
					$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(26);
					$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
					$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
					$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);

					//set each row height
					$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
					$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

					//make the font become bold
					$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
					$this->excel->getActiveSheet()->getStyle('A4:D4')->getFont()->setBold(true);

					//merge cell A2 until E2
					$this->excel->getActiveSheet()->mergeCells('A1:D1');
					$this->excel->getActiveSheet()->mergeCells('A2:D2');

					//set aligment to center for that merged cell (A2 to E4)
					$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('A4:D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$filename='withdrawal(paytm)'.date('d-m-Y H:i').'.xls';
				} else {
					$this->excel->getActiveSheet()->setCellValue('A2', "Withdrawal (Bank)");
					$this->excel->getActiveSheet()->setCellValue('A4', "A/C Holder Name");
					$this->excel->getActiveSheet()->setCellValue('B4', "A/C Number");
					$this->excel->getActiveSheet()->setCellValue('C4', 'IFSC');
					$this->excel->getActiveSheet()->setCellValue('D4', 'Amount');
					$this->excel->getActiveSheet()->setCellValue('E4', 'Remarks (optional)');
					$a=5;
					$sr=1;
					$acc_ids = array();
					foreach ($getWithdrawalData as $report) {
						if(!empty($report->acc_holderName)){ $acc_holderName = $report->acc_holderName; }else{ $acc_holderName = 'NA'; }
						if(!empty($report->accno)){ $accno = $report->accno; }else{ $accno = 'NA'; }
						if(!empty($report->ifsc)){ $ifsc = $report->ifsc; }else{ $ifsc = 'NA'; }

						// if(!empty($report->mobile)){ $mobile = $report->mobile; }else if(!empty($report->email_id)){ $mobile = $report->email_id; } else { $mobile = ""; }

						if(!empty($report->amount)){ $amount = $report->amount; }else{ $amount = '0'; }

						$this->excel->getActiveSheet()->setCellValue('A'.$a, ucfirst($acc_holderName));
						$this->excel->getActiveSheet()->setCellValue('B'.$a, $accno);
						$this->excel->getActiveSheet()->setCellValue('C'.$a, $ifsc);
						$this->excel->getActiveSheet()->setCellValue('D'.$a, $amount);
						$this->excel->getActiveSheet()->setCellValue('E'.$a, $statusMessage);

						$this->excel->getActiveSheet()->getStyle('B'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('C'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

						$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 

						$sr++;
						$a++;
						array_push($acc_ids, $report->id);
					}

					$data['status'] = 'BankExport';
					$data['statusMessage'] = 'From Export';

					$this->Crud_model->SaveData("user_account",$data,"id in (".implode(",", $acc_ids).")");

					//change the font size
					$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

					//set each column width
					$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(26);
					$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
					$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
					$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
					$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);

					//set each row height
					$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
					$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

					//make the font become bold
					$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
					$this->excel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);

					//merge cell A2 until E2
					$this->excel->getActiveSheet()->mergeCells('A1:E1');
					$this->excel->getActiveSheet()->mergeCells('A2:E2');

					//set aligment to center for that merged cell (A2 to E4)
					$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$filename='withdrawal(bank)'.date('d-m-Y H:i').'.xls';
				}

				//save our workbook as this file name
				ob_end_clean();
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
				
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');

			} else {
				$this->session->set_flashdata('message', 'Record not avaliable.');
				redirect(WITHDRAWAL);
			}
		} else {
			$this->session->set_flashdata('message', 'Please select Payment type.');
			redirect(WITHDRAWAL);
		}
	}

	public function paytmRejectWithdraw(){
		$id= $this->input->post('id',TRUE);
		$explodeId = explode(',', $id);
		$ids =$explodeId;
		$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
		
		if(!empty($ids)){
			$data= array('status'=>'Rejected','modified'=>date("Y-m-d H:i:s"));
			$this->Crud_model->SaveData("user_account",$data,'id in  ('.$id.')');
			foreach ($ids as $id) {
					$userData =$this->Withdrawal_model->getAllRedeemUser("user_account d","d.id='".$id."'");
					$getSms = $this->Crud_model->GetData('user_details','email_id,user_name,mobile,balance,winWallet,mainWallet',"id='".$userData[0]->user_detail_id."'",'','','','');
					$updateBal = $getSms[0]->balance + $userData[0]->amount; 
					//print_r($getSms);
					$updateWinWallet = $getSms[0]->winWallet + $userData[0]->amount; 
					$updateMainWallet = $getSms[0]->mainWallet; 

					$updateUserDetail = array(
						'balance'=>$updateBal,
						'winWallet'=>$updateWinWallet,
						'mainWallet'=>$updateMainWallet,
						);
					$this->Crud_model->SaveData("user_details",$updateUserDetail,"id='".$userData[0]->user_detail_id."'");
					$ReqredeemData = array(
						'status'=>'Rejected',
						'type'=>'Withdraw',
						'user_account_id'=>$id,
						'user_detail_id'=>$userData[0]->user_detail_id,
						'paymentType'=>$userData[0]->paymentType,
						'amount'=>$userData[0]->amount,
						'balance'=>$updateBal,
						'winWallet'=>$updateWinWallet,
						'mainWallet'=>$updateMainWallet,
						'created'=>date("Y-m-d H:i:s")
					);
					$this->Crud_model->SaveData('user_account_logs',$ReqredeemData);
					$getSetting = $this->Crud_model->GetData('mst_settings','id,site_title','','','','','1');
					/*------  Mail Code -------*/
					$siteTitle=$getSetting->site_title;
					$withdrawAmount = $userData[0]->amount;
		            $mail_to=$userData[0]->email_id;
					
		            $userName=$userData[0]->user_name;
					
		            $subject='Redeem on ludo fantacy';
		           
		           
		            $mail_body ='<html>
						<head>
							<title></title>
						</head>
						<body>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
						        <tbody><tr>
						            <td valign="top" align="left">
						                <center>
						                    <table cellspacing="0" cellpadding="0" width="600">
						                        <tbody><tr>

						                            <td>

						                                <table cellspacing="0" cellpadding="0" width="100%">
						                                    <tbody><tr>
						                                       <td style="padding: 30.0px 0 10.0px 0;"><img src="http://3.20.220.191/admin/assets/images/profile/AT_8033logo.png" id="" alt="logo" width="120"><br></td>
						                                    </tr>
						                                    <tr>
						                                        <td height="150" valign="top">
						                                            <b>
						                                                <span>'.$siteTitle.'</span>
						                                            </b>
						                                            <br>
						                                            <span><small>'.$siteTitle.' is a dream game project of  Games Pvt. Ltd.</small></span>
						                                        </td>
						                                    </tr>

						                                    <tr>
						                                        <td style="height: 180.0px;width: 299.0px;">
						                                        </td>
						                                    </tr>
						                                </tbody></table>
						                            </td>

						                            <td valign="top">
						                                <table cellspacing="0" cellpadding="0" width="100%">
						                                    <tbody><tr>
						                                        <td>
						                                            <table cellspacing="0" cellpadding="0" width="100%">
						                                                <tbody><tr>
						                                                    <td>
						                                                        <table cellspacing="0" cellpadding="10" width="100%">
						                                                            <tbody><tr>
						                                                                <td>
						                                                                    <b>Dear '.$userName.',</b>
						                                                                </td>
						                                                            </tr>
						                                                        </tbody></table>

						                                                        <table cellspacing="0" cellpadding="10" width="100%">
						                                                            <tbody><tr>
						                                                                <td>
						                                                                    Your withdrawal request of Rs '.$withdrawAmount.' has been Rejected by Admin ,please contact us at  <a href="mailto:support@ludosf.com" target="_blank">support@ludosf.com</a>
						                                                                    <p><b>Thank you,</b></p>
						                                                                    <p><b><i>Team '.$siteTitle.'</i></b></p>
						                                                                </td>
						                                                            </tr>
						                                                        </tbody></table>
						                                                        
						                                                        <table cellspacing="0" cellpadding="0" width="100%">
						                                                            <tbody><tr>
						                                                                <td style="text-align: center;padding-top: 30.0px;"><img src="http://3.20.220.191/admin/uploads/settings/thank-you.png" id="" alt="signature" width="80px"><br>
						                                                                </td>
						                                                            </tr>
						                                                        </tbody></table>
						                                                        <table cellspacing="0" cellpadding="0" width="100%">
						                                                            <tbody><tr>
						                                                                <td>
						                                                                    <b>
						                                                                        <span>'.$siteTitle.'</span>
						                                                                    </b>
						                                                                    <br>
						                                                                    <span><small>'.$siteTitle.' is a dream game project of  Games Pvt. Ltd.</small></span>
						                                                                </td>
						                                                            </tr>
						                                                    </tbody></table></td>
						                                                </tr>
						                                            </tbody></table>
						                                        </td>
						                                    </tr>
						                                </tbody></table>
						                            </td>
						                        </tr>
						                    </tbody></table>
						                </center>
						            </td>
						        </tr>
						    </tbody></table>
						</body>
					</html>';
					$this->load->library("Custom");
		    		$this->custom->sendEmailSmtp($subject,$mail_body,$mail_to);
					/*------  Mail Code -------*/
				}
			$msg= 'Redeem request rejected';
		}else{
			$msg= 'Not Found';
		}


		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);exit();
	}

	public function paytmAcceptWithdraw(){
		$id= $this->input->post('id',TRUE);
		$explodeId = explode(',', $id);
		$ids =$explodeId;
		$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
		
		if(!empty($ids)){
			foreach ($ids as $id) {
				$userTransactionData =$this->Withdrawal_model->getAllRedeemUser("user_account d","d.id='".$id."'");
				$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
				$admin_rs=($userTransactionData[0]->amount * $getSettData->adminPercent)/100;
				$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');
				$userAmt = $userTransactionData[0]->amount - $admin_rs;
				//$userData =$this->Crud_model->GetData("user_details","id,status,mobile,balance","id='".$userTransactionData[0]->user_detail_id."'","","","","");
				//$order_id = rand(11111111,9999999);
				$order_id = $userTransactionData->orderId;
				/*$beneficiaryAccount= $userBankData->accno;
				$beneficiaryIFSC= $userBankData->ifsc;*/
				$amount=$userAmt;
				$userAccId=$userTransactionData[0]->id;
				$userId=$userTransactionData[0]->user_detail_id;
				$withrawAmt=$userTransactionData[0]->amount;
				$userMobileNo= $userTransactionData[0]->mobileNo;
				
				$getResponse = $this->walletTransferByPaytm($order_id,$amount,$userMobileNo,$userAccId,$userId,$withrawAmt);
			}
			
			$msg= 'Redeem request accepted';
		}else{
			$msg= 'Not Found';
		}


		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);exit();
	}
	
	

	public function walletTransferByPaytm($order_id,$amount,$userMobileNo,$userAccId,$userId,$withrawAmt){
		/*print_r($order_id);echo "<br>";
		print_r($amount);echo "<br>";
		print_r($withrawAmt);echo "<br>";
		print_r($userMobileNo);echo "<br>";
		print_r($userAccId);echo "<br>";
		print_r($userId);echo "<br>";
		exit;*/
		/**
		* import checksum generation utility
		* You can get this utility from https://developer.paytm.com/docs/checksum/
		*/
		//print_r($customer_id);exit()
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
	    // following files need to be included
	   // require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
	    require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");
	    $paytmChecksum = "";

		/* initialize an array */
		$paytmParams = array();

		/* Find Sub Wallet GUID in your Paytm Dashboard at https://dashboard.paytm.com */
		$paytmParams["subwalletGuid"] = "8aaab070-65bb-48d2-a5f3-f763edf6eb0d";
		//$paytmParams["subwalletGuid"] = "258EAFA5-E914-47DA-95CA-C5AB0DC85B11";

		/* Enter your unique order id, this should be unique for every disbursal */
		$paytmParams["orderId"] = $order_id;
		//$paytmParams["orderId"] = "190202";
		    
		/* Enter Beneficiary Phone Number against which the disbursal needs to be made */
		$paytmParams["beneficiaryPhoneNo"] = $userMobileNo;

		/* Amount in INR payable to beneficiary */
		$paytmParams["amount"] = $amount;
		//$paytmParams["timestamp"] = date("Y-m-d h:i:s");

		/* prepare JSON string for request body */
		$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
		/*print_r("https://dashboard.paytm.com/bpay/api/v1/disburse/order/wallet/Gratification");print_r("<br/>");
		print_r($post_data);print_r("<br/>");*/
		/**
		* Generate checksum by parameters we have in body
		* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
		*/
		$checksum = getChecksumFromString($post_data, "sB6awRVJ@YpDm3ZV");
		//$checksum = getChecksumFromString($post_data, "uF9cZaNpABsC&Xxa");

		/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
		$x_mid = "97870791415983";
		//$x_mid = "12966438680092";
		//print_r("x-mid : ".$x_mid);print_r("<br/>");	
		/* put generated checksum value here */
		$x_checksum = $checksum;
		//print_r("x-checksum : ".$x_checksum );print_r("<br/>");		
		/* Solutions offered are: food, gift, gratification, loyalty, allowance, communication */

		/* for Staging */
		//$url = "https://staging-dashboard.paytm.com/bpay/api/v1/disburse/order/wallet/{solution}";

		/* for Production */
		 //$url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/wallet/Gratification";
		 $url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/wallet/gratification";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$resData = curl_exec($ch);
		$response = json_decode($resData);
		$userBal =$this->Crud_model->GetData("user_details","id,status,balance","id='".$userId."'","","","","1");
		$getPaytmData = $this->Crud_model->GetData("user_account",'','id="'.$userAccId.'"','','','','1');
		if($response->status=='ACCEPTED'){
			$resStatus ='Approved';
			$status ='Approved';
			$statusMail ='successfully';
			$content='Congratulations! Your withdrawal request of Rs '.$withrawAmt.' has been processed '.$statusMail.'. Amount will reflect in your account within 24 working hours, if not then please contact us at ';
			if(!empty($getPaytmData) && $getPaytmData->isAdminReedem=='No'){
				$userData =$this->Crud_model->GetData("user_details","id,status,balance","id='".$userId."'","","","","1"); 
				$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
				$admin_rs=($amount*$getSettData->adminPercent)/100;
				$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');
				if (!empty($getAdminData->adminBalance)) {
					$adminTotalAmt = $getAdminData->adminBalance + $admin_rs;
				} else {
					$adminTotalAmt = $admin_rs; 
				}
				$updateAdminData = array(
					'adminBalance'=>$adminTotalAmt,
				);

				$this->Crud_model->SaveData("admin_login",$updateAdminData,"id='".$_SESSION[SESSION_NAME]['id']."'");
				$saveAdminLogData = array(
						'user_account_id'=>$userAccId,
						'from_user_details_id'=>$userId,
						'to_admin_login_id'=>$getAdminData->id,
						'percent'=>$getSettData->adminPercent,
						'total_amount'=>$admin_rs,
						'type'=>'deposit',
					);
				$this->Crud_model->SaveData("admin_account_log",$saveAdminLogData);
				/***** Admin Data *****/
				 $approveData = array(
	                'status'=>$status,
	                'isAdminReedem'=>'Yes',
	                'paymentType'=>'paytm',
	                'paytmStatus'=>$response->status,
		    		'statusCode'=>$response->statusCode,
		    		'statusMessage'=>$response->statusMessage,
		    		'checkSum'=>$x_checksum,
	                'modified'=>date("Y-m-d H:i:s")
	            );
				 $approveDataLog = array(
	                'orderId'=>$order_id,
	                'mobileNo'=>$userMobileNo,
	                'user_account_id'=>$userAccId,
	                'user_detail_id'=>$userId,
	                'amount'=>$amount,
	                'balance'=>$userBal->balance,
	                'type'=>'Withdraw',
	                'paymentType'=>'paytm',
	                'paytmStatus'=>$response->status,
		    		'statusCode'=>$response->statusCode,
		    		'statusMessage'=>$response->statusMessage,
		    		'checkSum'=>$x_checksum,
	                'status'=>$status,
	                'created'=>date("Y-m-d H:i:s")
	            );
				$this->Crud_model->SaveData('user_account',$approveData,'id="'.$userAccId.'"');
				//$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
				$this->Crud_model->SaveData('user_account_logs',$approveDataLog);
				
			}
			
		}elseif($response->status=='FAILURE'){
			$getUserFail = $this->Crud_model->GetData('user_details','email_id,user_name,mobile,balance,winWallet',"id='".$userId."'",'','','','1');
			
			$updateBal =  $getUserFail->balance + $getPaytmData->amount;
			$updatewinWallet =  $getUserFail->winWallet + $getPaytmData->amount;
            $updateUserBal = array(
                'balance'=> $updateBal,
                'winWallet'=> $updatewinWallet,
                );
			$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
			$resStatus ='Failed';
			$status='Failed';
			$statusMail ='failed';
			$content='Your withdrawal request of Rs '.$withrawAmt.' has been processed '.$statusMail.' due to '.$response->statusMessage.' ,please contact us at ';
		}else{
			$getUserFail = $this->Crud_model->GetData('user_details','email_id,user_name,mobile,balance,winWallet',"id='".$userId."'",'','','','1');
			
			$updateBal =  $getUserFail->balance + $getPaytmData->amount;
			$updatewinWallet =  $getUserFail->winWallet + $getPaytmData->amount;
            $updateUserBal = array(
                'balance'=> $updateBal,
                'winWallet'=> $updatewinWallet,
                );
			$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
			$resStatus ='Failed';
			$status='Failed';
			$statusMail ='failed';
			$content='Your withdrawal request of Rs '.$withrawAmt.' has been processed '.$statusMail.' due to '.$response->statusMessage.' ,please contact us at ';
		}
		$saveRefundUpdate = array(
        		'orderId'=>$order_id,
        		'user_detail_id'=>$getPaytmData->user_detail_id,
        		'paytmStatus'=>$resStatus,
        		'statusCode'=>$response->statusCode,
        		'statusMessage'=>$response->statusMessage,
        		'checkSum'=>$x_checksum,
        		'type'=>'Withdraw',
                'status'=>$status,
                'paymentType'=>'paytm',
        		'modified'=>date('Y-m-d H:i:s'),
        	);
        $saveData = $this->Crud_model->SaveData("user_account",$saveRefundUpdate,'id="'.$userAccId.'"');
        $saveRefundUpdateLog = array(
        		'user_account_id'=>$userAccId,
        		'orderId'=>$order_id,
        		'mobileNo'=>$userMobileNo,
        		'amount'=>$getPaytmData->amount,
        		'balance'=>$getPaytmData->balance,
        		'user_detail_id'=>$getPaytmData->user_detail_id,
        		'paytmStatus'=>$response->status,
        		'statusCode'=>$response->statusCode,
        		'statusMessage'=>$response->statusMessage,
        		'checkSum'=>$x_checksum,
        		'type'=>'Withdraw',
        		'paymentType'=>'paytm',
                'status'=>$status,
        		'created'=>date('Y-m-d H:i:s'),
        		'modified'=>date('Y-m-d H:i:s'),
        	);
        $saveData = $this->Crud_model->SaveData("user_account_logs",$saveRefundUpdateLog);
        $getUserDAta=$this->Crud_model->GetData('user_details','id,user_name,email_id,mobile',"id='".$userId."'", '', '', '', '1');
        if($getUserDAta){
        	$siteTitle="LUDO FANTACY";
            $mail_to=$getUserDAta->email_id;
            $subject='Redeem on ludo fantacy';
            $mail_body ='<html>
				<head>
					<title></title>
				</head>
				<body>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
				        <tbody><tr>
				            <td valign="top" align="left">
				                <center>
				                    <table cellspacing="0" cellpadding="0" width="600">
				                        <tbody><tr>

				                            <td>

				                                <table cellspacing="0" cellpadding="0" width="100%">
				                                    <tbody><tr>
				                                       <td style="padding: 30.0px 0 10.0px 0;"><img src="http://3.20.220.191/admin/assets/images/profile/AT_8033logo.png" id="" alt="logo" width="120"><br></td>
				                                    </tr>
				                                    <tr>
				                                        <td height="150" valign="top">
				                                            <b>
				                                                <span>'.$siteTitle.'</span>
				                                            </b>
				                                            <br>
				                                            <span><small>'.$siteTitle.' is a dream game project of  Games Pvt. Ltd.</small></span>
				                                        </td>
				                                    </tr>

				                                    <tr>
				                                        <td style="height: 180.0px;width: 299.0px;">
				                                        </td>
				                                    </tr>
				                                </tbody></table>
				                            </td>

				                            <td valign="top">
				                                <table cellspacing="0" cellpadding="0" width="100%">
				                                    <tbody><tr>
				                                        <td>
				                                            <table cellspacing="0" cellpadding="0" width="100%">
				                                                <tbody><tr>
				                                                    <td>
				                                                        <table cellspacing="0" cellpadding="10" width="100%">
				                                                            <tbody><tr>
				                                                                <td>
				                                                                    <b>Dear '.$getUserDAta->user_name.',</b>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>

				                                                        <table cellspacing="0" cellpadding="10" width="100%">
				                                                            <tbody><tr>
				                                                                <td>
				                                                                    '.$content.' <a href="mailto:support@ludosf.com" target="_blank">support@ludosf.com</a>
				                                                                    <p><b>Thank you,</b></p>
				                                                                    <p><b><i>Team '.$siteTitle.'</i></b></p>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>
				                                                        
				                                                        <table cellspacing="0" cellpadding="0" width="100%">
				                                                            <tbody><tr>
				                                                                <td style="text-align: center;padding-top: 30.0px;"><img src="http://3.20.220.191/admin/uploads/settings/thank-you.png" id="" alt="signature" width="80px"><br>
				                                                                </td>
				                                                            </tr>
				                                                        </tbody></table>
				                                                        <table cellspacing="0" cellpadding="0" width="100%">
				                                                            <tbody><tr>
				                                                                <td>
				                                                                    <b>
				                                                                        <span>'.$siteTitle.'</span>
				                                                                    </b>
				                                                                    <br>
				                                                                    <span><small>'.$siteTitle.' is a dream game project of  Games Pvt. Ltd.</small></span>
				                                                                </td>
				                                                            </tr>
				                                                    </tbody></table></td>
				                                                </tr>
				                                            </tbody></table>
				                                        </td>
				                                    </tr>
				                                </tbody></table>
				                            </td>
				                        </tr>
				                    </tbody></table>
				                </center>
				            </td>
				        </tr>
				    </tbody></table>
				</body>
			</html>';
			//print_r($mail_body);exit;
			///$this->load->library("Custom");
    		$this->custom->sendEmailSmtp($subject,$mail_body,$mail_to);
        }
	}

}
?>