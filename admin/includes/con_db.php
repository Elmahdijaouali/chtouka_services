<?php 
  
  $dsn = 'mysql:host=localhost;dbname=chtouka_service_db'; 
  $username = 'root';                            
  $password = '';                                   
  
  try {
     
      $con = new PDO($dsn, $username, $password);
    
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
  } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
  }
  
  