<?php

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.pagos360.com/adhesion",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
		"accept: application/pdf",
		"authorization: Authorization"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	$http = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	
	if($http == 500){
		echo "500";
	} else{
		echo "There was  a problem...";
	}

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
?>