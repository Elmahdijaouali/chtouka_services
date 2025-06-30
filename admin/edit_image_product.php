<?php 
session_start();
require_once 'includes/con_db.php';

if (isset($_SESSION['admin']) && isset($_GET['id_image']) && isset($_GET['id_product'])) {
    $image_id = $_GET['id_image'];
    $product_id = $_GET['id_product'];

    // Fetch the existing image details
    $sql = "SELECT * FROM product_image WHERE image_id = ?";
    $req = $con->prepare($sql);
    $req->execute([$image_id]);
    $image = $req->fetch(PDO::FETCH_ASSOC);

    if (!$image) {
        $_SESSION['error'] = "Image not found.";
        header('Location: ../edit_product.php?id=' . $product_id);
        exit();
    }

    // Handle form submission for image update
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Handle the new image upload
            $target_dir = "../images_uploaded/products/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if it's a PNG file
            if ($imageFileType == "png") {
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                // Update the database with the new image URL
                $sql = "UPDATE product_image SET image_url = ? WHERE image_id = ?";
                $req = $con->prepare($sql);
                $req->execute([basename($_FILES["image"]["name"]), $image_id]);

                $_SESSION['success'] = "Image updated successfully.";
                header('Location: edit_product.php?id=' . $product_id);
                exit();
            } else {
                $_SESSION['error'] = "Only PNG files are allowed.";
            }
        }
    }

    include_once 'layouts/header.php';
?>

<!-- edit style for style form -->
 <style>
 

 </style>

<div class="container_edit_image">
    <h1>Edit Image</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Current Image:</label>
        <img src="../images_uploaded/products/<?= htmlspecialchars($image['image_url']) ?>" width="100" height="100" alt="Current Image">
        <br>
        <label for="image">Upload New Image (PNG only):</label>
        <input type="file" id="image" name="image" accept="image/png" required>
        <br>
        <button type="submit">Update Image</button>
    </form>
    <a href="edit_product.php?id=<?= $product_id ?>">Cancel</a>
</div>



<?php 
    include_once 'layouts/footer.php';
} else {
    header('Location: login.php');
    exit();
}
?>
