<?php
session_start();

if (isset($_SESSION['admin']) && $_SESSION['role'] === "superadmin" ) {
    require_once '../includes/con_db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $tel_admin = $_POST['tel_admin'];
        $role = $_POST['role'];

        $img = '';
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $imgName = basename($_FILES['img']['name']);
            $imgPath = '../../images_uploaded/admins/'.time() . $imgName;
            if (move_uploaded_file($_FILES['img']['tmp_name'].time(), $imgPath)) {
                $img = $imgName;
            }
        }


          // Check if username already exists
          $sqlCheck = 'SELECT COUNT(*) FROM `admins` WHERE `username` = ?';
          $stmtCheck = $con->prepare($sqlCheck);
          $stmtCheck->execute([$username]);
          if ($stmtCheck->fetchColumn() > 0) {
              header('Location: ../form_add_admin.php?error=Username already exists');  
              exit();
          }

        // Insert new admin
        $sql = 'INSERT INTO `admins` (`username`, `email`, `password_hash`, `created_at`, `updated_at`, `img`, `tel_admin` , `role`) VALUES (?, ?, ?, NOW(), NOW(), ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([
            $username,
            $email,
            $password,
            $img,
            $tel_admin,
            $role
        ]);

        header('Location: ../admins.php');
        exit();
    } else {
        header('Location: ../form_add_admin.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
