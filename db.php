<?php
    
    
    $config = json_decode(file_get_contents("./config.json"),true);
    

  
    $con = new mysqli($config['dbHost'],$config['dbUserName'],$config['dbPassword'],$config['dbName']);

    if ($con -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }
   


?>