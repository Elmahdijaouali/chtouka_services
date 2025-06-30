<?php
session_start();

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // Validate order_id
        if (empty($order_id)) {
            $_SESSION['error'] = "Invalid order ID.";
            header('Location: ../orders.php');
            exit();
        }

        $sql = "DELETE FROM orders WHERE order_id = ?";
        $req = $con->prepare($sql);

        if ($req->execute([$order_id])) {
            $_SESSION['success'] = "Order deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting order: " . implode(", ", $req->errorInfo());
        }

        header('Location: ../orders.php');
        exit();
    } else {
        $_SESSION['error'] = "No order ID specified.";
        header('Location: ../orders.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
