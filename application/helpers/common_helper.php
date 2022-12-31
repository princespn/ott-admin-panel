<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

    function headers()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header("Content-type: application/json");
    }

    function sendNotification($subject,$body,$player_id)
    {
        //$notification_type[]='Order Notification';

        /*$hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Like",
        ));*/
        
        $headings = array(
            "en" => $subject
        );
        $content = array(
            "en" => $body
        ); 
        $fields = array(
            'app_id' => "ef20b32e-00b1-4005-82c0-b827583a9f03",
            'include_player_ids' => array($player_id),
            'data' => array(
               "PlayerId"=>$player_id,
            ),
            'contents' => $content,
            'headings' => $headings,
            //'web_buttons' => $hashes_array
        );    
        $fields = json_encode($fields);
        // print_r($fields);exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic ODZkMGQxYmItNjhiZC00YmM5LTllYTYtNDA5MGRmNjUwNWIy'));
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);
        //print_r($result);exit();
    }
    
?>