<?php

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';
     
    $sql ="SELECT *  FROM category" ;
    $req=$con->prepare($sql);
    $req->execute() ;
    $categories =$req->fetchAll(PDO::FETCH_ASSOC) ;



} else {
    header('Location: ../login.php');
    exit();
}
?>
