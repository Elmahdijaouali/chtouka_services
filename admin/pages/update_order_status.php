<?php
session_start();

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Prepare and execute the update statement
        $sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
        $stmt = $con->prepare($sql);
        $stmt->execute([':status' => $status, ':order_id' => $order_id]);

        // Redirect back to the orders page (or wherever you need)
        header('Location: ../dashboard.php'); // Update the path as needed
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
