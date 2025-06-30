<?php
session_start();
require_once '../includes/con_db.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $sql = 'SELECT admin_id, email, password_hash , role FROM admins WHERE email = ?';
    $req = $con->prepare($sql);
    $req->execute([$email]);

    $admin = $req->fetch(PDO::FETCH_ASSOC);

    if ($admin && $admin['password_hash'] === $password) {
        $_SESSION['admin'] = sha1($email);
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['role'] = $admin['role'];
        header('Location: ../dashboard.php');
        exit();
    } else {
        header('Location: ../login.php?error=admin not found');
        exit();
    }
}
?>
