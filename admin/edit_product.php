<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once 'includes/con_db.php';
    include 'pages/categories.php';

    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];

        // Fetch product details
        $sql = "SELECT p.product_id ,price , stock_quantity , category_titre_fr  ,p.category_id 
         FROM product p
        inner join product_translation pt on p.product_id = pt.product_id
         inner join category c on p.category_id = c.category_id
         WHERE p.product_id = ? ";
        $req = $con->prepare($sql);
        $req->execute([$product_id]);
        $product = $req->fetch(PDO::FETCH_ASSOC);

     // Fetch product details
     $sql = "SELECT * FROM product_translation WHERE product_id = ? AND language_code = ?";
     $req = $con->prepare($sql);
     $req->execute([$product_id, "ar"]);
     $product_translation_ar = $req->fetch(PDO::FETCH_ASSOC);
     
     $req->execute([$product_id, "fr"]);
     $product_translation_fr = $req->fetch(PDO::FETCH_ASSOC);

        // Fetch product images
        $sql = 'SELECT image_id, image_url FROM product_image WHERE product_id = ?';
        $req = $con->prepare($sql);
        $req->execute([$product_id]);
        $product_images = $req->fetchAll(PDO::FETCH_ASSOC);

        if (!$product) {
            $_SESSION['error'] = "Product not found.";
            header('Location: ../products.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "No product ID specified.";
        header('Location: ../products.php');
        exit();
    }

    include_once 'layouts/header.php'; 
?>

<link rel="stylesheet" href="css/style_form_add.css">
<style>
    .images_product {
        position: relative;
        width: 100px;
        height: 60px;
        margin: 0 5px;
    }
    .action_images {
        position: absolute;
        margin-left: 50px;
    }
    .action_images .edit {
        color: #7fad39;
    }
    .action_images .delete {
        color: red;
    }
</style>

<div class="container_add" style="margin-bottom: 6em;">
    <h1>Edit Product</h1>
    <form action="pages/update_product.php"  class="form_add_product" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

        <!-- Price and Quantity Fields -->
        <label for="price">Price:</label>
        <input type="number" id="price" name="price"  step="0.01" min="0" value="<?php echo htmlspecialchars($product['price']); ?>" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['stock_quantity']); ?>" required>

        <label for="category">Category:</label>
        <select id="category" name="category_id" required>
          <?php 
          if (!empty($categories)) {
              foreach ($categories as $category) {
                  // Ensure you're checking the category of the product being edited
                  $selected = ($category['category_id'] == $product['category_id']) ? 'selected' : '';
                  echo "<option value='" . htmlspecialchars($category['category_id']) . "' $selected>" . htmlspecialchars($category['category_titre_fr']) . "</option>";
              }
          }
          ?>
       </select>


        <div style="display: flex;">
            <?php foreach ($product_images as $image) { ?>
                <div class="images_product">
                    <div class="action_images">
                        <a class="delete" href="pages/delete_image_product.php?id_image=<?= $image['image_id'] ?>&id_product=<?= $product_id ?>">
                            <img width="20px" height="20px" src="img/svg/delete.png" alt="Delete">
                        </a>
                        <a class="edit" href="edit_image_product.php?id_image=<?= $image['image_id'] ?>&id_product=<?= $product_id ?>">
                            <img width="20px" height="20px" src="img/svg/pen.png" alt="Edit">
                        </a>
                    </div>
                    <img src="../images_uploaded/products/<?= htmlspecialchars($image['image_url']) ?>" width="100%" height="100%" alt="Old Image">
                </div>
            <?php } ?>
        </div>

        <label for="images">New Image :</label>
        <input type="file" id="images" name="images[]" accept="image/jpeg, image/png, image/gif, image/webp, image/svg+xml, image/bmp, image/tiff" multiple>

        <small>Leave this field empty if you do not want to change the image.</small><br><br>

        <!-- Language-specific Fields -->
        <h2>Product Details by Language</h2>

        <!-- French Fields -->
        <fieldset>
            <legend>French</legend>
            <label for="product_name_fr">Product Name:</label>
            <input type="text" id="product_name_fr" name="product_name_fr" value="<?php echo htmlspecialchars($product_translation_fr['name']); ?>" required>

            <label for="description_fr">Description:</label>
            <textarea id="description_fr" name="description_fr" rows="4" required><?php echo htmlspecialchars($product_translation_fr['description']); ?></textarea>
        </fieldset>

        <!-- Arabic Fields -->
        <fieldset>
            <legend>Arabic</legend>
            <label for="product_name_ar" class="text_right">: اسم المنتج </label>
            <input type="text" id="product_name_ar" name="product_name_ar" value="<?php echo htmlspecialchars($product_translation_ar['name']); ?>" required>

            <label for="description_ar" class="text_right"> : وصف</label>
            <textarea id="description_ar" class="text_right" name="description_ar" rows="4" required><?php echo htmlspecialchars($product_translation_ar['description']); ?></textarea>
        </fieldset>

        <button type="submit">Update Product</button>
    </form>
</div>

<?php 
include_once 'layouts/footer.php';
} else {
    header('Location: login.php');
    exit();
}
?>
