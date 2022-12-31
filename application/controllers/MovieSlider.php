<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MovieSlider extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->helper('Common_helper');
		$this->load->model('Users_model');
		$this->load->model('Crud_model');
		$this->load->model('Admin_model');
		$this->load->model('S3');
	}

	public function index($flag =""){
		
		 $fields = "Msv.id,Msv.movieId,Msv.sequence, Mv.movieName";
		 $joincon = "Msv.movieId = Mv.movieId";
		

		 $subscription_plan_data = $this->Crud_model->result_getall("movies_slider Msv", $fields, "movies Mv", $joincon, "left","DESC");


		/// print_r($subscription_plan_data); die();
		
		$data = array(
			'heading' => "Movie Slider",
			'bread' => "Movie Slider",
			'flag' => $flag,
			'subscription_plan_data'=>$subscription_plan_data
			
		);
		$this->load->view('MovieSlider/list.php', $data);
	}

	public function getSliderDetails(){
		$id = $this->input->post('id',TRUE);
		$cond = "movies_slider.id = '".$id."'";
			if(!empty($id)){
				$res=$this->Crud_model->GetDataArr("movies_slider", '', $cond, '', '', '', '1');
				echo json_encode($res);
		}
	}

	public function editSequence(){
		$id = $this->input->post('editId');
		$condition = "movies_slider.id = '" .$id. "'";
		$editSequence = $this->input->post('editSequence');
		$movieId = $this->input->post('movieId');


		$data = array(
			"sequence" => $editSequence,
			"movieId" => $movieId,

		);
		
		$this->Crud_model->SaveData("movies_slider", $data, $condition);
		$this->session->set_flashdata('message', 'Plan updated successfully');
			
		redirect(site_url(MOVIESLIDER));

	}

}	