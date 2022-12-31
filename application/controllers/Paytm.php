<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Calcutta");

class Paytm extends CI_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->clientId = 'CF52176D69AV0ZRRDYUYU2';
		$this->clientSecret = '9166fe274f1df2c984f49e2979910c160bb690d4';
		$this->env = 'prod';
		$this->baseUrls = array(
		    'prod' => 'https://payout-api.cashfree.com',
		    'test' => 'https://payout-gamma.cashfree.com',
		);
		$this->urls = array(
		    'auth' => '/payout/v1/authorize',
		    'getBene' => '/payout/v1/getBeneficiary/',
		    'addBene' => '/payout/v1/addBeneficiary',
		    'getBeneId' => '/payout/v1/validation/getBeneId?bankAccount=',
		    'removeBeneficiary' => '/payout/v1/removeBeneficiary', 
		    'requestTransfer' => '/payout/v1/requestTransfer',
		    'getTransferStatus' => '/payout/v1/getTransferStatus?transferId='
		);
		$this->header = array(
		    'X-Client-Id: '.$this->clientId,
		    'X-Client-Secret: '.$this->clientSecret, 
		    'Content-Type: application/json',
		);
		$this->baseurl = $this->baseUrls[$this->env];
    }

    public function saveAllDistributerRedeem(){
        $userData =$this->Crud_model->GetData("user_account","*","id='".$_POST['id']."'","","","","1");
        if($userData){
        	if($userData->paymentType=='bank'){
        		$userAccId = $userData->id;
        		$orderId =$userData->orderId;
        		$userId = $userData->user_detail_id;
        		$user_details =$this->Crud_model->GetData("user_details","","id='".$userId."'","","","","1");
        		if($user_details->is_bankVerified=='Verified'){
        			$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
					$admin_rs=($userData->amount*$getSettData->adminPercent)/100;
					$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');
        			
					$userAmt = $userData->amount - $admin_rs;
					$amount =$userData->amount;
					$bankHolderName =$user_details->bankHolderName;
		    		$bankIfsc =$user_details->bankIfsc;
		    		$bankAccountNo =$user_details->bankAccountNo;
		    		$beneId = $bankAccountNo;
		    		$email_id=$beneId.'@gmail.com';
		    		if($user_details->email_id){
		    			$email_id =$user_details->email_id;
		    		}
		    		$mobile ="9822000891";
		    		if($user_details->mobile){
		    			$mobile =$user_details->mobile;
		    		}
					
		    		$token = $this->getToken();// get token

			    	$beneficiary = array(
					    'beneId' =>$beneId,
					    'name' => $bankHolderName,
					    'email' => $email_id,
					    'phone' => $mobile,
					    'bankAccount' => $bankAccountNo,
					    'ifsc' => $bankIfsc,
					    'address1' => 'pune',
					    'city' => 'pune',
					    'state' => 'maharashtra',
					    'pincode' => '411042',
					);
			    	
			  //   $response8 = $this->post_helper('addBene', $beneficiary, $token);
			

			     //  try{
       	// 				$beneId = $beneficiary['beneId'];
			     //    	$finalUrl = $this->baseurl.$this->urls['getBene'].$beneId;
			     //   	 	$response = $this->get_helper($finalUrl, $token); // get beneficiary
			     //    	//echo "<pre>"; print_r($response);exit();
   					//  }
   					//  catch(Exception $ex){
        // 					$msg = $ex->getMessage();
      		// 			  if(strstr($msg, 'Beneficiary does not exist')) {
      					  
      		// 			   $response = $this->post_helper('addBene', $beneficiary, $token);
      		// 			  }
       	// 					// error_log('error in getting beneficiary details');
       	// 					// error_log($msg);
       					
    				// }  

  					//$response = $this->post_helper('addBene', $beneficiary, $token);

    				$beneId = $beneficiary['beneId'];
		        	$finalUrl = $this->baseurl.$this->urls['getBene'].$beneId;
		       	 	$response = $this->get_helper($finalUrl, $token); // get beneficiary


		       	 	//echo "<pre>1nilesh"; print_r($response);
		       	 	// if($response['message']=='Beneficiary does not exist'){
		       	 	// 	 
		       	 	// }
		       	 	  
		       	 	// $response8="";
		       	 	if(isset($response) && $response['message']=='Beneficiary does not exist'){
		       	 		$response8 = $this->post_helper('addBene', $beneficiary, $token);

		       	 			if(isset($response8) && $response8['message']=='Entered bank Account is already registered'){

		       	 				$beneIdacct = $beneficiary['bankAccount'];
		       	 				$beneIdifsc = $beneficiary['ifsc'];
		       	 				
		        				$finalUrl9 = $this->baseurl.$this->urls['getBeneId'].$beneIdacct."&ifsc=".$beneIdifsc;
		        				//echo "<pre>5nilesh"; print_r($finalUrl9.$token);
		       	 				$response9 = $this->get_helper($finalUrl9, $token); // get beneficiary	
		       	 				//echo "<pre>6nilesh"; print_r($response9);

		       	 				$beneficiary['beneId']=$response9['data']['beneId'];
		       	 			}

		       	 		
		       	 		// echo "<pre>"; print_r($response8);
		       	 		// $token = $this->getToken();// get token
		       	 		// $response10 = $this->post_helper('removeBeneficiary', $beneficiary, $token);
		       	 		// echo "<pre>"; print_r($response10);

		       	 		sleep(1);
		       	 		$token = $this->getToken();// get token
		       	 		$beneId = $beneficiary['beneId'];
			        	$finalUrl = $this->baseurl.$this->urls['getBene'].$beneId;
			       	 	$response = $this->get_helper($finalUrl, $token); // get beneficiary
		       	 		//$this->saveAllDistributerRedeem();
		       	 	}

		       	 	//echo "<pre>"; print_r($response);exit();
					 // echo "<pre>";  print_r($response8);
					 // echo "<pre>";  print_r($response);exit();
					
			        $type ='Withdraw';
			        if(isset($response) && ($response['status']=='SUCCESS' || $response['subCode']=='200')){
			        	$resStatus ='Approved';
	        			// $userAmt =5;
			        	$transfer = array(
						    'beneId' => $beneficiary['beneId'],
						    'amount' => $userAmt,
						    'transferId' => $orderId,
						);
			        	$response2 = $this->requestTransfer($token,$transfer);
			        	$res2 = json_decode($response2);
			     
			        	if(isset($res2) && ($res2->status=='SUCCESS' || $response->subCode=='200'))
			        	{

			        		$saveRefundData = array(
					    		'orderId'=>$orderId,
					    		'user_detail_id'=>$userId,
					    		'beneId'=>$beneId,
					    		'paytmStatus'=>$res2->status,
					    		'statusCode'=>$res2->subCode,
					    		'statusMessage'=>$res2->message,
					    		'token'=>$token,					    		
					    		'type'=>$type,
					    		'paymentType'=>'Cashfree',
					            'status'=>$resStatus,
					    		'created'=>date('Y-m-d H:i:s'),
					    		'modified'=>date('Y-m-d H:i:s'),
					        );
					        $saveData = $this->Crud_model->SaveData("user_account",$saveRefundData,'id="'.$userAccId.'"');

					        $saveRefundDataLog = array(
					        		'user_account_id'=>$userAccId,
					        		'orderId'=>$orderId,
					    			'amount'=>$amount,
					    			'beneId'=>$beneId,
					    			'balance'=>$user_details->balance,
					        		'user_detail_id'=>$userId,
					        		'paytmType'=>'byBank',
					        		'paytmStatus'=>$res2->status,
					        		'statusCode'=>$res2->subCode,
					        		'statusMessage'=>$res2->message,
					        		
					        		'type'=>$type,
					        		'paymentType'=>'Cashfree',
					                'status'=>$resStatus,
					        		'created'=>date('Y-m-d H:i:s'),
					        		'modified'=>date('Y-m-d H:i:s'),
					        	);
					        $saveData = $this->Crud_model->SaveData("user_account_logs",$saveRefundDataLog);
					        if (!empty($getAdminData->adminBalance)) {
								$adminTotalAmt = $getAdminData->adminBalance + $admin_rs;
							} else {
								$adminTotalAmt = $admin_rs; 
							}
							$updateAdminData = array(
								'adminBalance'=>$adminTotalAmt,
							);
							$this->Crud_model->SaveData("admin_login",$updateAdminData,"id='".$_SESSION[SESSION_NAME]['id']."'");
							$saveAdminLogData = array(
									'user_account_id'=>$userAccId,
									'from_user_details_id'=>$userId,
									'to_admin_login_id'=>$getAdminData->id,
									'percent'=>$getSettData->adminPercent,
									'total_amount'=>$admin_rs,
									'type'=>'widhdraw',
								);
							$this->Crud_model->SaveData("admin_account_log",$saveAdminLogData);
			        	}else{
			        		 // echo "<pre>";   print_r($res2);exit();
			        		$resStatus ='Failed';
			        		$status='Failed';
			        		$amount =$userData->amount;
			        		$saveRefundData = array(
					    		'orderId'=>$orderId,
					    		'user_detail_id'=>$userId,
					    		'beneId'=>$beneId,
					    		'paytmStatus'=>$res2->status,
					    		'statusCode'=>$res2->subCode,
					    		'statusMessage'=>$res2->message,
					    		'token'=>$token,
					    		
					    		'type'=>$type,
					    		'paymentType'=>'Cashfree',
					            'status'=>$resStatus,
					    		'created'=>date('Y-m-d H:i:s'),
					    		'modified'=>date('Y-m-d H:i:s'),
					        );
					        $saveData = $this->Crud_model->SaveData("user_account",$saveRefundData,'id="'.$userAccId.'"');
					        $saveRefundDataLog = array(
					        		'user_account_id'=>$userAccId,
					        		'orderId'=>$orderId,
					    			'amount'=>$amount,
					    			'beneId'=>$beneId,
					    			'balance'=>$user_details->balance,
					        		'user_detail_id'=>$userId,
					        		'paytmType'=>'byBank',
					        		'paytmStatus'=>$res2->status,
					        		'statusCode'=>$res2->subCode,
					        		'statusMessage'=>$res2->message,
					        		
					        		'type'=>$type,
					        		'paymentType'=>'Cashfree',
					                'status'=>$resStatus,
					        		'created'=>date('Y-m-d H:i:s'),
					        		'modified'=>date('Y-m-d H:i:s'),
					        	);
					        $saveData = $this->Crud_model->SaveData("user_account_logs",$saveRefundDataLog);
			        		$updateBal =  $user_details->balance + $userData->amount;
			        		$winWallet =  $user_details->winWallet + $userData->amount;
				            $updateUserBal = array(
				                'balance'=> $updateBal,
				                'winWallet'=> $winWallet,
				                );
							$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
			        	}
			        	$this->session->set_flashdata('message', '<span>'.$res2->message.'</span>');
			        }else{
			        	$this->session->set_flashdata('message', '<span>'.$response['message'].'</span>');
			        }
					// echo "<pre>"; print_r($orderId);
					// echo "<pre>"; print_r($userAmt);
					// echo "<pre>"; print_r($response);
     //    			exit();

        		}else{
        			$this->session->set_flashdata('message', '<span>Bank not verified.</span>');
        			// $returnData['message']='Bank not verified';
        		}
        	}else{
        		$this->session->set_flashdata('message', '<span>Only paymentType bank accept.</span>');
        	}
        }
   
       redirect(site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($_POST['id'])));
    }
    function getStatus(){
  
    	$transfer = array(
			    'beneId' => 'ashishz',
			    'amount' => '10.00',
			    'transferId' => 'decv543231234',
			);
    	$token="ab9JCVXpkI6ICc5RnIsICN4MzUIJiOicGbhJye.ab9JCSUVVQflEUBRVVPlVQQJiOiIWdzJCL0czN2UjN5gTNxojI0FWaiwCN3MzN1YTO4UTM6ICc4VmIsISO4EjL4UTMuQzMy4yMxIiOiAXaiwSZzxWYmpjIrNWZoNUZyVHdh52ZpNnIsQTM1IjOiQWS05WdvN2YhJCLiITVZVVWEJlUaBjVBljNEZzNxITNGNkI6ICZJRnbllGbjJye.ab9C-VmIMSRydJx9n4s3RurBACzTHnYczdSAC3CkoOOK1utO7vPIcTPqtI8tGFedpi";
    	$resultvallue=$this->getTransferStatus($token,$transfer);
    	print_r(json_encode($resultvallue));exit();
    }
    #request transfer
	function requestTransfer($token,$transfer){
	    try{

	        // global $transfer;
	        $response = $this->post_helper('requestTransfer', $transfer, $token);
	        error_log('transfer requested successfully');
	        $resultvallue=$this->getTransferStatus($token,$transfer);
	        return json_encode($resultvallue);
	         
	    }
	    catch(Exception $ex){
	        $msg = $ex->getMessage();

	        
	        error_log('error in requesting transfer');
	        $resultvallue=$this->getTransferStatus($token,$transfer);
	        return json_encode($resultvallue);
	        die();
	    }
	}
	#get transfer status
	function getTransferStatus($token,$transfer){
	    try{
	     //   global $baseurl, $urls, $transfer;
	        $transferId = $transfer['transferId'];
	        $finalUrl = $this->baseurl.$this->urls['getTransferStatus'].$transferId;
	        $response = $this->get_helper($finalUrl, $token);

	       
	       
	        error_log(json_encode($response));

	       return $response;
	    }
	    catch(Exception $ex){
	        $msg = $ex->getMessage();
	        error_log('error in getting transfer status');
	        error_log($msg);
	      
	        die();

	         return $msg."msg";
	    }
	}
	#add beneficiary
	function addBeneficiary($token,$beneficiary){
	    try{
	        //global $beneficiary;
	        $response = $this->post_helper('addBene', $beneficiary, $token);
	    	print_r($beneficiary);exit;
	        error_log('beneficiary created');
	    }
	    catch(Exception $ex){
	        $msg = $ex->getMessage();
	        error_log('error in creating beneficiary');
	        error_log($msg);
	        die();
	    }    
	}
     #get beneficiary details
	function getBeneficiary($token,$beneId){
	    try{
	 
	        $beneId = $beneId;
	        $finalUrl = $this->baseurl.$this->urls['getBene'].$beneId;
	        $response = $this->get_helper($finalUrl, $token);
	        //print_r($response);exit();
	        return true;
	    }
	    catch(Exception $ex){
	        $msg = $ex->getMessage();
	        if(strstr($msg, 'Beneficiary does not exist')) return false;
	        error_log('error in getting beneficiary details');
	        error_log($msg);
	        die();
	    }    
	}
    function get_helper($finalUrl, $token){
		    $headers = $this->create_header($token);

		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $finalUrl);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
		    
		    $r = curl_exec($ch);
		    
		    if(curl_errno($ch)){
		        print('error in posting');
		        print(curl_error($ch));
		        die();
		    }
		    curl_close($ch);

		    $rObj = json_decode($r, true);    



		   // if($rObj['status'] != 'SUCCESS' || $rObj['subCode'] != '200') throw new Exception('incorrect response: '.$rObj['message']);
		    return $rObj;
		}
   

    #get auth token
	function getToken(){
		try{

		   $response = $this->post_helper('auth', null, null);
		//   print_r($response);exit();
		   return $response['data']['token'];
		}
		catch(Exception $ex){


		    error_log('error in getting token');
		    error_log($ex->getMessage());


		    die();
		}

	}
	function post_helper($action, $data, $token){
	    //global $this->baseurl, $urls;
	    $finalUrl = $this->baseurl.$this->urls[$action];
	    
	    $headers = $this->create_header($token);
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_URL, $finalUrl);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
	    if(!is_null($data)) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
	    
	    $r = curl_exec($ch);
	    
	    if(curl_errno($ch)){
	        print('error in posting');
	        print(curl_error($ch));
	        die();
	    }
	    curl_close($ch);
	    $rObj = json_decode($r, true);    
	  //  if($rObj['status'] != 'SUCCESS' || $rObj['subCode'] != '200') throw new Exception('incorrect response: '.$rObj['message'] );
	    return $rObj;
	}
	function create_header($token){
	    // global $this->header;
	    $headers = $this->header;
	    if(!is_null($token)){
	        array_push($headers, 'Authorization: Bearer '.$token);
	    }
	    return $headers;
	}


   
}