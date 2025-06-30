<?php
session_start();
require_once '../includes/con_db.php';

if (isset($_SESSION['admin'])) {
    $admin_id = $_SESSION['admin_id'];
    $query = "SELECT password_hash FROM admins WHERE admin_id = ?";
    $stmt = $con->prepare($query);
    $stmt->execute([$admin_id]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
 
    if ( isset($_POST['current_password'])  && isset($_POST['new_password'])  && isset($_POST['confirm_password']) ) {
        $current_password =sha1($_POST['current_password']) ;
        
        if ($_POST['new_password'] === $_POST['confirm_password'] && $admin['password_hash'] === $current_password ) {
               
      
            $updateQuery = "UPDATE admins SET password_hash = ? WHERE admin_id = ?";
            $updateStmt = $con->prepare($updateQuery);
            if ($updateStmt->execute([ sha1( $_POST['new_password']) , $admin_id])) {
                // Success message
                $_SESSION['success']= "Password updated successfully." ;
                header('Location: ../profile_setting_admin.php');
                exit();
            } else {
                // Error handling
                $_SESSION['errors'][] = "Error updating password." ;
                header('Location: ../profile_setting_admin.php');
                exit();
            }
        } else {
            $_SESSION['errors'][] = "New passwords do not match." ;
            header('Location: ../profile_setting_admin.php');
            exit();
        }
    } else {
        $_SESSION['errors'][] = "Current password is incorrect." ;
        header('Location: ../profile_setting_admin.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
