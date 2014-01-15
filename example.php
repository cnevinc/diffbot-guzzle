<?php
require_once 'diffbot-client-lib.php';


// API Settings
$token="bcf8eff68d2cd2c615b6b0c4a3d702cf";

// Target URL
$url ="http://www.sierratradingpost.com/gregory-z55-backpack-internal-frame~p~2021t/?filterString=s~gregory-/&colorFamily=09";

// API parameters
$params = array(
	'fields'	=>	"product(title,type,brand)",
	'timeout' 	=>	"6000",
    'callback' 	=>	"<script>
					// alert('JS Call Back !');
					</script>"
);
	
// Initial Diffbot client with developer token					
$dfClient = new DiffbotClient($token);

// Get response from AUTOMATIC APIS
// Visit http://www.diffbot.com/products/automatic/product/ for parameters detail
$json = $dfClient->getProduct( $url , $param);
//$json = $dfClient->getArticle( $url); 
//$json = $dfClient->getImage( $url); 
//$json = $dfClient->getAnalyze( $url); 


// Test returned result
$data = json_decode($json, TRUE);

var_dump($data);

?>
