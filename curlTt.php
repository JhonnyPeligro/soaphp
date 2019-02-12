<?php 

	include ("simple_html_dom.php");

	/*$postFields = array('http' => array(
		'method' => 'POST',
		'content' => http_build_query(array(
			'username' => 
		)),
	));*/

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://cimera.od1.vtiger.com/index.php");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, True);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query())
	$response = curl_exec($ch);

	curl_close($ch);

	echo $response;
	exit();
	$html = (new simple_html_dom)->load($response);
	 
	 foreach ($html->find('a[href^=/url?]') as $link) {
		if (strpos($link->href, "webcache.google") === false) {
			echo $link->plaintext."<br>";
		} 
	}
?>
