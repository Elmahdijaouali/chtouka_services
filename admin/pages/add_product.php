<?php
require_once '../includes/con_db.php';

if (
    isset($_POST['product_name_fr']) &&
    isset($_POST['description_fr']) &&
    isset($_POST['product_name_ar']) &&
    isset($_POST['description_ar']) &&
    isset($_POST['price']) &&
    isset($_POST['quantity']) &&
    isset($_POST['category_id']) &&
    isset($_FILES['images'])
) {
    $product_name_fr = $_POST['product_name_fr'];
    $description_fr = $_POST['description_fr'];
    $product_name_ar = $_POST['product_name_ar'];
    $description_ar = $_POST['description_ar'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];

    // Insert product data into the product table
    $sql = "INSERT INTO product (price, stock_quantity, category_id) VALUES (?, ?, ?)";
    
    $req = $con->prepare($sql);
    
    if ($req->execute([$price, $quantity, $category_id])) {
        $product_id = $con->lastInsertId(); // Get the ID of the newly inserted product
        
        // Insert translations into the product_translation table
        $sqlTranslation = "INSERT INTO product_translation (product_id, language_code, name, description) VALUES (?, 'fr', ?, ?), (?, 'ar', ?, ?)";
        $translationReq = $con->prepare($sqlTranslation);
        $translationReq->execute([$product_id, $product_name_fr, $description_fr, $product_id, $product_name_ar, $description_ar]);

        // Handle multiple image uploads
        $allowedTypes = ['image/png'];
        $maxSize = 2 * 1024 * 1024; // 2MB
        $images = $_FILES['images'];

        foreach ($images['name'] as $key => $img) {
            $imgTmp = $images['tmp_name'][$key];
            $imgSize = $images['size'][$key];
            $imgType = $images['type'][$key];

            // Validate the file type and size
            if (in_array($imgType, $allowedTypes) && $imgSize <= $maxSize) {
                $targetDir = '../../images_uploaded/products/';
                $targetFile = $targetDir . time() . 'product_img_' . basename($img);

                if (move_uploaded_file($imgTmp, $targetFile)) {
                    // Insert image data into product_image table
                    $sqlImg = "INSERT INTO product_image (product_id, image_url) VALUES (?, ?)";
                    $imgReq = $con->prepare($sqlImg);
                    $imgReq->execute([$product_id, $targetFile]);
                } else {
                    $error = "Error moving the file: $img";
                }
            } else {
                $error = "Invalid file type or file size exceeds limit for: $img";
            }
        }

        $success = "Product added successfully with images.";
        header('Location: ../products.php');
        exit();
    } else {
        $error = "Error: " . $req->errorInfo()[2];
    }
}
?>
