<?php 
require_once 'includes/con_db.php';
include 'handle_pages/pagination.php';
include 'handle_pages/categories.php';
include 'includes/header.php';

$notFound=false;
$results = [];
$name_product = ''; 

if (isset($_GET['name']) || isset($_GET['category_id'])) {
    $search_by = "";

    // Search by product name
    if (isset($_GET['name'])) {
        $name_product = htmlspecialchars($_GET['name']); // Sanitize input
        $search_by = $name_product;

        $sql = "SELECT p.product_id, 
                       pt.name AS name, 
                       pt.description AS description, 
                     
                       p.price, 
                       pi.image_url AS image_url
                FROM product p
                INNER JOIN category c ON c.category_id = p.category_id
                LEFT JOIN product_image pi ON pi.product_id = p.product_id
                INNER JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code  IN ('fr', 'ar') 
                WHERE pt.name LIKE :query OR pt.description LIKE :query
                GROUP BY p.product_id";

        $stmt = $con->prepare($sql); $stmt->execute([':query'=> "%$name_product%"]); $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
      } 
      //Search by category 
      if (isset($_GET['category_id'])) {

        $category_id =htmlspecialchars($_GET['category_id']);

         $sql = "SELECT p.product_id, pt.name AS
         name, pt.description AS description, category_titre_ar , category_titre_fr ,
         p.price, pi.image_url AS image_url FROM product p INNER JOIN category c ON
         c.category_id = p.category_id LEFT JOIN product_image pi ON pi.product_id =
         p.product_id LEFT JOIN product_translation pt ON pt.product_id = p.product_id
         AND pt.language_code = ? WHERE p.category_id = ? GROUP BY p.product_id"; 
         $stmt =$con->prepare($sql);
          $stmt->execute([ $lang, $category_id]);
         $results =$stmt->fetchAll(PDO::FETCH_ASSOC); 
         if (!empty($results)) { 
        
           
           if ( $lang == "ar" ){ 
            $search_by = $results[0]["category_titre_ar"]; }
           
           else{ 
            $search_by = $results[0]["category_titre_fr"];
           }
            }
            
            } ?>

<style>

</style>

<!-- category -->
<div class="category_products">
  <div class="hero__categories">
    <div class="hero__categories__all">
      <i class="fa fa-bars"></i>
      <span> <?= $langStrings['all_departments'] ?></span>
    </div>
    <ul>
      <?php foreach ($categories as $category): ?>
      <li>
        <a
          href="products.php?category_id=<?= $category['category_id'] ?>"
          class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
        >
          <?php 
                          if( $lang =="ar"){
                            echo htmlspecialchars($category['category_titre_ar']);
                          }else{
                            echo htmlspecialchars($category['category_titre_fr']);
                          }
                       
                          ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<!-- Featured Section Begin -->
<section class="featured spad p-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2 style="color: #7fad39">
            <span style="color: #bdd7e7"><?= $search_by ?></span>
          </h2>
        </div>
      </div>
    </div>
    <div class="row featured__filter">
      <?php 
            if (!empty($results)) {
                foreach ($results as $product) { ?>
      <a
        href="shop-details.php?id=<?= htmlspecialchars($product['product_id']) ?>"
      >
        <div class="col-lg-3 col-md-4 col-6">
          <div class="featured__item">
            <div class="featured__item__pic bg_product">
              <img
                src="images_uploaded/products/<?= htmlspecialchars($product['image_url']) ?>"
                width="100%"
                height="100%"
                alt="image product"
              />
            </div>
            <div class="featured__item__text">
              <h6>
                <a
                  href="shop-details.php?id=<?= htmlspecialchars($product['product_id']) ?>"
                  ><?= htmlspecialchars($product['name']) ?></a
                >
              </h6>
              <h5>
                <?= htmlspecialchars($product['price']) ?>
                DH
              </h5>
            </div>
          </div>
        </div>
      </a>
      <?php }
            } else { 
                $notFound=true;
                ?>

      <div class="not_result">
        <img src="img/not_result.png" alt="not result" />
      </div>

      <?php }
            ?>
    </div>
  </div>
</section>
<!-- Featured Section End -->

<?php
include 'includes/footer.php';

} else {
    header('location:index.php');
}
?>
