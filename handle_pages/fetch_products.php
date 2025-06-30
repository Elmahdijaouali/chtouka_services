<?php
session_start();
require_once 'includes/con_db.php';

if (isset($_POST['category'])) {
    $_SESSION['best_category'] = $_POST['category'];
}

$best_category = isset($_SESSION['best_category']) ? $_SESSION['best_category'] : null;

if ($best_category) {
    $sql = 'SELECT p.product_id, pt.name, pt.description, c.titre as category, p.stock_quantity , p.price, pi.image_url 
            FROM product p
            INNER JOIN category c ON c.category_id = p.category_id
            LEFT JOIN product_image pi ON pi.product_id = p.product_id
            LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = "fr"
            WHERE c.titre = ?';
    $req = $con->prepare($sql);
    $req->execute([$best_category]);
} else {
    $sql = 'SELECT p.product_id, pt.name, pt.description, c.titre as category, p.stock_quantity , p.price, pi.image_url 
            FROM product p
            INNER JOIN category c ON c.category_id = p.category_id
            LEFT JOIN product_image pi ON pi.product_id = p.product_id 
            LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = "fr" ';
    $req = $con->prepare($sql);
    $req->execute();
}

$products = $req->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($products);
?>
