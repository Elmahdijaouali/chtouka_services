<?php
session_start();
require '../includes/con_db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $email = htmlspecialchars(trim($_POST['email']));
    $password =sha1(htmlspecialchars(trim($_POST['password']))) ;

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['handle_notification']="Invalid All fields are required.";
        header("Location: ../login.php"); 
        exit;
    }

    
    $sql = "SELECT * FROM users WHERE email = ? and password_hash=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$email , $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (!empty($user)) {
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] =sha1($user['email']);
        
      
        header("Location: ../index.php"); 
        exit;
    } else {
        $_SESSION['handle_notification']="Invalid email or password.";
        header("Location:../login.php"); 
    }
} else {
    $_SESSION['handle_notification']="Invalid request method.";
    header("Location: ../login.php"); 
}
?>
