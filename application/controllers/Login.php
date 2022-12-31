<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	    $this->load->library('image_lib');
	} 

	public function index()
	{
		$this->load->view('login/login');
	}

	public function loginAction()
	{
		$response = array(
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
            );
	
		$email = $this->input->post("email",true);
		$password = $this->input->post("password",true);
		$cond = "email='".$email."' and password='".md5($password)."'";
		$user_result = $this->Crud_model->GetData("admin_login",'',$cond,'','','','1');

		if(!empty($user_result))
		{
			if($user_result->status == 'Active')
			{
				$sess_array[SESSION_NAME] = array(
					 'id' => $user_result->id,
					 'name' => $user_result->name,
					 'email' => $user_result->email,
					 'image' => $user_result->image,
					);
				$this->session->set_userdata($sess_array);
				$response['success'] =1;
			}
			else
			{
				$response['success'] =2;
			}
		}
		else
		{
			$response['success'] =3;
		}
		echo json_encode($response);
	}

	public function profile()
	{
		$cond = "id = '".$_SESSION[SESSION_NAME]['id']."'";
		$user_data = $this->Crud_model->GetData("admin_login",'',$cond,'','','','1');
		$data = array(
						'name'=>$user_data->name,
						'email'=>$user_data->email,
						'image'=>$user_data->image,
						'action'=>site_url()."/Login/updateProfile",
					);
		$this->load->view('login/profile',$data);
	}

	public function updateProfile()
	{
		$sess = $this->session->userdata(SESSION_NAME);
		$session_id = $sess['id'];
		
		$condition = "id='".$session_id."'";
		//$image='';
        if ($_FILES['profile_image']['error']==0) 
        {
          $file_element_name='image';
          $_POST['profile_image']='AT_'.rand(0000,9999).$_FILES['profile_image']['name'];

          $config2['image_library'] ='gd2';
          $config2['source_image'] = $_FILES['profile_image']['tmp_name'];
          $config2['new_image'] = getcwd()."/assets/images/profile/".$_POST['profile_image'] ;
          $config2['upload_path'] = getcwd()."/assets/images/profile/".$_POST['profile_image'] ;
          $config2['allowed_types'] = 'JPG|PNG|jpg|png|jpeg|JPEG';
          $config2['maintain_ratio'] = TRUE;
          $config2['max_size'] = '1024';
          $config2['width'] = "200";
          $config2['height'] = "300";
          $this->image_lib->initialize($config2);
          if(!$this->image_lib->resize()) 
          {
          	//print_r("expression");exit();
              echo('<pre>');
              echo ($this->image_lib->display_errors());
          }
          else
          {
            $image=$_POST['profile_image'];
            unlink(getcwd()."/assets/images/profile/".$_POST['old_img']);
          }
        }
        else
		{
			$image=$_POST['old_img'];
		}  

        $data = array(
        				'name' => $_POST['name'],
        				'email' => $_POST['email'],
        				'image' => $image,
        				'modified' => date("Y-m-d,H:i:s"),
        			);
        $this->Crud_model->SaveData("admin_login",$data,$condition);

        $user_data = $this->Crud_model->GetData('admin_login','',$condition,'','','','1');

        if(!empty($user_data))
        {
	        $sess_array[SESSION_NAME] = array(
					 'id' => $user_data->id,
					 'name' => $user_data->name,
					 'email' => $user_data->email,
					 'image' => $user_data->image,
					);
			$this->session->set_userdata($sess_array);
			$this->session->set_flashdata('message', 'Profile has been updated successfully');
        }
        redirect(site_url(DASHBOARD));
	}

	public function changePassword()
	{
		$response = array(
	        'csrfName' => $this->security->get_csrf_token_name(),
	        'csrfHash' => $this->security->get_csrf_hash()
	        );
		$sess_id = $_SESSION[SESSION_NAME]['id'];
		$condition = "id = '".$sess_id."' and password = '".md5($_POST['currentPass'])."' ";
		$getAdmin = $this->Crud_model->GetData('admin_login','',$condition,'','','','1');
		if(!empty($getAdmin))
		{
			$data = array(
							'password' => md5($this->input->post('newPass',TRUE)),
							'modified' => date("Y-m-d, H:i:s"),
						);
			$cond = "id = '".$sess_id."'";
			$this->Crud_model->SaveData("admin_login",$data,$cond);
			$this->session->set_flashdata('message',"Password change successfully");
			$response['success'] =1;
		}
		else
		{
			$response['success'] =0;
		}
		echo json_encode($response);
	}


	public function verifyEmail($id){
		$getData = $this->Crud_model->GetData('user_details','id,email_id,is_emailVerified','id="'.$id.'"','','','','1');
		if(!empty($id) && !empty($getData) && $getData->is_emailVerified=='No'){
			$data= array(
				'is_emailVerified'=>'Yes',
			);
			$this->Crud_model->SaveData("user_details",$data,'id="'.$id.'"');
			redirect('Welcome/emaiVerify/1');
		}elseif($getData->is_emailVerified=='Yes'){
			redirect('Welcome/emaiVerify/2');
		}else{
			redirect('Welcome/emaiVerify/0');
		}
	}

	public function changekey(){



	}
	

	public function logout()
	{
		unset($_SESSION[SESSION_NAME]);
		$this->session->sess_destroy();
		redirect(LOGIN);
	}
}
