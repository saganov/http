<?php
    
    function __autoload($class_name) {
        include $class_name . '.class.php';
    }

    echo "<h1>My HTTP Server</h1>";
    
    $options = array(
        'url' => 'http://localhost/http/test.php',
        'method' => 'post',
        'version' => '1.0',
        'params' => array('firstname'=>'Vacya', 'surname'=>'Ivanov'),
        'headers' => array(
            'Content-Length: 500',            
        )
    );
           
    $http_request = new HttpRequest();    
    $http_request->setOptions($options);
    $http_request->send();
    
    
    print "<pre>";
    print "<h3>MY Request Data</h3>";
    print_r($options);
    print "</pre>";
    print "<br /><hr><br />";
    
    
    
     
    print "<pre>";
    print "<h3>MY Response Data</h3>";
    print_r($http_request->getResponse());   
    //print_r($http_request->getResponseCode());   
    print_r($http_request->getResponseContent());   
    print "</pre>";
    
    

