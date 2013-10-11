<?php
require_once 'HttpResponse.class.php';

class HttpServer extends HttpResponse{        
    private $ch;
    private $url;
    private $params;
    private $params_string = '';
      
                    
    public function send_request(array $options){
        if(is_array($options)){
            $this->url = $options['url'];
            if(!isset($this->url) && $this->url != ''){
                exit;
            }
            $this->params = $options['params'];
            $method = strtoupper($options['method']);
            if(isset($method) && $method == 'GET'){
                $this->params += $_GET;                 
            }                        
            
            foreach($this->params as $key=>$value) { 
                $this->params_string .= $key.'='.urlencode($value).'&';             
            }
            $this->params_string = rtrim($this->params_string, '&');
            
            //start curl
            $this->run_curl($method);        
        } else {
            throw new Exception('Options is missed');
        }                          
    }            
    
    private function run_curl($method){
        $this->ch = curl_init();    
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        $this->{'run_'.strtolower($method)}();        
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_" . str_replace(".", "_", $this->options['version']));
        curl_setopt($this->ch, CURLOPT_HEADER, 1); // get the header
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); // get the response as a string from curl_exec(), rather than echoing it
        curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, 1); // don't use a cached version of the url
        $content = curl_exec($this->ch);
        $err     = curl_errno($this->ch);
        $errmsg  = curl_error($this->ch);
        $header  = curl_getinfo($this->ch);        
        curl_close($this->ch);        
        
        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;     
        $this->setResponse($header);
    }
            
    private function run_get(){
        curl_setopt($this->ch, CURLOPT_URL, $this->url.'?'. $this->params_string);
    }
        
    private function run_post(){        
        curl_setopt($this->ch, CURLOPT_POST, count($this->params));    
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->params_string);
    }
        
    private function run_put(){
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->params_string);
    }
            
    private function run_delete(){
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->params_string);
    }
    
}

?>
