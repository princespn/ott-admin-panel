<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('Deposit_model');
	} 

	public function index()
	{
		$data=array(
			'heading'=>"Manage Deposit",
			'bread'=>"Manage Deposit",

			);
		$this->load->view('deposit/list',$data);
	}

	public function ajax_manage_page()
	{
		$cond='d.type="Deposit" and d.amount !="0" and u.id!=""';

		if(!empty($this->input->post('SearchData')) && !empty($this->input->post('SearchData1'))) {
			$cond .= " and date(d.created) between '".date("Y-m-d",strtotime($this->input->post('SearchData')))."' and '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."' ";
		}else if(!empty($this->input->post('SearchData'))) {
			$cond .= " and date(d.created) = '".date("Y-m-d",strtotime($this->input->post('SearchData')))."'";
		}else if(!empty($this->input->post('SearchData1'))) {
			$cond .= " and date(d.created) = '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."'";
		}
		$getDeposit = $this->Deposit_model->get_datatables('user_account d',$cond);
	   // print_r($this->db->last_query());exit;

		if(empty($_POST['start']))
		{
			$no =0;   
		}else{
			 $no =$_POST['start'];
		}
		$data = array();
				  
		foreach ($getDeposit as $getDepositData) 
		{
			
			// $btn = '';
			// $btn = ''.anchor(site_url(USERVIEW.'/'.base64_encode($getDepositData->id)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>');

			// $btn .="&nbsp;&nbsp;". anchor(site_url('users/delete/'.base64_encode($getDepositData->id)),"<button title='Delete' onclick='return confirm(\"Are you sure want to delete this record?\");' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>");

			if(!empty($getDepositData->user_name)){ $user_name = $getDepositData->user_name; }else{ $user_name = 'NA'; }

			if(!empty($getDepositData->amount)){ $amount = $getDepositData->amount; }else{ $amount = 'NA'; }

			if(!empty($getDepositData->transactionId)){ $transactionId = $getDepositData->transactionId; }else{ $transactionId = 'NA'; }

			if(!empty($getDepositData->created)){ $created = $getDepositData->created; }else{ $created = 'NA'; }

			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucfirst($user_name);
			$nestedData[] = $getDepositData->email_id;
			$nestedData[] = $amount;
			$nestedData[] = date('d F Y h:i A', strtotime($created));
			$nestedData[] = $transactionId;
			//$nestedData[] = $btn;
			
			$data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->Deposit_model->count_all('user_account d',$cond),
					"recordsFiltered" => $this->Deposit_model->count_filtered('user_account d',$cond),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	public function exportAction() {
		$cond='d.type="Deposit" and d.amount !="0" and paymentType!="byAdmin"';
		$getDepositData = $this->Deposit_model->getDepositData("user_account d",$cond);
		if(!empty($getDepositData)) {
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('');
			
			$this->excel->getActiveSheet()->setCellValue('A2', 'Deposit');
			$this->excel->getActiveSheet()->setCellValue('A4', 'Sr. No.');
			$this->excel->getActiveSheet()->setCellValue('B4', 'Name');
			$this->excel->getActiveSheet()->setCellValue('C4', 'Email');
			$this->excel->getActiveSheet()->setCellValue('D4', 'Deposit');
			$this->excel->getActiveSheet()->setCellValue('E4', 'Date');
			$this->excel->getActiveSheet()->setCellValue('F4', 'Transaction Id');
			$a=5;
			$sr=1;
			foreach ($getDepositData as $report) {
				if(!empty($report->user_name)){ $user_name = $report->user_name; }else{ $user_name = 'NA'; }

				if(!empty($report->email_id)){ $email_id = $report->email_id; }else{ $email_id = 'NA'; }

				if(!empty($report->amount)){ $amount = $report->amount; }else{ $amount = '0'; }

				if(!empty($report->created)){ $created = date('d/m/Y', strtotime($report->created)); }else{ $created = 'NA'; }

				if(!empty($report->transactionId)){ $transactionId = $report->transactionId; }else{ $transactionId = 'NA'; }

				$this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
				$this->excel->getActiveSheet()->setCellValue('B'.$a, ucfirst($user_name));
				$this->excel->getActiveSheet()->setCellValue('C'.$a, $email_id);
				$this->excel->getActiveSheet()->setCellValue('D'.$a, round($amount,2));
				$this->excel->getActiveSheet()->setCellValue('E'.$a, $created);
				$this->excel->getActiveSheet()->setCellValue('F'.$a, ' '.$transactionId);

				$this->excel->getActiveSheet()->getStyle('A'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('D'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('F'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				// $this->excel->getActiveSheet()->getStyle('F'.$a)->getNumberFormat()->setFormatCode('0');

				$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 

				$sr++;

			   $a++;
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

			//set each column width
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);

			//set each row height
			$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);

			//merge cell A2 until E2
			$this->excel->getActiveSheet()->mergeCells('A1:F1');
			$this->excel->getActiveSheet()->mergeCells('A2:F2');

			//set aligment to center for that merged cell (A2 to E4)
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$filename='deposit_'.date('d-m-Y H:i').'.xls';
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
			redirect(DEPOSIT);
		}
	}
}
