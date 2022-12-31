<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Support extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('Common_helper');
		$this->load->model('Users_model');
		$this->load->library('Custom');
		$this->load->model('Crud_model');
		$this->load->model('Admin_model');
		$this->load->model('S3');
	}

	public function index($flag =""){
		
		$cond = "";
		$support_data = $this->Crud_model->GetDataAll("support", $cond);

	   
	   $data = array(
		   'heading' => "Support Details",
		   'bread' => "Support",
		   'flag' => $flag,
		   'support_data'=>$support_data,
	   );
	   
	   $this->load->view('support/list.php', $data);
	}

	public function changeStatus(){

		$id = $this->input->post('editId');
		$condition = "support.id = '" .$id. "'";
		$reason = $this->input->post('reason');

		$data = array(			
			"status"=>"Resolved",
			"reason" => $reason
		);
		
		$this->Crud_model->SaveData("support", $data, $condition);
		$this->session->set_flashdata('message', 'Plan updated successfully');
			
		redirect(site_url(SUPPORT));
	}

	public function change_status() {
		$table = "support";
		$con = "id='" . $this->input->post('id') . "'";
		$getSingleData = $this->Admin_model->get_single_record($table, $con);
		$status = $getSingleData->status;

		if ($status == 'Pending') {
			$data = array('status' => 'Resolved');
			$success = 1;
		} else {
			$data = array('status' => 'Pending');
			$success = 0;
		}
		$this->Admin_model->save($table, $data, $con);

		$msg = 'Status has been changed successfully';
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg' => $msg,
			'success' => $success,
		);
		echo json_encode($response);exit();
	}

	public function delete_status() {
		$id = $this->input->post('id', TRUE);
		if (!empty($id)) {
			$this->Crud_model->DeleteData("support", "id='" . $id . "'", '');
			$msg = 'Record has been deleted successfully';
		} else {
			$msg = 'No record found User';
		}
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg' => $msg,
		);
		echo json_encode($response);exit;
	}


}