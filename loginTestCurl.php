<?php

	$URL = 'https://www.vtiger.com/log-in/';
	$user = 'pedro_hernandorena@hotmail.com';
	$pass = 'Demo135!';

	/**
		*Hace login en la web enviando POST con el usuario y contraseña
	*/

	function login($user, $pass){
		$ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setop($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'username='.$user.'&password'.$pass);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiepath);
		//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiepath);
		$ret = curl_exec($ch);
		curl_close($ch);

		return $ret;
	}
	/**
	* recupera html
	*/
	function get($url){
		global $cookiepath;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiepath);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiepath);
		$html = curl_exec($ch);
		curl_close($ch);

		return $html;
	}

	/**
	*Parsea el html y retorna un array con todos los datos relevantes
	*/
	function parse($html){

	}

	/**
	 * Crea un nodo a partir del contenido de $data
	 */
	function create_node($data) {
	  // guarda un nodo
	  $node = (object)array(
	  'title' => 'Loren ipsum',
	  'body' => 'dolor sit amet'
	  );
	  $node = node_save($node);
	  if (!$node->nid) {
	    print "ERROR: error al crear un nodo para $data"; // TODO: $data se imprimirá como 'Array'
	  }
	  // lo asocia a una tax
	  taxonomy_node_save($node, array($tax1, $tax2, $tax3));
	}
	 
	/**
	 *
	 */
	function main($user, $pass) {
	  if (!login($user, $pass)) {
	    print "ERROR: no pude hacer login.\n";
	    exit;
	  }
	 
	  $html = get($url);
	  $data = parse($html);
	  create_node($data);
	}
	 
	main();
?>