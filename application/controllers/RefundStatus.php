<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RefundStatus extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Common_helper');
		$this->load->library('Custom');
		$this->load->model('Crud_model');
	}

	public function index($flag = "")
	{

		$sql = "SELECT tral.*, user_details.user_name, tournaments.name FROM `tournament_refund_amount_log` tral LEFT JOIN user_details ON tral.userId = user_details.user_id LEFT JOIN tournaments ON tral.tournamentId = tournaments.id";
		$refundData = $this->Crud_model->joinmatchesData($sql);

		$data = array(
			'heading' => "Refund Status Logs",
			'bread' => "Refund Status Logs",
			'flag' => $flag,
			'refundData' => $refundData
		);
		$this->load->view('refundStatus/list.php', $data);
	}
}
