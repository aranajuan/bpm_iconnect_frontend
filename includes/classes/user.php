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
    private $ubicacion;
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

    public function logout() {
        $this->delete_file_tmp();
        if ($this->usr) {
            $LOG = new LOGGER();
            $LOG->addLine(array($this->usr, "logout"));
            session_destroy();
        }
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
        $this->nombre = $tmp["nombre"];
        $this->perfil = $tmp["perfil"];
        $this->puesto = $tmp["puesto"];
        $this->ubicacion = $tmp["ubicacion"];
        $this->mail = $tmp["mail"];
        $this->telefono = $tmp["telefono"];
        if ($this->hash != "" && $this->hash != null) {
            $this->logged = true;
        } else {
            $this->logged = false;
        }
        $this->access = $tmp["access"];
        $this->accessV = explode(",", $this->access);
    }

    /**
     * Devuelve la cantidad de intentos de logueo
     * @return int intentos
     */
    public function get_try() {
        if (!isset($_SESSION["intento"]))
            return 0;
        return $_SESSION["intento"];
    }

    /**
     * Agrega intento de logueo
     * @return int intentos
     */
    public function add_try() {
        if (!isset($_SESSION["intento"])) {
            $_SESSION["intento"] = 1;
            return 1;
        }
        $_SESSION["intento"]++;
        return $this->get_try();
    }

    /**
     * Resetea contador de logueo
     */
    public function reset_try() {
        unset($_SESSION["intento"]);
    }

    /**
     * Cambia de instancia
     * @param string $name
     */
    public function set_instance($name) {
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
     * @return array|null  puede acceder (class method)
     */
    public function check_access($class, $method) {
        if ($class == null || $class == "")
            $class = "page";
        $class = strtolower($class);
        $valid = $this->accessV;
        foreach ($valid as $v) {
            //echo strtolower($GLOBALS["access"][trim($v)][1])."/".strtolower($GLOBALS["access"][trim($v)][2])."<br/>";
            $lClass=$GLOBALS["access"][trim($v)][1];
            $lMethod=$GLOBALS["access"][trim($v)][2];
            if (strtolower($lClass) == $class && strtolower($lMethod) == $method) {
                return array($lClass,$lMethod);
            }
        }
        return null;
    }

    /**
     * Lista los metodos habilitado para la clase seleccionada
     * @param type $class 
     * @return array<string> lista de metodos
     */
    public function list_access($class = null) {
        if ($class == null || $class == "")
            $class = "page";
        $ret = array();
        $valid = $this->accessV;
        foreach ($valid as $v) {
            if (strtolower($GLOBALS["access"][trim($v)][1]) == $class) {
                array_push($ret, $GLOBALS["access"][trim($v)]);
            }
        }
        return $ret;
    }

    /**
     * @return string pagina inicio
     */
    public function get_home() {
        $arr = $this->list_access();
        if (count($arr) == 0) { // no tiene ningun acceso
            return "noacces";
        }
        return $arr[0][2];
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
            case 'ubicacion':
                return $this->ubicacion;
            case 'mail':
                return $this->mail;
            case 'telefono':
                return $this->telefono;
            default:
                return "Propiedad invalida.";
        }
    }

    /**
     * Devuelve menu de usuario
     * @param String $LA Ubicacion actual
     * @return array{main,sub}{titulo,script}
     */
    public function get_menu() {
        if (!$this->is_logged()) {
            return null;
        }
        $mainm = array();
        $subel=array();
        $alist = $this->list_access();
        foreach ($alist as $link) {
            $exp = explode("_", $link[3]);
            if (count($exp) == 1) {
                array_push($mainm, array($link[3], "menu_go('" . $link[2] . "')","path"=>$link[2]));
            } else {
                if (!isset($subel[$exp[0]])) {
                    array_push($mainm, array($exp[0], "menu_sub('" . $exp[0] . "')","path"=> $exp[0]));
                }
                $link[2]="submenu_go('" . $link[2] . "')";
                $subel[$exp[0]][$exp[1]] = $link;
            }
        }
        return array($mainm,$subel);
    }

    /**
     *  Cuenta los archivos temporales
     * @return  int
     */
    public function user_files() {
        $ret = array();
        $i = 0;
        $dirs = array(FILEUP_TMP_FOLDER . "/", FILEUP_TMP_FOLDER . "/thumbnail/");
        foreach ($dirs as $dir) {
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $archivos = glob($dir . $this->get_prop("usr") . "_*.*");
                    foreach ($archivos as $archivo) {
                        $exp = explode("_", $archivo);
                        $usr = explode("/", $exp[0]);
                        if ($usr[count($usr) - 1] == $this->get_prop("usr")) {
                            $ret[$i] = $archivo;
                            $i++;
                        }
                    }
                    closedir($dh);
                }
            }
        }
        return $ret;
    }

    /**
     * Elimina temporal especifico
     * @param string $file
     * @return string
     */
    public function delete_tmp($file) {
        $list = $this->user_files();
        foreach ($list as $f) {
            if (strpos($f, $file)) {
                unlink($f);
            }
        }
        return "ok";
    }

    /**
     * Elimina temporales de fileuploader 
     */
    public function delete_file_tmp() {
        $list = $this->user_files();
        foreach ($list as $f) {
            unlink($f);
        }
    }

}

?>
