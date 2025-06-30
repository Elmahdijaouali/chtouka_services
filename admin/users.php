<?php 
    session_start();

   if(isset($_SESSION['admin'])){

    require_once 'includes/con_db.php' ;
     
    $sql='SELECT `user_id`, `username`, `email`, `created_at`, `updated_at` FROM `users`' ;
    $req = $con->prepare($sql);
    $req->execute();

    
    $users = $req->fetchAll(PDO::FETCH_ASSOC) ;

    
    
     include_once 'layouts/header.php' ; ?>
        
     <!-- ! Main -->
     <main class="main users chart-page" id="skip-target">
       <div class="container">
        <h2 class="main-title">Users</h2>

<!-- start table users -->
    <div class="users-table table-wrapper">
        <table class="posts-table styled-table">
            <thead>
                <tr class="users-table-info">
                   
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php if(!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($user['updated_at']); ?></td>
                        <td>
                          
                           <a href="mailto:<?= htmlspecialchars($user['email']); ?>" class="btn btn-info">Contact</a>
                           <a href="pages/delete_user.php?id=<?php echo urlencode($user['user_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;
                endif ; ?>
              
            </tbody>
                 <?php if(empty($users)): ?>
                        <tr>
                            <td colspan="8">No users found</td>
                        </tr>
                    <?php endif; ?>
        </table>
    </div>

    
<!-- end table users -->



        
       </div>
     </main>
  




    <?php include_once 'layouts/footer.php' ;

   }else{
     header('Location:login.php');
     exit();
   }

   ?>