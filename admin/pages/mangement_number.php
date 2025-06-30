<?php 

    // count users 
    $sql = "SELECT COUNT(*) AS total_users FROM `users`";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $total_users = $stmt->fetch(PDO::FETCH_ASSOC);


    //count user of last month 
    $sql = "SELECT COUNT(*) AS total_users_last_month
    FROM `users`
    WHERE `created_at` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $total_users_of_last_month = $stmt->fetch(PDO::FETCH_ASSOC);
    
      // Count total orders
      $sqlTotal = "SELECT COUNT(*) AS total_orders FROM `orders`";
      $stmtTotal = $con->prepare($sqlTotal);
      $stmtTotal->execute();
      $resultTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC);
      $totalOrders = $resultTotal['total_orders'];
  
      // Count orders from the last month
      $sqlLastMonth = "SELECT COUNT(*) AS total_orders_last_month
                        FROM `orders`
                        WHERE `order_date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
      $stmtLastMonth = $con->prepare($sqlLastMonth);
      $stmtLastMonth->execute();
      $resultLastMonth = $stmtLastMonth->fetch(PDO::FETCH_ASSOC);
      $totalOrdersLastMonth = $resultLastMonth['total_orders_last_month'];

      

    
    // Count total products
$sqlProducts = "SELECT COUNT(*) AS total_products FROM `product`";
$stmtProducts = $con->prepare($sqlProducts);
$stmtProducts->execute();
$resultProducts = $stmtProducts->fetch(PDO::FETCH_ASSOC);
$totalProducts = $resultProducts['total_products'];

// (Optional) Count products added in the last month
$sqlProductsLastMonth = "SELECT COUNT(*) AS total_products_last_month
                         FROM `product`
                         WHERE `created_at` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$stmtProductsLastMonth = $con->prepare($sqlProductsLastMonth);
$stmtProductsLastMonth->execute();
$resultProductsLastMonth = $stmtProductsLastMonth->fetch(PDO::FETCH_ASSOC);
$totalProductsLastMonth = $resultProductsLastMonth['total_products_last_month'];



// Count total subscriptions
$sqlSubscriptions = "SELECT COUNT(*) AS total_subscriptions FROM `subscribe`";
$stmtSubscriptions = $con->prepare($sqlSubscriptions);
$stmtSubscriptions->execute();
$resultSubscriptions = $stmtSubscriptions->fetch(PDO::FETCH_ASSOC);
$totalSubscriptions = $resultSubscriptions['total_subscriptions'];

// Count subscriptions from the last month
$sqlSubscriptionsLastMonth = "SELECT COUNT(*) AS total_subscriptions_last_month
                               FROM `subscribe`
                               WHERE `subscribed_at` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$stmtSubscriptionsLastMonth = $con->prepare($sqlSubscriptionsLastMonth);
$stmtSubscriptionsLastMonth->execute();
$resultSubscriptionsLastMonth = $stmtSubscriptionsLastMonth->fetch(PDO::FETCH_ASSOC);
$totalSubscriptionsLastMonth = $resultSubscriptionsLastMonth['total_subscriptions_last_month'];