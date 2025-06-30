<?php
session_start();

if (isset($_SESSION['admin']) && $_SESSION['role'] === "superadmin") {
    require_once '../includes/con_db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the French and Arabic titles from the form
        $titreFr = $_POST['titre_fr'];
        $titreAr = $_POST['titre_ar'];

        // Insert new category
        $sql = 'INSERT INTO `category` (category_titre_fr, category_titre_ar) VALUES (?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$titreFr, $titreAr]);

        header('Location: ../categories.php');
        exit();
    } else {
        header('Location: ../form_add_category.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
