<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientews extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->library("Nusoap_library");//cargando mi biblioteca
		$this->load->helper("url");
	}

	function index(){

		$params = array(
			'a' => 2,
			'b' => 3,
			);
		$webserviceUrl = base_url().'index.php/soap?wsdl';
		print_r($webserviceUrl."<br>");
		$client = new nusoap_client($webserviceUrl, true);
		$err = $client->getError();
		if($err) echo $err;
		$response = $client->call("sumar", $params);
		print_r($response);
	}
	function test(){
		$url = "http://www.w3schools.com/webservices/tempconvert.asmx?wsdl";
		$namespace = "http://www.w3schools.com/webservices";
		$soapAction = "http://www.w3schools.com/webservices/FahrenheitToCelsius";
		$client = new nusoap_client($url,
									$wsdl=true,
									$proxyhost = '172.26.96.2',
									$proxyport = '8080');
		$err = $client->getError();
		if($err) echo $err;


		$response = $client->call("FahrenheitToCelsius", array('Fahrenheit' =>'100'));
		var_dump($response);
		echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
		echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
	}
	function cliente1(){
		$url = 'http://www.xignite.com/xquotes.asmx?WSDL';
		$client = new nusoap_client($url,true,$proxyhost = '172.26.96.2', $proxyport = '8080');
		$err = $client->getError();
		if($err) echo $err;
		$response = $client->call('GetQuickQuotes', ['parameters' =>['Symbol' => 'IBM']],"","",false,true);
		var_dump($response);
		echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
		echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
	}
}