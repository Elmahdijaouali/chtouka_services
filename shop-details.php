<?php


include 'includes/header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    require 'includes/con_db.php';

    $product_id = $_GET['id'] ;

    // SQL query to select data from the products table
    $sql = 'SELECT p.product_id , pt.name, pt.description, category.category_titre_fr AS category, 
             stock_quantity , `price`, p.created_at, p.updated_at
            FROM `product` p
            INNER JOIN category ON category.category_id = p.category_id 
            LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = ?
            WHERE p.product_id = ?';
    
    $req = $con->prepare($sql); 
    $req->execute([$lang , $product_id]);
     $product = $req->fetch(PDO::FETCH_ASSOC);
      if (!$product) {
         header('Location: index.php');
          exit; 
      } 
// SQL query to select data from the more image product table 
 $sql ='SELECT `image_url` FROM `product_image` WHERE product_id = :product_id';
 $req =$con->prepare($sql);
 $req->bindParam(':product_id', $product_id,PDO::PARAM_INT);
 $req->execute();
 $product_images = $req->fetchAll(PDO::FETCH_ASSOC);
 $_SESSION['best_category'] =$product['category'];
 
 ?>

<style>
  .error-message {
    color: red;
    font-size: 0.9em;
  }
</style>

<!-- Product Details Section Begin -->
<section class="product-details spad pt-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6">
        <div class="product__details__pic">
          <div
            class="product__details__pic__item container_image_product"
            style="height: 56vh !important "
          >
            <img
              class="product__details__pic__item--large"
              width="100%"
              height="100%"
              src="images_uploaded/products/<?= htmlspecialchars($product_images[0]['image_url'] ?? 'default.jpg') ?>"
              alt="<?= $product['name'] ?>"
            />
          </div>
          <div class="product__details__pic__slider p-0 owl-carousel">
            <?php foreach ($product_images as $image): ?>
            <img
              data-imgbigurl="images_uploaded/products/<?= htmlspecialchars($image['image_url']) ?>"
              src="images_uploaded/products/<?= htmlspecialchars($image['image_url']) ?>"
              alt="image product <?= $product['name'] ?>"
              style="width: 100px; height: 100px; object-fit: cover"
            />
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="product__details__text">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <div class="product__details__price">
            <input
              type="hidden"
              id="price_value"
              value="<?= htmlspecialchars($product['price']) ?>"
            />
            <span id="price_product"
              ><?= htmlspecialchars($product['price']) ?></span
            >
            DH
          </div>
          <p><?= htmlspecialchars($product['description']) ?></p>
          <div class="product__details__quantity">
            <div class="quantity">
              <div class="pro-qty">
                <input type="number" id="qte" value="1" min="1" />
              </div>
            </div>
          </div>

          <div class="container_add" style="margin-top: 2.5em">
            <h3><?= $langStrings['order_now'] ?></h3>
            <form
              action="handle_pages/add_commande.php"
              method="post"
              class="form_commande"
            >
              <input
                type="hidden"
                id="product_id"
                name="product_id"
                value="<?= htmlspecialchars($product['product_id']) ?>"
                required
              />
              <input
                type="hidden"
                class="qte_product"
                name="quantity"
                value="1"
                required
              />

              <label
                for="full_name"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                ><?= $langStrings['full_name'] ?>:</label
              >
              <input
                type="text"
                id="full_name"
                name="full_name"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                value="<?= isset($_SESSION['form_data']['full_name']) ? htmlspecialchars($_SESSION['form_data']['full_name']) : '' ?>"
                placeholder="<?= $langStrings['enter_full_name'] ?>"
                required
              />
              <span
                class="error-message"
                id="full_name_error"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
              ></span>

              <label for="tel" class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                ><?= $langStrings['tel'] ?>:</label
              >
              <input
                type="text"
                id="tel"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                name="tel"
                value="<?= isset($_SESSION['form_data']['tel']) ? htmlspecialchars($_SESSION['form_data']['tel']) : '' ?>"
                placeholder="<?= $langStrings['enter_tel'] ?>"
                required
              />
              <span
                class="error-message"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                id="tel_error"
              ></span>

              <label for="city" class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                ><?= $langStrings['city'] ?>:</label
              >
              <input
                type="text"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                id="city"
                name="city"
                value="<?= isset($_SESSION['form_data']['city']) ? htmlspecialchars($_SESSION['form_data']['city']) : '' ?>"
                placeholder="<?= $langStrings['enter_your_city'] ?>"
                required
              />
              <span
                class="error-message"
                class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
                id="city_error"
              ></span>

              <button type="submit"><?= $langStrings['buy'] ?></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Details Section End -->

<!-- Validation Frontend -->
<script>
  document
    .querySelector(".form_commande")
    .addEventListener("submit", function (event) {
      const fullName = document.getElementById("full_name").value;
      const tel = document.getElementById("tel").value;
      const city = document.getElementById("city").value;
      let isValid = true;

      // Clear previous error messages
      document.getElementById("full_name_error").textContent = "";
      document.getElementById("tel_error").textContent = "";
      document.getElementById("city_error").textContent = "";

      if (!fullName || fullName.length < 3) {
        document.getElementById("full_name_error").textContent =
          "Please enter a valid full name (at least 3 characters).";
        isValid = false;
      }

      if (!/^(06|07)\d{8}$/.test(tel)) {
        document.getElementById("tel_error").textContent =
          "Please enter a valid 10-digit phone number.";
        isValid = false;
      }

      if (!city || city.length < 2) {
        document.getElementById("city_error").textContent =
          "Please enter a valid city name (at least 2 characters).";
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault();
      }
    });
</script>

<?php 
    include 'includes/footer.php';
} else {
    header('Location: index.php');
    exit;
}
?>
