<?php 
session_start();

if (isset($_SESSION['admin'])) {
    
    include_once 'layouts/header.php'; 
?>

<!-- ! Main -->
<main class="main users chart-page" id="skip-target">
    <div class="container">
        <h2 class="main-title">Orders</h2>
       
        <div  class="users-table table-wrapper  orders-container">
            <!-- Orders will be dynamically loaded here -->
        </div>
    </div>
</main>

<script>
  
</script>

<?php 
    include_once 'layouts/footer.php';
} else {
    header('Location:login.php');
    exit();
}
?>
