<?php

class HttpResponse{
    public $response = array();
    
    function __construct() {
        echo 'HttpServer';        
    }
    public function setResponse(array $response){        
        $this->response = $response;
        //var_dump($this->response);
    }
    
    public function getResponse(){
        //var_dump($this->response);
        return $this->response;
    }
    
    public function getResponseCode(){
        return $this->response['http_code'];
    }
    
    public function getResponseContent(){
        return $this->response['content'];
    }
}

?>
