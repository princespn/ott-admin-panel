<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserReport extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserReport_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}

	public function index($isWinLoss='')
	{
		$getGameType = $this->Crud_model->GetData('ludo_mst_rooms','roomTitle');
		$data=array(
			'heading'=>"Manage Report",
			'bread'=>"Manage Report",
			'getGameType'=>$getGameType,
			'isWinLoss'=>$isWinLoss,
		);
		$this->load->view('userReport/list',$data);
	}

	public function ajax_manage_page($isWinLoss='')
	{
		//print_r($_POST);exit();
		$SearchData = $this->input->post('SearchData');
		$SearchData1 = $this->input->post('SearchData1');
		$SearchData2 = $this->input->post('SearchData2');
		$SearchData3 = $this->input->post('SearchData3');
		$SearchData4 = $this->input->post('SearchData4');

		$cond = "cdh.coinsDeductHistoryId!='0' and u.id!=''";
		//select * from *table_name* where *datetime_column* >= '01/01/2009' and *datetime_column* <= curdate()
		if($isWinLoss!='' && empty($SearchData) && empty($SearchData1)){
			$cond .= " and  date(cdh.created) = '".date("Y-m-d")."'";
		}
		if(!empty($SearchData)){
			$cond .= " and  date(cdh.created) >= '".date("Y-m-d",strtotime($SearchData))."'";
		}
		if(!empty($SearchData1)){
			$cond .= " and  date(cdh.created) <= '".date("Y-m-d",strtotime($SearchData1))."'";
		}
		if(!empty($SearchData2)){
			$cond .= " and cdh.isWin='".$SearchData2."'";
		}
		if(!empty($SearchData3)){
			$cond .= " and cdh.gameType LIKE '%".$SearchData3."%'";
		}
		if(!empty($SearchData4)){
			$cond .= " and u.playerType='".$SearchData4."'";
		}

		$getUsers = $this->UserReport_model->get_datatables('coins_deduct_history cdh',$cond);
		//print_r($this->db->last_query());exit();
		if(empty($_POST['start']))
		{
			$no =0;   
		}else{
			 $no =$_POST['start'];
		}
		$data = array();


		foreach ($getUsers as $userData) 
		{
			if($userData->isWin=='Win'){
				$sign = '+ ';
			}else{
				$sign = '- ';
			}

			if($userData->playerType=='Real' && $userData->isWin=='Win'){
				$coins= $userData->coins + $userData->adminAmount;
			}else{
				$coins= $userData->coins;
			}
			
			//$coins= $userData->coins;
			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = ucfirst($userData->user_name);
			$nestedData[] = $userData->mobile;
			$nestedData[] = $userData->playerType;
			$nestedData[] = $userData->roomId;
			$nestedData[] = ucfirst($userData->game);
			$nestedData[] = $userData->gameType;
			$nestedData[] = $userData->betValue;
			$nestedData[] = $userData->isWin;
			$nestedData[] = $sign."".$coins;
			$nestedData[] = $userData->mainWallet;
			$nestedData[] = $userData->winWallet;
			$nestedData[] = $userData->adminCommition.'%';
			$nestedData[] = $userData->adminAmount;
			$nestedData[] = date('d-m-Y H:i:s',strtotime($userData->created));
			
			$data[] = $nestedData;
		}

		$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->UserReport_model->count_all('coins_deduct_history cdh',$cond),
					"recordsFiltered" => $this->UserReport_model->count_filtered('coins_deduct_history cdh',$cond),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);
	}

	public function exportAction(){
		$cond = "cdh.coinsDeductHistoryId!='0' and u.id!=''";
		$getUserData = $this->UserReport_model->getReportData('coins_deduct_history cdh',$cond);

		if(!empty($getUserData)) {
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('');
			
			$this->excel->getActiveSheet()->setCellValue('A2', 'User Report');
			$this->excel->getActiveSheet()->setCellValue('A4', 'Sr. No.');
			$this->excel->getActiveSheet()->setCellValue('B4', 'User Name');
			$this->excel->getActiveSheet()->setCellValue('C4', 'User Mobile');
			$this->excel->getActiveSheet()->setCellValue('D4', 'User Type');
			$this->excel->getActiveSheet()->setCellValue('E4', 'Room Id');
			$this->excel->getActiveSheet()->setCellValue('F4', 'Game');
			$this->excel->getActiveSheet()->setCellValue('G4', 'Game Type');
			$this->excel->getActiveSheet()->setCellValue('H4', 'Bet Value');
			$this->excel->getActiveSheet()->setCellValue('I4', 'Is Win');
			$this->excel->getActiveSheet()->setCellValue('J4', 'Win/Loss Coins');
			$this->excel->getActiveSheet()->setCellValue('K4', 'Admin Commission');
			$this->excel->getActiveSheet()->setCellValue('L4', 'Admin Amount');
			$this->excel->getActiveSheet()->setCellValue('M4', 'Date');
			$a=5;
			$sr=1;
			foreach ($getUserData as $report) {
				if(!empty($report->user_name)){ $user_name = $report->user_name; }else{ $user_name = 'NA'; }

				if(!empty($report->mobile)){ $mobile = $report->mobile; }else{ $mobile = 'NA'; }

				if(!empty($report->created)){ $created = date("d/m/Y",strtotime($report->created)); }else{ $created = 'NA'; }

				if($report->isWin=='Win'){
					$sign = '+ ';
				}else{
					$sign = '- ';
				}

				if($report->playerType=='Real' && $report->isWin=='Win'){
					$coins= $report->coins + $report->adminAmount;
				}else{
					$coins= $report->coins;
				}

				$this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
				$this->excel->getActiveSheet()->setCellValue('B'.$a, ucfirst($user_name));
				$this->excel->getActiveSheet()->setCellValue('C'.$a, $mobile);
				$this->excel->getActiveSheet()->setCellValue('D'.$a, $report->playerType);
				$this->excel->getActiveSheet()->setCellValue('E'.$a, $report->roomId);
				$this->excel->getActiveSheet()->setCellValue('F'.$a, ucfirst($report->game));
				$this->excel->getActiveSheet()->setCellValue('G'.$a, $report->gameType);
				$this->excel->getActiveSheet()->setCellValue('H'.$a, $report->betValue);
				$this->excel->getActiveSheet()->setCellValue('I'.$a, $report->isWin);
				$this->excel->getActiveSheet()->setCellValue('J'.$a, $sign."".$coins);
				$this->excel->getActiveSheet()->setCellValue('K'.$a, $report->adminCommition.'%');
				$this->excel->getActiveSheet()->setCellValue('L'.$a, $report->adminAmount);
				$this->excel->getActiveSheet()->setCellValue('M'.$a, $created);

				$this->excel->getActiveSheet()->getStyle('A'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('C'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 

			   $sr++;

			   $a++;
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

			//set each column width
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(18);

			//set each row height
			$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A4:M4')->getFont()->setBold(true);

			//merge cell A2 until F2
			$this->excel->getActiveSheet()->mergeCells('A1:M1');
			$this->excel->getActiveSheet()->mergeCells('A2:M2');

			//set aligment to center for that merged cell (A2 to F4)
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A4:M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$filename='manage_report_'.date('d-m-Y H:i').'.xls';
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
			redirect(USERREPORT);
		}
	}

}