<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soap extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper("url");

		$ns = base_url().'index.php/soap/';
		$this->load->library("Nusoap_library");//cargando mi biblioteca
		$this->nusoap_server = new soap_server();
		$this->nusoap_server->configureWSDL("SOAP_Server",$ns);
		$this->nusoap_server->wsdl->schemaTargetNamespace = $ns;

		//registrando funciones
		$input_array = array("a" => "xsd:string", "b" => "xsd:string");
		$return_array = array("return" => "xsd:string");
		$this->nusoap_server->register('sumar',
				$input_array, $return_array,
				"urn:SOAPServerWSDL",
				"urn:".$ns."sumar",
				"rpc",
				"encoded",
				"Suma dos numeros"
			);

	}
	public function index(){
        function sumar($a,$b)
        {
            $c = $a + $b;
            return $c;
        }
        $this->nusoap_server->service(file_get_contents("php://input"));
    }
}