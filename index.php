<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$data_string = '
{
 "dateFormat": "dd MMMM yyyy",
  "locale": "en",
  "transactionDate": "16 August 2016",
  "transactionAmount": "500.00",
  "paymentTypeId": "12",
  "note": "check payment",
  "accountNumber": "Pasay000000010",
  "checkNumber": "che123",
  "routingCode": "rou123",
  "receiptNumber": "rec123",
  "bankNumber": "ban123"
}
// create client data required and not trnasaction related data

';

$endpoint = "https://197.234.237.253:8443/fineract-provider/api/v1/";
$username= "benk";
$password= "12345";
$tenant = "default";

$method = "POST";
$api_target = "clients";
$extra_parameters = '';
//$extra_parameters = "&command=close";
$URL= $endpoint.$api_target.";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string),
    'Fineract-Platform-TenantId:default')  // << missing header
);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
$result=curl_exec ($ch);
curl_close ($ch);

$result = json_decode(json_encode(json_decode($result,true)), true);
echo "<pre>".print_r($result,true)."</pre>";


?>
