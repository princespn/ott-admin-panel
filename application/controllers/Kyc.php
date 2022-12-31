<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyc extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kyc_model');
		$this->load->helper('Common_helper');
		$this->load->library('email');
		$this->load->library('Custom');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
	} 

	public function index($flag=''){
		//print_r($flag);exit;
		$getKyc=$this->Crud_model->GetData('user_details','kyc_status','','','','','');
		$data=array(
			'heading'=>"Manage Kyc",
			'bread'=>"Manage Kyc",
			'getKyc'=>$getKyc,
			'flag'=>$flag,

			);
		$this->load->view('kyc/list',$data);
	}

	public function ajax_manage_page()
	{    
		$SearchData = $this->input->post('SearchData');
		$SearchData1 = $this->input->post('SearchData1');
		$SearchData2 = $this->input->post('SearchData2');

		$condition[] = "playerType='Real' and u.id!=''";

		if(!empty($SearchData)){
			if($SearchData=='All'){
				$condition[] = "u.kyc_status!='' and u.adharCard_no!='' or u.panCard_no!=''"; 
			}else{
				$condition[] = "u.kyc_status = '".$SearchData."' and ((u.adharCard_no!='' and u.is_aadharVerified = '".$SearchData."') or (u.panCard_no!='' and u.is_panVerified = '".$SearchData."'))";
			}
		}

		
		if ($SearchData1 && $SearchData2) {
			$condition[] = "date(u.kycDate) between '".date("Y-m-d",strtotime($SearchData1))."' and '".date("Y-m-d",strtotime($SearchData2))."'";
		}elseif ($SearchData1){
			$condition[] = "date(u.kycDate) ='".date("Y-m-d",strtotime($SearchData1))."'";
		}elseif ($SearchData2){
			$condition[] = "date(u.kycDate) ='".date("Y-m-d",strtotime($SearchData2))."'";
		}

		$cond= implode(" and ", $condition);
		
		$getKyc = $this->Kyc_model->get_datatables('user_details u',$cond);
		//print_r($this->db->last_query());exit;
		if(empty($_POST['start']))
		{
			$no =0;   
		}else{
			 $no =$_POST['start'];
		}
		$data = array();
				  
		foreach ($getKyc as $kycData) 
		{
			
			$btn = '';
			$btn = ''.anchor(site_url(KYCVIEW.'/'.base64_encode($kycData->id)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>');

		 
			if($kycData->kyc_status=='Pending')
			{      
				$kyc_status = '<a class="label label-warning"><b>'.$kycData->kyc_status.'</b></a>';
			}
			elseif($kycData->kyc_status=='Rejected')
			{
				$kyc_status = '<a class="label label-danger"><b>'.$kycData->kyc_status.'</b></a>';
			}else{
				$kyc_status = '<a class="label label-success" ><b>'.$kycData->kyc_status.'</b></a>';
			}

			if($kycData->is_mobileVerified=='Yes')
			{      
				$is_mobileVerified = '<a class="label label-success"><b>'.$kycData->is_mobileVerified.'</b></a>';
			}
			elseif($kycData->is_mobileVerified=='No')
			{
				$is_mobileVerified = '<a class="label label-danger" ><b>'.$kycData->is_mobileVerified.'</b></a>';
			}else{
				$is_mobileVerified = 'NA';
			}

			if(!empty($kycData->adharCard_no) && !empty($kycData->is_aadharVerified) && $kycData->is_aadharVerified =='Pending')
			{      
				$is_aadharVerified = '<a class="label label-warning"><b>'.$kycData->is_aadharVerified.'</b></a>';
			}
			elseif(!empty($kycData->adharCard_no) && !empty($kycData->is_aadharVerified) && $kycData->is_aadharVerified =='Rejected')
			{
				$is_aadharVerified = '<a class="label label-danger"><b>'.$kycData->is_aadharVerified.'</b></a>';
			}elseif(!empty($kycData->adharCard_no) && !empty($kycData->is_aadharVerified) && $kycData->is_aadharVerified =='Verified'){
				$is_aadharVerified = '<a class="label label-success" ><b>'.$kycData->is_aadharVerified.'</b></a>';
			}else{
				$is_aadharVerified="NA";
			}

			if(!empty($kycData->panCard_no) && !empty($kycData->is_panVerified) && $kycData->is_panVerified=='Pending')
			{      
				$is_panVerified = '<a class="label label-warning"><b>'.$kycData->is_panVerified.'</b></a>';
			}
			elseif(!empty($kycData->panCard_no) && !empty($kycData->is_panVerified) && $kycData->is_panVerified=='Rejected')
			{
				$is_panVerified = '<a class="label label-danger" "><b>'.$kycData->is_panVerified.'</b></a>';
			}elseif(!empty($kycData->panCard_no) && !empty($kycData->is_panVerified) && $kycData->is_panVerified=='Verified'){
				$is_panVerified = '<a class="label label-success" ><b>'.$kycData->is_panVerified.'</b></a>';
			}else{
				$is_panVerified="NA";
			}

			
			/*if(!empty($kycData->accno) && !empty($kycData->is_bankVerified) && $kycData->is_bankVerified=='Pending')
			{      
				$is_bankVerified = '<a class="label label-warning"><b>'.$kycData->is_bankVerified.'</b></a>';
			}
			elseif(!empty($kycData->accno) &&  !empty($kycData->is_bankVerified)  && $kycData->is_bankVerified =='Rejected')
			{
				$is_bankVerified = '<a class="label label-danger"><b>'.$kycData->is_bankVerified.'</b></a>';
			}elseif(!empty($kycData->accno) &&  !empty($kycData->is_bankVerified)  && $kycData->is_bankVerified =='Verified'){
				$is_bankVerified = '<a class="label label-success" ><b>'.$kycData->is_bankVerified.'</b></a>';
			}else{
				$is_bankVerified="NA";
			}
			*/

			if(!empty($kycData->user_name)){ $user_name = $kycData->user_name; }else{ $user_name = 'NA'; }

			if(!empty($kycData->email_id)){ $email_id = $kycData->email_id; }else{ $email_id = 'NA'; }

			if(!empty($kycData->mobile)){ $mobile = $kycData->mobile; }else{ $mobile = 'NA'; }

			if(!empty($kycData->kycDate) && $kycData->kycDate!='0000-00-00'){ $kycDate = date("d M Y",strtotime($kycData->kycDate)); }else{ $kycDate = 'NA'; }

			if(!empty($kycData->bank_name)){ $bankDetails = $kycData->bank_name; }else{ $bankDetails = 'NA'; }

			// if(!empty($kycData->pan_img) )
			// {
			// 	$panImg =  '<a class="label label-success" onClick="return getImage('.$kycData->id.',\'pan_img\');">View Image</a>';
			// }else{ 
			// 	$panImg = 'NA'; 
			// }

			// if(!empty($kycData->adhar_img))
			// {
			// 	$adharImg = '<a class="label label-success" onClick="return getImage('.$kycData->id.',\'adhar_img\');">View Image</a>';
			// }else{ 
			// 	$adharImg = 'NA'; 
			// }

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucfirst($user_name);
			$nestedData[] = $email_id;
			$nestedData[] = $mobile;
			$nestedData[] = $kycDate;
			$nestedData[] = $is_mobileVerified;
			$nestedData[] = $is_aadharVerified;
			$nestedData[] = $is_panVerified;
			/*$nestedData[] = $is_bankVerified;*/
			$nestedData[] = $kyc_status;
			$nestedData[] = $btn;
			
			$data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->Kyc_model->count_all('user_details u',$cond),
					"recordsFiltered" => $this->Kyc_model->count_filtered('user_details u',$cond),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	public function view($id)
	{
		$id=base64_decode($id);
		$cond = "ud.id = '".$id."'";
		$getKycData = $this->Kyc_model->getKyc("user_details ud",$cond);
		//print_r($getKycData);exit;
		$data=array(
			'heading'=>"View Kyc",
			'breadhead'=>"Manage Kyc",
			'bread'=>"View Kyc",
			'getKycData'=>$getKycData,
			);
		$this->load->view('kyc/view',$data);
	}

	public function verifyKyc(){
		$response = array(
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash()
				);
		$cond = "id = '".$_POST['id']."'";
		$getKycData = $this->Crud_model->GetData("user_details",'',$cond,'','','','1');

		if($getKycData->kyc_status == 'Pending')
		{
			$data=array(
					'kyc_status'=>"Verified",
				);
		}elseif($getKycData->kyc_status == 'Rejected'){
			$data=array(
				'kyc_status'=>"Rejected",
			);
		}else{
			$data=array(
					'kyc_status'=>"Pending",
				);
		}

		$this->Crud_model->SaveData("user_details",$data,$cond);
		$msg='<div class="alert-success padd">Status has been changed successfully</div>';
		//echo $msg;exit();
		$response['msg'] = $msg;
		echo json_encode($response);
	}

	public function getImage()
	{
		$con = "id='".$this->input->post('id')."' ";
		$getImg = $this->Crud_model->GetData('user_details','pan_img,adhar_img',$con,'','','','1');
		if(!empty($getImg))
		{
			if($this->input->post('imgType') == 'pan_img')
			{
				$image = $getImg->pan_img;
				$title = "Pan Image";
			}
			else
			{
				$image = $getImg->adhar_img;
				$title = "Adhar Image";
			}
		}
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'getImg'=> base_url('assets/images/kycImages/'.$image),
			'title'=> $title,
		);
		echo json_encode($response);
	}

	public function getBankDetail()
	{
		$con = "user_detail_id='".$this->input->post('id')."'";
		$getDetail = $this->Crud_model->GetData('bank_details','',$con,'','','','1');
		$response = array(
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash(),
				'title' =>'Bank Detail',
			);
		if(!empty($getDetail))
		{
			$response['success']=1;
			$response['message']="success";

			$response['getTable'] = '<table class="table table-bordered table-striped" style="width: 100%;">
								<thead>
								<tr>
								  <th>Bank Name</th>
								  <th>Account No.</th>
								  <th>City</th>
								  <th>Branch</th>
								  <th>IFSC Code</th>
								</tr>
								</thead>
								<tbody>
									<td>'.$getDetail->bank_name.'</td>
									<td>'.$getDetail->accno.'</td>
									<td>'.$getDetail->bank_city.'</td>
									<td>'.$getDetail->bank_branch.'</td>
									<td>'.$getDetail->ifsc.'</td>
								</tbody>
							  </table>';
		}else{
			$response['success']=0;
			$response['message']="No record found";
			$response['getName']="No record found";
		}
		echo json_encode($response);
	}


	public function updateBankStatus()
	{
		// print_r($_POST);exit;
		$getUser = $this->Kyc_model->getKyc("user_details ud","ud.id='".$_POST['userId']."'");
		
		//print_r($getUser);
		$kycStatus = $this->input->post('isbankStatusVerify');
		// if($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Verified' && ($getUser->is_aadharVerified == 'Verified' || $getUser->is_panVerified == 'Verified' )){
		// 	$kycStatus = 'Verified';
		// }elseif($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Rejected' && ($getUser->is_aadharVerified == 'Rejected' || $getUser->is_panVerified == 'Rejected' )){
		// 	$kycStatus='Rejected';
		// }else{
		// 	$kycStatus='Pending';
		// }
		if($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Verified' && $getUser->is_aadharVerified == 'Verified' && $getUser->is_panVerified == 'Verified' ){
			$kycStatus = 'Verified';
		}elseif($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Rejected' && $getUser->is_aadharVerified == 'Rejected' || $getUser->is_panVerified == 'Rejected' ){
			$kycStatus='Rejected';
		}else{
			$kycStatus='Pending';
		}
		$dataBank = array(
			'is_bankVerified'=>$_POST['isbankStatusVerify'],
		);

		$data = array(
			'isBankVerified'=>$_POST['isbankStatusVerify'],
			'bankRejectionReason'=>$_POST['bankRejectionReason'],
			'kyc_status'=>$kycStatus,
			'kycDate'=>date("Y-m-d"),
		);
		$KycBankDataLog=array(
			'user_detail_id'=>$this->input->post('userId'),
			'acc_holderName'=>$getUser->acc_holderName,
			'accno'=>$getUser->accno,
			'ifsc'=>$getUser->ifsc,
			'bank_name'=>$getUser->bank_name,
			'bank_city'=>$getUser->bank_city,
			'is_bankVerified'=>$_POST['isbankStatusVerify'],
			'kyc_status'=>$kycStatus,
			'created'=>date("Y-m-d H:i:s"),
		);
		/*print_r($data);echo "<br>";;
		print_r($KycBankDataLog);exit;*/
		$this->Crud_model->SaveData('bank_details',$dataBank,"user_detail_id='".$_POST['userId']."'");
		$this->Crud_model->SaveData('user_details',$data,"id='".$_POST['userId']."'");
		$this->Crud_model->SaveData('kyc_logs',$KycBankDataLog);

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Pending'){
			$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","bank details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," is Pending.".$_POST['bankRejectionReason'],$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);
				
			}
		}
		
		if($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Verified'){
			$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","bank details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," has been approved successfully.".$_POST['bankRejectionReason'],$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);

			}
		}

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isbankStatusVerify'] == 'Rejected'){
			$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","bank details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," rejected reason is ".$_POST['bankRejectionReason'],$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);
			}
		}
		echo 1;exit;
	}
	
	public function updateAadharStatus()
	{
		// print_r($_POST);exit;
		$getUser = $this->Kyc_model->getKyc("user_details ud","ud.id='".$_POST['userId']."'");
		$kycStatus = $this->input->post('isAadharStatusVerify');
		if($getUser->is_mobileVerified == 'Yes'  && $getUser->is_panVerified == 'Verified' && $_POST['isAadharStatusVerify'] == 'Verified'){
			$kycStatus = 'Verified';
		}elseif($getUser->is_mobileVerified == 'Yes' && $getUser->is_panVerified == 'Rejected' && $_POST['isAadharStatusVerify'] == 'Rejected'){
			$kycStatus='Rejected';
		}else{
			$kycStatus='Pending';
		}

		$data = array(
			'is_aadharVerified'=>$_POST['isAadharStatusVerify'],
			'aadharRejectionReason'=>$_POST['aadharRejectionReason'],
			'kyc_status'=>$kycStatus,
			'kycDate'=>date("Y-m-d"),
		);
		//print_r($data);exit;
		$KycBankDataLog=array(
			'user_detail_id'=>$this->input->post('userId'),
			'adharCard_no'=>$getUser->adharCard_no,
			'adharFron_img'=>$getUser->adharFron_img,
			'adharBack_img'=>$getUser->adharBack_img,
			'is_aadharVerified'=>$_POST['isAadharStatusVerify'],
			'kyc_status'=>$kycStatus,
			'created'=>date("Y-m-d H:i:s"),
		);
		/*print_r($data);echo "<br>";
		print_r($KycBankDataLog);exit;*/
		$this->Crud_model->SaveData('user_details',$data,"id='".$_POST['userId']."'");
		 $this->Crud_model->SaveData('kyc_logs',$KycBankDataLog);

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isAadharStatusVerify'] == 'Pending'){
				$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","aadhar card document details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," is pending.",$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				// $this->custom->sendSms($mobileNo,$body);
			}
		}


		if($getUser->is_mobileVerified == 'Yes' && $_POST['isAadharStatusVerify'] == 'Verified'){
				$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","aadhar card document details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," has been approved successfully.",$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);
			}
		}

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isAadharStatusVerify'] == 'Rejected'){
				$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","aadhar card document details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," rejected reason is ".$_POST['aadharRejectionReason'],$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				// $this->custom->sendSms($mobileNo,$body);
			   // print_r($this->db->last_query());exit;
			}
		}

		if(isset($getUser->playerId) && !empty($getUser->playerId)){
			$subject = "KYC Verification";
			sendNotification($subject,$body,$getUser->playerId);
		}

		echo 1;exit;
	}


	public function updatePanStatus()
	{
		$getUser = $this->Kyc_model->getKyc("user_details ud","ud.id='".$_POST['userId']."'",'','','','1');

		$kycStatus = $this->input->post('isPanStatusVerify');
		if($getUser->is_mobileVerified == 'Yes' &&  ($getUser->is_aadharVerified == 'Verified' && $_POST['isPanStatusVerify'] == 'Verified')){
			$kycStatus = 'Verified';
		}else if($getUser->is_mobileVerified == 'Yes' && $getUser->is_aadharVerified == 'Rejected' && $_POST['isPanStatusVerify'] == 'Rejected'){
			$kycStatus='Rejected';
		}else{
			$kycStatus='pending';
		}
		
		$data = array(
			'is_panVerified'=>$_POST['isPanStatusVerify'],
			'panRejectionReason'=>$_POST['panRejectionReason'],
			'kyc_status'=>$kycStatus,
			'kycDate'=>date("Y-m-d"),
		);
		$this->Crud_model->SaveData('user_details',$data,"id='".$_POST['userId']."'");

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isPanStatusVerify'] == 'Pending'){
				$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","pan card document details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," is pending.",$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);
			}
		}

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isPanStatusVerify'] == 'Verified'){
				$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","pan card document details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," has been approved successfully.",$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);
			}
		}

		if($getUser->is_mobileVerified == 'Yes' && $_POST['isPanStatusVerify'] == 'Rejected'){
			$sms_body=$this->Crud_model->GetData('mst_sms_body','',"smsType='kyc_type_message'",'','','','1');
			if(!empty($sms_body))
			{
				$sms_body->smsBody=str_replace("{user_name}",$getUser->user_name,$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{kyc_type}","pan card document details",$sms_body->smsBody);
				$sms_body->smsBody=str_replace("{message}"," rejected reason is ".$_POST['panRejectionReason'],$sms_body->smsBody);
				$body=$sms_body->smsBody;
				$mobileNo=$getUser->mobile;
				$this->custom->sendSms($mobileNo,$body);
			}
		}

		if(isset($getUser->playerId) && !empty($getUser->playerId)){
			$subject = "Pan Card Verification";
			sendNotification($subject,$body,$getUser->playerId);
		}

		echo 1;exit;
	}


	function exportAction() {
		$getKycData = $this->Kyc_model->getReportData("user_details u","playerType='Real' and u.id!=''");
		if(!empty($getKycData)) {
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('');
			
			$this->excel->getActiveSheet()->setCellValue('A2', 'Kyc');
			$this->excel->getActiveSheet()->setCellValue('A4', 'Sr. No.');
			$this->excel->getActiveSheet()->setCellValue('B4', 'Name');
			$this->excel->getActiveSheet()->setCellValue('C4', 'Email');
			$this->excel->getActiveSheet()->setCellValue('D4', 'Mobile');
			$this->excel->getActiveSheet()->setCellValue('E4', 'Kyc Date');
			$this->excel->getActiveSheet()->setCellValue('F4', 'Mobile Verified');
			$this->excel->getActiveSheet()->setCellValue('G4', 'Aadhaar Verified');
			$this->excel->getActiveSheet()->setCellValue('H4', 'Pan Verified');
			$this->excel->getActiveSheet()->setCellValue('I4', 'Bank Verified');
			$this->excel->getActiveSheet()->setCellValue('J4', 'Status');
			$a=5;
			$sr=1;
			foreach ($getKycData as $report) {
				if(!empty($report->user_name)){ $user_name = $report->user_name; }else{ $user_name = 'NA'; }

				if(!empty($report->email_id)){ $email_id = $report->email_id; }else{ $email_id = 'NA'; }

				if(!empty($report->mobile)){ $mobile = $report->mobile; }else{ $mobile = 'NA'; }

				if(!empty($report->kycDate) && $report->kycDate!='0000-00-00'){ $kycDate = date("d M Y",strtotime($report->kycDate)); }else{ $kycDate = 'NA'; }

				if(!empty($report->is_mobileVerified)){ $is_mobileVerified = $report->is_mobileVerified; }else{ $is_mobileVerified = 'NA'; }

				if(!empty($report->adharCard_no) && !empty($report->is_aadharVerified)){ $is_aadharVerified = $report->is_aadharVerified; }else{ $is_aadharVerified = 'NA'; }

				if(!empty($report->panCard_no) && !empty($report->is_panVerified)){ $is_panVerified = $report->is_panVerified; }else{ $is_panVerified = 'NA'; }

				if(!empty($report->accno) && !empty($report->is_bankVerified)){ $is_bankVerified = $report->is_bankVerified; }else{ $is_bankVerified = 'NA'; }

				if(!empty($report->kyc_status)){ $kyc_status = $report->kyc_status; }else{ $kyc_status = 'NA'; }

				$this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
				$this->excel->getActiveSheet()->setCellValue('B'.$a, ucfirst($user_name));
				$this->excel->getActiveSheet()->setCellValue('C'.$a, $email_id);
				$this->excel->getActiveSheet()->setCellValue('D'.$a, $mobile);
				$this->excel->getActiveSheet()->setCellValue('E'.$a, $kycDate);
				$this->excel->getActiveSheet()->setCellValue('F'.$a, $is_mobileVerified);
				$this->excel->getActiveSheet()->setCellValue('G'.$a, $is_aadharVerified);
				$this->excel->getActiveSheet()->setCellValue('H'.$a, $is_panVerified);
				$this->excel->getActiveSheet()->setCellValue('I'.$a, $is_bankVerified);
				$this->excel->getActiveSheet()->setCellValue('J'.$a, ucfirst($kyc_status));

				$this->excel->getActiveSheet()->getStyle('A'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('D'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 

				$sr++;

			   $a++;
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

			//set each column width
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(18);

			//set each row height
			$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);

			//merge cell A2 until E2
			$this->excel->getActiveSheet()->mergeCells('A1:J1');
			$this->excel->getActiveSheet()->mergeCells('A2:J2');

			//set aligment to center for that merged cell (A2 to E4)
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$filename='kyc_'.date('d-m-Y H:i').'.xls';
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
			redirect(KYC);
		}
	}
}
