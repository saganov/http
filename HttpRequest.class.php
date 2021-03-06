<?php
require_once 'HttpServer.class.php';

class HttpRequest extends HttpServer{    
    public $options;
    public $headers;
    
    function __construct() {
        $this->options = array(
            'url' => '',
            'method' => 'GET',
            'version' => '1.0',
            'params' => array()
        );
        $this->headers = array(      
            'Content-Length: 500',            
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
