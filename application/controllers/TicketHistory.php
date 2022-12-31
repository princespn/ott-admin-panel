<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketHistory extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('Crud_model');
	  
	} 

	public function index()
	{
		$sql = "SELECT ticket_details.* ,user_details.user_name , tournaments.name FROM `ticket_details` LEFT JOIN user_details ON ticket_details.userId = user_details.user_id LEFT JOIN tournaments ON ticket_details.tournamentId = tournaments.id";
		$tickect_data = $this->Crud_model->joinmatchesData($sql);

		$data=array(
			'heading'=>"Ticket History",
			'bread'=>"Ticket History",
			'tickect_data' =>$tickect_data

			);
		$this->load->view('ticketHistory/list',$data);
	}
}