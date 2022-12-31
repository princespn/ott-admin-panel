<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BankExpWithdrawRequest extends CI_Controller {

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
				'heading'=>"Manage Bank Export Withdrawal",
				'bread'=>"Manage Bank Export Withdrawal"
			);
		$this->load->view('withdrawal/bankexport_list',$data);
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

		$cond = "d.amount != '0' and d.type = 'Withdraw' and d.status IN ('BankExport') and u.user_id!=''";
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
			/*$btn ='<span class=" action-buttons"><a class="btn btn-success btn-xs" href="'.site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($listData->id)).'" title="Approve User Redeem Request"><i class="ace-icon fa fa-check-circle"></i></a></span>';*/

			$btn .= ''.anchor(site_url(USERVIEW.'/'.base64_encode($listData->user_detail_id)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>');
			if($listData->status=='BankExport'){
				$listData->status = 'Pending';
			}
			
			if ($listData->status == 'Approved') { $status = '<span class="label label-success">'.$listData->status.'</span>'; } else if ($listData->status == 'Pending') { $status = '<span class="label label-warning">'.$listData->status.'</span>'; } else { $status = '<span class="label label-danger">'.$listData->status.'</span>'; }

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


			$no++;
			$nestedData = array();
			//$nestedData[] = '<input type="checkbox" '.$check.' id="checkid'.$listData->id.'" onchange="chageSelect('.$listData->id.');" name="checkid[]" class="checkid checkid'.$listData->id.'" value="'.$listData->id.'">';
			$nestedData[] = '<input type="checkbox" '.$check.' id="checkid_'.$listData->id.'" onchange="selectSingle(this.value);" name="checkid[]" class="checkid checkid'.$listData->id.'" value="'.$listData->id.'">';
			//$nestedData[] = '<input type="checkbox" '.$check.' id="chk" onchange="changeSelect('.$listData->id.');" name="selected[]" class="chk" value="'.$listData->id.'">';
			$nestedData[] = $no;
			$nestedData[] = ucfirst($listData->user_name);
			$nestedData[] = $listData->email_id;
			$nestedData[] = $listData->amount;
			$nestedData[] = $adPercent." % (&#8377; ".$adminAmount.")"; 
			$nestedData[] = "&#8377; ".$main_user_rs;  
			$nestedData[] = "&#8377; ".round($listData->balance,2);   
			$nestedData[] = date("d F Y h:i A",strtotime($listData->created));
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

	
	public function bankAcceptedRedem(){
		$id= $this->input->post('id',TRUE);
		$explodeId = explode(',', $id);
		$ids =$explodeId;
		$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
		
		if(!empty($id)){
			$data= array('status'=>'Approved');
			$this->Crud_model->SaveData("user_account",$data,'id in  ('.$id.')');
			foreach ($ids as $id) {
					$userData =$this->Withdrawal_model->getAllRedeemUser("user_account d","d.id='".$id."'");
					$getSetting = $this->Crud_model->GetData('mst_settings','id,site_title','','','','','1');
					/*------  Mail Code -------*/
					$siteTitle=$getSetting->site_title;
					$withdrawAmount = $userData[0]->amount;
					//$rejectReason = $this->input->post("rejectReason");
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
																							Congratulations! Your withdrawal request of Rs '.$withdrawAmount.' has been processed successfully. Amount will reflect in your account within 24 working hours, if not then please contact us at <a href="mailto:support@ludosf.com" target="_blank">support@ludosf.com</a>
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

	public function bankRejectedRedem(){
		
		$id= $this->input->post('id',TRUE);
		$explodeId = explode(',', $id);
		$ids =$explodeId;
		$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
		
		if(!empty($id)){
			$data= array('status'=>'Rejected','modified'=>date("Y-m-d H:i:s"));
			$this->Crud_model->SaveData("user_account",$data,'id in  ('.$id.')');
			if(!empty($ids)){
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

	public function CheckAllids(){
		// print_r($_POST['search']);exit;
		$cond = "d.amount != '0' and d.type = 'Withdraw' and d.status IN ('BankExport') and u.user_id!=''";
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

		$cond = "d.amount != '0' and d.type = 'Withdraw' and d.status IN ('BankExport') and u.user_id!=''";
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
				if(!empty($report->statusMessage)){ $statusMessage = $report->statusMessage; }else{ $statusMessage = 'NA'; }

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
			$filename='bank_export_withdrawal(bank)'.date('d-m-Y H:i').'.xls';
			
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
			redirect(WITHDRAWALBANKEXPORT);
		}
	}
	
	
}
?>