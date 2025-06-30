<?php 
require_once '../includes/con_db.php';
session_start(); 

// Assuming you set the language somewhere in your session or directly
$lang = $_SESSION['lang'] ?? 'fr'; // Default to French if not set

if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['email'];

    $sql = "INSERT INTO `subscribe`(`email`) VALUES (?)";
    $req = $con->prepare($sql);
    $req->execute([$email]);

    if ($lang == 'ar') {
        $_SESSION['handle_notification_success'] = "شكراً لك على الاشتراك";
    } else {
        $_SESSION['handle_notification_success'] = "Merci de vous être abonné!";
    }

    header('Location: ../index.php');
    

} else {
    if ($lang == 'ar') {
        $_SESSION['handle_notification_error'] = "عنوان البريد الإلكتروني غير صالح.";
    } else {
        $_SESSION['handle_notification_error'] = "Adresse e-mail invalide.";
    }

    header("Location: ../index.php");
    
}
