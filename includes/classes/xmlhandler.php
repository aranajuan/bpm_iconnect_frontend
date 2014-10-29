<?php

/**
 * Administra la comunicacion XML con el application
 */
class XmlHandler {

    /**
     *
     * @var SimpleXMLElement 
     */
    private $request;
    private $response;

    /**
     *
     * @var SimpleXMLElement 
     */
    private $responseDom;

    /**
     *
     * @var USER
     */
    private $user;
    private $params;
    private $error;

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
        $this->params = $params;
        $requestNodes = $this->request->getElementsByTagName("request");
        $request = $requestNodes->item(0);
        $request->appendChild($this->create_requestElement("class", xmlEscape($class)));
        $request->appendChild($this->create_requestElement("method", xmlEscape($method)));
        if (is_array($this->params)) {
            $paramsNode = $this->create_requestElement("params");
            foreach ($this->params as $k => $v) {
                $paramsNode->appendChild($this->create_requestElement($k, $v));
            }
            $request->appendChild($paramsNode);
        }
        $this->make_header();
    }

    /**
     * Devuelve DOM de request
     * @return SimpleXMLElement
     */
    private function get_requestDOM() {
        return $this->request;
    }

    /**
     * Crea elemento en request dom
     * @param string $k key
     * @param string $v value
     * @param boolean $CDATA is cdata
     * @return SimpleXMLElement elemento creado
     */
    public function create_requestElement($k, $v = null, $CDATA = false) {
        if ($v) {
            return $this->get_requestDOM()->createElement($this->make_param($k), $this->make_param($v, $CDATA));
        } else {
            return $this->get_requestDOM()->createElement($this->make_param($k));
        }
    }

    /**
     * Escapa caracteres del texto a enviar por xml
     * @param string $text
     * @param boolean $CDATA
     * @return string
     */
    private function make_param($text, $CDATA) {
        return trim(xmlEscape(strip_tags($text), $CDATA));
    }

    /**
     * Envia request al aplication
     * @return boolean exito al parsear.
     */
    public function send_request() {
        $requestTS = $this->request->saveXML(null, LIBXML_NOEMPTYTAG);
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
        $this->response = $data;
        return $this->load_response();
    }

    /**
     * Carga respuesta en dom
     * @return boolean error
     */
    private function load_response() {
        try {
            $this->responseDom = new SimpleXMLElement($this->response);
            $this->error = null;
            return $this->check_error();
        } catch (Exception $e) {
            $this->error = $e->getMessage() . ";" . $this->response;
            $this->responseDom = null;
            $this->input = null;
            return false;
        }
    }

    /**
     * Analiza error en xml desde el aplication
     * @return boolean true->no hay error
     */
    private function check_error() {
        $this->error = $this->get_respose("error");
        if($this->error==="ejecution::Usuario no logeado"){
            $this->get_user()->logout();
        }
        if ($this->error) {
            return false;
        }
        return true;
    }

    /**
     * Devuelve error
     * @return string Description error
     */
    public function get_error() {
        return $this->error;
    }

    /**
     * Obtener datos de la respuesta
     * @return array<string> Datos recursivos
     */
    public function get_respose($tag) {
        $resDom = $this->responseDom->response;
        $gR = $resDom->{$tag};
        if ($gR) {
            return $this->XMLtoArray($gR);
        } else {
            return null;
        }
    }

    /**
     * 
     * @param SimpleXMLElement $EL
     * @return array<string><string>/string array recursivo
     */
    private function XMLtoArray($EL) {
        $ch = $EL->children();
        if (count($ch)) {
            $i = 0;
            $arr = array(); // tiene hijos devuelve array
            foreach ($ch as $child) {
                if (isset($arr[$child->getName()])) {
                    if ($i == 0) {
                        $tmp = $arr[$child->getName()];
                        unset($arr[$child->getName()]);
                        $arr[$child->getName()][$i] = $tmp;
                        $i++;
                    }
                    $arr[$child->getName()][$i] = $this->XMLtoArray($child);
                    $i++;
                } else {
                    $arr[$child->getName()] = $this->XMLtoArray($child);
                }
            }
            return $arr;
        } else {
            return $this->filter_param($EL->asXML()); // solo contiene texto
        }
    }

    /**
     * Devuelve parametro limpio de etiquetas XSS
     * @param string $param
     * @return string $param
     */
    private function filter_param($value) {
        return trim(strip_tags(xmlText($value)));
    }

    /**
     * Usuario ejecuta
     * @return USER
     */
    public function get_user() {
        return $this->user;
    }

}

?>
