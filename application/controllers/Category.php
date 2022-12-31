<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct()
	{
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

	public function index($flag = "")
	{

		 $cond = "";
		 $subscription_plan_data = $this->Crud_model->GetDataAll("categories_list",$cond);
		
		$data = array(
			'heading' => "Category",
			'bread' => "Category",
			'flag' => $flag,
			'subscription_plan_data'=>$subscription_plan_data
		);
		$this->load->view('Category/list.php', $data);

	}

	public function addCategory(){
		$condition="";
		$categoryName = $this->input->post('categoryName');	
		
		
		$data = array(
			'categoryName'=>$categoryName	
		);

		$this->Crud_model->SaveData("categories_list", $data, $condition);

		$this->session->set_flashdata('message', 'Plan added successfully');
		
		redirect(site_url(CATEGORY));
	}

	public function deleteCategory(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$res=$this->Crud_model->DeleteData("categories_list","id='".$id."'",'');
		$this->session->set_flashdata('message', 'categories delete successfully');
			redirect(site_url(CATEGORY));

		}else{

		$this->session->set_flashdata('message', 'categories Not Delete');
					redirect(site_url(CATEGORY));

		}
			

	
	}

	public function getCategoryDetails(){
		$id = $this->input->post('id',TRUE);
		$cond = "categories_list.id = '".$id."'";
			if(!empty($id)){
				$res=$this->Crud_model->GetDataArr("categories_list", '', $cond, '', '', '', '1');
				echo json_encode($res);
			}
	}

	public function editCategory(){
		$id = $this->input->post('editId');
		$condition = "categories_list.id = '" .$id. "'";
		$editcategoryName = $this->input->post('editcategoryName');

		$data = array(
			"categoryName" => $editcategoryName
		);
		
		$this->Crud_model->SaveData("categories_list", $data, $condition);
		$this->session->set_flashdata('message', 'Plan updated successfully');
			
		redirect(site_url(CATEGORY));

	}


}
