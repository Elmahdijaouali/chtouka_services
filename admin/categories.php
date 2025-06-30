<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once 'includes/con_db.php';

    include 'pages/categories.php'; 
    include_once 'layouts/header.php'; 
?>
    
<!-- ! Main -->
<main class="main admins chart-page" id="skip-target">
    <div class="container">
        <h2 class="main-title">Categories</h2>

        <!-- start table categories -->
        <div class="users-table table-wrapper">
            <table class="posts-table styled-table">
                <thead>
                    <tr class="users-table-info">
                        <th>Category ID</th>
                        <th>French Title</th>
                        <th>Arabic Title</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($category['category_id']); ?></td>
                                <td><?php echo htmlspecialchars($category['category_titre_fr']); ?></td>
                                <td><?php echo htmlspecialchars($category['category_titre_ar']); ?></td>
                                <td><?php echo htmlspecialchars($category['created_at']); ?></td>
                                <td><?php echo htmlspecialchars($category['updated_at']); ?></td>
                                <td>
                                    <a href="edit_category.php?id=<?php echo urlencode($category['category_id']); ?>" class="btn btn-info">Edit</a>
                                    <a href="pages/delete_category.php?id=<?php echo urlencode($category['category_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No categories found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- end table categories -->

    </div>
</main>

<?php 
    include_once 'layouts/footer.php'; 
} else {
    header('Location:login.php');
    exit();
}
?>
