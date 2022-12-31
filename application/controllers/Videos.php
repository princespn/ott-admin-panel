<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Videos extends CI_Controller {
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
		$video_data = $this->Crud_model->GetDataAll("videos", $cond);
		$subscription_plan_data = $this->Crud_model->GetDataAll("subscription_plan_details",$cond);
		$categories_list = $this->Crud_model->GetDataAll("categories_list",$cond);
		$data = array(
			'heading' => "Videos",
			'bread' => "Videos",
			'flag' => $flag,
			'video_data'=>$video_data,
			'subscription_plan_data'=>$subscription_plan_data,
			'categories_list'=>$categories_list
		);
		$this->load->view('videos/list.php', $data);

	}

	public function addVideo(){
		$allowedExts = array("mp4", "wma", "jpg", "jpeg");
		$extension_video = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);
		$extension_thumbnail = pathinfo(($_FILES['thumbnail_image'])['name'], PATHINFO_EXTENSION);
		$movie_name = $this->input->post('name');
		
		if ((($_FILES["video_file"]["type"] == "video/mp4")&&($_FILES["thumbnail_image"]["type"] == "image/jpeg") ) && in_array($extension_video, $allowedExts)) {
			$video_filename = 'vid'.rand(000,999).time().$_FILES['video_file']['name'];
					
					$config['file_name'] 	   = $video_filename;
				$config['upload_path']    = getcwd().'/uploads/Videos/';
				
					$config['allowed_types']   = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('video_file');
					$temp_file_path = 'uploads/Videos/'.$video_filename;
					$keyname = "videos/movie/{$video_filename}";
					$video_result = $this->S3->uploadMovie($video_filename,$temp_file_path,$keyname);
					$condition = "";
					$name = $this->input->post('name');
					$details = $this->input->post('details');
					
					$data = array(
						'moviesName' => $name,
						'movieDetails' => $details,
						'keyname'=> $keyname,
						'link' =>$video_result					
					);
					
					$this->Crud_model->SaveData("videos",$data,$condition);			
					
					unlink('uploads/videos/'.$video_filename);

					$this->session->set_flashdata('message', 'Video added Successfuly');
					redirect(site_url(VIDEO));
				
		} else{
			$this->session->set_flashdata('message', 'Please Upload mp4 Only');

			redirect(site_url(VIDEO));

		}
		
	}

	public function deleteVideo(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "movies.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("movies",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['movieId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(MOVIE));			
			} else {
				
				$keyname = $videoData['movieId'];
				$deleteS3 = $this->S3->deleteVideo($keyname);
				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("movies","id='".$id."'",'');

					$msg = 'movies has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIE));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIE));
				}
			}
			
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}

	
}

public function deleteTrailVideo(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "movies.movieId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("movies",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['movieId']) {
				$this->session->set_flashdata('message', 'Try Again');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));

			} else {
				
				$keyname = $videoData['movieId'];
				$slag_trailer = '0';
				$data = array(
					"trailer" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("movie_trailer_data","movieId='".$id."'",'');
				$this->Crud_model->SaveData("movies", $data, $cond);

					$msg = 'Video has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
			}
			
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}

	
}


public function deleteMovieVideo(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "movies.movieId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("movies",'', $cond, '', '', '', '1');
			
			print_r($videoData); die();
			if(!$videoData['movieId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(MOVIE));			
			} else {
				
				$keyname = $videoData['movieId'];
				$slag_trailer = '0';
				$data = array(
					"video" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("movie_video_data","movieId='".$id."'",'');
				$this->Crud_model->SaveData("movies", $data, $cond);

					$msg = 'Video has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
			}
			
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}

	
}


public function deleteBanner(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "movies.movieId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("movies",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['movieId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(MOVIE));			
			} else {
				
				$keyname = $videoData['movieId'];
				$slag_trailer = '0';
				$data = array(
					"bannerImage" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("movie_banner_data","movieId='".$id."'",'');
				$this->Crud_model->SaveData("movies", $data, $cond);

					$msg = 'Banner has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
			}
			
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}

	
}


public function deleteThumbnail(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "movies.movieId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("movies",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['movieId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(MOVIE));			
			} else {
				
				$keyname = $videoData['movieId'];
				$slag_trailer = '0';
				$data = array(
					"thumbnailImage" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("movie_thumbnail_data","movieId='".$id."'",'');
				$this->Crud_model->SaveData("movies", $data, $cond);

					$msg = 'Thumbnail has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($id)));
				}
			}
			
		$response = array(
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
			'msg'      => $msg
		);
		echo json_encode($response);
	}

	
}



public function view($id){
		$id=base64_decode($id);
		$cond = "ud.id = '".$id."'";
		$getUserData = $this->Users_model->getUsers("videos ud",$cond);
		// $getDeposite = $this->Crud_model->GetData('user_account','','userId="'.$id.'" ','','id desc');
		// $getWithdraw = $this->Crud_model->GetData('user_account','','userId="'.$id.'" ','','id desc');
		
		// $getReferralCount = $this->Crud_model->GetData('referal_user_logs','count(toUserId) as refCount','fromUserId="'.$id.'" and referalAmountBy="Register"','','','','1');
		$data = array(
			'heading' => 'Video Details',
			'breadhead' => 'Video Users',
			'bread' => 'Video Details',
			'getUserData' => $getUserData,
					);
		$this->load->view('Videos/view',$data);
	
}

}
