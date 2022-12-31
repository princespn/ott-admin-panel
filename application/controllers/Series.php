<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Series extends CI_Controller {
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
		$series_data = $this->Crud_model->GetDataAll("series", $cond);
		$subscription_plan_data = $this->Crud_model->GetDataAll("plan_details", $cond);
		$categories_list = $this->Crud_model->GetDataAll("categories_list", $cond);

		$data = array(
			'heading' => "Series Details",
			'bread' => "Series",
			'flag' => $flag,
			'series_data' => $series_data,
			'subscription_plan_data' => $subscription_plan_data,
			'categories_list' => $categories_list,

		);
		//print_r($movie_data);
		//die();
		$this->load->view('series/seriesList.php', $data);
	}

	public function addSeries() {

		$name = $this->input->post('name', true);
		$seriesShortDescription = $this->input->post('seriesShortDescription', true);
		$seriesLongDescription = $this->input->post('seriesLongDescription', true);
		$categories = $this->input->post('categories', true);
		$director = $this->input->post('director', true);
		$cast = $this->input->post('cast', true);
		$seriesType = $this->input->post('seriesType', true);
		$releaseDate = $this->input->post('releaseDate', true);
		$condition = "";
		//$languageDetails = 	$this->Crud_model->GetDataAll("language",$condition);
		$seriesId = 'SER' . rand(0, 999) . time();
		//print_r($categories);
		// die();
		$data = array(
			'seriesId' => $seriesId,
			'seriesName' => $name,
			'seriesShortDescription' => $seriesShortDescription,
			'seriesLongDescription' => $seriesLongDescription,
			'director' => $director,
			'cast' => $cast,
			'seriesCategory' => $categories,
			'seriesType' => $seriesType,
			'releasseDate' => $releaseDate,
		);

		$this->Crud_model->SaveData("series", $data, $condition);
		// $getLanguage = $this->Crud_model->GetDataAll('language',$condition);

		// foreach($getLanguage as $language){

		// 	//create subtitle entry
		// 	$datasubtitle = array(
		// 		'movieId'=>$movieId,
		// 		'language'=>$language->id
		// 	);
		// 	$this->Crud_model->SaveData("movie_subtitle",$datasubtitle,$condition);

		// 	//create audioFile entry
		// 	$dataaudio = array(
		// 		'movieId'=>$movieId,
		// 		'language'=>$language->id
		// 	);
		// 	$this->Crud_model->SaveData("movie_audio_files",$dataaudio,$condition);

		// }

		$this->session->set_flashdata('message', 'Series added Successfuly');
		redirect(site_url(SERIES));
	}


	public function EditSeries(){

		$name = $this->input->post('name', true);
		$seriesShortDescription = $this->input->post('seriesShortDescription', true);
		$seriesLongDescription = $this->input->post('seriesLongDescription', true);
		$categories = $this->input->post('categories', true);
		$director = $this->input->post('director', true);
		$cast = $this->input->post('cast', true);
		$seriesType = $this->input->post('seriesType', true);
		$releaseDate = $this->input->post('releaseDate', true);



		
		
		$seriesId = $this->input->post('seriesId',true);
		$condition = "series.seriesId = '" .$seriesId. "'";

		$data = array(
			'seriesId' => $seriesId,
			'seriesName' => $name,
			'seriesShortDescription' => $seriesShortDescription,
			'seriesLongDescription' => $seriesLongDescription,
			'director' => $director,
			'cast' => $cast,
			'seriesCategory' => $categories,
			'seriesType' => $seriesType,
			'releasseDate' => $releaseDate,
		);

		
			
		$this->Crud_model->SaveData("series",$data,$condition);	
		$cond = "";
	
		$getLanguage = $this->Crud_model->GetDataAll('language',$cond);

		/*foreach($getLanguage as $language){
			
			//create subtitle entry
			$datasubtitle = array(
				'seriesId'=>$movieId,
				'language'=>$language->id
			);
			

			$this->Crud_model->SaveData("movie_subtitle",$datasubtitle,$cond);
			
			//create audioFile entry
			$dataaudio = array(
				'seriesId'=>$movieId,
				'language'=>$language->id
			);
			$this->Crud_model->SaveData("movie_audio_files",$dataaudio,$cond);

		}*/
		
		
		$this->session->set_flashdata('message', 'Edit seriesId details Successfuly');
		redirect(site_url(SERIES));				
	}



	public function uploadSeriesTrailer() {
		$allowedExts = array("mp4", "wma");
		$extension_video = pathinfo($_FILES['trailer_file']['name'], PATHINFO_EXTENSION);
		$seriesId = $this->input->post('seriesId', true);

		if ((($_FILES["trailer_file"]["type"] == "video/mp4")) && in_array($extension_video, $allowedExts)) {
			$video_filename = 'serTrailer' . $seriesId . '-' . rand(000, 999) . time() . $_FILES['trailer_file']['name'];

			mkdir('uploads/Videos/' . $seriesId . '_trailer', 0777);
			$config['file_name'] = $video_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/' . $seriesId . '_trailer';
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('trailer_file');

			//$output=shell_exec('ls'); die();

			$cmd = 'sudo ffmpeg -i uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 240x320 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . '_240x320.m3u8';

			$cmd1 = 'sudo ffmpeg -i uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 360x640 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . '_360x640.m3u8';

			$cmd2 = 'sudo ffmpeg -i uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 480x800 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . '_480x800.m3u8';

			$output = shell_exec($cmd);
			$output1 = shell_exec($cmd1);
			$output2 = shell_exec($cmd2);
			

			$myfile = fopen("uploads/Videos/" . $seriesId . "_trailer/" . $seriesId . "_trailer.m3u8", "w") or die("Unable to open file!");
			$txt = "#EXTM3U
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=700000
" . $video_filename . "_240x320.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=1000000
" . $video_filename . "_360x640.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=2000000
" . $video_filename . "_480x800.m3u8";

			fwrite($myfile, $txt);
			fclose($myfile);

			$mydir = "uploads/Videos/" . $seriesId . "_trailer";
			$myfiles = scandir($mydir);
			unset($myfiles[0]);
			unset($myfiles[1]);
			//print_r($myfiles);
			//exit();
			/*
					$temp_file_path = 'uploads/Videos/'.$video_filename;
					$keyname = "videos/series/trailer/{$video_filename}";
					$video_result = $this->S3->uploadMovie($video_filename,$temp_file_path,$keyname);*/
			//	print_r($video_result);
			//	die();

			foreach ($myfiles as $key) {
				$temp_file_path = 'uploads/Videos/' . $seriesId . '_trailer/' . $key;
				$keyname = "videos/series/trailer/" . $seriesId . "_trailer/{$key}";
				$this->S3->uploadFile($key, $temp_file_path, $keyname);
				unlink($temp_file_path);
			}

			// print_r($video_result);
			// die();
			$keyname1 = "videos/series/trailer/" . $seriesId . "_trailer/" . $seriesId . "_trailer.m3u8";
			
	$video_result = "https://s-sgc1.cloud.gcore.lu/oops1234/videos/series/trailer/" . $seriesId . "_trailer/" . $seriesId . "_trailer.m3u8";


			$condition = "";
			$data = array(
				'seriesId' => $seriesId,
				'keyName' => $keyname1,
				'trailerLink' => $video_result,
			);
			$this->Crud_model->SaveData("series_trailer_data", $data, $condition);

			$movCondn = "seriesId='{$seriesId}'";
			$saveData = array(
				'trailer' => 1,
			);

			$this->Crud_model->SaveData("series", $saveData, $movCondn);

			//unlink('uploads/Videos/'.$video_filename);
			rmdir('uploads/Videos/' . $seriesId . '_trailer');
			$this->session->set_flashdata('message', 'Trailer added Successfuly');
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));
		} else {
			$this->session->set_flashdata('message', 'Please Upload mp4 Only');
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));
		}
	}

	public function viewSeries($seriesId) {
		$seriesId = base64_decode($seriesId);

		$cond = "seriesId = '" . $seriesId . "'";
		$getSeriesData = $this->Crud_model->GetData("series", '', $cond, '', '', '', 1);
		$getSeriesThumbnail = $this->Crud_model->GetData("series_thumbnail", '', $cond, '', '', '', 1);
		$getSeriesTrailer = $this->Crud_model->GetData("series_trailer_data", '', $cond, '', '', '', 1);
		$getSeriesBanner = $this->Crud_model->GetData("series_banner_data", '', $cond, '', '', '', 1);
		$getSeasonData = $this->Crud_model->GetData("seasons", '', $cond, '', '', '', '');
		if(!empty($getSeriesData->seriesCategory)){
		$condCat = "id = '". $getSeriesData->seriesCategory."'";
		}else{$condCat = "id = ";}
		$getCategories = $this->Crud_model->GetData("categories_list", '', $condCat, '', '', '', 1);
		$catcond ='';
		$categories_list = $this->Crud_model->GetDataAll("categories_list", $catcond);

		//print_r($getSeriesData);
		//die();
		$data = array(
			'heading' => 'Series Details',
			'seasonHeading' => 'Seasons',
			'breadhead' => 'Series Users',
			'bread' => 'Series Details',
			'seriesData' => $getSeriesData,
			'getCategories' => $getCategories,
			'getSeriesThumbnail' => $getSeriesThumbnail,
			'getSeriesTrailer' => $getSeriesTrailer,
			'getSeriesBanner' => $getSeriesBanner,
			'seasonData' => $getSeasonData,
			'categories_list' => $categories_list,
		);
		$this->load->view('series/seriesView', $data);
	}

	public function uploadSeriesThumbnail() {
		$allowedExts = array("jpg", "PNG", "jpeg");
		$extension_video = pathinfo($_FILES['thumbnail_image']['name'], PATHINFO_EXTENSION);
		$seriesId = $this->input->post('seriesId', true);
		//print_r($_FILES["thumbnail_image"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["thumbnail_image"]["type"] == "image/jpeg") || ($_FILES["thumbnail_image"]["type"] == "image/jpg") || ($_FILES["thumbnail_image"]["type"] == "image/png")) && in_array($extension_video, $allowedExts)) {
			$image_filename = 'serImage' . $seriesId . '-' . rand(000, 999) . time() . $_FILES['thumbnail_image']['name'];

			$config['file_name'] = $image_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('thumbnail_image');

			$temp_file_path = 'uploads/Videos/' . $image_filename;
			$keyname = "videos/series/thumbnail/{$image_filename}";
			$imageResult = $this->S3->uploadImage($image_filename, $temp_file_path, $keyname);
			//	print_r($video_result);
			//	die();
			$condition = "";
			$data = array(
				'seriesId' => $seriesId,
				'keyName' => $keyname,
				'imageLink' => $imageResult,
			);
			$this->Crud_model->SaveData("series_thumbnail", $data, $condition);

			$movCondn = "seriesId='{$seriesId}'";
			$saveData = array(
				'thumbnail' => 1,
			);
			$this->Crud_model->SaveData("series", $saveData, $movCondn);

			unlink('uploads/Videos/' . $image_filename);

			$this->session->set_flashdata('message', 'Thumbnail added Successfuly');
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));

		} else {
			$this->session->set_flashdata('message', 'Please Upload jpeg | png | jpg Only');
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));
		}

	}
	public function uploadSeriesBanner() {
		$allowedExts = array("jpg", "png", "jpeg");
		$extension_video = pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION);
		$seriesId = $this->input->post('seriesId', true);
		// print_r($_FILES["banner_image"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["banner_image"]["type"] == "image/jpeg") || ($_FILES["banner_image"]["type"] == "image/jpg") || ($_FILES["banner_image"]["type"] == "image/png")) && in_array($extension_video, $allowedExts)) {
			$image_filename = 'serBanner' . $seriesId . '-' . rand(000, 999) . time() . $_FILES['banner_image']['name'];

			$config['file_name'] = $image_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('banner_image');

			$temp_file_path = 'uploads/Videos/' . $image_filename;
			$keyname = "videos/series/banner/{$image_filename}";
			$imageResult = $this->S3->uploadImage($image_filename, $temp_file_path, $keyname);
			//	print_r($video_result);
			//	die();
			$condition = "";
			$data = array(
				'seriesId' => $seriesId,
				'keyName' => $keyname,
				'bannerLink' => $imageResult,
			);
			$this->Crud_model->SaveData("series_banner_data", $data, $condition);

			$movCondn = "seriesId='{$seriesId}'";
			$saveData = array(
				'banner' => 1,
			);
			$this->Crud_model->SaveData("series", $saveData, $movCondn);

			unlink('uploads/Videos/' . $image_filename);

			$this->session->set_flashdata('message', 'Thumbnail added Successfuly');
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));

		} else {
			$this->session->set_flashdata('message', 'Please Upload jpeg | png | jpg Only');
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));
		}

	}
	public function addSeason() {
		$seriesId = $this->input->post('seriesId', true);
		$seasonNo = $this->input->post('seasonNo', true);
		$seasonDetails = $this->input->post('details', true);
		$releaseDate = $this->input->post('releaseDate', true);

		$checkCond = "seriesId = '{$seriesId}' AND seasonNo = {$seasonNo}";
		$checkSeason = $this->Crud_model->GetData("seasons", '', $checkCond, '', '', '', '');

		$seriesCond = "seriesId = '{$seriesId}'";
		$seriesData = $this->Crud_model->GetData("series", '', $seriesCond, '', '', '', '');

		if (sizeof($seriesData) == 0) {
			$this->session->set_flashdata('message', "Series doesnot Exists");
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));
		};

		if (sizeof($checkSeason) > 0) {
			$this->session->set_flashdata('message', "Season {$seasonNo} Already Exists");
			redirect(site_url(SERIESVIEW . '/' . base64_encode($seriesId)));
		};
		$seriesInfo = $seriesData[0];
		$seasonId = "{$seriesInfo->seriesId}-S-{$seasonNo}-" . rand(100, 999);
		$data = array(
			'seriesId' => $seriesId,
			'seasonNo' => $seasonNo,
			'seasonId' => $seasonId,
			'seasonDetails' => $seasonDetails,
			'releaseDate' => $releaseDate,
		);
		$seasonCond = "";
		$this->Crud_model->SaveData("seasons", $data, $seasonCond);
		redirect(site_url(SERIES));

	}
	public function viewSeason($seasonId) {

		$seasonId = base64_decode($seasonId);
		$cond = "seasonId = '{$seasonId}'";
		$seasonData = $this->Crud_model->GetData("seasons", '', $cond, '', '', '', 1);
		$getSeasonThumbnail = $this->Crud_model->GetData("season_thumbnail", '', $cond, '', '', '', 1);
		$getSeriesTrailer = $this->Crud_model->GetData("season_trailer_data", '', $cond, '', '', '', 1);

		$cond = "seriesId = '{$seasonData->seriesId}'";
		$seriesData = $this->Crud_model->GetData("series", '', $cond, '', '', '', 1);
		$cond = "seriesId = '{$seasonData->seriesId}' AND seasonId = '{$seasonId}'";
		$episodeData = $this->Crud_model->GetData("episodes", '', $cond, '', '', '', '');

		$data = array(
			'heading' => 'Season',
			'episodeHearing' => 'Episodes',
			'season' => $seasonData,
			'seriesData' => $seriesData,
			'getSeriesTrailer' => $getSeriesTrailer,
			'episodeData' => $episodeData,
			'getSeasonThumbnail' => $getSeasonThumbnail,

		);
		// print_r($seriesData);
		// die();
		$this->load->view('series/seasonView.php', $data);

	}

	public function uploadSeasonTrailer() {
		$allowedExts = array("mp4", "wma");
		$extension_video = pathinfo($_FILES['trailer_file']['name'], PATHINFO_EXTENSION);
		$seriesId = $this->input->post('seriesId', true);

		if ((($_FILES["trailer_file"]["type"] == "video/mp4")) && in_array($extension_video, $allowedExts)) {
			$video_filename = 'serTrailer' . $seriesId . '-' . rand(000, 999) . time() . $_FILES['trailer_file']['name'];
			mkdir('uploads/Videos/' . $seriesId . '_trailer', 0777);
			$config['file_name'] = $video_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/' . $seriesId . '_trailer';
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('trailer_file');
			//exit();
			//$output=shell_exec('ls');
			$cmd = 'ffmpeg -i uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 240x320 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . '_240x320.m3u8';

			$cmd1 = 'ffmpeg -i uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 360x640 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . '_360x640.m3u8';

			$cmd2 = 'ffmpeg -i uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 480x800 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $seriesId . '_trailer/' . $video_filename . '_480x800.m3u8';

			$output = shell_exec($cmd);
			$output1 = shell_exec($cmd1);
			$output2 = shell_exec($cmd2);

			$myfile = fopen("uploads/Videos/" . $seriesId . "_trailer/" . $seriesId . "_trailer.m3u8", "w") or die("Unable to open file!");
			$txt = "#EXTM3U
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=700000
" . $video_filename . "_240x320.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=1000000
" . $video_filename . "_360x640.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=2000000
" . $video_filename . "_480x800.m3u8";

			fwrite($myfile, $txt);
			fclose($myfile);

			$mydir = "uploads/Videos/" . $seriesId . "_trailer";
			$myfiles = scandir($mydir);
			unset($myfiles[0]);
			unset($myfiles[1]);
			print_r($myfiles);
			//exit();
			/*
					$temp_file_path = 'uploads/Videos/'.$video_filename;
					$keyname = "videos/series/trailer/{$video_filename}";
					$video_result = $this->S3->uploadMovie($video_filename,$temp_file_path,$keyname);*/
			//	print_r($video_result);
			//	die();

			foreach ($myfiles as $key) {
				$temp_file_path = 'uploads/Videos/' . $seriesId . '_trailer/' . $key;
				$keyname = "videos/series/season/trailer/" . $seriesId . "_trailer/{$key}";
				$this->S3->uploadFile($key, $temp_file_path, $keyname);
				unlink($temp_file_path);
			}

			// print_r($video_result);
			// die();
			$keyname1 = "videos/series/season/trailer/" . $seriesId . "_trailer/" . $seriesId . "_trailer.m3u8";
			
		$video_result = "https://s-sgc1.cloud.gcore.lu/oops1234/videos/series/season/trailer/" . $seriesId . "_trailer/" . $seriesId . "_trailer.m3u8";


			$condition = "";
			$data = array(
				'seasonId' => $seriesId,
				'keyName' => $keyname1,
				'trailerLink' => $video_result,
			);
			$this->Crud_model->SaveData("season_trailer_data", $data, $condition);

			$movCondn = "seasonId='{$seriesId}'";
			$saveData = array(
				'trailer' => 1,
			);
			echo $movCondn;
			//exit();
			$this->Crud_model->SaveData("seasons", $saveData, $movCondn);

			//unlink('uploads/Videos/'.$video_filename);
			rmdir('uploads/Videos/' . $seriesId . '_trailer');
			$this->session->set_flashdata('message', 'Trailer added Successfuly');
			redirect(site_url(SEASONVIEW . '/' . base64_encode($seriesId)));
		} else {
			$this->session->set_flashdata('message', 'Please Upload mp4 Only');
			redirect(site_url(SEASONVIEW . '/' . base64_encode($seriesId)));
		}
	}

	public function uploadSeasonThumbnail() {
		$allowedExts = array("jpg", "PNG", "jpeg");
		$extension_video = pathinfo($_FILES['thumbnail_image']['name'], PATHINFO_EXTENSION);
		$seasonId = $this->input->post('seasonId', true);
		//print_r($_FILES["thumbnail_image"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["thumbnail_image"]["type"] == "image/jpeg") || ($_FILES["thumbnail_image"]["type"] == "image/jpg") || ($_FILES["thumbnail_image"]["type"] == "image/png")) && in_array($extension_video, $allowedExts)) {
			$image_filename = 'seasonIMG' . $seasonId . '-' . rand(000, 999) . time() . $_FILES['thumbnail_image']['name'];

			$config['file_name'] = $image_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('thumbnail_image');

			$temp_file_path = 'uploads/Videos/' . $image_filename;
			$keyname = "videos/series/thumbnail/{$image_filename}";
			$imageResult = $this->S3->uploadImage($image_filename, $temp_file_path, $keyname);
			//	print_r($video_result);
			//	die();
			$condition = "";
			$data = array(
				'seasonId' => $seasonId,
				'keyName' => $keyname,
				'thumbnailLink' => $imageResult,
			);
			$this->Crud_model->SaveData("season_thumbnail", $data, $condition);

			$movCondn = "seasonId='{$seasonId}'";
			$saveData = array(
				'thumbnail' => 1,
			);
			$this->Crud_model->SaveData("seasons", $saveData, $movCondn);

			unlink('uploads/Videos/' . $image_filename);

			$this->session->set_flashdata('message', 'Thumbnail added Successfuly');
			redirect(site_url(SERIES));

		} else {
			$this->session->set_flashdata('message', 'Please Upload jpeg | png | jpg Only');
			redirect(site_url(SERIES));
		}

	}
	public function addEpisode() {
		$seriesId = $this->input->post('seriesId', true);
		$seasonId = $this->input->post('seasonId', true);
		$episodeNo = $this->input->post('episodeNo', true);
		$episodeName = $this->input->post('episodeName', true);

		$episodeDetails = $this->input->post('details', true);
		$releaseDate = $this->input->post('releaseDate', true);

		$checkCond = "seriesId = '{$seriesId}' AND seasonId = '{$seasonId}' AND episodeId = {$episodeNo}";
		$checkEpisode = $this->Crud_model->GetData("episodes", '', $checkCond, '', '', '', '');
		if (sizeof($checkEpisode) > 0) {
			$this->session->set_flashdata('message', "episode {$episodeNo} Already Exists");
			redirect(site_url(SEASONVIEW . '/' . base64_encode($seasonId)));
		};

		$seasonCond = "seasonId = '{$seasonId}'";
		$seasonData = $this->Crud_model->GetData("seasons", '', $seasonCond, '', '', '', 1);
		$seriesCond = "seriesId = '{$seriesId}'";
		$seriesData = $this->Crud_model->GetData("series", '', $seriesCond, '', '', '', 1);

		if (empty($seriesData)) {
			$this->session->set_flashdata('message', "Series doesnot Exists");
			redirect(site_url(SEASONVIEW . '/' . base64_encode($seasonId)));
		};

		$episodeId = "{$seriesId}-S-{$seasonData->seasonNo}-E-{$episodeNo}";

		$data = array(
			'seriesId' => $seriesId,
			'episodeNo' => $episodeNo,
			'episodeName' => $episodeName,
			'seasonId' => $seasonId,
			'episodeId' => $episodeId,
			'episodeDetails' => $episodeDetails,
			'releaseDate' => $releaseDate,
		);
		$seasonCond = "";
		$this->Crud_model->SaveData("episodes", $data, $seasonCond);
		$getLanguage = $this->Crud_model->GetDataAll('language', $seasonCond);

		foreach ($getLanguage as $language) {

			//create subtitle entry
			$datasubtitle = array(
				'episodeId' => $episodeId,
				'language' => $language->id,
			);
			$this->Crud_model->SaveData("episode_subtitle", $datasubtitle, $seasonCond);

			//create audioFile entry
			$dataaudio = array(
				'episodeId' => $episodeId,
				'language' => $language->id,
			);
			$this->Crud_model->SaveData("episode_audio_files", $dataaudio, $seasonCond);

		}
		redirect(site_url(SEASONVIEW . '/' . base64_encode($seasonId)));

	}
	public function viewEpisode($episodeId) {
		$episodeId = base64_decode($episodeId);

		$cond = "episodeId = '{$episodeId}'";
		$episodeData = $this->Crud_model->GetData("episodes", '', $cond, '', '', '', 1);
		$getEpisodeThumbnail = $this->Crud_model->GetData("episode_thumbnail_data", '', $cond, '', '', '', 1);
		$getEpisodeVideo = $this->Crud_model->GetData("episode_video_data", '', $cond, '', '', '', 1);
		$getEpisodeSubtitle = $this->Crud_model->GetData("episode_subtitle", '', $cond, '', '', '', '');
		$getEpisodeAudioFiles = $this->Crud_model->GetData("episode_audio_files", '', $cond, '', '', '', '');
		$cond = "seriesId = '{$episodeData->seriesId}'";
		$seriesData = $this->Crud_model->GetData("series", '', $cond, '', '', '', 1);
		$cond = "seriesId = '{$episodeData->seriesId}' AND seasonId = '{$episodeData->seasonId}'";
		$seasonData = $this->Crud_model->GetData("seasons", '', $cond, '', '', '', 1);

		$langCondn1 = "episode_audio_files.episodeId = '" . $episodeId . "'";
		$joinTables = array('language');
		$jointype = 'left';

		$joincond1 = array('episode_audio_files.language = language.id ');
		$getEpisodeAudioFiles = $this->Crud_model->multijoin("episode_audio_files", '', $langCondn1, '', '', '', $joinTables, $joincond1, $jointype, '');
		//print_r($getEpisodeAudioFiles);
		//die();

		$langCondn2 = "episode_subtitle.episodeId = '" . $episodeId . "'";
		$joincond2 = array('episode_subtitle.language = language.id ');
		$getEpisodeSubtitle = $this->Crud_model->multijoin("episode_subtitle", '', $langCondn2, '', '', '', $joinTables, $joincond2, $jointype, '');

		$data = array(
			'heading' => 'Episode Details',
			'episodeHearing' => 'Episodes',
			'episodeData' => $episodeData,
			'season' => $seasonData,
			'seriesData' => $seriesData,
			'episodeData' => $episodeData,
			'getEpisodeThumbnail' => $getEpisodeThumbnail,
			'getVideoLink' => $getEpisodeVideo,
			'subtitleFiles' => $getEpisodeSubtitle,
			'audioFiles' => $getEpisodeAudioFiles,
		);
		// print_r($seriesData);
		// die();
		$this->load->view('series/episodeView.php', $data);

	}
	public function uploadEpisodeVideo() {
		$allowedExts = array("mp4", "wma");
		$extension_video = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);
		$episodeId = $this->input->post('episodeId', true);

		if ((($_FILES["video_file"]["type"] == "video/mp4")) && in_array($extension_video, $allowedExts)) {
			$video_filename = str_replace(' ', '_', 'mov' . $episodeId . '-' . rand(000, 999) . time() . $_FILES['video_file']['name']);
			mkdir('uploads/Videos/' . $episodeId, 0777);
			$config['file_name'] = $video_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/' . $episodeId;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('video_file');

			$cmd = 'sudo ffmpeg -i uploads/Videos/' . $episodeId . '/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 240x320 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $episodeId . '/' . $video_filename . '_240x320.m3u8';

			$cmd1 = 'sudo ffmpeg -i uploads/Videos/' . $episodeId . '/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 360x640 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $episodeId . '/' . $video_filename . '_360x640.m3u8';

			$cmd2 = 'sudo ffmpeg -i uploads/Videos/' . $episodeId . '/' . $video_filename . ' -c:a aac -strict experimental -c:v libx264 -s 480x800 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/' . $episodeId . '/' . $video_filename . '_480x800.m3u8';

			$output = shell_exec($cmd);
			$output1 = shell_exec($cmd1);
			$output2 = shell_exec($cmd2);

			$myfile = fopen("uploads/Videos/" . $episodeId . "/" . $episodeId . ".m3u8", "w") or die("Unable to open file!");
			$txt = "#EXTM3U
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=700000
" . $video_filename . "_240x320.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=1000000
" . $video_filename . "_360x640.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=2000000
" . $video_filename . "_480x800.m3u8";

			fwrite($myfile, $txt);
			fclose($myfile);

			$mydir = "uploads/Videos/" . $episodeId;
			$myfiles = scandir($mydir);
			unset($myfiles[0]);
			unset($myfiles[1]);

			/*$temp_file_path = 'uploads/Videos/'.$video_filename;
					$keyname = "videos/series/video/{$video_filename}";
					$video_result = $this->S3->uploadMovie($video_filename,$temp_file_path,$keyname);*/

			foreach ($myfiles as $key) {

				$temp_file_path = 'uploads/Videos/' . $episodeId . '/' . $key;
				$keyname = "videos/series/video/{$episodeId}/{$key}";
				$this->S3->uploadFile($key, $temp_file_path, $keyname);
				 unlink($temp_file_path);

			}

			// print_r($video_result);
			// die();
			$keyname1 = "videos/series/video/" . $episodeId . "/" . $episodeId . ".m3u8";
			$video_result = "https://s-sgc1.cloud.gcore.lu/oops1234/videos/series/video/" . $episodeId . "/" . $episodeId . ".m3u8";


			//	print_r($video_result);
			//	die();
			$condition = "";
			$data = array(
				'episodeId' => $episodeId,
				'keyName' => $keyname1,
				'videoLink' => $video_result,
			);
			$this->Crud_model->SaveData("episode_video_data", $data, $condition);

			$movCondn = "episodeId='{$episodeId}'";
			$saveData = array(
				'videoLink' => 1,
			);
			$this->Crud_model->SaveData("episodes", $saveData, $movCondn);

			rmdir('uploads/Videos/' . $episodeId);

			$this->session->set_flashdata('message', 'Video added Successfuly');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));

		} else {
			$this->session->set_flashdata('message', 'Please Upload mp4 Only');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));
		}

	}
	public function uploadEpisodeAudio() {
		$allowedExts = array("mp3");
		$episodeId = $this->input->post('episodeId', true);
		$languageId = $this->input->post('language', true);
		$languageName = $this->input->post('name', true);
		$extension_video = pathinfo($_FILES["$languageName"]['name'], PATHINFO_EXTENSION);
		// print_r($languageName);
		// print_r($_FILES["$languageName"]["type"]);
		// print_r($extension_video);
		// die();

		if ((($_FILES["$languageName"]["type"] == "audio/mpeg")) && in_array($extension_video, $allowedExts)) {
			$image_filename = "$languageName-" . $episodeId . '-' . rand(000, 999) . time() . $_FILES["$languageName"]['name'];
			$config['file_name'] = $image_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/';
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("$languageName");
			$temp_file_path = 'uploads/Videos/' . $image_filename;
			$keyname = "videos/series/audio/{$image_filename}";
			$fileLink = $this->S3->uploadFile($image_filename, $temp_file_path, $keyname);

			$condition = "episodeId='$episodeId' and language='$languageId'";

			$data = array(
				'keyName' => $keyname,
				'audioFileLink' => $fileLink,
			);
			$this->Crud_model->SaveData("episode_audio_files", $data, $condition);

			// $movCondn = "id='{$movieId}'"	;
			// $saveData = array(
			// 	'audioFile'=>'yes'
			// );
			// $this->Crud_model->SaveData("movies",$saveData,$movCondn);

			unlink('uploads/Videos/' . $image_filename);

			$this->session->set_flashdata('message', 'Audio File added Successfuly');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));

		} else {
			$this->session->set_flashdata('message', 'Please Upload mp3');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));
		}

	}
	public function uploadEpisodeThumbnail() {
		$allowedExts = array("jpg", "png", "jpeg");
		$extension_video = pathinfo($_FILES['thumbnail_image']['name'], PATHINFO_EXTENSION);
		$episodeId = $this->input->post('episodeId', true);
		//print_r($_FILES["thumbnail_image"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["thumbnail_image"]["type"] == "image/jpeg") || ($_FILES["thumbnail_image"]["type"] == "image/jpg") || ($_FILES["thumbnail_image"]["type"] == "image/png")) && in_array($extension_video, $allowedExts)) {
			$image_filename = 'EPImage' . $episodeId . '-' . rand(000, 999) . time() . $_FILES['thumbnail_image']['name'];

			$config['file_name'] = $image_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('thumbnail_image');

			$temp_file_path = 'uploads/Videos/' . $image_filename;
			$keyname = "videos/series/thumbnail/{$image_filename}";
			$imageResult = $this->S3->uploadImage($image_filename, $temp_file_path, $keyname);
			//	print_r($video_result);
			//	die();
			$condition = "";
			$data = array(
				'episodeId' => $episodeId,
				'keyName' => $keyname,
				'thumbnailLink' => $imageResult,
			);
			$this->Crud_model->SaveData("episode_thumbnail_data", $data, $condition);

			$movCondn = "episodeId='{$episodeId}'";
			$saveData = array(
				'thumbnailImage' => 1,
			);
			$this->Crud_model->SaveData("episodes", $saveData, $movCondn);

			unlink('uploads/Videos/' . $image_filename);

			$this->session->set_flashdata('message', 'Thumbnail added Successfuly');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));

		} else {
			$this->session->set_flashdata('message', 'Please Upload jpeg | png | jpg Only');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));
		}

	}

	public function uploadEpisodeSubtitles() {
		$allowedExts = array("txt");
		$episodeId = $this->input->post('episodeId', true);
		$languageId = $this->input->post('language', true);
		$languageName = $this->input->post('name', true);
		$extension_video = pathinfo($_FILES["$languageName"]['name'], PATHINFO_EXTENSION);
		// print_r($_FILES["$languageName"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["$languageName"]["type"] == "text/plain")) && in_array($extension_video, $allowedExts)) {
			$image_filename = "$languageName-" . $episodeId . '-' . rand(000, 999) . time() . $_FILES["$languageName"]['name'];
			$config['file_name'] = $image_filename;
			$config['upload_path'] = getcwd() . '/uploads/Videos/';
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload("$languageName");
			$temp_file_path = 'uploads/Videos/' . $image_filename;
			$keyname = "videos/series/subtitle/{$image_filename}";
			$fileLink = $this->S3->uploadFile($image_filename, $temp_file_path, $keyname);
			// print_r($fileLink);
			// die();
			$condition = "episodeId='$episodeId' and language='$languageId'";
			$data = array(
				'keyName' => $keyname,
				'subtitle_fileLink' => $fileLink,
			);
			$this->Crud_model->SaveData("episode_subtitle", $data, $condition);
			// print_r( $this->Crud_model->SaveData("movie_subtitle",$data,$condition));
			// die();

			unlink('uploads/Videos/' . $image_filename);

			$this->session->set_flashdata('message', 'Subtitle added Successfuly');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));

		} else {
			$this->session->set_flashdata('message', 'Please Upload txt or srt  Only');
			redirect(site_url(EPISODEVIEW . '/' . base64_encode($episodeId)));
		}

	}

public function deleteSVideos(){


		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "series.seriesId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("series",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seriesId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIESVIEW));			
			} else {
				
				$keyname = $videoData['seriesId'];
				$slag_trailer = '0';
				$data = array(
					"trailer" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("series_trailer_data","seriesId='".$id."'",'');
				$this->Crud_model->SaveData("series", $data, $cond);

					$msg = 'Series Videos has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIESVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIESVIEW.'/'.base64_encode($id)));
					
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


	public function deleteSThumbs(){


		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "series.seriesId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("series",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seriesId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIESVIEW));			
			} else {
				
				$keyname = $videoData['seriesId'];
				$slag_trailer = '0';
				$data = array(
					"thumbnail" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("series_thumbnail","seriesId='".$id."'",'');
				$this->Crud_model->SaveData("series", $data, $cond);

					$msg = 'Series thumbnail has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIESVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIESVIEW.'/'.base64_encode($id)));
					
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


	public function deleteSBanners(){


		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "series.seriesId = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("series",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seriesId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIESVIEW));			
			} else {
				
				$keyname = $videoData['seriesId'];
				$slag_trailer = '0';
				$data = array(
					"banner" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("series_banner_data","seriesId='".$id."'",'');
				$this->Crud_model->SaveData("series", $data, $cond);

					$msg = 'Series banner has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIESVIEW.'/'.base64_encode($id)));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIESVIEW.'/'.base64_encode($id)));
					
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
	
	public function deleteVideo(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "series.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("series",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seriesId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['seriesId'];
				$deleteS3 = $this->S3->deleteVideo($keyname);
				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("series","id='".$id."'",'');

					$msg = 'series has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
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


	public function deleteEPISODE(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "episodes.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("episodes",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['episodeId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['episodeId'];
				$deleteS3 = $this->S3->deleteVideo($keyname);
				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("episodes","id='".$id."'",'');

					$msg = 'episodes has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
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

	
	public function deleteSeason(){
		
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "seasons.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("seasons",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seasonId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['seasonId'];
				$deleteS3 = $this->S3->deleteVideo($keyname);
				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("seasons","id='".$id."'",'');

					$msg = 'episodes has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
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

public function deleteEPVideos(){


		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "episodes.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("episodes",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['episodeId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['episodeId'];
				$slag_trailer = '0';
				$data = array(
					"videoLink" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("episode_video_data","episodeId='".$id."'",'');
				$this->Crud_model->SaveData("episodes", $data, $cond);

					$msg = 'Series banner has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
					
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
	

	public function deleteEPThumbs(){
	
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "episodes.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("episodes",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['episodeId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['episodeId'];
				$slag_trailer = '0';
				$data = array(
					"thumbnailImage" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("episode_thumbnail_data","episodeId='".$id."'",'');
				$this->Crud_model->SaveData("episodes", $data, $cond);

					$msg = 'Series banner has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					redirect(site_url(SERIES));
					
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

//session 


public function deleteSEVideos(){


		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "seasons.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("seasons",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seasonId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['seasonId'];
				$slag_trailer = '0';
				$data = array(
					"trailer" => $slag_trailer
					);
		

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {
				$res=$this->Crud_model->DeleteData("season_trailer_data","seasonId='".$id."'",'');
				$this->Crud_model->SaveData("seasons", $data, $cond);

					$msg = 'Series banner has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					//redirect(site_url(SERIES));
					redirect(site_url(SEASONVIEW . '/' . base64_encode($id)));

				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					//redirect(site_url(SERIES));
					redirect(site_url(SEASONVIEW . '/' . base64_encode($id)));

					
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
	

	public function deleteSEThumb(){
	
		$id = $this->input->post('id',TRUE);
		
		if(!empty($id)){

			$cond = "seasons.id = '".$id."'";
			
			$videoData = $this->Crud_model->GetDataArr("seasons",'', $cond, '', '', '', '1');
			
			//print_r($videoData); die();
			if(!$videoData['seasonId']) {
				$this->session->set_flashdata('message', 'Try Again');
				redirect(site_url(SERIES));			
			} else {
				
				$keyname = $videoData['seasonId'];
				$slag_trailer = '0';
				$data = array(
					"thumbnail" => $slag_trailer
					);
	

				$deleteS3 = $this->S3->deleteVideo($keyname);

				if($deleteS3['DeleteMarker']) {

				$res=$this->Crud_model->DeleteData("season_thumbnail","seasonId='".$id."'",'');

				$this->Crud_model->SaveData("seasons", $data, $cond);

					$msg = 'Series banner has been deleted successfully';
					$this->session->set_flashdata('message', $msg);
					//redirect(site_url(SERIES));
				}
				else{
					$msg = 'Something Went Wrong Please try again';
					$this->session->set_flashdata('message', $msg);
					//redirect(site_url(SERIES));
					
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

}
