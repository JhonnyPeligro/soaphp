<?php
	
	$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://cimera.od1.vtiger.com/restapi/v1/vtiger/default",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10, 
		CURLOPT_TIMEOUT => 30, 
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"authoriation : Basic kOaxi1ca0YXq2GgH"
		),
	));
	
	$http = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	
	if($http == 400){
		echo "400";
	}
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);

	if ($err){
		echo " cURL ERROR #:" .$err;
	} else{
		echo $response;
	}
?>
