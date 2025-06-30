<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';
    
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        // Fetch all images for the product
        $sql = "SELECT image_url FROM product_image WHERE product_id = ?";
        $req = $con->prepare($sql);
        $req->execute([$product_id]);
        $images = $req->fetchAll(PDO::FETCH_ASSOC);

        // Delete each image file
        foreach ($images as $image) {
            $imgPath = '../../images_uploaded/products/' . $image['image_url'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        // Delete images from product_image table
        $sql = "DELETE FROM product_image WHERE product_id = ?";
        $req = $con->prepare($sql);
        $req->execute([$product_id]);

        // Now delete the product
        $sql = "DELETE FROM product WHERE product_id = ?";
        $req = $con->prepare($sql);

        if ($req->execute([$product_id])) {
            $_SESSION['success'] = "Product and associated images deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting product: " . $req->errorInfo()[2];
        }
    } else {
        $_SESSION['error'] = "No product ID specified.";
    }

    header('Location: ../products.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>
