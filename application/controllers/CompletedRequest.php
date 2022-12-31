<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompletedRequest extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('CompletedRequest_model');
	} 

	public function index()
	{
		$getUsers = $this->Crud_model->GetData('user_details','','playerType="Real" and status="Active"');
		$data=array(
			'heading'=>"Completed Request",
			'bread'=>"Manage Completed Request",
			'getUsers'=>$getUsers,
			);
		$this->load->view('withdrawal/comp_list',$data);
	}


	public function ajax_manage_page()
	{
		$condition = "ua.type='Withdraw' and ua.status='Approved' and ua.paymentType in ('bank','paytm')";
		if(!empty($this->input->post('SearchData')) && !empty($this->input->post('SearchData1'))) {
			$condition .= " and date(ua.created) between '".date("Y-m-d",strtotime($this->input->post('SearchData')))."' and '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."' ";
		}else if(!empty($this->input->post('SearchData'))) {
			$condition .= " and date(ua.created) >= '".date("Y-m-d",strtotime($this->input->post('SearchData')))."'";
		}else if(!empty($this->input->post('SearchData1'))) {
			$condition .= " and date(ua.created) <= '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."'";
		}
		if(!empty($this->input->post('SearchData2'))) {
			$condition .= " and ua.paymentType = '".$this->input->post('SearchData2')."'";
		}

		$getPenWith = $this->CompletedRequest_model->get_datatables('user_account ua',$condition);
		// print_r($getPenWith);exit();

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

			$btn = ''.anchor(site_url(WITHDRAWALCOMPREQVIEW.'/'.base64_encode($PendingWithd->id)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View">View</span>');



			if(!empty($PendingWithd->user_name)){ $user_name = $PendingWithd->user_name; }else{ $user_name = 'NA'; }
			if(!empty($PendingWithd->mobileNo)){ $mobileNo = $PendingWithd->mobileNo; }else{ $mobileNo = 'NA'; }

			if(!empty($PendingWithd->orderId)){ $orderId = $PendingWithd->orderId; }else{ $orderId = 'NA'; }

			if(!empty($PendingWithd->amount)){ $amount = $PendingWithd->amount; }else{ $amount = 'NA'; }

			if(!empty($PendingWithd->paymentType)){ $paymentType = $PendingWithd->paymentType; }else{ $paymentType = 'NA'; }

			if(!empty($PendingWithd->created) && $PendingWithd->created !="0000-00-00 00:00:00"){ $created = date('d M Y H:i A', strtotime($PendingWithd->created)); }else{ $created = 'NA'; }
			
			if(!empty($PendingWithd->modified) && $PendingWithd->modified !="0000-00-00 00:00:00"){ $modified = date('d M Y H:i A', strtotime($PendingWithd->modified)); }else{ $modified = 'NA'; }
		 
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucfirst($user_name);
			$nestedData[] = $mobileNo;
			$nestedData[] = $orderId;
			$nestedData[] = $amount;
			$nestedData[] = $paymentType;
			$nestedData[] = $created;
			$nestedData[] = $modified;
			$nestedData[] = $btn;
			
			$data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->CompletedRequest_model->count_all('user_account ua',$condition),
					"recordsFiltered" => $this->CompletedRequest_model->count_filtered('user_account ua',$condition),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}


	public function viewRequest($id){
		$id = base64_decode($id);
		$this->db->select('d.*,u.user_name,u.user_id,u.user_name,u.email_id,u.balance,u.mobile,bd.acc_holderName,bd.accno,bd.ifsc');
		$this->db->from("user_account d"); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left");
		$this->db->join("bank_details bd","bd.user_detail_id=d.user_detail_id","left");
		$this->db->order_by('d.id DESC'); 
		$this->db->where("d.id='".$id."' and d.type='Withdraw' and d.status='Approved'");
		$queryData = $this->db->get()->row();

		$data = array(
			"getData" => $queryData,
			"heading" => "Completed Request",
			"breadhead" => "Completed Request",
			"bread" => "View Completed request",
		);
		// print_r($data);exit;

		$this->load->view('withdrawal/view_comp_list',$data);
	}



	public function exportAction(){
		
		if(!empty($this->input->post('payment_type')) && $this->input->post('payment_type')!=''){
			$condition = "ua.type='Withdraw' and ua.status='Approved' and ua.paymentType in ('bank','paytm')";
			if(!empty($this->input->post('fromDate')) && !empty($this->input->post('toDate'))) {
				$condition .= " and date(ua.created) between '".date("Y-m-d",strtotime($this->input->post('fromDate')))."' and '".date("Y-m-d",strtotime($this->input->post('toDate')))."' ";
			}else if(!empty($this->input->post('fromDate'))) {
				$condition .= " and ua.created >= '".date("Y-m-d",strtotime($this->input->post('fromDate')))."'";
			}else if(!empty($this->input->post('toDate'))) {
				$condition .= " and ua.created <= '".date("Y-m-d",strtotime($this->input->post('toDate')))."'";
			}
			if(!empty($this->input->post('payment_type'))) {
				$condition .= " and ua.paymentType = '".$this->input->post('payment_type')."'";
			}
			$getUserData = $this->CompletedRequest_model->getExportData('user_account ua',$condition);

			if(!empty($getUserData)) {
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
					foreach ($getUserData as $report) {
						if(!empty($report->user_name)){ $user_name = $report->user_name; }else{ $user_name = 'NA'; }

						if(!empty($report->mobileNo)){ $mobile = $report->mobileNo; }else if(!empty($report->email_id)){ $mobile = $report->email_id; } else { $mobile = ""; }

						if(!empty($report->amount)){ $amount = $report->amount; }else{ $amount = '0'; }
						if(!empty($report->statusMessage)){ $statusMessage = $report->statusMessage; }else{ $statusMessage = 'NA'; }

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
					$filename='completed withdrawl(paytm)'.date('d-m-Y H:i').'.xls';
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
					foreach ($getUserData as $report) {
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
					$filename='completed withdrawal(bank)'.date('d-m-Y H:i').'.xls';
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
				redirect(WITHDRAWALCOMPREQ);
			}
		} else {
			$this->session->set_flashdata('message', 'Please select Payment type.');
			redirect(WITHDRAWALCOMPREQ);
		}
	}

}