<?php 
session_start();

if(isset($_SESSION['admin'])){
    require_once 'includes/con_db.php';

    // Modify SQL query to select admin details
    $sql = 'SELECT `admin_id`, `username`, `email` ,role, `created_at`, `updated_at`, `img`, `tel_admin` FROM `admins`';
    $req = $con->prepare($sql);
    $req->execute();

    $admins = $req->fetchAll(PDO::FETCH_ASSOC);

    include_once 'layouts/header.php'; 
?>
    
<!-- ! Main -->
<main class="main admins chart-page" id="skip-target">
    <div class="container">
        <h2 class="main-title">Admins</h2>

        <!-- start table admins -->
        <div class="users-table table-wrapper">
            <table class="posts-table styled-table">
                <thead>
                    <tr class="users-table-info">
                        <th>Admin ID</th>
                        <th>Username</th>
                        <th>Email</th>   
                        <th>Role</th>   
                        <th>Image</th>
                        <th>Telephone</th>
                        <th>Created At</th>
                        <th>Updated At</th>

                        <?php if($_SESSION['role'] === "superadmin"){ ?>      
                           <th>Action</th>
                        <?php  }   ?>
                      
                    </tr>
                </thead>
                <tbody>
                  <?php if(!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($admin['admin_id']); ?></td>
                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td><?php echo htmlspecialchars($admin['email']); ?></td>
                            <td><?php echo htmlspecialchars($admin['role']); ?></td>
                         
                            <td>
                            <?php 
                                    $imgPath = "../images_uploaded/admins/" . htmlspecialchars($admin['img']);
                                    ?>
                                    <img src="<?php echo $imgPath; ?>" alt="Service Image" style="width:40px;height:40px;border-radius:50%;" onerror="this.onerror=null; this.src='../images/default-placeholder.png';">
                            </td>
                            <td> <?php if(empty($admin['tel_admin'])){
                               echo   "Not have number";
                            }else{
                              echo   "+212".htmlspecialchars($admin['tel_admin']);
                            } ?></td>
                            <td><?php echo htmlspecialchars($admin['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($admin['updated_at']); ?></td>

                            <?php
                              if($_SESSION['role'] === "superadmin"){ ?>

                                <td>
                                   <a href="pages/delete_admin_by_supperAdmin.php?id=<?php echo urlencode($admin['admin_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                                </td>

                             <?php  }   ?>
                            
                          
                          

                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No admins found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- end table admins -->

    </div>
</main>

<?php 
    include_once 'layouts/footer.php'; 
} else {
    header('Location:login.php');
    exit();
}
?>
