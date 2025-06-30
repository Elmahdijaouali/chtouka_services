<?php 
session_start();
require_once 'includes/con_db.php';

if (isset($_SESSION['admin']) && isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Fetch the category details
    $sql = "SELECT   category_titre_ar , category_titre_fr 
        FROM category  
        WHERE category_id = ? ";
;
    $req = $con->prepare($sql);
    $req->execute([$category_id]);
    $category = $req->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get French and Arabic titles from the form
        $titreFr = htmlspecialchars(trim($_POST['titre_fr']));
        $titreAr = htmlspecialchars(trim($_POST['titre_ar']));

        // Update the category
        $sql = 'UPDATE category SET category_titre_fr = ?, category_titre_ar = ?, updated_at = NOW() WHERE category_id = ?';
        $req = $con->prepare($sql);
        $req->execute([$titreFr, $titreAr, $category_id]);

        // Redirect back to the categories page
        header('Location: categories.php');
        exit();
    }

    include "layouts/header.php";
?>
    
<link rel="stylesheet" href="./css/style_form_add.css">
<div class="container_add" style="padding:3em;">
    <h2>Edit Category</h2>
    <form action="" method="post" enctype="multipart/form-data" class="form_add_product">
        
        <!-- French Fields -->
        <fieldset>
            <legend>French</legend>
            <label for="titre_fr">Titre category:</label>
            <input type="text" id="titre_fr" name="titre_fr" value="<?php echo htmlspecialchars($category['category_titre_fr']); ?>" required>
        </fieldset> 
        
        <!-- Arabic Fields -->
        <fieldset>
            <legend>Arabic</legend>
            <label for="titre_ar" class="text_right"> : العنوان فئة</label>
            <input type="text" id="titre_ar" name="titre_ar" value="<?php echo htmlspecialchars($category['category_titre_ar']); ?>" required class="text_right">
        </fieldset>

        <button type="submit">Update Category</button>
    </form>
</div>

<?php 
    include "layouts/footer.php";
} else {
    header('Location: login.php');
    exit();
}
?>
