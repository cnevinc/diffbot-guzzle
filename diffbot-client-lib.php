<?php

/**
 * Copyright 2014 Ing Shuoh, Chen.
 *
 * Licensed under NU GENERAL PUBLIC LICENSE 
 *
 * 					Version 3, 29 June 2007; 
 *
 * Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 * Everyone is permitted to copy and distribute verbatim copies of 
 * this license document, but changing it is not allowed.
 */

if (!function_exists('curl_init')&& !function_exists('file_get_contents') ) {
	throw new Exception('Dfiibot client needs the CURL or file_get_contents support.');
}

if (!function_exists('json_decode')) {
	throw new Exception('Facebook needs the JSON PHP extension.');
}

/**
 * Provides access to the Diffbot client api.  This class provides
 * a majority of the functionality needed.
 *
 * @author Ing Shuoh,Chen <cnevinchen@gmail.com>
 */
class DiffbotClient
{
	protected $debug= false;
	protected $token;
	
	protected $API_ARTICLE = "article";
	protected $API_FRONTPAGE = "frontpage";
	protected $API_PRODUCT = "product";
	protected $API_IMAGE = "image";
	protected $API_ANALYZE = "analyze";
	protected $API_URL_V2="http://api.diffbot.com";
	protected $API_URL_V1="http://www.diffbot.com/api";
	
	
	/**
	 * Initialize a Diffbot client. 
	 *
	 * @param string $token The client token
	 */
	public function __construct($token) {
		$this->token = $token;
	}
	
	public function setDebug($debug) {
		$this->debug = $debug;
	}
	

	function getArticle(  $url ,$params , $version=2 ){
		return  $this->getContent( $this->API_ARTICLE , $url ,$params , $version );
	}
	
	function getFrontPage( $url ,$params , $version=2 ){
		return  $this->getContent( $this->API_FRONTPAGE , $url ,$params , $version );
	}
	
	public function getProduct( $url ,$params , $version=2 ){
		return $this->getContent( $this->API_PRODUCT , $url ,$params , $version );
	}
	
	public function getImage( $url ,$params , $version=2 ){
		return  $this->getContent( $this->API_IMAGE , $url ,$params , $version );
	}
	
	public function getAnalyze( $url ,$params , $version=2 ){
		return  $this->getContent( $this->API_ANALYZE , $url ,$params , $version );
	}
	
	protected function getContent( $api, $url ,$params , $version=2){

		if ($version===1){	
			// Currently only support this version of API
			$geturl = $this->API_URL_V1 . "/" . $api . "?tags=1&token=" . $this->token . "&url=" . ($url);
		}else{
			$geturl = $this->API_URL_V2 . "/v" . $version ."/" . $api . "?token=" . $this->token . "&url=" . ($url);
			// Fix some server not compatible with RFC 1738
			//$geturl = str_replace('%7E','~',$geturl); 
		}
		
		if (is_array($params)){
			foreach($params as $key => $value){
				$geturl = $geturl . "&" .$key ."=".urlencode($value);
			}
		}
		if ($this->debug) echo "<font  color =red >Debug Info:</font>Requesting URL:$geturl<br />";
		
		// Check if "file_get_contents" or "curl_exec" supported on host server
		if (function_exists("file_get_contents")){
			
			$json =  @file_get_contents($geturl);
				
			if ($json == false && $this->debug){
				$error = error_get_last();
				echo "<font color=red >Debug Info :</font> Error was: " . $error['message'] ." <br />";
				exit;
			}
			return $json;	
		} else if (function_exists("curl_exec")){

			$curl = curl_init($geturl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			$json = curl_exec($curl);
			curl_close($curl);

			if ($json == false && $this->debug){
				$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
				echo "<font color=red >Debug Info:</font> Error was: " . $error['message']." <br />";
				exit;
			}
			return $json;
		} else{
			// Neither curl nor file_get_content are not supported
			echo  "<font color=red >Debug Info:</font>Neither curl nor file_get_content are not supported. Please contact your system admin";
			exit;
		}
		
	}
}	

?>

