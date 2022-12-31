<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Custom
{


	public function __contruct($params =array())
    {
       
        $this->CI->config->item('base_url');
        $this->CI->load->helper('url');
        $this->CI->load->database();
        $this->CI->library('session');
        $this->CI->library('email');
        $CI =& get_instance();
        //$this->CI =& get_instance();
       // $this->CI->load->database();
    }  

    


    public function sendEmailSmtp($subject,$body_email,$to)
    {
    	//http://3.20.220.191/admin/index.php/Zsendgridmail/index/ludsf@gmail.com
    	//https://api.sendgrid.com/api/mail.send.json
        $url = 'https://api.sendgrid.com/';
		$user = 'ludosf';
		$pass = 'cUGR$xg8rpFZ$a.';
		$params = array(
		    'api_user'  => $user,
		    'api_key'   => $pass,
		    'to'        => $to,
		    'subject'   => $subject,
		    'html'      => $body_email,
		    //'text'      => $body_email,
		    'from'      => 'info@sf.com',
		  );


		$request =  $url.'api/mail.send.json';
		//print_r($request);exit;

		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		// obtain response
		$response = curl_exec($session);
		curl_close($session);
		//return $response;
		// print everything out
		//print_r($response);exit;
    }

    function sendEmailSmtp_old($subject,$body_email,$to)
	{
		$CI =& get_instance();
		$CI->load->library('email');
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'ludo.sf@gmail.com';
		$config['smtp_pass']    = 'vtabwzhcpgmbxdoc';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$CI->email->initialize($config);
		$CI->email->from('ludo.sf@gmail.com', 'Ludo SF');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($body_email);
		$CI->email->send();
	}

	 function sendTest($subject,$body_email,$to)
	{
		$CI =& get_instance();
		$CI->load->library('email');
		$from = "shriram@ludosf.com";
		$config['protocol']    = 'smtp';
	    $config['smtp_host']    = 'ses-smtp-user.20200214-164606';
		//$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '25';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'AKIAQF73EBVP4MH77ZBQ';
		$config['smtp_pass']    = 'BC3JgK2l+MLbApk1f+CeZKcQxDgdMnHH3dN+4rQuvPEH';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not      
		$CI->email->initialize($config);
		$CI->email->from($from,'REMITOUT');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($body_email);
		$CI->email->send();
	}

	function sendSms($mobileNo,$sms_body)
	{  
       
        $username = 'samudra1020';
        $pass = 'Samudra@123';
        $route = 'trans1';
        // Message details
        $numbers = $mobileNo; // Multiple numbers separated by comma
        $senderid = 'MYSFXI';
        $message = $sms_body;
       
        // Prepare data for POST request
        $data = 'username='.$username.'&pass='.$pass.'&route='.$route.'&senderid='.$senderid.'&numbers='.$numbers."&message=".$message;
        // Send the GET request with cURL
        $url = 'http://173.45.76.227/send.aspx?'.$data;
        $url = preg_replace("/ /", "%20", $url);
        $response = file_get_contents($url);

		
	}

	function sendSmsOld($mobileNo,$sms_body)
	{  
		
		
		$username = 'ludosf@gmail.com';
	    $apiKey = 'b329085b4779d9c9a00c9432e0fe43bf37be7c6b2023e87768179a63a496968a';
	    $apiRequest = 'Text';
	    // Message details
	    $numbers = $mobileNo; // Multiple numbers separated by comma
	    $senderId = 'LUDOSF';
	    $message = $sms_body;
	    // Route details
	    $apiRoute = 'TRANS';
	    // Prepare data for POST request
	    $data = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&sender='.$senderId."&message=".$message;
	    // Send the GET request with cURL
	    $url = 'http://www.alots.in/sms-panel/api/http/index.php?'.$data;
	    //print_r($url);exit();
	    $url = preg_replace("/ /", "%20", $url);
	    $response = file_get_contents($url);
	    // Process your response here
	    //echo $response;
	}
}

?> 