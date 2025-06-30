<?php


    require_once 'includes/con_db.php';
     
    $sql ="SELECT p.category_id, category_titre_fr , category_titre_ar  FROM category c
    INNER JOIN product p ON c.category_id = p.category_id 
    GROUP BY p.category_id  " ;
    $req=$con->prepare($sql);
    $req->execute() ;
    $categories =$req->fetchAll(PDO::FETCH_ASSOC) ;




?>
