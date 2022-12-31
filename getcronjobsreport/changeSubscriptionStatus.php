<?php
$servername = 'localhost';
$username = 'root';
$password = 'odsdsa@!$opp*&S';
$dbname = 'opps2';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

print("working...");

$qry="SELECT user_id FROM user_details WHERE subscriptionType='paid'";

$result=mysqli_query($conn,$qry);

if($result->num_rows>0){
	while($row=mysqli_fetch_assoc($result)){
		$qry1="SELECT userId FROM plan_user_details WHERE userId ='".$row['user_id']."' AND endDate < NOW() ORDER BY id DESC LIMIT 1";
		$result1=mysqli_query($conn,$qry1);//print_r($result);die;
		if($result1->num_rows==1){			
			/*Update user_detail table*/
			mysqli_query($conn,"UPDATE user_details SET subscriptionType='free' WHERE user_id ='".$row['user_id']."'");
		}
	}
}
?>