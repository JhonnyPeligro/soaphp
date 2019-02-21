<?php

	function call($url, $params, $type = "GET") {
		$is_post = 0;
		if ($type == "POST") {
			$is_post = 1;
			$post_data = $params;
		} else {
			$url = $url . "?" . http_build_query($params);
		}
		$ch = curl_init($url);
		if (!$ch) {
			die("Cannot allocate a new PHP-CURL handle");
		}
		if ($is_post) {
			curl_setopt($ch, CURLOPT_POST, $is_post);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);

		$return = null;
		if (curl_error($ch)) {
			$return = false;
		} else {
			$return = json_decode($data, true);
		}

		curl_close($ch);

		return $return;
	}

	$endpointUrl = 'http://cimera.od1.vtiger.com/restapi/v1/vtiger/default';
	$userName = 'pedro_hernandorena@hotmail.com';
	$password = 'Demo135!';
	$userAccessKey = 'kOaxi1ca0YXq2GgH';

	$sessionData = call($endpointUrl, array("operation" => "getchallenge", "username" => $userName));
	$challengeToken = $sessionData['result']['token'];
	$generatedKey = md5($challengeToken . $userAccessKey);
	$dataDetails = call($endpointUrl, array("operation" => "login", "username" => $userName, "accessKey" => $generatedKey), "POST");

	$query = "SELECT * FROM Contacts WHERE cf_771='ajay' and cf_781='ajay';";
	$queryParam = urldecode($query);

	$sessionid = $dataDetails['result']['sessionName'];
	$getUserDetail = call($endpointUrl, array("operation" => "query", "sessionName" => $sessionid, 'query' => $query));
	echo "<pre>";
	print_r($getUserDetail);
	echo "</pre>";
	if (!empty($getUserDetail['result'])) {
		echo "success!!!!";
	} else {
		echo "fail!!!!";
	}

?>