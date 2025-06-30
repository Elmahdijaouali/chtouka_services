<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    // Check if all necessary data is provided
    if (isset($_POST['product_id'], $_POST['product_name_fr'], $_POST['description_fr'], $_POST['product_name_ar'], $_POST['description_ar'], $_POST['price'], $_POST['quantity'], $_POST['category_id'])) {
        $product_id = $_POST['product_id'];
        $product_name_fr = $_POST['product_name_fr'];
        $description_fr = $_POST['description_fr'];
        $product_name_ar = $_POST['product_name_ar'];
        $description_ar = $_POST['description_ar'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];

        // Update product details
        $sql = "UPDATE product SET price = ?, stock_quantity = ?, category_id = ?, updated_at = NOW() WHERE product_id = ?";
        $values = [$price, $quantity, $category_id, $product_id];
        $req = $con->prepare($sql);

        if ($req->execute($values)) {
            // Update product translations
            $sqlUpdateTranslation = "UPDATE product_translation SET name = ?, description = ? WHERE product_id = ? AND language_code = ?";
            $reqFr = $con->prepare($sqlUpdateTranslation);
            $reqFr->execute([$product_name_fr, $description_fr, $product_id, 'fr']);

            $reqAr = $con->prepare($sqlUpdateTranslation);
            $reqAr->execute([$product_name_ar, $description_ar, $product_id, 'ar']);

            if (isset($_FILES['images'])) {
                $allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    'image/webp',
                    'image/svg+xml',
                    'image/bmp',
                    'image/tiff'
                ];
                $maxSize = 2 * 1024 * 1024;
            
                foreach ($_FILES['images']['name'] as $key => $name) {
                    $imgTmp = $_FILES['images']['tmp_name'][$key];
                    $imgSize = $_FILES['images']['size'][$key];
                    $imgType = $_FILES['images']['type'][$key];
            
                    if (in_array($imgType, $allowedTypes) && $imgSize <= $maxSize) {
                        $targetDir = '../../images_uploaded/products/';
                        $targetFile = $targetDir . basename($name);
            
                        if (move_uploaded_file($imgTmp, $targetFile)) {
                            $sqlImg = "INSERT INTO product_image (product_id, image_url) VALUES (?, ?)";
                            $imgReq = $con->prepare($sqlImg);
                            $imgReq->execute([$product_id, $name]);
                        }
                    }
                }
            }
            

            $_SESSION['success'] = "Product updated successfully.";
            header('Location: ../products.php');
            exit();
        } else {
            $_SESSION['error'] = "Error updating product: " . $req->errorInfo()[2];
            header('Location: ../products.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Incomplete form data.";
        header('Location: ../products.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
