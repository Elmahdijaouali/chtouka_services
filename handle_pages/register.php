<?php
session_start();
require_once '../includes/con_db.php';

// Assuming you set the language somewhere in your session or directly
$lang = $_SESSION['lang'] ?? 'fr'; // Default to French if not set

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirmed'])) {
    
    if ($_POST['password'] === $_POST['password_confirmed']) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']); 

        // Check if email already exists
        $sql = 'SELECT email FROM users WHERE email = ?';
        $req = $con->prepare($sql);
        $req->execute([$email]);
        
        if ($req->rowCount() > 0) {
            if ($lang == 'ar') {
                $_SESSION['handle_notification_error'] = "خطأ، البريد الإلكتروني موجود بالفعل.";
            } else {
                $_SESSION['handle_notification_error'] = "Erreur, l'adresse e-mail existe déjà.";
            }
            header('Location: ../register.php');
            exit();
        }

        // Insert new user
        $sql = 'INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)';
        $stmt = $con->prepare($sql);
        if ($stmt->execute([$username, $email, $password])) { 
            header('Location: ../login.php'); 
            exit();
        } else {
            if ($lang == 'ar') {
                $_SESSION['handle_notification_error'] = "خطأ، فشل التسجيل.";
            } else {
                $_SESSION['handle_notification_error'] = "Erreur, l'inscription a échoué.";
            }
            header('Location: ../register.php');
            exit();
        }
    } else {
        if ($lang == 'ar') {
            $_SESSION['handle_notification_error'] = "خطأ، كلمة المرور غير متطابقة!";
        } else {
            $_SESSION['handle_notification_error'] = "Erreur, les mots de passe ne correspondent pas!";
        }
        header('Location: ../register.php');
        exit();
    }
}
?>
