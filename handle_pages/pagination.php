<?php
require_once 'includes/con_db.php';

ob_start() ;

$availableLanguages = ['fr', 'ar'];
$defaultLanguage = 'fr';

if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? $defaultLanguage;
$langStrings = require "languages/$lang.php"; 


// Define how many results you want per page
$results_per_page = 32;

// Find out the number of results stored in the database
$sql = 'SELECT COUNT(product_id) AS total FROM product';
$result = $con->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$total_results = $row['total'];

$number_of_pages = ceil($total_results / $results_per_page);

if (!isset($_GET['page']) || $_GET['page'] <= 0) {
    $page = 1;
} else {
    $page = (int)$_GET['page'];
}

$starting_limit = ($page - 1) * $results_per_page;

// SQL query to include product images with pagination
$sql = 'SELECT p.product_id, 
               COALESCE(pt.name, "") AS name, 
               COALESCE(pt.description, "") AS description, 
               c.category_titre_fr AS category, 
               p.stock_quantity, 
               p.price, 
               pi.image_url 
        FROM product p
        LEFT JOIN category c ON c.category_id = p.category_id
        LEFT JOIN product_image pi ON pi.product_id = p.product_id
        LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = :lang
        GROUP BY p.product_id
        LIMIT :starting_limit, :results_per_page';

// Prepare the statement
$req = $con->prepare($sql);

// Bind the parameters
$req->bindValue(':starting_limit', $starting_limit, PDO::PARAM_INT);
$req->bindValue(':results_per_page', $results_per_page, PDO::PARAM_INT);
$req->bindValue(':lang', $lang, PDO::PARAM_STR); 

// Execute the statement
$req->execute();  
$products = $req->fetchAll(PDO::FETCH_ASSOC);
?>
