<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller {
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
		$notification_log = $this->Crud_model->GetDataAll("notification_log", $cond);

		$data = array(
			'heading' => "Notification Details",
			'bread' => "Notification",
			'flag' => $flag,
			'notification_log' => $notification_log,

		);
	
		$this->load->view('notification/notification.php', $data);
	}

	public function sendNotification() {

		$data['user_type'] = $this->input->post('user_type', true);
		$data['title'] = $this->input->post('title', true);
		$data['message'] = $this->input->post('message', true);
		$data['datetime	'] = $this->input->post('message', true);

		$registration_ids = array();

		if ($data['user_type'] != 'all') {

			$cond = "deviceId !='' AND  subscriptionType ='" . $data['user_type'] . "'";
		} else {
			$cond = "deviceId !=''";
		}
		
		 $fields = "NUs.deviceId";
		 $joincon = "NUs.user_detail_id = Us.user_id";
		 $groupby = "NUs.deviceId";
		 
		

	$notification_log = $this->Crud_model->resultgr_getall("num_device_login_by_user NUs", $fields, "user_details Us", $joincon, "left", $groupby,"");



		 

		$registration_ids = array_column($notification_log, 'deviceId');


		//$deviceIdList = implode(' , ', $registration_ids);

		

		define('API_ACCESS_KEY', 'AAAAJVhPOqg:APA91bHUCiiEg-XpkFZAAVCUpJTA8FJopTOQEjlRUlF4g0sRdl0Y2f52A0a4Crs_a7rf2HY57TCkSIJLVzhSPKFaPFiMn32cl40eVTN5azne5WntYrC5yl9vmy_dOyAzvJoNhIoPVD8C');

		
		$fcmMsg = array(
			'title' => $data['title'],
			'body' => $data['message'],
			'sound' => "default",
			'color' => "#203E78",
		);

	//	$deviceId = 'dlh0mKTXReOedINSI7raJP:APA91bFQm62TIQ5p2Kvtnj-zq4j4yukEstZEWuinz7QApnRHngnQg3iXphVHv707WRUrFdnCoPuYBpwpGI_bvxTlVA8hl6mEcXMy4-zzt0SAAMY9zAAdXS9-LyWwsJ0woADjaGG5rWHi';

		$fcmFields = array(
			//'to' => $deviceId,// 'to' => $singleID ;  // expecting a single ID
			'registration_ids' => $registration_ids, // expects an array of ids
			'priority' => 'high', // options are normal and high, if not set, defaults to high.
			'notification' => $fcmMsg,
		);
		

			

		$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json',
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
		$result = curl_exec($ch);
		curl_close($ch);
	
	
		$res = json_decode($result);

			
	
		if (($res->success !== '0')  && ($counter <= '1000')) {

			$condition = "";
			$this->Crud_model->SaveData("notification_log", $data, $condition);


			$this->session->set_flashdata('message', 'Notification send Successfully');
			redirect(site_url(NOTIFICATION));

		} else {

			$error = ' Error ' . $res->results[0]->error;

			$this->session->set_flashdata('message', $error);
			redirect(site_url(NOTIFICATION));

		}

	
	}
}
