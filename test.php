<?php
    echo '<h2>Hello world!</h2>';
    
    print "<pre>";
    echo '<b>METHOD = '.$_SERVER['REQUEST_METHOD'].'</b><br/>';
    print "</pre>";
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        echo "this is a get request\n";       
        var_dump($_REQUEST);
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "this is a post request\n";
        var_dump($_REQUEST);        
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        echo "this is a put request\n";
        parse_str(file_get_contents("php://input"),$post_vars);
        var_dump($post_vars);
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        echo "this is a delete request\n";
        parse_str(file_get_contents("php://input"),$post_vars);
        var_dump($post_vars);
    }
    
?>
 
