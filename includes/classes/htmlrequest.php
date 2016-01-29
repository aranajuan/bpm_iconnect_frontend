<?php

/**
 * Clase administradora del la solicitud HTTP
 * Utilizada por xml handler
 */
class HtmlRequest {
   
    private static $Svars = array('REQUEST_URI','HTTP_HOST');
    
    /**
     * Devuelve valor de variable enviada por post o get
     * @param type $name
     * @return type
     */
    public function get_param($name){
        if(isset($_POST[$name])){
            $value=$_POST[$name];
        }elseif(isset($_GET[$name])){
            $value=$_GET[$name];    
        }else{
            return null;
        }
        return $this->check_param($value);
    }
    
    /**
     * Evalua si existe el parametro en post o get y no es null o vacio
     * @param type $name
     * @return boolean
     */
    public function is_set($name){
        return $this->get_param($name)!=null;
    }
    
    /**
     * Lista todos los parametros por post y get//predomina post
     * @param  array<string>    $exceptions array de parametros a ignorar
     * @return array<string,string> lista de parametros
     */
    public function get_allvars($exceptions=null){
        $ret= array();
        $checkExcep=is_array($exceptions);
        foreach($_GET as $k => $v){
            if($checkExcep && !in_array($k, $exceptions)){
                $ret[$this->check_param($k)]=$this->check_param($v);
            }
        }
        foreach($_POST as $k => $v){
            if($checkExcep && !in_array($k, $exceptions)){
                $ret[$this->check_param($k)]=$this->check_param($v);
            }
        }
        return $ret;
    }
    
    /**
     * Lista de parametros filtrado de class y method
     * @param array $exceptions parametros a ignorar por defaul se ignora class y method
     */
    public function get_allparams($exceptions=null){
        $ignore=array("class","method","instancia");
        if(is_array($exceptions)){
            $ignore=  array_merge($ignore,$exceptions);
        }
        return $this->get_allvars($ignore);
    }
    
    /**
     * Devuelve valor limpio de XSS
     * @param type $value
     * @return string $value
     */
    private function check_param($value){
        return trim(strip_tags($value));
    }
    
    /**
     * Obtiene valor del server
     * @param type $value
     * @return type
     */
    public function get_server($name){
        if(!in_array($name, HtmlRequest::$Svars)){
            return null;
        }
        return $this->check_param($_SERVER[$name]);
    }
    

    
    
}

?>
