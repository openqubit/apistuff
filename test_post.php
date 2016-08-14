<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$data_string = '
{
	"officeId": 1,
	"firstname": "Petra",
	"lastname": "Yton",
	"externalId": "786YYH7",
	"dateFormat": "dd MMMM yyyy",
	"locale": "en",
	"active": true,
	"activationDate": "29 January 2015",
    "submittedOnDate":"29 January 2015"
}
';

$endpoint = "https://demo.openmf.org/mifosng-provider/api/v1/";
$username= "mifos";
$password= "password";
$tenant = "default";

$method = "POST";
$api_target = "clients";
$extra_parameters = '';
//$extra_parameters = "&command=close";
$URL= $endpoint.$api_target."?tenantIdentifier=".$tenant.$extra_parameters;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
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