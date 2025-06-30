<?php 
session_start();

if (isset($_SESSION['admin'])) {
    require_once 'includes/con_db.php'; 

    $admin_id = $_SESSION['admin_id']; 

    $query = "SELECT admin_id, `username`, `email`, `img`, `tel_admin` FROM `admins` WHERE `admin_id` = ?";
    $stmt = $con->prepare($query);
    $stmt->execute([$admin_id]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    include_once 'layouts/header.php'; 
?>

<style>
    input{
    background: white;
    color: #333 !important;
}
input::placeholder{
    color: grey;
}

</style>

<main class="container container-settings mt-0">
   
        
    <div class="profile-wrapper mb" >
        <hr class="separator">
        <div class="profile-layout">
            <div class="picture-section" >
                <div class="card profile-picture-card" style="background:#F0F2FA;">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <?php 
                        $imgPath = "../images_uploaded/admins/" . htmlspecialchars($admin['img']);
                        ?>
                        <img src="<?php echo $imgPath; ?>" alt="Profile Image" style="width:150px;height:150px;border-radius:50%;" onerror="this.onerror=null; this.src='../images/default-placeholder.png';">
                        <div class="small text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <form method="POST" action="pages/update_profile_admin.php" enctype="multipart/form-data">
                            <label class="btn btn-info" for="img_admin">Upload new image</label>
                            <input type="file" name="img" id="img_admin" style="display: none;">
                            <button class="btn btn-info" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="details-section mb">
                <div class="card account-details-card" style="background:#F0F2FA;">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form method="POST" action="pages/update_profile_admin.php">
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Enter your username" value="<?php echo htmlspecialchars($admin['username']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" name="tel_admin" type="tel" placeholder="+212 123456789" value="<?php echo htmlspecialchars($admin['tel_admin']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Enter your email address" value="<?php echo htmlspecialchars($admin['email']); ?>">
                            </div>
                            <button class="btn btn-info" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="password-section mb" style="width:100%;" >
                
                <div class="card password-card" style="background:#F0F2FA;">
                    <!-- affiche the errors -->
                <div class="div_errors" style="padding:.4em;">
                    <ul>
               
                    <?php 
                    if( isset($_SESSION['errors'])){
     
                        $errors = $_SESSION['errors'] ;
                        foreach($errors as $error ){
                           echo "<li style='color:red;text-align:center;'>  $error  </li>" ; 
                        }
                        unset( $_SESSION['errors']);

                    }
                    if( isset($_SESSION['success'])){
                        $msg=$_SESSION['success'] ;
                        echo "<p style='color:green;text-align:center;padding:.4em;'> $msg </p>" ;
                        
                        unset($_SESSION['success']) ;
                    }
                    ?>
                             
                   </ul>
                </div>

                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form method="POST" action="pages/update_password.php">
                            <div class="form-group">
                                <label for="inputCurrentPassword">Current Password</label>
                                <input class="form-control" id="inputCurrentPassword" name="current_password" type="password" placeholder="Enter your current password" required>
                            </div>
                            <div class="form-group">
                                <label for="inputNewPassword">New Password</label>
                                <input class="form-control" id="inputNewPassword" name="new_password" type="password" placeholder="Enter new password" required>
                            </div>
                            <div class="form-group">
                                <label for="inputConfirmPassword">Confirm New Password</label>
                                <input class="form-control" id="inputConfirmPassword" name="confirm_password" type="password" placeholder="Confirm new password" required>
                            </div>
                            <button class="btn btn-info" type="submit">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <a href="pages/del_admin.php?id=<?php echo htmlspecialchars($admin['admin_id']); ?>" class="delete-btn">Delete account</a>
            </div>
        </div>
    </div>
</main>

<?php include_once 'layouts/footer.php'; ?>

<?php 
} else {
    header('Location: login.php');
    exit();
}
?>

<style>

    .delete-btn {
        background-color: red;
        color: white;
        border: none;
        padding: 0.75em 1.5em;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
        margin-top: 1em;
        margin-left: .5em;
    }
    .card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s;
    margin-bottom: 2em;

}
</style>
