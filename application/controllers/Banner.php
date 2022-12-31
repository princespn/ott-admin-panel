<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends CI_Controller {
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
		$tbl = "movie_banner_data";
		if ($flag == 'movies') {
			$tbl = "movie_banner_data";
		}
		if ($flag == 'series') {
			$tbl = "series_banner_data";
		}

		$banner_data = $this->Crud_model->GetDataAll($tbl, $cond);

		//print_r($banner_data);
		//die();

		$data = array(
			'heading' => "App Banner Details",
			'bread' => "App Banner",
			'flag' => $flag,
			'banner_data' => $banner_data,

		);
		//print_r($movie_data);
		//die();
		$this->load->view('app_banner/app_banner.php', $data);
	}

	public function updateBanner() {

		$flag = $this->input->post('flag', true);
		if ($flag == 'movies') {
			$tbl = "movie_banner_data";
		}
		if ($flag == 'series') {
			$tbl = "series_banner_data";
		}

		$id = $this->input->post('id', true);
		$oldStatus = $this->input->post('oldStatus', true);
		$add_banner = $oldStatus == 0 ? 1 : 0;

		$condition = "id='$id'";

		$data = array('appBanner' => $add_banner);

		$res = $this->Crud_model->SaveData($tbl, $data, $condition);

	}

}
