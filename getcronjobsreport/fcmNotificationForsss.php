<?php
$servername = 'localhost';
$username = 'root';
$password = 'odsdsa@!$opp*&S';
$dbname = 'opps2';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

define( 'API_ACCESS_KEY', 'AAAAu2_jRQk:APA91bGXj494EHSwyW8qZxJlGwCkSAs43S3wqj2aw2B27PsQXBcQQhNQJC9sg2L94QCWMojUlkWMsk-uzkX_m3yZb0qWBZCftWkTfie8g7ZSnN07oTxvHd2wVxOmX6qvunnXD5IrepCL' );

/****************************Movies***************************************/
$movie="SELECT movieName FROM movies WHERE date(releaseDate) = DATE(NOW())";
$movieData=mysqli_query($conn,$movie);
if($movieData->num_rows>0){
	while($movieDataRow=mysqli_fetch_assoc($movieData)){
		$registration_ids = array();
		$movUser="SELECT deviceId FROM user_details WHERE deviceId !=''";
		$movUserData=mysqli_query($conn,$movUser);//print_r($result);die;
		if($movUserData->num_rows>0){
			while($movUserDataRow=mysqli_fetch_assoc($movUserData)){			
				$registration_ids[] = $movUserDataRow['deviceId'];
			}
		}
		$deviceIdList = implode(',', $registration_ids);

		// print_r();die;
		$fcmMsg = array(
		'title' => 'New Movie Release',
		'body' => $movieDataRow['movieName'],
		'sound' => "default",
		'color' => "#203E78" 
		);
		
		$fcmFields = array(
			// 'to' => $singleID,// 'to' => $singleID ;  // expecting a single ID
			'registration_ids' => array($deviceIdList),// 'registration_ids' => $registrationIDs ;  // expects an array of ids
			'priority' => 'high',// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
			'notification' => $fcmMsg
		);

		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result . "\n\n";
	}

}
/*********************************************************************/


/****************************Seasons***************************************/
$season="SELECT seasons.seasonNo,series.seriesName FROM seasons JOIN series WHERE date(seasons.releaseDate) = DATE(NOW()) AND seasons.seriesId=series.seriesId";
$seasonData=mysqli_query($conn,$season);
if($seasonData->num_rows>0){
	while($seasonDataRow=mysqli_fetch_assoc($seasonData)){
		$registration_ids = array();
		$seaUser="SELECT deviceId FROM user_details WHERE deviceId !=''";
		$seaUserData=mysqli_query($conn,$seaUser);//print_r($result);die;
		if($seaUserData->num_rows>0){
			while($movUserDataRow=mysqli_fetch_assoc($seaUserData)){			
				$registration_ids[] = $movUserDataRow['deviceId'];
			}
		}
		$deviceIdList = implode(',', $registration_ids);

		// print_r($deviceIdList);die;
		$fcmMsg = array(
		'title' => 'New Season Released',
		'body' => $seasonDataRow['seriesName'].'-Season-'.$seasonDataRow['seasonNo'],
		'sound' => "default",
		'color' => "#203E78" 
		);
		
		$fcmFields = array(
			// 'to' => $singleID,// 'to' => $singleID ;  // expecting a single ID
			'registration_ids' => array($deviceIdList),// 'registration_ids' => $registrationIDs ;  // expects an array of ids
			'priority' => 'high',// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
			'notification' => $fcmMsg
		);

		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result . "\n\n";
	}

}
/*********************************************************************/


/*****************Subscription 7 Days Before*************************/
$subs="SELECT plan_details.planName,user_details.user_name,user_details.deviceId FROM plan_user_details JOIN plan_details JOIN user_details WHERE plan_details.id=plan_user_details.plan_details_id AND user_details.user_id=plan_user_details.userId AND date(plan_user_details.endDate) = DATE(NOW() + INTERVAL 7 DAY)";
$subsData=mysqli_query($conn,$subs);
if($subsData->num_rows>0){
	while($subsDataRow=mysqli_fetch_assoc($subsData)){

		$fcmMsg = array(
		'title' => 'Plan Expiring Alert',
		'body' => $subsDataRow['user_name'].', your '.$subsDataRow['planName'].' pack will expire in next 7 days',
		'sound' => "default",
		'color' => "#203E78" 
		);
		
		$fcmFields = array(
			// 'to' => $singleID,// 'to' => $singleID ;  // expecting a single ID
			'to' => $subsDataRow['deviceId'],// 'registration_ids' => $registrationIDs ;  // expects an array of ids
			'priority' => 'high',// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
			'notification' => $fcmMsg
		);

		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result . "\n\n";
	}

}
/*********************************************************************/


/*****************Subscription 4 Days Before*************************/
$subs="SELECT plan_details.planName,user_details.user_name,user_details.deviceId FROM plan_user_details JOIN plan_details JOIN user_details WHERE plan_details.id=plan_user_details.plan_details_id AND user_details.user_id=plan_user_details.userId AND date(plan_user_details.endDate) = DATE(NOW() + INTERVAL 4 DAY)";
$subsData=mysqli_query($conn,$subs);
if($subsData->num_rows>0){
	while($subsDataRow=mysqli_fetch_assoc($subsData)){

		$fcmMsg = array(
		'title' => 'Plan Expiring Alert',
		'body' => $subsDataRow['user_name'].', your '.$subsDataRow['planName'].' pack will expire in next 4 days',
		'sound' => "default",
		'color' => "#203E78" 
		);
		
		$fcmFields = array(
			// 'to' => $singleID,// 'to' => $singleID ;  // expecting a single ID
			'to' => $subsDataRow['deviceId'],// 'registration_ids' => $registrationIDs ;  // expects an array of ids
			'priority' => 'high',// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
			'notification' => $fcmMsg
		);

		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result . "\n\n";
	}

}
/*********************************************************************/


/*****************Subscription same Day*************************/
$subs="SELECT plan_details.planName,user_details.user_name,user_details.deviceId FROM plan_user_details JOIN plan_details JOIN user_details WHERE plan_details.id=plan_user_details.plan_details_id AND user_details.user_id=plan_user_details.userId AND date(plan_user_details.endDate) = DATE(NOW())";
$subsData=mysqli_query($conn,$subs);
if($subsData->num_rows>0){
	while($subsDataRow=mysqli_fetch_assoc($subsData)){

		$fcmMsg = array(
		'title' => 'Plan Expiring Alert',
		'body' => $subsDataRow['user_name'].', your '.$subsDataRow['planName'].' pack is expiring today',
		'sound' => "default",
		'color' => "#203E78" 
		);
		
		$fcmFields = array(
			// 'to' => $singleID,// 'to' => $singleID ;  // expecting a single ID
			'to' => $subsDataRow['deviceId'],// 'registration_ids' => $registrationIDs ;  // expects an array of ids
			'priority' => 'high',// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
			'notification' => $fcmMsg
		);

		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result . "\n\n";
	}

}
/*********************************************************************/
?>