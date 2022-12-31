<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TodayBonus extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->library('upload');
       $this->load->library('image_lib');
       $this->load->model('TodayBonus_model');
   } 

   public function index()
   {
      //print_r($isBalanceZero);exit();
      $data=array(
         'heading'=>"Today's Bonus List",
         'bread'=>"Today's Bonus",

         );
      $this->load->view('referral/todaybonus_list',$data);
   }

   
   public function ajax_manage_page()
   {
      $condition = "date(ru.created)='".date("Y-m-d")."'";
      $getRefUsers = $this->TodayBonus_model->get_datatables('referal_user_logs ru',$condition);
     //print_r($getRefUsers);exit;	
      if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }
      $data = array();
                 
      foreach ($getRefUsers as $refUsers) 
      {
        if($refUsers->fromUserId==0){
          $referredBy = "Admin";
        }elseif(!empty($refUsers->referredBy)){
          $referredBy = $refUsers->referredBy;
        }else{
          $referredBy = "NA";
        }

        //if(!empty($refUsers->referredBy)){ $referredBy = $refUsers->referredBy; }else{ $referredBy = 'NA'; }
        if(!empty($refUsers->toUserName)){ $toUserName = $refUsers->toUserName; }else{ $toUserName = 'NA'; }

        if(!empty($refUsers->referalAmountBy) && $refUsers->referalAmountBy=='Register'){ $referalAmountBy = "<span class='label label-success'>".$refUsers->referalAmountBy."</span>"; }else{ $referalAmountBy = "<span class='label label-warning'>".$refUsers->referalAmountBy."</span>"; }

        if(!empty($refUsers->referalAmount)){ $referalAmount = $refUsers->referalAmount; }else{ $referalAmount = "NA"; }

  			$no++;
  			$nestedData = array();
  			$nestedData[] = $no;
        $nestedData[] = ucfirst($referredBy);
  			$nestedData[] = ucfirst($toUserName);
  			$nestedData[] = $referalAmount;
  			$nestedData[] = $referalAmountBy;

  			$data[] = $nestedData;
      }

      $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->TodayBonus_model->count_all('referal_user_logs ru',$condition),
               "recordsFiltered" => $this->TodayBonus_model->count_filtered('referal_user_logs ru',$condition),
               "data" => $data,
               "csrfHash" => $this->security->get_csrf_hash(),
               "csrfName" => $this->security->get_csrf_token_name(),
            );
      echo json_encode($output);
   }

}
?>