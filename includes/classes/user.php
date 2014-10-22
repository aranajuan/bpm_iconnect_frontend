<?php

class USER {

    private $usr;
    private $instancia;
    private $ip;
    private $hash;
    private $intento;
    private $nombre;
    private $perfil;
    private $puesto;
    private $mail;
    private $telefono;
    private $access;
    private $accessV;
    private $logged;

    /**
     * Crea clase - inicia session
     */
    function USER() {
        session_start();
        $this->logged = false;
    }

    /**
     * Carga datos de la session, devuelve true si esta iniciada
     * @return boolean hay session 
     */
    public function load_session() {
        if (session_id() === "") {
            $this->load_vec(null);
            return false;
        } else {
            $this->load_vec($_SESSION);
            return true;
        }
    }

    /**
     * Carga datos de vector al objeto
     * @param array $tmp 
     */
    public function load_vec($tmp) {
        $this->usr = $tmp["usr"];
        $this->instancia = $tmp["instancia"];
        $this->ip = $tmp["ip"];
        $this->hash = $tmp["hash"];
        $this->intento = $tmp["intento"];
        $this->nombre = $tmp["nombre"];
        $this->perfil = $tmp["perfil"];
        $this->puesto = $tmp["puesto"];
        $this->mail = $tmp["mail"];
        $this->telefono = $tmp["usr"];
        if ($this->hash != "" && $this->hash != null) {
            $this->logged = true;
        } else {
            $this->logged = false;
        }
        $this->access = $tmp["access"];
        $this->accessV = explode(",", $this->access);
    }

    /**
     * Cambia de instancia
     * @param string $name
     */
    public function set_instance($name){
        $this->instancia = $name;
    }
    
    /**
     * Informa si el usuario se encuentra logueado
     * @return boolean 
     */
    public function is_logged() {
        return $this->logged;
    }

    /**
     * Verifica acceso a un metodo o pagina (PAGE)
     * @param string $class
     * @param string $method 
     * @return boolean  puede acceder
     */
    public function check_access($class, $method) {
        if ($class == null || $class == "")
            $class = "PAGE";
        $valid = $this->accessV;
        foreach ($valid as $v) {
            if (strtolower($GLOBALS["access"][trim($v)][1]) == $class && strtolower($GLOBALS["access"][trim($v)][2]) == $method) {
                return true;
            }
        }
        return false;
    }

    /**
     * Lista los metodos habilitado para la clase seleccionada
     * @param type $class 
     * @return array<string> lista de metodos
     */
    public function list_access($class) {
        if ($class == null || $class == "")
            $class = "PAGE";
        $ret = array();
        $valid = $this->accessV;
        foreach ($valid as $v) {
            if (strtolower($GLOBALS["access"][trim($v)][1]) == $class) {
                array_push($ret, strtolower($GLOBALS["access"][trim($v)][2]));
            }
        }
        return $ret;
    }

    /**
     * Genera menu en html
     * @return string
     */
    public function get_menu() {
        return "";
    }

    /**
     * Devuelve el valor de la propiedad solicitada
     * @param string $property 
     */
    public function get_prop($property) {
        switch ($property) {
            case 'usr':
                return $this->usr;
            case 'instancia':
                return $this->instancia;
            case 'dominio':
                return $this->dominio;
            case 'ip':
                return $this->ip;
            case 'hash':
                return $this->hash;
            case 'intento':
                return $this->intento;
            case 'nombre':
                return $this->nombre;
            case 'perfil':
                return $this->perfil;
            case 'access':
                return $this->access;
            case 'puesto':
                return $this->puesto;
            case 'mail':
                return $this->mail;
            case 'telefono':
                return $this->telefono;
            default:
                return "Propiedad invalida.";
        }
    }

}

?>
