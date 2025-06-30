<?php 
session_start();
require_once '../includes/con_db.php';

$admin_id = $_SESSION['admin_id'];

if (isset($_SESSION['admin'])) {

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['tel_admin'])) {
        
        // Update profile details
        $username = $_POST['username'];
        $email = $_POST['email'];
        $tel_admin = $_POST['tel_admin'];
        
        $updateQuery = "UPDATE admins SET username = ?, email = ?, tel_admin = ? WHERE admin_id = ?";
        $stmt = $con->prepare($updateQuery);
        $stmt->execute([$username, $email, $tel_admin, $admin_id]);
    }

    // Handle image upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['img'];
        $imgName = uniqid() . '_' . basename($img['name']); 
        $imgTmp = $img['tmp_name'];
        $imgSize = $img['size'];
        $imgType = $img['type'];

        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        $imgPath = '../../images_uploaded/admins/' . $imgName;

        if (in_array($imgType, $allowedTypes) && $imgSize <= $maxSize) {
            if (move_uploaded_file($imgTmp, $imgPath)) {
                // Check and delete previous image
                $sql = 'SELECT img FROM admins WHERE admin_id = ?';
                $stmt = $con->prepare($sql);
                $stmt->execute([$admin_id]);
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($admin && $admin['img']) {
                    $prevImgPath = '../../images_uploaded/admins/' . $admin['img'];
                    if (file_exists($prevImgPath)) {
                        unlink($prevImgPath);
                    }
                }

                // Update the database with the new image name
                $updateImageQuery = "UPDATE admins SET img = ? WHERE admin_id = ?";
                $stmt = $con->prepare($updateImageQuery);
                if ($stmt->execute([$imgName, $admin_id])) {
                    $_SESSION['success'] = "Profile image updated successfully.";
                    $_SESSION['img_admin']=$imgName ;
                    
                } else {
                    $_SESSION['error'] = "Error updating profile image: " . implode(", ", $stmt->errorInfo());
                }
            } else {
                $_SESSION['error'] = "Failed to move uploaded file.";
            }
        } else {
            $_SESSION['error'] = "Invalid image file. Please upload a JPG or PNG image less than 5MB.";
        }
    } else {
        $_SESSION['error'] = "No image uploaded or an error occurred.";
    }

    header('Location:../profile_setting_admin.php');
    exit();
} else {
    header('Location: ../login.php');
    exit();
}
?>
