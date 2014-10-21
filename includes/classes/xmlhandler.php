<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of xmlhandler
 *
 * @author u548391
 */
class XmlHandler extends HtmlRequest {

    private $request;
    private $response;
    private $user;
    private $params;

    /**
     * Crea documento para la solicitud
     */
    private function create_doc() {
        $this->request = new DOMDocument('1.0', 'UTF-8');
        $xmlRoot = $this->request->createElement("itracker");
        $xmlRoot = $this->request->appendChild($xmlRoot);
        $header = $this->request->createElement("header");
        $xmlRoot->appendChild($header);
        $request_d = $this->request->createElement("request");
        $xmlRoot->appendChild($request_d);
    }

    /**
     * Genera el header para el envio del XML // ip del usuario usr hash etc
     */
    private function make_header() {
        $headerNodes = $this->request->getElementsByTagName("header");
        $header = $headerNodes->item(0);
        $header->appendChild($this->request->createElement("usr", $this->user->get_prop("usr")));
        $header->appendChild($this->request->createElement("instance", $this->user->get_prop("instancia")));
        if ($this->user->is_logged()) {
            $header->appendChild($this->request->createElement("hash", $this->user->get_prop("hash")));
        }
        $header->appendChild($this->request->createElement("ip", $_SERVER['REMOTE_ADDR']));
        $header->appendChild($this->request->createElement("front", FRONT_NAME));
    }

    /**
     * Carga los parametros necesarios para ejecutar la consulta
     * @param USER $u
     * @param array $params 
     */
    public function load_params($U, $class, $method, $params = null) {
        $this->create_doc();
        $this->user = $U;
        $requestNodes = $this->request->getElementsByTagName("request");
        $request = $requestNodes->item(0);
        $request->appendChild($this->request->createElement("class", $class));
        $request->appendChild($this->request->createElement("method", $method));
        if (is_array($params)) {
            $paramsNode = $this->request->createElement("params");
            foreach ($params as $k => $v) {
                $paramsNode->appendChild($this->request->createElement($k, $v));
            }
            $request->appendChild($paramsNode);
        }
        $this->make_header();
    }

    /**
     * Envia request al aplication
     */
    public function send_request() {
        $requestTS = $this->request->saveXML();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, APLICATION_SERVER);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestTS);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = curl_exec($ch);
        curl_close($ch);
        echo "SOLICITUD:<br/>";
        echo $requestTS;
        echo "RESPUESTA:<br/>";
        echo $data;
    }

    /**
     * Devuelve el XML
     */
    public function get_response() {
        
    }

}

?>
