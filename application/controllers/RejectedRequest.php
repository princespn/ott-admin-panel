<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RejectedRequest extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('RejectedRequest_model');
	} 

	public function index()
	{
		$getUsers = $this->Crud_model->GetData('user_details','','playerType="Real" and status="Active"');
		$data=array(
			'heading'=>"Rejected Request",
			'bread'=>"Manage Rejected Request",
			'getUsers'=>$getUsers,
			);
		$this->load->view('withdrawal/reject_list',$data);
	}

	public function ajax_manage_page()
	{
		
		$condition = "ua.type='Withdraw' and ua.status='Rejected'";
		if(!empty($this->input->post('SearchData')) && !empty($this->input->post('SearchData1'))) {
			$condition .= " and date(ua.created) between '".date("Y-m-d",strtotime($this->input->post('SearchData')))."' and '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."' ";
		}else if(!empty($this->input->post('SearchData'))) {
			$condition .= " and date(ua.created) = '".date("Y-m-d",strtotime($this->input->post('SearchData')))."'";
		}else if(!empty($this->input->post('SearchData1'))) {
			$condition .= " and date(ua.created) = '".date("Y-m-d",strtotime($this->input->post('SearchData1')))."'";
		}

		$getPenWith = $this->RejectedRequest_model->get_datatables('user_account ua',$condition);

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

			$btn = ''.anchor(site_url(WITHDRAWALREJECTVIEW.'/'.base64_encode($PendingWithd->id)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View">View</span>');

			if(!empty($PendingWithd->user_name)){ $user_name = $PendingWithd->user_name; }else{ $user_name = 'NA'; }

			if(!empty($PendingWithd->amount)){ $amount = $PendingWithd->amount; }else{ $amount = 'NA'; }

			if(!empty($PendingWithd->paymentType)){ $paymentType = $PendingWithd->paymentType; }else{ $paymentType = 'NA'; }

			if(!empty($PendingWithd->created) && $PendingWithd->created !="0000-00-00 00:00:00"){ $created = date('d M Y H:i A', strtotime($PendingWithd->created)); }else{ $created = 'NA'; }

			if(!empty($PendingWithd->modified) && $PendingWithd->modified !="0000-00-00 00:00:00"){ $modified = date('d M Y H:i A', strtotime($PendingWithd->modified)); }else{ $modified = 'NA'; }
		 
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucfirst($user_name);
			$nestedData[] = $amount;
			$nestedData[] = $paymentType;
			$nestedData[] = $created;
			$nestedData[] = $modified;
			$nestedData[] = $btn;
			
			$data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->RejectedRequest_model->count_all('user_account ua',$condition),
					"recordsFiltered" => $this->RejectedRequest_model->count_filtered('user_account ua',$condition),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	public function exportAction(){
		$condition = "ua.type='Withdraw' and ua.status='Rejected'";
		$getUserData = $this->RejectedRequest_model->getExportData('user_account ua',$condition);

		if(!empty($getUserData)) {
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('');
			
			$this->excel->getActiveSheet()->setCellValue('A2', 'User Report');
			$this->excel->getActiveSheet()->setCellValue('A4', 'Sr. No.');
			$this->excel->getActiveSheet()->setCellValue('B4', 'Username');
			$this->excel->getActiveSheet()->setCellValue('C4', 'Amount(Rs.)');
			$this->excel->getActiveSheet()->setCellValue('D4', 'Payment Mode');
			$this->excel->getActiveSheet()->setCellValue('E4', 'Request On');
			$this->excel->getActiveSheet()->setCellValue('F4', 'Completed On');
			$a=5;
			$sr=1;
			foreach ($getUserData as $report) {

				if(!empty($report->user_name)){ $user_name = $report->user_name; }else{ $user_name = 'NA'; }

				if(!empty($report->amount)){ $amount = $report->amount; }else{ $amount = 'NA'; }

				if(!empty($report->paymentMode)){ $paymentMode = $report->paymentMode; }else{ $paymentMode = 'NA'; }

				if(!empty($report->created) && $report->created !="0000-00-00 00:00:00"){ $created = date('d M Y H:i A', strtotime($report->created)); }else{ $created = 'NA'; }

				if(!empty($report->modified) && $report->modified !="0000-00-00 00:00:00"){ $modified = date('d M Y H:i A', strtotime($report->modified)); }else{ $modified = 'NA'; }

				$this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
				$this->excel->getActiveSheet()->setCellValue('B'.$a, $user_name);
				$this->excel->getActiveSheet()->setCellValue('C'.$a, $amount);
				$this->excel->getActiveSheet()->setCellValue('D'.$a, $paymentMode);
				$this->excel->getActiveSheet()->setCellValue('E'.$a, $created);
				$this->excel->getActiveSheet()->setCellValue('F'.$a, $modified);

				$this->excel->getActiveSheet()->getStyle('A'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 

			   $sr++;

			   $a++;
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

			//set each column width
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(18);

			//set each row height
			$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);

			//merge cell A2 until F2
			$this->excel->getActiveSheet()->mergeCells('A1:F1');
			$this->excel->getActiveSheet()->mergeCells('A2:F2');

			//set aligment to center for that merged cell (A2 to F4)
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$filename='rejected_req_'.date('d-m-Y H:i').'.xls';
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
			redirect(WITHDRAWALREJECTREQ);
		}
	}

	public function viewRequest($id){
		$id = base64_decode($id);
		$this->db->select('d.*,u.user_name,u.user_id,u.user_name,u.email_id,u.balance,u.mobile,bd.acc_holderName,bd.accno,bd.ifsc');
		$this->db->from("user_account d"); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left");
		$this->db->join("bank_details bd","bd.user_detail_id=d.user_detail_id","left");
		$this->db->order_by('d.id DESC'); 
		$this->db->where("d.id='".$id."' and d.type='Withdraw' and d.status='Rejected'");
		$queryData = $this->db->get()->row();

		$data = array(
			"getData" => $queryData,
			"heading" => "View Rejected Request",
			"breadhead" => "Rejected Request",
			"bread" => "View rejected request",
		);
		// print_r($data);exit;

		$this->load->view('withdrawal/view_reject_list',$data);
	}

}