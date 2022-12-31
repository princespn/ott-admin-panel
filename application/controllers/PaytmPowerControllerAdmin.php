<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Calcutta");

class Paytm extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('Custom');
    }

	public function pay_by_paytm($orderId,$customer_id,$amount)
	{
		$getOrderId = $this->Crud_model->GetData('orders','','orderId="'.$orderId.'" and customer_id="'.$customer_id.'"');
		if(!empty($getOrderId)){
			redirect('Welcome/payMentSucces/2');
		}
		if(!empty($orderId) && !empty($customer_id) && !empty($amount))
		{
			$Data = array(
				'customer_id' => $customer_id,
	            'orderId' => $orderId,
				'amount' => $amount,
				'paymentMode' => 'Paytm',	
				'created' =>date('Y-m-d H:i:s'),
			    );
		   
			$saveData = $this->Crud_model->SaveData('orders',$Data);
			$_POST["customer_id"] = $customer_id;
			header("Pragma: no-cache");
	 		header("Cache-Control: no-cache");
	  		header("Expires: 0");
	   
		    // following files need to be included
		    require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
		    require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");	
				
			$paramList["MID"] = PAYTM_MERCHANT_MID;
		
			$paramList["ORDER_ID"] = $orderId;
			$paramList["CUST_ID"] = $customer_id;
			$paramList["INDUSTRY_TYPE_ID"] = 'Retail';// For Live Retail109
			$paramList["CHANNEL_ID"] = 'WEB';
			//$paramList["TXN_AMOUNT"] = $amount;//$final_amount
			 $paramList["TXN_AMOUNT"] = $amount; 
			
			$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
			$paramList["CALLBACK_URL"] = base_url('index.php/Paytm/checkPayment/'.$customer_id);
			$paramList["MSISDN"] = ''; //Mobile number of customer
			$paramList["EMAIL"] = '';//Email ID of customer
			$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
			//$action = PAYTM_TXN_URL;

			echo "<html>
			<head>
			<title>Merchant Check Out Page</title>
			</head>
			<body>
			    <center><h1>Please do not refresh this page...</h1></center>
			        <form method='post' action='".PAYTM_TXN_URL."' name='f1'>
			<table border='1'>
			<tbody>";

			foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="'. $name .'" value="'. $value .'">';
			}

			echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum ."'>
			</tbody>
			</table>
			<script type='text/javascript'>
			 document.f1.submit();
			</script>
			</form>
			</body>
			</html>";
		}
		else
		{
			print_r('Insufficient parameters, Kindly uppdate with parameters');exit;
		}
	}

	public function checkPayment($customer_id)
	{
		//print_r($customer_id);exit()
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
	    // following files need to be included
	    require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
	    require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");
	    $paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";
		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
		
		if($isValidChecksum == "TRUE") 
		{
			if($_POST["STATUS"] == "TXN_SUCCESS"){
		    	$json_data = json_encode($_POST);
					
		        $PaymentLog = array(
		          'transaction_id' => $_POST['TXNID'],
		          'isPayment' => "Yes",
		          'json_data' => $json_data,
		          'modified' => date('Y-m-d H:i:s'),
		         );
		        $this->Crud_model->SaveData("orders",$PaymentLog, "orderId='".$_POST['ORDERID']."'");
		        $saveuserData = array(
		        		'transactionId'=>$_POST['TXNID'],
		        		'orderId'=>$_POST['ORDERID'],
		        		'amount'=>$_POST['TXNAMOUNT'],
		        		'user_detail_id'=>$customer_id,
		        		'type'=>'Deposit',
		        		//'status'=>'Pending',
		        		'status'=>'Success',
		        		'created'=>date('Y-m-d H:i:s'),
		        		'modified'=>date('Y-m-d H:i:s'),
		        	);
		        $this->Crud_model->SaveData("user_account",$saveuserData);
		        //print_r($this->db->last_query());exit;
		        $last_insertedId= $this->db->insert_id();
		        $saveuserDataLog = array(
		        		'transactionId'=>$_POST['TXNID'],
		        		'user_account_id'=>$last_insertedId,
		        		'orderId'=>$_POST['ORDERID'],
		        		'amount'=>$_POST['TXNAMOUNT'],
		        		'user_detail_id'=>$customer_id,
		        		'type'=>'Deposit',
		        		//'status'=>'Pending',
		        		'status'=>'Success',
		        		'created'=>date('Y-m-d H:i:s'),
		        	);
		        $this->Crud_model->SaveData("user_account_logs",$saveuserDataLog);
		        $getUserData = $this->Crud_model->GetData("user_details","","user_id='".$customer_id."'","","","","1");
		       	// print_r($saveuserData);exit();
		       	//  echo "<pre>"; 
		        if ($getUserData) {
		        	$totalCoins= $getUserData->balance + $_POST['TXNAMOUNT'];
		        	$data=array(
		        		"balance"=>$totalCoins,
		        	);
		        	$this->Crud_model->SaveData("user_details",$data, "user_id='".$customer_id."'");
		        }
		        redirect('Welcome/payMentSucces/1');
		        print_r('Payment Done ');exit;
			}
			else
			{				
				if(isset($_POST['TXTID'])){
					$json_data = json_encode($_POST);
						
			        $PaymentLog = array(
			          'transaction_id' => $_POST['TXNID'],
			          'isPayment' => "No",
			          'json_data' => $json_data,
			          'modified' => date('Y-m-d H:i:s'),
			         );
			        $this->Crud_model->SaveData("orders",$PaymentLog, "orderId='".$_POST['ORDERID']."'");
			        redirect('Welcome/payMentSucces/0');
					print_r('Payment Failed ');exit;
					}
				else{
					redirect('Welcome/payMentSucces/0');
					print_r('Payment Failed ');exit;	
				}
			} 
		}
		else 
		{
			if(!empty($_POST))
			{
				$json_data = json_encode($_POST);
					
		        $PaymentLog = array(
		          'transaction_id' => $_POST['TXNID'],
		          'isPayment' => "No",
		          'json_data' => $json_data,
		          'modified' => date('Y-m-d H:i:s'),
		         );
			    $this->Crud_model->SaveData("orders",$PaymentLog, "orderId='".$_POST['ORDERID']."'");
				redirect('Welcome/payMentSucces/0');
				print_r('Payment Failed ');exit;	
			}
			else{
				redirect('Welcome/payMentSucces/0');
				print_r('Payment Failed ');exit;	
			}
			
		} 
	}


    public function saveAllDistributerRedeem(){

        $userData =$this->Crud_model->GetData("user_details","id,status,balance","id='".$_POST['userId']."'","","","","1");
        /*if($userData->balance >= $_POST['withAmt'])
		{*/	

			$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
			$admin_rs=($_POST['withAmt']*$getSettData->adminPercent)/100;
			$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');

			$userAmt = $_POST['withAmt'] - $admin_rs;

		   	$userBankData =$this->Crud_model->GetData("bank_details","","user_detail_id='".$_POST['userId']."'","","","","1"); 
			$order_id = rand(11111111,9999999);
			$beneficiaryAccount= $userBankData->accno;
			$beneficiaryIFSC= $userBankData->ifsc;
			$amount=$userAmt;
			$userAccId=$this->input->post('id');
			$userId=$this->input->post('userId');
			$withAmt=$this->input->post('withAmt');

			//print_r($userAccId);exit;
			$this->disburseFund($order_id,$amount,$beneficiaryAccount,$beneficiaryIFSC,$userAccId,$userId,$withAmt);
        	/*$this->session->set_flashdata('message', '<span>User redeem amount distribute successfully</span>'); 	
		}else{
			$this->session->set_flashdata('message', '<span >You Can not approved -- user has insufficient available balance</span>');
		}*/
       redirect(site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($_POST['id'])));
    }



	public function disburseFund($order_id,$amt,$beneficiaryAccount,$beneficiaryIFSC,$userAccId,$userId,$withAmt)// Creation of disburse Bank Transfer API.
	{	
		header("Pragma: no-cache");
 		header("Cache-Control: no-cache");
  		header("Expires: 0");
   
	    //require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
		require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");	
		//require_once("encdec_paytm.php");

	    /* initialize an array */
		$paytmParams = array();

		$paytmParams["subwalletGuid"] = guid;//"97d2a3d6-f3bd-44e9-80de-c8a6dc89e7bc"; //GUID of AJAY

		$date = date('Y-m-d');
		$time = date('H:i:s');
		$paytmParams["orderId"] = $order_id;
		    
		/* Enter Beneficiary Phone Number against which the disbursal needs to be made */
		//$paytmParams["beneficiaryPhoneNo"] = 8421491235;

		/* Amount in INR payable to beneficiary */
		//$paytmParams["beneficiaryAccount"] = 919899996782;
		//$paytmParams["beneficiaryIFSC"] = 'PYTM0123456';
		//$paytmParams["beneficiaryAccount"] = 919890800533;
		//$paytmParams["beneficiaryIFSC"] = 'HDFC0002746';
		//$paytmParams["beneficiaryAccount"] = 300000002448;	Invalid Account details
		//$paytmParams["beneficiaryIFSC"] = 'PYTM0123456';		Invalid Account details
		$paytmParams["beneficiaryAccount"] = $beneficiaryAccount;//20195656312;
		$paytmParams["beneficiaryIFSC"] = $beneficiaryIFSC;//'MAHB0000303';
		$amount = $amt;//23;
		$paytmParams["amount"] = $amount;
		$paytmParams["purpose"] = 'BONUS';//'BONUS';
		$paytmParams["date"] = $date;
		$paytmParams["requestTimestamp"] = $time;

		/* prepare JSON string for request body */
		$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

		//echo "post_data <pre>"; print_r($post_data);echo '<br/>';
		/**
		* Generate checksum by parameters we have in body
		*/
		$checksum = getChecksumFromString($post_data, key);//iwpS9miFa%K0!x1L
		//echo "checksum <pre>"; print_r($checksum);echo '<br/>';

		/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
		//$x_mid = "AagamE55778795707048";
		$x_mid = mid;//"AagamE15178612468400";

		/* put generated checksum value here */
		$x_checksum = $checksum;
		// echo "x_checksum <pre>"; print_r($x_checksum);echo '<br/>';

		/* Solutions offered are: food, gift, gratification, loyalty, allowance, communication */

		/* for Staging */
		//$url = "https://staging-dashboard.paytm.com/bpay/api/v1/disburse/order/bank";
		

		/* for Production */
		$url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/bank";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$response = curl_exec($ch);	
		$response = curl_error($ch) ? curl_error($ch) : $response;
		$response = json_decode($response);
		$userBal =$this->Crud_model->GetData("user_details","id,status,balance","id='".$_POST['userId']."'","","","","1");
		$getPaytmData = $this->Crud_model->GetData("user_account",'','id="'.$userAccId.'"','','','','1');
		//print_r($response);exit;
		if($response->status=='ACCEPTED'){
			$content='Congratulations! Your withdrawal request of Rs '.$withrawAmt.' has been processed '.$statusMail.'. Amount will reflect in your account within 24 working hours, if not then please contact us at ';
			$resStatus ='Approved';
			$type ='Gratification';
			$statusMessage=$response->statusMessage;
			$statusCode=$response->statusCode;

			if(!empty($getPaytmData) && $getPaytmData->isAdminReedem=='No'){
				$userData =$this->Crud_model->GetData("user_details","id,status,balance","id='".$userId."'","","","","1"); 
				$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
				$admin_rs=($amount*$getSettData->adminPercent)/100;
				$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');
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
						'type'=>'deposit',
					);
				$this->Crud_model->SaveData("admin_account_log",$saveAdminLogData);
				$saveRefundData = array(
		    		'orderId'=>$order_id,
		    		'user_detail_id'=>$userId,
		    		'paytmStatus'=>$response->status,
		    		'statusCode'=>$response->statusCode,
		    		'statusMessage'=>$response->statusMessage,
		    		'checkSum'=>$x_checksum,
		    		'type'=>$type,
		    		'paymentType'=>'Paytm',
		            'status'=>$resStatus,
		    		'created'=>date('Y-m-d H:i:s'),
		    		'modified'=>date('Y-m-d H:i:s'),
		        );
		        $saveData = $this->Crud_model->SaveData("user_account",$saveRefundData,'id="'.$userAccId.'"');

		        $saveRefundDataLog = array(
		        		'user_account_id'=>$userAccId,
		        		'orderId'=>$order_id,
		    			'amount'=>$withAmt,
		    			'balance'=>$userBal->balance,
		        		'user_detail_id'=>$userId,
		        		'paytmType'=>'byBank',
		        		'paytmStatus'=>$response->status,
		        		'statusCode'=>$response->statusCode,
		        		'statusMessage'=>$response->statusMessage,
		        		'checkSum'=>$x_checksum,
		        		'type'=>$type,
		        		'paymentType'=>'Paytm',
		                'status'=>$resStatus,
		        		'created'=>date('Y-m-d H:i:s'),
		        		'modified'=>date('Y-m-d H:i:s'),
		        	);
		        $saveData = $this->Crud_model->SaveData("user_account_logs",$saveRefundDataLog);
			}
			
		}elseif($response->status=='FAILURE'){
			$getUserDatadetails = $this->Crud_model->GetData('user_details','email_id,user_name,mobile,balance',"id='".$userId."'",'','','','1');
			$updateBal =  $getUserDatadetails->balance + $withAmt;
            $updateUserBal = array(
                'balance'=> $updateBal,
                );
			$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
			/*  Sms Code  */
			$sms_body=$this->Crud_model->GetData("mst_sms_body","","smsType='refund-reedem-amount'",'','','','1');
	        $sms_body->smsBody=str_replace("{user_name}",ucfirst($getUserDatadetails->user_name),$sms_body->smsBody); 
	        $sms_body->smsBody=str_replace("{amt}",$withAmt,$sms_body->smsBody); 
			$sms_body->smsBody=str_replace("{reason}",$response->statusMessage,$sms_body->smsBody);
			$body=$sms_body->smsBody;
			$mobileNo=$getUserDatadetails->mobile;
	        $this->custom->sendSms($mobileNo,$body);
			/*  /.Sms Code  */
			$resStatus="Failed";
			$type ='Withdraw';
			$statusMessage=$response->statusMessage;
			$statusCode=$response->statusCode;
           
		}else{
			$resStatus ='Pending';
			$type ='Withdraw';
			$statusMessage=$response->statusMessage;
			$statusCode=$response->statusCode;
		}
		$saveRefundData = array(
    		'orderId'=>$order_id,
    		'user_detail_id'=>$userId,
    		'paytmStatus'=>$response->status,
    		'statusCode'=>$response->statusCode,
    		'statusMessage'=>$response->statusMessage,
    		'checkSum'=>$x_checksum,
    		'type'=>$type,
            'status'=>$resStatus,
            'paymentType'=>'Paytm',
    		'created'=>date('Y-m-d H:i:s'),
    		'modified'=>date('Y-m-d H:i:s'),
        );
        $saveData = $this->Crud_model->SaveData("user_account",$saveRefundData,'id="'.$userAccId.'"');

        $saveRefundDataLog = array(
        		'user_account_id'=>$userAccId,
        		'orderId'=>$order_id,
    			'amount'=>$withAmt,
    			'balance'=>$userBal->balance,
        		'user_detail_id'=>$userId,
        		'paytmType'=>'byBank',
        		'paytmStatus'=>$response->status,
        		'statusCode'=>$response->statusCode,
        		'statusMessage'=>$response->statusMessage,
        		'checkSum'=>$x_checksum,
        		'type'=>$type,
                'status'=>$resStatus,
                'paymentType'=>'Paytm',
        		'created'=>date('Y-m-d H:i:s'),
        		'modified'=>date('Y-m-d H:i:s'),
        	);
        $saveData = $this->Crud_model->SaveData("user_account_logs",$saveRefundDataLog);
	   	// echo "<pre>"; print_r($response);echo '<br/>';
	    //exit();
	   if($response->status=='FAILURE'){
	   		$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>'); 
	   }elseif($response->status=='PENDING'){
	   		$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>'); 	
	   }else{
	   		$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>'); 
	   }
	   curl_close($ch);
	   redirect(site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($userAccId)));
	}

	public function checkDisburseStatus($order_id,$userAccId,$userId,$amount)	// Check disburse bank status API
	{
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");		
		require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");	

		/* initialize an array */
		$paytmParams = array();
		$getPaytmData = $this->Crud_model->GetData("user_account",'','id="'.$userAccId.'"','','','','1');
		/* Enter your order id which needs to be check disbursal status for */
		//$order_id = $_REQUEST['order_id'];
		$paytmParams["orderId"] = $order_id;
		/* prepare JSON string for request body */
		$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
		//echo "checksum <pre>"; print_r($post_data);echo '<br/>';
		/**
		* Generate checksum by parameters we have in body
		*/
		$checksum = getChecksumFromString($post_data, key);//iwpS9miFa%K0!x1L
		//echo "checksum <pre>"; print_r($checksum);echo '<br/>';
		/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
		$x_mid = mid;//"AagamE15178612468400"

		/* put generated checksum value here */
		$x_checksum = $checksum;

		/* for Staging */
		//$url = "https://staging-dashboard.paytm.com/bpay/api/v1/disburse/order/query";

		/* for Production */
		$url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/query";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$response = curl_exec($ch);
		$response = curl_error($ch) ? curl_error($ch) : $response;
		$response = json_decode($response);
	    curl_close($ch);
	    $userBal =$this->Crud_model->GetData("user_details","id,status,balance","id='".$_POST['userId']."'","","","","1");
	    if($response->status=='SUCCESS'){
	    	//print_r("if");exit;
			$resStatus ='Approved';
			$status='Approved';
			if(!empty($getPaytmData) && $getPaytmData->isAdminReedem=='No'){
				$userData =$this->Crud_model->GetData("user_details","id,status,balance","id='".$userId."'","","","","1"); 
				$getSettData = $this->Crud_model->GetData("mst_settings","id,adminPercent","id='4'",'','','','1');
				$admin_rs=($amount*$getSettData->adminPercent)/100;

				$getAdminData=$this->Crud_model->GetData("admin_login","id,adminBalance","id='".$_SESSION[SESSION_NAME]['id']."'",'','','','1');
				
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
						'type'=>'deposit',
					);
				$this->Crud_model->SaveData("admin_account_log",$saveAdminLogData);
				/***** Admin Data *****/
				 $approveData = array(
	                'status'=>'Approved',
	                'isAdminReedem'=>'Yes',
	                'paymentType'=>'Paytm',
	                'modified'=>date("Y-m-d H:i:s")
	            );

				 $approveDataLog = array(
	                'orderId'=>$order_id,
	                'user_account_id'=>$userAccId,
	                'user_detail_id'=>$userId,
	                'amount'=>$amount,
	                'balance'=>$userBal->balance,
	                'type'=>'Withdraw',
	                'paymentType'=>'Paytm',
	                'status'=>'Approved',
	                'created'=>date("Y-m-d H:i:s")
	            );
				
				$this->Crud_model->SaveData('user_account',$approveData,'id="'.$userAccId.'"');
				//$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
				$this->Crud_model->SaveData('user_account_logs',$approveDataLog);
			}
		}elseif($response->status=='PENDING'){
			$resStatus ='Process';
			$status='Process';
		}elseif($response->status=='FAILURE'){
			//print_r("query");echo "<prev>";
			$getUserFail = $this->Crud_model->GetData('user_details','email_id,user_name,mobile,balance',"id='".$userId."'",'','','','1');
			$updateBal =  $getUserFail->balance + $getPaytmData->amount;
            $updateUserBal = array(
                'balance'=> $updateBal,
                );
			$this->Crud_model->SaveData('user_details',$updateUserBal,'id="'.$userId.'"');
			/*  Sms Code  */
			$sms_body=$this->Crud_model->GetData("mst_sms_body","","smsType='refund-reedem-amount'",'','','','1');
	        $sms_body->smsBody=str_replace("{user_name}",ucfirst($getUserFail->user_name),$sms_body->smsBody); 
	        $sms_body->smsBody=str_replace("{amt}",$getPaytmData->amount,$sms_body->smsBody); 
			$sms_body->smsBody=str_replace("{reason}",$response->statusMessage,$sms_body->smsBody);
			$body=$sms_body->smsBody;
			$mobileNo=$getUserFail->mobile;
	        $this->custom->sendSms($mobileNo,$body);
			$resStatus ='Failed';
			$status='Failed';
		}else{
			$resStatus ='Pending';
			$status='Pending';
		}

		$saveRefundUpdate = array(
        		'orderId'=>$order_id,
        		'user_detail_id'=>$getPaytmData->user_detail_id,
        		'paytmStatus'=>$resStatus,
        		'statusCode'=>$response->statusCode,
        		'statusMessage'=>$response->statusMessage,
        		'checkSum'=>$x_checksum,
        		'type'=>'Withdraw',
                'status'=>$status,
                'paymentType'=>'Paytm',
        		'modified'=>date('Y-m-d H:i:s'),
        	);
        $saveData = $this->Crud_model->SaveData("user_account",$saveRefundUpdate,'id="'.$userAccId.'"');
        $saveRefundUpdateLog = array(
        		'user_account_id'=>$userAccId,
        		'orderId'=>$order_id,
        		'amount'=>$getPaytmData->amount,
        		'balance'=>$getPaytmData->balance,
        		'user_detail_id'=>$getPaytmData->user_detail_id,
        		'paytmType'=>'byQuery',
        		'paytmStatus'=>$response->status,
        		'statusCode'=>$response->statusCode,
        		'statusMessage'=>$response->statusMessage,
        		'checkSum'=>$x_checksum,
        		'type'=>'Withdraw',
        		'paymentType'=>'Paytm',
                'status'=>$status,
        		'created'=>date('Y-m-d H:i:s'),
        		'modified'=>date('Y-m-d H:i:s'),
        	);
        $saveData = $this->Crud_model->SaveData("user_account_logs",$saveRefundUpdateLog);

    	if($response->status=='SUCCESS'){
	    	$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>'); 	
	   }elseif($response->status=='PENDING'){
	   		$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>'); 
	   }elseif($response->status=='FAILURE'){
	   		$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>'); 
	   }else{
	   		$this->session->set_flashdata('message', '<span>'.$response->statusMessage.'</span>');
	   }
	   redirect(site_url(WITHDRAWALDISTRIBUTE.'/'.base64_encode($userAccId)));
	}
}