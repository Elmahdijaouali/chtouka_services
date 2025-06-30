<?php 
require_once 'includes/con_db.php';

include 'includes/header.php';

// Set default language if not set
$lang = isset($lang) ? $lang : 'fr';
if ($lang != 'ar' && $lang != 'fr') {
    $lang = 'fr';
}

// SQL query to select products
$sql = 'SELECT p.product_id, 
               pt.name AS name, 
               pt.description  AS description, 
               c.category_titre_fr AS category, 
               p.stock_quantity, 
               p.price, 
               p.created_at, 
               p.updated_at, 
               pi.image_url 
        FROM product p
        INNER JOIN category c ON c.category_id = p.category_id
        LEFT JOIN product_image pi ON pi.product_id = p.product_id
        LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = ?
        GROUP BY p.product_id';

$req = $con->prepare($sql); $req->execute([$lang]);
 $products = $req->fetchAll(PDO::FETCH_ASSOC); 

 $sql = 'SELECT p.product_id, 
 (SELECT pi.image_url FROM product_image pi WHERE pi.product_id = p.product_id LIMIT 1) AS image_url, 
 COUNT(o.product_id) AS order_count 
FROM product p
LEFT JOIN orders o ON o.product_id = p.product_id 
GROUP BY p.product_id 
ORDER BY order_count DESC 
LIMIT 10';

$req = $con->prepare($sql); 
$req->execute();
$top_products = $req->fetchAll(PDO::FETCH_ASSOC);

// Include pagination and categories
 include 'handle_pages/pagination.php'; 
include 'handle_pages/categories.php'; ?>

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

<!-- Categories Section Begin -->
<section class="categories">
  <div class="container">
    <div class="row">
      <div class="categories__slider owl-carousel">
        <?php if (!empty($top_products)): ?>
        <?php foreach ($top_products as $product): ?>
        <div class="col-lg-3">
          <div class="categories__item bg_product top_product">
            <img
              src="images_uploaded/products/<?= htmlspecialchars($product['image_url']) ?>"
              alt="product image"
            />
            <h5>
              <a
                href="shop-details.php?id=<?= htmlspecialchars($product['product_id']) ?>"
                class="primary-btn"
                style="background: #7fad39; color: white; border-radius: 0.2em"
              >
                <i class="fa-solid fa-cart-shopping"></i>
                <?= $langStrings['shop_now'] ?>
              </a>
            </h5>
          </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mb-5">
        <div class="section-title">
          <h2><?= $langStrings['featured_products'] ?></h2>
        </div>
        <div class="featured__controls"></div>
      </div>
    </div>
    <div class="row featured__filter">
      <?php if (!empty($products)): ?>
      <?php foreach ($products as $product): ?>
      <a
        href="shop-details.php?id=<?= htmlspecialchars($product['product_id']) ?>"
      >
        <div
          class="col-lg-3 col-md-4 col-6 card_product mix <?= htmlspecialchars($product['category']) ?>"
        >
          <div class="featured__item">
            <div class="featured__item__pic bg_product">
              <img
                src="images_uploaded/products/<?= htmlspecialchars($product['image_url']) ?>"
                alt=""
              />
            </div>
            <div class="featured__item__text">
              <h6 style="font-size: 0.9em">
                <a
                  href="shop-details.php?id=<?= htmlspecialchars($product['product_id']) ?>"
                >
                  <?= htmlspecialchars($product['name']) ?>
                </a>
              </h6>
              <h5>
                <?= htmlspecialchars($product['price']) ?>
                DH
              </h5>
              <!-- <p style="font-size:.8em"><?= htmlspecialchars($product['description']) ?></p> -->
            </div>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-12">
  <div class="pagination d-flex justify-content-center mt-5">
    <a href="?page=<?= max(1, $page - 1) ?>" class="rounded">&laquo;</a>
    
    <?php if ($number_of_pages <= 6): ?>
      <?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?> rounded"><?= $i ?></a>
      <?php endfor; ?>
    <?php else: ?>
      
      
      
      <?php 
        // Determine the last pages to display
        if ($page > $number_of_pages - 2) {
          // Show the last two pages
          for ($i = $number_of_pages - 1; $i <= $number_of_pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?> rounded"><?= $i ?></a>
          <?php endfor;
        } else {
          // Show two pages after the current page if possible
          for ($i = $page; $i <= min($page + 1, $number_of_pages); $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?> rounded"><?= $i ?></a>
          <?php endfor;
          // Show the last page
          if ($number_of_pages > $page + 1) {
            echo '<a href="?page=' . $number_of_pages . '" class="rounded">' . $number_of_pages . '</a>';
          }
        }
      ?>
    <?php endif; ?>
    
    <a href="?page=<?= min($number_of_pages, $page + 1) ?>" class="rounded">&raquo;</a>
  </div>
</div>


</section>
<!-- Featured Section End -->

<?php 
include 'includes/footer.php';
?>
