<?php
session_start();
require_once '../includes/con_db.php';
$lang=  $_SESSION['lang']  ;
$lang = isset($lang) ? $lang : 'fr';
if ($lang != 'ar' && $lang != 'fr') {
    $lang = 'fr';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $qte_product = $_POST['quantity'];
    $name_client = $_POST['full_name'];
    $city_client = $_POST['city'];
    $tel_client = $_POST['tel'];

    // Store the values for repopulation
    $_SESSION['form_data'] = [
        'full_name' => $name_client,
        'tel' => $tel_client,
        'city' => $city_client,
    ];

    // Fetch stock quantity
    $sql = "SELECT stock_quantity FROM product WHERE product_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if product exists and quantity is sufficient
    if ($product && $product['stock_quantity'] > $qte_product) {
        echo print_r([$product_id, $name_client, $city_client, $tel_client, $qte_product]);

        // Insert new order
        $sql = "INSERT INTO `orders` (product_id, name_client, city_client, tel_client, qte_product) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->execute([$product_id, $name_client, $city_client, $tel_client, $qte_product]);

        // Process the order...
        if ($lang == 'fr') {
            $_SESSION['handle_notification_success'] = "Votre commande a été passée!";
        } else {
            $_SESSION['handle_notification_success'] = "تم تقديم طلبك";
          
        }
    
    } else {

        if ($lang == 'ar') {
            $_SESSION['handle_notification_error'] = "تحقق من كمية طلبك";
        } else {
            $_SESSION['handle_notification_error'] = "Vérifiez la quantité de votre commande!";
        }
    }

    header('Location: ../index.php');
    exit();
} else {

    if ($lang == 'ar') {
        $_SESSION['handle_notification_error'] = "تحقق من طلبك";
    } else {
        $_SESSION['handle_notification_error'] = "Vérifiez votre commande!";
    }

    header('Location: ../index.php');
    exit();
}
?>
