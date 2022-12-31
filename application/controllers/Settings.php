<?php 
defined ('BASEPATH') or exit('No direct scripts are allowed');
class Settings extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('image_lib');
	}
	public function index(){
		
		$getdata = $this->Crud_model->GetData('mst_settings','','','','','','1');

		$getsettings = array(
			'heading'=>"Manage Settings",
			'bread' => 'Manage Settings',
			'getdata'=> $getdata,
			'formAction'=>site_url('Settings/update_action')
		);	
		$this->load->view('settings/form',$getsettings);
	}
	
	public function update_action(){
		//print_r($_FILES);exit;
		$id=$this->input->post('id');
		$this->form_rules($id);
			if($this->form_validation->run()==FALSE){
			$this->index();
		}
		else{
			if($_FILES['logo']['name']){
					$photo = 'AT_'.time().$_FILES['logo']['name'];
					$config['file_name'] 	   =$photo;
					$config['upload_path'] 	   = getcwd().'/uploads/settings/';
					$config['allowed_types']   = 'jpg|jpeg|png';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->do_upload('logo');
					unlink('uploads/settings/'.$this->input->post('old_photo'));
			}else{
				$photo = $this->input->post('old_photo',TRUE);
			}
			if($_FILES['apk']['name']){

					$apkFile = rand(000,999).$_FILES['apk']['name'];
					$config1['file_name'] 	   = $apkFile;
					$config1['upload_path']    = getcwd().'/uploads/apkfiles/';
					$config1['allowed_types']   = '*';
					$this->load->library('upload', $config1);
					$this->upload->initialize($config1);
					$this->upload->do_upload('apk');					
					unlink('uploads/apkfiles/'.$this->input->post('apk_old'));
			}else{
				$apkFile = $this->input->post('apk_old',TRUE);
			}

			if($_FILES['videoUrl']['name']){

					$videoFile = rand(000,999).$_FILES['videoUrl']['name'];
					$config1['file_name'] 	   = $videoFile;
					$config1['upload_path']    = getcwd().'/uploads/settings/';
					$config1['allowed_types']   = '*';
					$this->load->library('upload', $config1);
					$this->upload->initialize($config1);
					$this->upload->do_upload('videoUrl');					
					unlink('uploads/settings/'.$this->input->post('old_videoUrl'));
			}else{
				$videoFile = $this->input->post('old_videoUrl',TRUE);
			}

			$data = array(
				'site_title'=>$this->input->post('site_title',TRUE),
				'companyName'=>$this->input->post('companyName',TRUE),
				'address'=>$this->input->post('address',TRUE),
				'email1'=>$this->input->post('email1',TRUE),
				'email2'=>$this->input->post('email2',TRUE),
				'phone'=>$this->input->post('phone',TRUE),
				'apk'=>$apkFile,
				'copyright'=>$this->input->post('copyright',TRUE),
				'contact_us_desc'=>$this->input->post('contact_us_desc',TRUE),
				'website'=>$this->input->post('website',TRUE),
				'topPlayerLimit'=>$this->input->post('topPlayerLimit',TRUE),
				'adminPercent'=>$this->input->post('adminPercent',TRUE),
				'referralBonus'=>$this->input->post('referralBonus',TRUE),
				'version'=>$this->input->post('version',TRUE),
				'baseUrl'=>$this->input->post('baseUrl',TRUE),
				'videoUrl'=>$videoFile,
				'logo'=>$photo,
			);
			$this->Crud_model->SaveData('mst_settings',$data,"id='".$id."'");
			$this->session->set_flashdata('message','Settings has been updated successfully');
			redirect(SETTINGS);
		}
	}

	public function form_rules($id){
		$this->form_validation->set_rules('site_title','Site Title','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('address','Address','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('email1','Email','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('email2','Email1','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('phone','Phone','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('copyright','Copyright','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('contact_us_desc','Contact Us','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('website','Website','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('topPlayerLimit','Top player limit','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('version','Version','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('baseUrl','baseUrl','required',
		array('required'=>"Please Enter %s."));
		$this->form_validation->set_rules('referralBonus','Referral Bonus','required',
		array('required'=>"Please Enter %s."));
	
	}

	public function dayWiseTimings(){
		$getdata = $this->Crud_model->GetData('daywisetimings','','','','','','');

		$getsettings = array(
			'heading'=>"Manage DayWise Timings",
			'bread' => 'Manage DayWise Timings',
			'getdata'=> $getdata,
			'formAction'=>site_url(DAYWISETIMINGSUPDATE)
		);	
		$this->load->view('settings/daySetting',$getsettings);
	}

	public function update_daytimings(){

		$getTimedata = $this->Crud_model->GetData('daywisetimings','','','','','','');
		$error_array = '';
		foreach($getTimedata as $row){
			if(isset($_POST['fromTime1_'.$row->dayIndex]) && isset($_POST['toTime1_'.$row->dayIndex])){

				if(!empty($_POST['fromTime1_'.$row->dayIndex]) && !empty($_POST['toTime1_'.$row->dayIndex])) {

					if(strtotime($_POST['fromTime1_'.$row->dayIndex]) < strtotime($_POST['toTime1_'.$row->dayIndex])){

						$data = array();
						$data['fromTime1'] = date('H:i:s',strtotime($_POST['fromTime1_'.$row->dayIndex]));
						$data['toTime1'] = date('H:i:s',strtotime($_POST['toTime1_'.$row->dayIndex]));
						$data['flag1'] = 'true';

						if(isset($_POST['fromTime2_'.$row->dayIndex]) && isset($_POST['toTime2_'.$row->dayIndex])){
							if(!empty($_POST['fromTime2_'.$row->dayIndex]) && !empty($_POST['toTime2_'.$row->dayIndex])) {

								$time1 = explode(":",$_POST['fromTime2_'.$row->dayIndex])[0];
								$time2 = explode(":",$_POST['toTime2_'.$row->dayIndex])[0];
							
								if($time1 > $time2){
									$fromTime2 = date('Y-m-d').' '.$_POST['fromTime2_'.$row->dayIndex];
									$toTime2 = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')).' '.$_POST['toTime2_'.$row->dayIndex];
								} else {
									$fromTime2 = date('Y-m-d').' '.$_POST['fromTime2_'.$row->dayIndex];
									$toTime2 = date('Y-m-d').' '.$_POST['toTime2_'.$row->dayIndex];
								}
								/*	print_r($fromTime2);echo "<br/>";
								print_r($toTime2);exit;*/

								if(strtotime($fromTime2) < strtotime($toTime2)){
									$data['fromTime2'] = date('H:i:s',strtotime($_POST['fromTime2_'.$row->dayIndex]));
									$data['toTime2'] = date('H:i:s',strtotime($_POST['toTime2_'.$row->dayIndex]));
									$data['flag2'] = 'true';
								} else {
									if($error_array==''){
										$error_array ="Time is not proper for ".$row->day;
									} else if($error_array!='') {
										$error_array .=", ".$row->day;
									}
								}
							} else {
								$data['fromTime2'] = date('H:i:s',strtotime('00:00:00'));
								$data['toTime2'] = date('H:i:s',strtotime('00:00:00'));
								$data['flag2'] = 'false';
							}
						}

						$this->Crud_model->SaveData("daywisetimings",$data,"id='".$row->id."' and dayIndex='".$row->dayIndex."'");
					} else {
						if($error_array==''){
							$error_array ="Time is not proper for ".$row->day;
						} else if($error_array!='') {
							$error_array .=", ".$row->day;
						}
					}
				} else {
					if($error_array==''){
						$error_array ="Time is not proper for ".$row->day;
					} else if($error_array!='') {
						$error_array .=", ".$row->day;
					}
				}
			}
		}

		if(!empty($error_array)){
			$this->session->set_flashdata('message',$error_array);
			redirect(DAYWISETIMINGS);
		} else {
			$this->session->set_flashdata('message','Settings has been updated successfully.');
			redirect(DAYWISETIMINGS);	
		}		

	}

}