<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintainance extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	    $this->load->library('image_lib');
	    $this->load->model('Maintainance_model');
	} 

	public function index()
	{
		$getSetting = $this->Crud_model->GetData('mst_settings','id,version,maintainance','','','','','1');
		$data=array(
			'heading'=>"Maintenance",
			'bread'=>"Manage Maintenance",
			'getSetting'=>$getSetting,
			);
		$this->load->view('maintainance',$data);
	}

	public function maintainanceUpdate(){
		$id = $this->input->post('id');
		$mode = $this->input->post('mode');
		$maintainanceMsg = $this->input->post('maintainanceMsg');
		$data= array(
			'maintainance'=>$mode,
			'maintainanceMsg'=>$maintainanceMsg,
		);
		$this->Crud_model->SaveData("mst_settings",$data,"id='".$id."'");
		$msg = 'Status change succesfully.';
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg,
		);
		echo json_encode($response);exit();
	}
}
