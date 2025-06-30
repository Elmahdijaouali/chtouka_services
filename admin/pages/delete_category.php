<?php
session_start();
if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $category_id = (int)$_GET['id'];

       
        $sql = 'DELETE FROM `category` WHERE `category_id` = ?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$category_id]);
        
       
       header('location:../categories.php') ;

    } else {
        echo 'Invalid category ID.';
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
