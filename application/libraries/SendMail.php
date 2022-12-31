<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SendMail{

    public function __contruct($params =array())
    {       
        $this->CI->config->item('base_url');
        $this->CI->load->helper('url');
        $this->CI->load->database();
        $this->CI->library('session');
        $this->CI->library('email');
        $CI =& get_instance();
    }  
    
    function Send($Data)
    {
		 print_r($Data);exit;
        $CI =& get_instance();
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ludosf@gmail.com';
        $config['smtp_pass']    = 'ljcsnlzakvlmolfj';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html//
        $config['validation'] = TRUE; // bool whether to validate email or not      
        $CI->email->initialize($config);
        $CI->email->from('ludosf@gmail.com', 'LUDO');   
        $CI->email->to($Data['mailoutbox_to']);
        $CI->email->subject($Data['mailoutbox_subject']);      
        $CI->email->message($Data['mailoutbox_body']);
        $CI->email->send();
        // print_r($attachment);exit;
        // echo $CI->email->print_debugger();exit;
    }
}

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


    function sendEmailSmtp($subject,$body_email,$to)
    {
        $CI =& get_instance();
        $CI->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'xyz@gmail.com';
        $config['smtp_pass']    = 'vtabwzhcpgmbxdoc';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $CI->email->initialize($config);
        $CI->email->from('xyz@gmail.com', 'Ludo Fantacy');
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($body_email);
        // if (!empty($attachment))
        // {
        //     //print_r($attachment);exit;
        //     $CI->email->attach($attachment);
        // }
        // if (!empty($attachment1)) {
        //     $CI->email->attach($attachment1);
        // }
        // if(!empty($RemoveAttachment))
        // {
        //     unlink($RemoveAttachment);
        // }
        $CI->email->send();
        //echo $CI->email->print_debugger();
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
}

?>