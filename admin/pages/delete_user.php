<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

       
        $sql = "DELETE FROM users WHERE user_id = ?";
        $req = $con->prepare($sql);

        if ($req->execute([$user_id])) {
            $_SESSION['success'] = "User deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting user: " . $req->errorInfo()[2];
        }

        header('Location: ../users.php'); 
        exit();
    } else {
        $_SESSION['error'] = "No user ID specified.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
