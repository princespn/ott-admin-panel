<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->library('upload');
       $this->load->library('image_lib');
       $this->load->model('Referral_model');
   } 

   public function index()
   {
      //print_r($isBalanceZero);exit();
      $data=array(
         'heading'=>"Referral List",
         'bread'=>"Referral",

         );
      $this->load->view('referral/list',$data);
   }

   
   public function ajax_manage_page()
   {
      $condition = "referalAmountBy='playGame'";
      $getRefUsers = $this->Referral_model->get_datatables('referal_user_logs ru',$condition);
      // print_r($this->db->last_query());exit;	
      if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
      $data = array();
                 
      foreach ($getRefUsers as $refUsers) 
      {
        
			  $btn = '';
        $btn = ''.anchor(site_url(REFERRALVIEW.'/'.base64_encode($refUsers->fromUserId)),'<span title="View" class="btn btn-primary btn-circle btn-xs"  data-placement="right" title="View"><i class="fa fa-eye"></i></span>');
         
        if(!empty($refUsers->referralUser)){ $referralUser = $refUsers->referralUser; }else{ $referralUser = 'NA'; }
        // $getRefCount = $this->Crud_model->GetData("referal_user_logs","","fromUserId='".$refUsers->fromUserId."'",'toUserId','','','');
        $getRefCount = $this->Crud_model->GetData("referal_user_logs","","fromUserId='".$refUsers->fromUserId."' and referalAmountBy = 'playGame'",'toUserId','','','');
        // print_r($this->db->last_query()); echo "<br/>";//exit;
       // if(!empty($refUsers->totalRef)){ $totalRef = "<span class='label label-success'>".$refUsers->totalRef."</span>"; }else{ $totalRef = "<span class='label label-danger'>0</span>"; }
        if(!empty($getRefCount)){ $totalRef = "<span class='label label-success'>".count($getRefCount)."</span>"; }else{ $totalRef = "<span class='label label-danger'>0</span>"; }

        if(!empty($refUsers->Amt)){ $Amt = $refUsers->Amt; }else{ $Amt = "NA"; }

  			$no++;
  			$nestedData = array();
  			$nestedData[] = $no;
  			$nestedData[] = ucfirst($referralUser);
  			$nestedData[] = $totalRef;
  			$nestedData[] = $Amt;
  			$nestedData[] = $btn;

  			$data[] = $nestedData;
      }

      $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->Referral_model->count_all('referal_user_logs ru',$condition),
               "recordsFiltered" => $this->Referral_model->count_filtered('referal_user_logs ru',$condition),
               "data" => $data,
               "csrfHash" => $this->security->get_csrf_hash(),
               "csrfName" => $this->security->get_csrf_token_name(),
            );
      echo json_encode($output);
   }

  public function view($id){
    $condition = 'fromUserId="'.base64_decode($id).'" and referalAmountBy="playGame"';
    $getReferralUsers = $this->Referral_model->getReferralRecord($condition);
     $data=array(
         'heading'=>"View of ".$getReferralUsers[0]->referralUser,
         'breadhead'=>"Referral List",
         'bread'=>"View",
         'getReferralUsers'=>$getReferralUsers,
         );
      $this->load->view('referral/view',$data);
  }
   

}
?>