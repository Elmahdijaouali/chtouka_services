<?php
session_start();
if (isset($_SESSION['admin'])) {
    include 'pages/categories.php';
    include_once 'layouts/header.php'; 
?>

<link rel="stylesheet" href="./css/style_form_add.css">

<div class="container_add " style="margin: 3em auto 12em auto">
    <h1>Add New Product</h1>
    <form action="pages/add_product.php" class="form_add_product" method="post" enctype="multipart/form-data">
        
        <!-- Price and Quantity Fields -->
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="1" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>

        <label for="category">Category:</label>
        <select id="category" name="category_id" required>
            <?php 
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    echo "<option value='" . $category['category_id'] . "'>" . $category['category_titre_fr'] . "</option>";
                }
            }
            ?>
        </select>

        <!-- Image Upload -->
        <label for="images">Images (PNG only):</label>
        <input type="file" id="images" name="images[]" accept="image/png" multiple required>

        <!-- Language-specific Fields -->
        <h2>Product Details by Language</h2>

        <!-- French Fields -->
        <fieldset>
            <legend>French</legend>
            <label for="product_name_fr">Product Name:</label>
            <input type="text" id="product_name_fr" name="product_name_fr" required>

            <label for="description_fr">Description:</label>
            <textarea id="description_fr" name="description_fr" rows="4" required></textarea>
        </fieldset>

        <!-- Arabic Fields -->
        <fieldset>
            <legend>Arabic</legend>
            <label for="product_name_ar"  class="text_right" >: اسم المنتج </label>
            <input type="text" id="product_name_ar"  name="product_name_ar" required>

            <label for="description_ar" class="text_right"> : وصف</label>
            <textarea id="description_ar" class="text_right" name="description_ar" rows="4" required></textarea>
        </fieldset>

        <button type="submit">Add Product</button>
    </form>
</div>

<script src="js/validation_form_add_product.js"></script>

<?php 
    include_once 'layouts/footer.php';
} else {
    header('Location:login.php');
    exit();
}
?>
