<?php
session_start();

if (isset($_SESSION['admin'])) {
 require_once '../includes/con_db.php';

    if (isset($_GET['id'])) {
        $subscribe_id = $_GET['id'];

        // Prepare and execute the deletion statement
        $sql = 'DELETE FROM `subscribe` WHERE `subscribe_id` = :subscribe_id';
        $req = $con->prepare($sql);
        $req->bindParam(':subscribe_id', $subscribe_id, PDO::PARAM_INT);

        if ($req->execute()) {
            // Redirect with a success message
            header('Location: ../subscribes.php?message=Subscription deleted successfully');
            exit();
        } else {
            // Redirect with an error message
            header('Location: ../subscribes.php?error=Failed to delete subscription');
            exit();
        }
    } else {
        // Redirect with an error message if no ID is set
        header('Location: ../subscribes.php?error=No subscription ID provided');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
