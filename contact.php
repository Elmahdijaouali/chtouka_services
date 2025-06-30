<?php 


include 'includes/header.php';
?>
<style></style>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <div class="breadcrumb__option">
            <h2 style="color: #7fad39"><?= $langStrings['contact'] ?></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_phone"></span>
          <h4><?= $langStrings['phone'] ?></h4>
          <p>+212 633680761</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_pin_alt"></span>
          <h4><?= $langStrings['address'] ?></h4>
          <p>Sidi Ali Ben Hamdouch, Azemmor</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_clock_alt"></span>
          <h4><?= $langStrings['open_time'] ?></h4>
          <p>8:00 am to 8:00 pm</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_mail_alt"></span>
          <h4><?= $langStrings['email'] ?></h4>
          <p>chtoukaservice01@gmail.com</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact Section End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="contact__form__title">
          <h2><?= $langStrings['leave_message'] ?></h2>
        </div>
      </div>
    </div>
    <form action="handle_pages/contact.php" method="POST">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <input
            type="text"
            placeholder="<?= $langStrings['your_name'] ?>"
            class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
            name="name"
            required
          />
        </div>
        <div class="col-lg-6 col-md-6">
          <input
            type="email"
            placeholder="<?= $langStrings['your_email'] ?>"
            class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
            name="email"
            required
          />
        </div>
        <div class="col-lg-12 text-center">
          <textarea
            placeholder="<?= $langStrings['your_message'] ?>"
            name="message"
            class="<?= $lang == 'ar' ? 'text-right' : '' ?>"
            required
          ></textarea>
          <button type="submit" class="site-btn">
            <?= $langStrings['send_message'] ?>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Contact Form End -->

<?php 
include 'includes/footer.php'; 
?>
