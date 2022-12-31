<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Movies extends CI_Controller{
	public function __construct(){
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

	public function index($flag =""){
		
		$cond = "";
		$movie_data = $this->Crud_model->GetDataAll("movies", $cond);
		$subscription_plan_data = $this->Crud_model->GetDataAll("plan_details",$cond);
		$categories_list = $this->Crud_model->GetDataAll("categories_list",$cond);

	   
	   $data = array(
		   'heading' => "Movies",
		   'bread' => "Movies",
		   'flag' => $flag,
		   'movie_data'=>$movie_data,
		   'subscription_plan_data'=>$subscription_plan_data,
		   'categories_list'=>$categories_list

	   );
	   //print_r($movie_data);
	   //die();
	   $this->load->view('movies/list.php', $data);
	}

	public function addMovies(){
		$name = $this->input->post('name',true);
		$cast = $this->input->post('cast',true);
		$director = $this->input->post('director',true);
		$categories = $this->input->post('categories',true);
		$movieLongDescription = $this->input->post('movieLongDescription',true);
		$movieShortDescription = $this->input->post('movieShortDescription',true);
		$movieType = $this->input->post('movieType',true);
		$releaseDate = $this->input->post('releaseDate',true);
		$condition = "";
		//$languageDetails = 	$this->Crud_model->GetDataAll("language",$condition);
		$movieId = 'MOV'.rand(0,999).time();
		// print_r($categories);
		//  die();
		$data = array(
			'movieId'=>$movieId,
			'movieName' => $name,
			'movieLongDescription' => $movieLongDescription,
			'movieShortDescription' => $movieShortDescription,
			'cast'=>$cast,
			'director'=>$director,			
			'movieCategory' => $categories,
			'movieType'=> $movieType,
			'releaseDate'=>$releaseDate								
			);
		
			
		$this->Crud_model->SaveData("movies",$data,$condition);		
		$getLanguage = $this->Crud_model->GetDataAll('language',$condition);

		foreach($getLanguage as $language){
			
			//create subtitle entry
			$datasubtitle = array(
				'movieId'=>$movieId,
				'language'=>$language->id
			);
			$this->Crud_model->SaveData("movie_subtitle",$datasubtitle,$condition);
			
			//create audioFile entry
			$dataaudio = array(
				'movieId'=>$movieId,
				'language'=>$language->id
			);
			$this->Crud_model->SaveData("movie_audio_files",$dataaudio,$condition);

		}
		
		
		$this->session->set_flashdata('message', 'Movie added Successfuly');
		redirect(site_url(MOVIE));				
	}


	public function EditMovies(){
		$name = $this->input->post('name',true);
		$cast = $this->input->post('cast',true);
		$director = $this->input->post('director',true);
		$categories = $this->input->post('categories',true);
		$movieLongDescription = $this->input->post('movieLongDescription',true);
		$movieShortDescription = $this->input->post('movieShortDescription',true);
		$movieType = $this->input->post('movieType',true);
		$releaseDate = $this->input->post('releaseDate',true);
		
		$movieId = $this->input->post('movieId',true);
		$condition = "movies.movieId = '" .$movieId. "'";

		$data = array(
			'movieName' => $name,
			'movieLongDescription' => $movieLongDescription,
			'movieShortDescription' => $movieShortDescription,
			'cast'=>$cast,
			'director'=>$director,			
			'movieCategory' => $categories,
			'movieType'=> $movieType,
			'releaseDate'=>$releaseDate								
			);
		
			
		$this->Crud_model->SaveData("movies",$data,$condition);	
		$cond = "";
	
		$getLanguage = $this->Crud_model->GetDataAll('language',$cond);

		foreach($getLanguage as $language){
			
			//create subtitle entry
			$datasubtitle = array(
				'movieId'=>$movieId,
				'language'=>$language->id
			);
			

			$this->Crud_model->SaveData("movie_subtitle",$datasubtitle,$cond);
			
			//create audioFile entry
			$dataaudio = array(
				'movieId'=>$movieId,
				'language'=>$language->id
			);
			$this->Crud_model->SaveData("movie_audio_files",$dataaudio,$cond);

		}
		
		
		$this->session->set_flashdata('message', 'Edit Movie details Successfuly');
		redirect(site_url(MOVIE));				
	}

	
	public function view($id){
		$id=base64_decode($id);
	
		$cond = "movieId = '".$id."'";
		$getMovieData = $this->Crud_model->GetData("movies",'',$cond,'','','',1);
		$condCat = "id = '$getMovieData->movieCategory'";
		$getCategories = $this->Crud_model->GetData("categories_list",'',$condCat,'','','',1);
		// print_r($getCategories);
		// die();
		$vid_cond = "mv.movieId= '".$id."'";
		$getVideoLink = $this->Crud_model->GetData("movie_video_data mv",'',$vid_cond,'','','',1);
	
		$langCondn1="movie_audio_files.movieId = '".$id."'";
		$joinTables = array('language');
		$jointype= 'left';

		$joincond1 = array('movie_audio_files.language = language.id ');
		$getMovieAudioFiles = $this->Crud_model->multijoin("movie_audio_files",'',$langCondn1,'','','',$joinTables,$joincond1,$jointype,'');
		 //print_r($getMovieAudioFiles);
		 //die();

		$langCondn2="movie_subtitle.movieId = '".$id."'";
		$joincond2 = array('movie_subtitle.language = language.id ');
		$getMovieSubtitle = $this->Crud_model->multijoin("movie_subtitle",'',$langCondn2,'','','',$joinTables,$joincond2,$jointype,'');
		// print_r(sizeof($getMovieSubtitle) );
		// die();
		//$getMovieAudioFiles = $this->Crud_model->GetDataAll("movie_audio_files mv",$vid_cond);
		$getThumbnailData = $this->Crud_model->GetData("movie_thumbnail_data mv",'',$vid_cond,'','','',1);
		$getBannerData = $this->Crud_model->GetData("movie_banner_data	mv",'',$vid_cond,'','','',1);		$getBannerData = $this->Crud_model->GetData("movie_banner_data	mv",'',$vid_cond,'','','',1);
		$getTrailerData = $this->Crud_model->GetData("movie_trailer_data mv",'',$vid_cond,'','','',1);

		$Cat_cond ="";

		$categories_list = $this->Crud_model->GetDataAll("categories_list",$Cat_cond);

		// $getDeposite = $this->Crud_model->GetData('user_account','','userId="'.$id.'" ','','id desc');
		// $getWithdraw = $this->Crud_model->GetData('user_account','','userId="'.$id.'" ','','id desc');
		// print_r($getMovieData);
	    // die();
		// $getReferralCount = $this->Crud_model->GetData('referal_user_logs','count(toUserId) as refCount','fromUserId="'.$id.'" and referalAmountBy="Register"','','','','1');
	
		$data = array(
			'heading' => 'Movie Details',
			'breadhead' => 'Movie Users',
			'bread' => 'Movie Details',
			'getMovieData' => $getMovieData,
			'categories_list'=>$categories_list,
			'getCategories' => $getCategories,
			'getVideoLink'=>$getVideoLink,
			'getThumbnailData'=>$getThumbnailData,
			'getMovieSubtitle'=>$getMovieSubtitle,
			'getMovieAudioFiles'=>$getMovieAudioFiles,
			'getBannerData'=>$getBannerData,
			'getTrailerData'=>$getTrailerData
			);
			$this->load->view('movies/view',$data);
	
	}

	public function uploadMovieTrailer(){
		$allowedExts = array("mp4", "wma");
		$extension_video = pathinfo($_FILES['trailer_file']['name'], PATHINFO_EXTENSION);
		$movieId = $this->input->post('movieId',true);

		if ((($_FILES["trailer_file"]["type"] == "video/mp4")) && in_array($extension_video, $allowedExts)) {
			$video_filename = 'movTrailer'.$movieId.'-'.rand(000,999).time().$_FILES['trailer_file']['name'];
			
			if (!file_exists($movieId)) {	
			mkdir('uploads/Videos/'.$movieId.'_trailer', 0777);
			}

					$config['file_name'] = $video_filename;
					$config['upload_path'] = getcwd().'/uploads/Videos/'.$movieId.'_trailer';
					$config['allowed_types'] = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('trailer_file');
					
					$cmd='sudo ffmpeg -i uploads/Videos/'.$movieId.'_trailer/'.$video_filename.' -c:a aac -strict experimental -c:v libx264 -s 240x320 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/'.$movieId.'_trailer/'.$video_filename.'_240x320.m3u8';

					$cmd1='sudo ffmpeg -i uploads/Videos/'.$movieId.'_trailer/'.$video_filename.' -c:a aac -strict experimental -c:v libx264 -s 360x640 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/'.$movieId.'_trailer/'.$video_filename.'_360x640.m3u8';

					$cmd2='sudo ffmpeg -i uploads/Videos/'.$movieId.'_trailer/'.$video_filename.' -c:a aac -strict experimental -c:v libx264 -s 480x800 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/'.$movieId.'_trailer/'.$video_filename.'_480x800.m3u8';

    				$output=shell_exec($cmd);
    				$output1=shell_exec($cmd1);
    				$output2=shell_exec($cmd2);		
							

    				$myfile = fopen("uploads/Videos/".$movieId."_trailer/".$movieId."_trailer.m3u8", "w") or die("Unable to open file!");
					$txt = "#EXTM3U
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=700000
".$video_filename."_240x320.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=1000000
".$video_filename."_360x640.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=2000000
".$video_filename."_480x800.m3u8";

					fwrite($myfile, $txt);
					fclose($myfile);

					$mydir="uploads/Videos/".$movieId."_trailer";
					$myfiles = scandir($mydir);
					unset($myfiles[0]);
					unset($myfiles[1]);
					/*print_r($myfiles);
					echo $output2;
    				exit();*/
					foreach ($myfiles as $key) {
    					$temp_file_path = 'uploads/Videos/'.$movieId.'_trailer/'.$key;
						$keyname = "videos/movie/video/".$movieId."_trailer/{$key}";
						$imageResult = $this->S3->uploadFile($key,$temp_file_path,$keyname);
						print_r($imageResult);
							die();
						//unlink($temp_file_path);	
						unlink($temp_file_path);	
    				}
					
					// print_r($keyname);
					// die();
$keyname1 = "videos/movie/video/".$movieId."_trailer/".$movieId."_trailer.m3u8";
$video_result="http://oops1234.s-sgc1.cloud.gcore.lu/videos/movie/video/".$movieId."_trailer/".$movieId."_trailer.m3u8";
					
					$condition = "";					
					$data = array(
						'movieId' => $movieId,
						'keyName'=> $keyname1,
						'videoLink' =>$video_result					
					);
				//print_r($video_result);
					//die();
					
					$this->Crud_model->SaveData("movie_trailer_data",$data,$condition);

					$movCondn = "movieId='{$movieId}'"	;		
					$saveData = array(
						'trailer'=>1
					);
					$this->Crud_model->SaveData("movies",$saveData,$movCondn);

			unlink('uploads/videos/'.$video_filename);
				rmdir('uploads/Videos/'.$movieId.'_trailer');


					$this->session->set_flashdata('message', 'Trailer added Successfuly');
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		} else{
			$this->session->set_flashdata('message', 'Please Upload mp4 Only');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		}
	}

	public function uploadVideo(){
		$allowedExts = array("mp4", "wma");
		//print_r($_FILES['video_file']);
		$extension_video = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);

		$movieId = $this->input->post('movieId',true);
		

		if ((($_FILES["video_file"]["type"] == "video/mp4")) && in_array($extension_video, $allowedExts)) {
			$video_filename = 'mov'.$movieId.'-'.rand(000,999).time().$_FILES['video_file']['name'];
			
			if (!file_exists($movieId)) {		
			mkdir('uploads/Videos/'.$movieId, 0777);
			}
					
					$config['file_name'] 	   = $video_filename;
					$config['upload_path']    = getcwd().'/uploads/Videos/'.$movieId;
					$config['allowed_types']   = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('video_file');
					

		
					$cmd='sudo ffmpeg -i uploads/Videos/'.$movieId.'/'.$video_filename.' -c:a aac -strict experimental -c:v libx264 -s 240x320 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/'.$movieId.'/'.$video_filename.'_240x320.m3u8';

					$cmd1='sudo ffmpeg -i uploads/Videos/'.$movieId.'/'.$video_filename.' -c:a aac -strict experimental -c:v libx264 -s 360x640 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/'.$movieId.'/'.$video_filename.'_360x640.m3u8';

					$cmd2='sudo ffmpeg -i uploads/Videos/'.$movieId.'/'.$video_filename.' -c:a aac -strict experimental -c:v libx264 -s 480x800 -aspect 16:9 -f hls -hls_list_size 10000000 -hls_time 2 uploads/Videos/'.$movieId.'/'.$video_filename.'_480x800.m3u8';

    				$output=shell_exec($cmd);
    				$output1=shell_exec($cmd1);
    				$output2=shell_exec($cmd2);
				
				
    				
    				$myfile = fopen("uploads/Videos/".$movieId."/".$movieId.".m3u8", "w") or die("Unable to open file!");
					$txt = "#EXTM3U
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=700000
".$video_filename."_240x320.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=1000000
".$video_filename."_360x640.m3u8
#EXT-X-STREAM-INF:PROGRAM-ID=1, BANDWIDTH=2000000
".$video_filename."_480x800.m3u8";

					fwrite($myfile, $txt);
					fclose($myfile);

					$mydir="uploads/Videos/".$movieId;
					$myfiles = scandir($mydir);
					unset($myfiles[0]);
					unset($myfiles[1]);
					//print_r($myfiles);
					//$cmd3="sudo rmdir -r uploads/Videos/".$movieId;
					//echo shell_exec($cmd3);

    				foreach ($myfiles as $key) {
    					$temp_file_path = 'uploads/Videos/'.$movieId.'/'.$key;
						$keyname = "videos/movie/video/{$movieId}/{$key}";
						$this->S3->uploadFile($key,$temp_file_path,$keyname);

						unlink($temp_file_path);	
    				}
					
					
	$keyname1 = "videos/movie/video/".$movieId."/".$movieId.".m3u8";
	$video_result="https://oops1234.s-sgc1.cloud.gcore.lu/videos/movie/video/".$movieId."/".$movieId.".m3u8";
					
					$condition = "";					
					$data = array(
						'movieId' => $movieId,
						'keyName'=> $keyname1,
						'videoLink' =>$video_result					
					);

					//print_r($data);
					//die();

					$this->Crud_model->SaveData("movie_video_data",$data,$condition);

					$movCondn = "movieId='{$movieId}'"	;		
					$saveData = array(
						'video'=>1
					);
					$this->Crud_model->SaveData("movies",$saveData,$movCondn);

					rmdir('uploads/Videos/'.$movieId);

					$this->session->set_flashdata('message', 'Video added Successfuly');
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
				
		} else{
			$this->session->set_flashdata('message', 'Please Upload mp4 Only');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		}	
	}

	public function uploadThumbnailImage(){
		
		$allowedExts = array("jpg","png","jpeg");
		$extension_video = pathinfo($_FILES['thumbnail_image']['name'], PATHINFO_EXTENSION);
		$movieId = $this->input->post('movieId',true);
		// print_r($_FILES["thumbnail_image"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["thumbnail_image"]["type"] == "image/jpeg") || ($_FILES["thumbnail_image"]["type"] == "image/jpg") || ($_FILES["thumbnail_image"]["type"] == "image/png")) && in_array($extension_video, $allowedExts)) {
			$image_filename = 'movImage'.$movieId.'-'.rand(000,999).time().$_FILES['thumbnail_image']['name'];
					
					$config['file_name'] 	   = $image_filename;
					$config['upload_path']    = getcwd().'/uploads/Videos/';
					$config['allowed_types']   = 'jpg|jpeg|png';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('thumbnail_image');
					
					$temp_file_path = 'uploads/Videos/'.$image_filename;
					$keyname = "videos/movie/thumbnail/{$image_filename}";
					$imageResult = $this->S3->uploadImage($image_filename,$temp_file_path,$keyname);
					
					$condition = "";					
					$data = array(
						'movieId' => $movieId,
						'keyName'=> $keyname,
						'imageLink' =>$imageResult					
					);
					$this->Crud_model->SaveData("movie_thumbnail_data",$data,$condition);

					$movCondn = "movieId='{$movieId}'"	;		
					$saveData = array(
						'thumbnailImage'=>1
					);
					$this->Crud_model->SaveData("movies",$saveData,$movCondn);

					unlink('uploads/Videos/'.$image_filename);

					$this->session->set_flashdata('message', 'Thumbnail added Successfuly');
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
				
		} else{
			$this->session->set_flashdata('message', 'Please Upload jpeg | png | jpg Only');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		}

	}

	public function uploadSubtitle(){
		$allowedExts = array("txt");
		$movieId = $this->input->post('movieId',true);
		$languageId = $this->input->post('language',true);
		$languageName = $this->input->post('name',true);
		$extension_video = pathinfo($_FILES["$languageName"]['name'], PATHINFO_EXTENSION);
		// print_r($_FILES["$languageName"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["$languageName"]["type"] == "text/plain") ) && in_array($extension_video, $allowedExts)) {
			$image_filename = "$languageName-".$movieId.'-'.rand(000,999).time().$_FILES["$languageName"]['name'];	
					$config['file_name'] 	   = $image_filename;
					$config['upload_path']    = getcwd().'/uploads/Videos/';
					$config['allowed_types']   = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload("$languageName");
					$temp_file_path = 'uploads/Videos/'.$image_filename;
					$keyname = "videos/movie/subtitle/{$image_filename}";
					$fileLink = $this->S3->uploadFile($image_filename,$temp_file_path,$keyname);
					// print_r($fileLink);
					// die();
					$condition = "movieId='$movieId' and language='$languageId'";					
					$data = array(
						'keyName'=> $keyname,
						'subtitle_fileLink' =>$fileLink					
					);
					$this->Crud_model->SaveData("movie_subtitle",$data,$condition);
					// print_r( $this->Crud_model->SaveData("movie_subtitle",$data,$condition));
					// die();

					unlink('uploads/videos/'.$image_filename);

					$this->session->set_flashdata('message', 'Subtitle added Successfuly');
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
				
		} else{
			$this->session->set_flashdata('message', 'Please Upload txt or srt  Only');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		}

	}

	public function uploadAudioFile(){
		$allowedExts = array("mp3");
		$movieId = $this->input->post('movieId',true);
		$languageId = $this->input->post('language',true);
		$languageName = $this->input->post('name',true);
		$extension_video = pathinfo($_FILES["$languageName"]['name'], PATHINFO_EXTENSION);
		// print_r($languageName);
		// print_r($_FILES["$languageName"]["type"]);
		// print_r($extension_video);
		// die();

		if ((($_FILES["$languageName"]["type"] == "audio/mpeg") ) && in_array($extension_video, $allowedExts)) {
			$image_filename = "$languageName-".$movieId.'-'.rand(000,999).time().$_FILES["$languageName"]['name'];	
					$config['file_name'] 	   = $image_filename;
					$config['upload_path']    = getcwd().'/uploads/Videos/';
					$config['allowed_types']   = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload("$languageName");
					$temp_file_path = 'uploads/Videos/'.$image_filename;
					$keyname = "videos/movie/audio/{$image_filename}";
					$fileLink = $this->S3->uploadFile($image_filename,$temp_file_path,$keyname);

					$condition = "movieId='$movieId' and language='$languageId'";					
					
					$data = array(
						'keyName'=> $keyname,
						'audioFileLink' =>$fileLink					
					);
					$this->Crud_model->SaveData("movie_audio_files",$data,$condition);

					// $movCondn = "id='{$movieId}'"	;		
					// $saveData = array(
					// 	'audioFile'=>'yes'
					// );
					// $this->Crud_model->SaveData("movies",$saveData,$movCondn);

					unlink('uploads/videos/'.$image_filename);

					$this->session->set_flashdata('message', 'Audio File added Successfuly');
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
				
		} else{
			$this->session->set_flashdata('message', 'Please Upload mp3');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		}

	}
	public function uploadBannerImage(){
		
		$allowedExts = array("jpg","png","jpeg");
		$extension_video = pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION);
		$movieId = $this->input->post('movieId',true);
		// print_r($_FILES["thumbnail_image"]["type"]);
		// print_r($extension_video);
		// die();
		if ((($_FILES["banner_image"]["type"] == "image/jpeg") || ($_FILES["banner_image"]["type"] == "image/jpg") || ($_FILES["banner_image"]["type"] == "image/png")) && in_array($extension_video, $allowedExts)) {
			$image_filename = 'movBanner'.$movieId.'-'.rand(000,999).time().$_FILES['banner_image']['name'];
					
					$config['file_name'] 	   = $image_filename;
					$config['upload_path']    = getcwd().'/uploads/Videos/';
					$config['allowed_types']   = 'jpg|jpeg|png';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('banner_image');
					
					$temp_file_path = 'uploads/Videos/'.$image_filename;
					$keyname = "videos/movie/banner/{$image_filename}";
					$imageResult = $this->S3->uploadImage($image_filename,$temp_file_path,$keyname);
					//print_r($config);
					//die();
					$condition = "";					
					$data = array(
						'movieId' => $movieId,
						'keyName'=> $keyname,
						'bannerLink' =>$imageResult					
					);
					$this->Crud_model->SaveData("movie_banner_data",$data,$condition);

					$movCondn = "movieId='{$movieId}'"	;		
					$saveData = array(
						'bannerImage'=>1
					);

					$this->Crud_model->SaveData("movies",$saveData,$movCondn);

					unlink('uploads/Videos/'.$image_filename);

					$this->session->set_flashdata('message', 'Banner added Successfuly');
					redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
				
		} else{
			$this->session->set_flashdata('message', 'Please Upload jpeg | png | jpg Only');
			redirect(site_url(MOVIEVIEW.'/'.base64_encode($movieId)));
		}

	}
}
