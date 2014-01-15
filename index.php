<?php
require_once 'vendor/autoload.php';
use Guzzle\Http\Client;


class DiffbotClient{

        private $api_token,$client; 

        function __construct($api_token){
			$this->api_token = $api_token;
			$this->client = new Client('http://api.diffbot.com');
        }
        
        function getProduct($url){
			$request = $this->client->get("/v2/product?url=".$url."&token=".$this->api_token);
			$response = $request->send();			
			return json_decode($response->getBody());
        }
        
}
$token="bcf8eff68d2cd2c615b6b0c4a3d702cf";
$url = "http://www.sierratradingpost.com/gregory-z55-backpack-internal-frame~p~2021t/?filterString=s~gregory-%2F&colorFamily=09";

$diffRobotClient = new DiffbotClient($token);

echo "--------Product Request Sample--------<BR><BR><BR>";
// API parameters
$json = $diffRobotClient->getProduct($url);
var_dump($json);



?>

