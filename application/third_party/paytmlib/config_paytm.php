<?php
/*

- Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
- Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
- Above details will be different for testing and production environment.*/


//MID : 12966438680092
//MERCHANT KEY: uF9cZaNpABsC&Xxa

define('PAYTM_ENVIRONMENT', 'PROD'); // PROD 
define('PAYTM_MERCHANT_KEY', 'Fo_AcvYl1IUh#mxw'); //Merchant key downloaded from portal
define('PAYTM_MERCHANT_MID', '23841871619947'); //MID (Merchant ID) received from Paytm
define('PAYTM_MERCHANT_WEBSITE', 'WEB'); //Website name received from Paytm

$PAYTM_DOMAIN = "securegw-stage.paytm.in";
if (PAYTM_ENVIRONMENT == 'PROD') {
	//$PAYTM_DOMAIN = 'secure.paytm.in';
	$PAYTM_DOMAIN = 'securegw.paytm.in';
}

//define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
//define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/theia/processTransaction');
define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/refund/HANDLER_INTERNAL/REFUND');
?>