<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentMode extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	    $this->load->library('image_lib');
	    $this->load->model('Payment_Model');
	} 

	public function index()
	{
		$getSetting = $this->Crud_model->GetData('mst_settings','id,version,ispaymentenable','','','','','1');
		$data=array(
			'heading'=>"Payment",
			'bread'=>"Manage Payment Activation",
			'getSetting'=>$getSetting,
			);
		$this->load->view('paymentenable',$data);
	}

	public function paymentmessUpdate(){
		$id = $this->input->post('id');
		$mode = $this->input->post('mode');
		$maintainanceMsg = $this->input->post('paymentmsg');
		$data= array(
			'ispaymentenable'=>$mode,
			'paymentmsg'=>$maintainanceMsg,
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
