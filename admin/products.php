<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once 'includes/con_db.php';

    // Adjust the query to match your new category structure
    $sql = 'SELECT p.product_id, pt.name, pt.description, c.category_titre_fr AS category, p.stock_quantity, p.price, p.created_at, p.updated_at, pi.image_url
            FROM product p
            INNER JOIN category c ON c.category_id = p.category_id
            LEFT JOIN product_image pi ON pi.product_id = p.product_id
            LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = "fr"
            GROUP BY p.product_id';
    
    $req = $con->prepare($sql);
    $req->execute();
    $products = $req->fetchAll(PDO::FETCH_ASSOC);

    include_once 'layouts/header.php'; 
?>
  
<style>
    /* Add any custom styles here */
    .products_btn a {
        margin-right: 5px;
    }
</style>

<main class="main services chart-page" id="skip-target">
    <div class="container">
        <h2 class="main-title">Products</h2>

        <div class="users-table table-wrapper u">
            <table class="posts-table styled-table">
                <thead>
                    <tr class="users-table-info">
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Quantity of Stock</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th style="width:15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product):
                            $words = explode(' ', $product['description']);
                            $first_10_words = array_slice($words, 0, 10);
                            $description = implode(' ', $first_10_words);
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                                <td>
                                    <?php 
                                    $imgPath = "../images_uploaded/products/" . htmlspecialchars($product['image_url']);
                                    ?>
                                    <img src="<?php echo $imgPath; ?>" alt="Product Image" style="all:unset;width:70px;height:50px;" onerror="this.onerror=null; this.src='../images/default-placeholder.png';">
                                </td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($description); ?>...</td>
                                <td><?php echo htmlspecialchars($product['category']); ?></td>
                                <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                                <td><?php echo htmlspecialchars($product['price']); ?> DH</td>
                                <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                                <td><?php echo htmlspecialchars($product['updated_at']); ?></td>
                                <td class="products_btn">
                                    <a href="edit_product.php?id=<?php echo urlencode($product['product_id']); ?>" class="btn btn-info">Edit</a>
                                    <a href="pages/delete_product.php?product_id=<?php echo urlencode($product['product_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">No products found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php 
    include_once 'layouts/footer.php';
} else {
    header('Location: login.php');
    exit();
}
?>
