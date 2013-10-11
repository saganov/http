<?php
require_once 'HttpServer.class.php';

class HttpRequest extends HttpServer{    
    public $options;
    
    function __construct() {
        $this->options = array(
            'url' => '',
            'method' => 'GET',
            'version' => '1.0',
            'params' => array()
        );
    }
    
    public function setOptions(array $options){
        $this->options = $options;
    }
    
    public function getOptions(){
        return $this->options;
    }
    
    public function send(){
        $this->send_request($this->options);
    }        
}


?>
