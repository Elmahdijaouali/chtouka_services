<?php 
    session_start();

   if(isset($_SESSION['admin'])){

    require_once 'includes/con_db.php' ;
     
    // users
    $sql='SELECT `user_id`, `username`, `email`, `created_at`, `updated_at` FROM `users`' ;
    $req = $con->prepare($sql);
    $req->execute();
    $users = $req->fetchAll(PDO::FETCH_ASSOC) ;

  

     require 'pages/mangement_number.php';

    
     include_once 'layouts/header.php' ; ?>
        
     <!-- ! Main -->
     <main class="main users chart-page" id="skip-target">
       <div class="container">
         <h2 class="main-title">Dashboard</h2>
         <div class="row stat-cards">
           <div class="col-md-6 col-xl-3">
             <article class="stat-cards-item">
               <div class="stat-cards-icon primary">
                 <i data-feather="bar-chart-2" aria-hidden="true"></i>
               </div>
               <div class="stat-cards-info">
                 <p class="stat-cards-info__num"><?= $total_users["total_users"] ?></p>
                 <p class="stat-cards-info__title">Total users</p>
                 <p class="stat-cards-info__progress">
                   <span class="stat-cards-info__profit success">
                      <?= $total_users_of_last_month['total_users_last_month'] ?>
                   </span>
                   Last month
                 </p>
               </div>
             </article>
           </div>

           <div class="col-md-6 col-xl-3">
             <article class="stat-cards-item">
               <div class="stat-cards-icon warning">
                 <i data-feather="file" aria-hidden="true"></i>
               </div>
               <div class="stat-cards-info">
                 <p class="stat-cards-info__num"><?= $totalOrders ?></p>
                 <p class="stat-cards-info__title">Total orders</p>
                 <p class="stat-cards-info__progress">
                   <span class="stat-cards-info__profit success">
                     <?=  $totalOrdersLastMonth ?>
                   </span>
                   Last month
                 </p>
               </div>
             </article>
           </div>
           <div class="col-md-6 col-xl-3">
             <article class="stat-cards-item">
               <div class="stat-cards-icon purple">
                 <i data-feather="file" aria-hidden="true"></i>
               </div>
               <div class="stat-cards-info">
                 <p class="stat-cards-info__num"><?=  $totalProducts ?></p>
                 <p class="stat-cards-info__title">Total products</p>
                 <p class="stat-cards-info__progress">
                   <span class="stat-cards-info__profit success">
                   <?= $totalProductsLastMonth?>
                   </span>
                   Last month
                 </p>
               </div>
             </article>
           </div>
           <div class="col-md-6 col-xl-3">
             <article class="stat-cards-item">
               <div class="stat-cards-icon success">
                 <i data-feather="feather" aria-hidden="true"></i>
               </div>
               <div class="stat-cards-info">
                 <p class="stat-cards-info__num"><?= $totalSubscriptions ?></p>
                 <p class="stat-cards-info__title">Total Subscribes</p>
                 <p class="stat-cards-info__progress">
                   <span class="stat-cards-info__profit success">
                     <?= $totalSubscriptionsLastMonth ?>
                   </span>
                   Last month
                 </p>
               </div>
             </article>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12">
            

 
              <!-- start table orders -->
              <div class="users-table table-wrapper">
                     <div class="container">
                        <h2 class="main-title">Orders</h2>
                       
                        <div  class="users-table table-wrapper  orders-container_new ">
                            <!-- Orders will be dynamically loaded here -->
                        </div>
                     </div>    
              </div>
              <!-- end table orders  -->
              
 


           </div>
           
         </div>
       </div>
     </main>
  




    <?php include_once 'layouts/footer.php' ;

   }else{
     header('Location:login.php');
     exit();
   }

   ?>