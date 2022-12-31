<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subscription extends CI_Controller {
	public function __construct() {
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

	public function index($flag = "") {

		$cond = "";
		$subscription_plan_data = $this->Crud_model->GetDataAll("plan_details", $cond);

		$data = array(
			'heading' => "Subscription",
			'bread' => "Subscription",
			'flag' => $flag,
			'subscription_plan_data' => $subscription_plan_data,
		);
		$this->load->view('Subscription/list.php', $data);

	}

	public function addSubs() {
		$condition = "";
		$planName = $this->input->post('planName');
		$durationType = $this->input->post('durationType');
		$duration = $this->input->post('duration');
		$planCost = $this->input->post('planCost');
		$noOfDeviceLogin = $this->input->post('noOfDeviceLogin');
		$desc = $this->input->post('desc');


		$data = array(
			'planName' => $planName,
			'durationType' => $durationType,
			'duration' => $duration,
			'planCost' => $planCost,
			'noOfDeviceLogin' => $noOfDeviceLogin,
			"description" => $desc,

		);

		$this->Crud_model->SaveData("plan_details", $data, $condition);

		$this->session->set_flashdata('message', 'Plan added successfully');

		redirect(site_url(SUBSCRIPTION));
	}

	public function deleteSubs() {

		$id = $this->input->post('id', TRUE);

		if (!empty($id)) {

			$res = $this->Crud_model->DeleteData("plan_details", "id='" . $id . "'", '');
			$msg = 'Plan has been deleted successfully';

		} else {

			$msg = 'No Plan found';
		}

		$this->session->set_flashdata('message', 'Plan updated successfully');

		redirect(site_url(SUBSCRIPTION));

	}

	public function getSubscriptionDetails() {
		$id = $this->input->post('id', TRUE);
		$cond = "plan_details.id = '" . $id . "'";
		if (!empty($id)) {
			$res = $this->Crud_model->GetDataArr("plan_details", '', $cond, '', '', '', '1');
			echo json_encode($res);
		}
	}

	public function editSubs() {
		$id = $this->input->post('editId');
		$condition = "plan_details.id = '" . $id . "'";
		$editPlanName = $this->input->post('editPlanName');
		$editDurationType = $this->input->post('editDurationType');
		$editDuration = $this->input->post('editDuration');
		$noOfDeviceLogin = $this->input->post('editNoOfDeviceLogin');
		$editPlanCost = $this->input->post('editPlanCost');
		$editPlandesc = $this->input->post('editPlandesc');

		$data = array(
			"planName" => $editPlanName,
			"durationType" => $editDurationType,
			"duration" => $editDuration,
			"planCost" => $editPlanCost,
			"noOfDeviceLogin" => $noOfDeviceLogin,
			"description" => $editPlandesc,
		);

		$this->Crud_model->SaveData("plan_details", $data, $condition);
		$this->session->set_flashdata('message', 'Plan updated successfully');

		redirect(site_url(SUBSCRIPTION));

	}

}
