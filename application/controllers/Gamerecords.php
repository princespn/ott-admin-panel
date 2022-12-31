<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gamerecords extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('Crud_model');
	    $this->load->model('MatchHistory_model');
	    

	} 
	
	public function index()
	{
	
		$data=array(
			'heading'=>"Manage Game Records",
			'bread'=>"Manage Game Records",
			
			);
		$this->load->view('gameRecord/list',$data);
	}

	public function ajax_manage_page()
	{
		$condition = "";
		// if(!empty($this->input->post('SearchData8')) && !empty($this->input->post('SearchData9'))) {
		// 	$condition .= " and date(gr.created) between '".date("Y-m-d",strtotime($this->input->post('SearchData8')))."' and '".date("Y-m-d",strtotime($this->input->post('SearchData9')))."' ";
		// }else if(!empty($this->input->post('SearchData8'))) {
		// 	$condition .= " and date(gr.created) = '".date("Y-m-d",strtotime($this->input->post('SearchData8')))."'";
		// }else if(!empty($this->input->post('SearchData9'))) {
		// 	$condition .= " and date(gr.created) = '".date("Y-m-d",strtotime($this->input->post('SearchData9')))."'";
		// }
		
		$getRoomData = $this->Crud_model->GetData('rooms gr',$condition);

		if(empty($_POST['start']))
		{
			$no =0;   
		}else{
			 $no =$_POST['start'];
		}
		$data = array();

		foreach ($getRoomData as $RoomData) 
		{
			// $btn = '';
			// $btn = ''.anchor(site_url(MACTHHISTORYVIEW.'/'.base64_encode($RoomData->tableId)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>');
			$table='';
			$cond= "roomId='".$RoomData->roomId."'";
			$getData = $this->Crud_model->matchesData($cond);
			
			
			$table .= '<table class="table table-striped table-bordered" width="100%"><thead>
				  <th>User Name</th>
				  <th>Is Win</th>
				  <th>Question Attempted</th>
				  <th>Correct Answer</th>
				  </thead><tbody>';
					foreach ($getData as $record) {
						if(!empty($record->user_name)){
							$userName = $record->user_name;
						}else{
							$userName = "NA";
						}
						$table.='<tr>
						<td>'.$userName.'</td>
						<td>'.$record->isWin.'</td>
						<td>'.$record->questionAttempted.'</td>
						<td>'.$record->correctAnswer.'</td>
						</tr>';
					}

			$table .='</tbody></table>';


			$no++;
			$nestedData = array();
			$nestedData[] = $no;
			$nestedData[] = $RoomData->roomId;
			$nestedData[] = $RoomData->gameStatus;
			$nestedData[] = $RoomData->isTournament;
			$nestedData[] = date('d  M Y h:i A',strtotime($RoomData->created));
			$nestedData[] = $table;
			//$nestedData[] =$btn;
			
			$data[] = $nestedData;
			
		}
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->MatchHistory_model->count_all('room_user_detail cdh',$condition),
					 "recordsFiltered" => $this->MatchHistory_model->count_filtered('room_user_detail cdh',$condition),
					"data" => $data,
					"csrfHash" => $this->security->get_csrf_hash(),
					"csrfName" => $this->security->get_csrf_token_name(),
				);
		echo json_encode($output);

	}

	public function exportAction(){
		$condition = "rud.id!='0' and u.id!=''";
		$getUserData = $this->MatchHistory_model->getExportData('rooms rud',$condition);

		if(!empty($getUserData)) {
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('');
			
			$this->excel->getActiveSheet()->setCellValue('A2', 'Game Report');
			$this->excel->getActiveSheet()->setCellValue('A4', 'Sr. No.');
			$this->excel->getActiveSheet()->setCellValue('B4', 'Room Id');
			$this->excel->getActiveSheet()->setCellValue('C4', 'Game Status');
			$this->excel->getActiveSheet()->setCellValue('D4', 'Game Type isTournament');
			$this->excel->getActiveSheet()->setCellValue('E4', 'Date');
			$this->excel->getActiveSheet()->setCellValue('F4', 'Remark');
			$a=5;
			$sr=1;
			foreach ($getUserData as $report) {

				if(!empty($report->created)){ $created = date('d  M Y h:i A',strtotime($report->created)); }else{ $created = 'NA'; }

				$cond= "roomId='".$report->roomId."'";
				$getData = $this->MatchHistory_model->matchesData($cond);

				$this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
				$this->excel->getActiveSheet()->setCellValue('B'.$a, $report->roomId);
				$this->excel->getActiveSheet()->setCellValue('C'.$a, $report->gameStatus);
				$this->excel->getActiveSheet()->setCellValue('D'.$a, $report->isTournament);
				$this->excel->getActiveSheet()->setCellValue('E'.$a, $created);
				$this->excel->getActiveSheet()->setCellValue('F'.$a, 'User Name');
				$this->excel->getActiveSheet()->setCellValue('G'.$a, 'Is Win');
				$this->excel->getActiveSheet()->setCellValue('H'.$a, 'Win/Loss Coins');

				$b = $a;
				foreach ($getData as $record) {
					$b = $b+1;
					$this->excel->getActiveSheet()->setCellValue('F'.$b, $record->user_name);
					$this->excel->getActiveSheet()->setCellValue('G'.$b, $record->isWin);
					$this->excel->getActiveSheet()->setCellValue('H'.$b, $record->questionAttempted);
					$this->excel->getActiveSheet()->setCellValue('I'.$b, $record->correctAnswer);
					$this->excel->getActiveSheet()->getStyle('H'.$b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				}

				$this->excel->getActiveSheet()->getStyle('A'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('B'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getStyle('D'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

				$this->excel->getActiveSheet()->getRowDimension($a)->setRowHeight(18); 
				$this->excel->getActiveSheet()->getStyle('F'.$a.':H'.$a)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('F'.$a.':H'.$a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->mergeCells('A'.$a.':A'.$b);
				$this->excel->getActiveSheet()->mergeCells('B'.$a.':B'.$b);
				$this->excel->getActiveSheet()->mergeCells('C'.$a.':C'.$b);
				$this->excel->getActiveSheet()->mergeCells('D'.$a.':D'.$b);
				$this->excel->getActiveSheet()->mergeCells('E'.$a.':E'.$b);
				$this->excel->getActiveSheet()->getStyle('A'.$a.':E'.$a)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

			   $sr++;

			   $a = $b+1;
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);

			//set each column width
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(21);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

			//set each row height
			$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
			$this->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(18);

			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);

			//merge cell A2 until F2
			$this->excel->getActiveSheet()->mergeCells('A1:F1');
			$this->excel->getActiveSheet()->mergeCells('A2:F2');
			$this->excel->getActiveSheet()->mergeCells('F4:H4');

			//set aligment to center for that merged cell (A2 to F4)
			$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$filename='match_history_'.date('d-m-Y H:i').'.xls';
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
			redirect(GAMERECORDS);
		}
	}

}