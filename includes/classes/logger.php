<?php
 
    /**
     * myLogger
     * @author Edder Rojas Douglas
     * @version 0.2
     */
 
    class LOGGER  {
 
        protected $_path;
        protected $_fileName = 'itlog.log';
 
        /**
         * @param string $path can be a directory o a file path
         */
        public function __construct($path=null) {
            if($path==null){
                $path=ROOT_DIR."/logs";
            }
            if (empty($path)){
                Throw new Exception("Path must be filled");
            }
            if (!file_exists($path)) {
                Throw new Exception("The Path doesn't exists.");
            }
            if (!is_writeable($path)) {
                Throw new Exception("You can write on the give path");
            }
            $this->_path = $this->_parsePath($path);
        }  
 
        /**
         * Validate the path the add the filename to the path
         * @param String $path
         * @return String
         */
        protected function _parsePath($path) {
            $strLenght = strlen($path);
            $lastChar = substr($path, $strLenght - 1, $strLenght);
            $path = $lastChar != "/" ? $path . "/" : $path;
 
            if ( is_dir($path) ) {
                return $path . $this->_fileName;
            } else {
                return $path;
            }
        }
 
        /**
         * Will save the path on the give path
         * @param String $line
         */
        protected function _save($line) {
            $fhandle = fopen($this->_path, "a+");
            fwrite($fhandle, $line);
            fclose($fhandle);
        }
 
        /**
         * main function to add lines to the logging file
         * @param String $line
         */
        public function addLine($line){
            $line = is_array($line) ? implode("\t",$line) : $line;
            $line = date("d-m-Y h:i:s")."\t".$_SERVER['REMOTE_ADDR'].": $line\n";
            $this->_save($line);
        }
    }