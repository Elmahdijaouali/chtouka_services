<?php 
session_start();
require_once '../includes/con_db.php';

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
                header('Location: ../edit_product.php?id=' . $product_id);
                exit();
            } else {
                $_SESSION['error'] = "Only PNG files are allowed.";
            }
        }
    }

    include_once '../layouts/header.php';
?>
<!-- style css call in this because style not work  -->
<link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
<link rel="stylesheet" href="../css/style.min.css">
<link rel="stylesheet" href="../css/style_btn.css">
<link rel="stylesheet" href="../css/style_table.css">
<!-- edit style for style form -->
 <style>
  .container_edit_image {
    max-width: 500px;
    margin: 2em auto;
    padding: 2em;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}

.container_edit_image h1 {
    text-align: center;
    color: #333;
    margin-bottom: 1.5em;
}

.container_edit_image label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5em;
    color: #555;
}

.container_edit_image img {
    display: block;
    margin: 0 auto 1em;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.container_edit_image input[type="file"] {
    display: block;
    width: 100%;
    padding: 0.5em;
    margin-bottom: 1.5em;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

.container_edit_image input[type="file"]:focus {
    border-color: #7fad39;
    outline: none;
}

.container_edit_image button {
    display: block;
    width: 100%;
    padding: 0.75em;
    background-color: #7fad39;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

.container_edit_image button:hover {
    background-color: #6fa831;
}

.container_edit_image a {
    display: block;
    text-align: center;
    margin-top: 1em;
    color: #007bff;
    text-decoration: none;
}

.container_edit_image a:hover {
    text-decoration: underline;
}


 </style>

<div class="container_edit_image">
    <h1>Edit Image</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Current Image:</label>
        <img src="../../images_uploaded/products/<?= htmlspecialchars($image['image_url']) ?>" width="100" height="100" alt="Current Image">
        <br>
        <label for="image">Upload New Image (PNG only):</label>
        <input type="file" id="image" name="image" accept="image/png" required>
        <br>
        <button type="submit">Update Image</button>
    </form>
    <a href="../edit_product.php?id=<?= $product_id ?>">Cancel</a>
</div>

<!-- call the secrips javaScript  -->
 <!-- Chart library -->
<script src="../plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="../plugins/feather.min.js"></script>
<!-- Custom scripts -->
<script src="../js/dashbord_script.js"></script>

<?php 
    include_once '../layouts/footer.php';
} else {
    header('Location: login.php');
    exit();
}
?>
