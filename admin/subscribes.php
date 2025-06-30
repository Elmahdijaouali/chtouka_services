<?php 
    session_start();

   if(isset($_SESSION['admin'])){

    include '../includes/con_db.php' ;
     
    $sql='SELECT `subscribe_id`,  `email`, `subscribed_at`, `updated_at` FROM `subscribe`' ;
    $req = $con->prepare($sql);
    $req->execute();

    
    $subscribes = $req->fetchAll(PDO::FETCH_ASSOC) ;

    
    
     include_once 'layouts/header.php' ; ?>
        
     <!-- ! Main -->
     <main class="main users chart-page" id="skip-target">
       <div class="container">
        <h2 class="main-title">Subscribes</h2>

<!-- start table users -->
    <div class="users-table table-wrapper">
        <table class="posts-table styled-table">
            <thead>
                <tr class="users-table-info">
                   
                    <th> ID</th>
                    <th>Email</th>
                    <th>subscribed At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php if(!empty($subscribes)): ?>
                <?php foreach ($subscribes as $subscribe): ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($subscribe['subscribe_id']); ?></td>
                        <td><?php echo htmlspecialchars($subscribe['email']); ?></td>
                        <td><?php echo htmlspecialchars($subscribe['subscribed_at']); ?></td>
                        <td><?php echo htmlspecialchars($subscribe['updated_at']); ?></td>
                        <td>
                       
                           <a href="mailto:<?= htmlspecialchars($subscribe['email']); ?>"   class="btn btn-info">Contact</a>
                           <a href="pages/delete_subscribe.php?id=<?php echo urlencode($subscribe['subscribe_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;
                endif ; ?>
              
            </tbody>
                 <?php if(empty($subscribes)): ?>
                        <tr>
                            <td colspan="8">No subscribes found</td>
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