<?php
session_start();
if (isset($_SESSION['admin'])) {
    include_once 'layouts/header.php'; 
?>
    
    <link rel="stylesheet" href="./css/style_form_add.css">

    <div class="container_add" style="padding:3em">
        <h2>Add New Category</h2>
        <form action="pages/add_category.php" method="post" enctype="multipart/form-data" class="form_add_product">
            
            <!-- French Fields -->
            <fieldset>
                <legend>French</legend>
                <label for="titre_fr">Titre category:</label>
                <input type="text" id="titre_fr" name="titre_fr" required>
            </fieldset> 
            
            <!-- Arabic Fields -->
            <fieldset>
                <legend>Arabic</legend>
                <label for="titre_ar" class="text_right"> : العنوان فئة</label>
                <input type="text" id="titre_ar" name="titre_ar" required class="text_right">
            </fieldset>

            <button type="submit">Add category</button>
        </form>
    </div>
   
<?php 
    include_once 'layouts/footer.php';
} else {
    header('Location:login.php');
    exit();
}
?> 
