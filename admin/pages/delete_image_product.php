<?php
session_start();
if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    if (isset($_GET['id_image']) && is_numeric($_GET['id_image']) && isset($_GET['id_product']) && is_numeric($_GET['id_product']) ) {
        $id_image= $_GET['id_image'] ; 
        $id_product= $_GET['id_product'] ; 
        
        // Fetch all images for the product
        $sql = "SELECT image_url FROM product_image WHERE product_id = ? and `image_id` = ? ";
        $req = $con->prepare($sql);
        $req->execute([$id_product ,  $id_image]);
        $image = $req->fetch(PDO::FETCH_ASSOC);

      
            $imgPath = '../../images_uploaded/products/' . $image['image_url'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
       
        $sql = 'DELETE FROM `product_image` WHERE `image_id` = ? and product_id = ?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id_image , $id_product ]);
         
     
       header("location:../edit_product.php?id=$id_product") ;

    } 
} else {
    header('Location: ../login.php');
    exit();
}
?>
