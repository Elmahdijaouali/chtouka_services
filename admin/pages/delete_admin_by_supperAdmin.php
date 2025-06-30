<?php
session_start();
if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $admin_id = (int)$_GET['id'];

       
        $sql = 'DELETE FROM `admins` WHERE `admin_id` = ?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$admin_id]);
        
       
       header('location:../admins.php') ;

    } else {
        echo 'Invalid admin ID.';
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
