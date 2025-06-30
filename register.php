<?php 
session_start(); 
$availableLanguages = ['fr', 'ar' ];
$defaultLanguage = 'fr';

if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? $defaultLanguage;
$langStrings = require "languages/$lang.php"; 
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($langStrings['register']) ?></title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <link rel="stylesheet" href="admin/css/style.min.css" />
    <style>
      @media (min-width: 1000px) {
        .sign-up {
          width: 25%;
        }
      }
      .title_r {
        text-align: center;
        font-size: 2em;
        font-weight: bold;
        color: #7fad39;
        margin-bottom: 0.2em;
      }
      .form-btn-bg {
        background: #7fad39;
      }
      .form-btn-bg:hover {
        background: #6a992d; /* Slightly darker for hover */
      }
      .btn_back {
        all: unset;
        position: absolute;
        top: 3em;
        right: 3em;
        cursor: pointer;
      }
      .btn_back i {
        font-size: 2em;
      }
      .text-right {
        text-align: right;
        direction: rtl;
      }
    </style>
  </head>

  <body>
    <div class="layer"></div>
    <main class="page-center">
      <article class="sign-up">
        <h1 class="title_r">
          <?= htmlspecialchars($langStrings['register']) ?>
        </h1>
        <br />
        <form
          class="sign-up-form form"
          action="handle_pages/register.php"
          method="post"
        >
          <label
            class="form-label-wrapper <?= $lang == 'ar' ? 'text-right' : '' ?>"
          >
            <p class="form-label <?= $lang == 'ar' ? 'text-right' : '' ?>">
              <?= htmlspecialchars($langStrings['username']) ?>
            </p>
            <input
              class="form-input <?= $lang == 'ar' ? 'text-right' : '' ?>"
              type="text"
              placeholder="<?= htmlspecialchars($langStrings['enter_your_name']) ?>"
              name="username"
              required
            />
          </label>

          <label
            class="form-label-wrapper <?= $lang == 'ar' ? 'text-right' : '' ?>"
          >
            <p class="form-label <?= $lang == 'ar' ? 'text-right' : '' ?>">
              <?= htmlspecialchars($langStrings['email']) ?>
            </p>
            <input
              class="form-input <?= $lang == 'ar' ? 'text-right' : '' ?>"
              type="email"
              placeholder="<?= htmlspecialchars($langStrings['enter_email']) ?>"
              name="email"
              required
            />
          </label>
          <label
            class="form-label-wrapper <?= $lang == 'ar' ? 'text-right' : '' ?>"
          >
            <p class="form-label <?= $lang == 'ar' ? 'text-right' : '' ?>">
              <?= htmlspecialchars($langStrings['password']) ?>
            </p>
            <input
              class="form-input <?= $lang == 'ar' ? 'text-right' : '' ?>"
              type="password"
              placeholder="<?= htmlspecialchars($langStrings['enter_password']) ?>"
              name="password"
              required
            />
          </label>
          <label
            class="form-label-wrapper <?= $lang == 'ar' ? 'text-right' : '' ?>"
          >
            <p class="form-label <?= $lang == 'ar' ? 'text-right' : '' ?>">
              <?= htmlspecialchars($langStrings['password_confirmed']) ?>
            </p>
            <input
              class="form-input <?= $lang == 'ar' ? 'text-right' : '' ?>"
              type="password"
              placeholder="<?= htmlspecialchars($langStrings['enter_your_password_confirmed']) ?>"
              name="password_confirmed"
              required
            />
          </label>
          <br />
          <button
            class="form-btn form-btn-bg primary-default-btn transparent-btn"
            type="submit"
          >
            <?= htmlspecialchars($langStrings['register']) ?>
          </button>
        </form>
      </article>
    </main>

    <a class="btn_back" href="index.php"
      ><i class="fa-solid fa-arrow-left"></i
    ></a>

    <?php include 'handle_pages/notification.php' ?>

    <script src="js/notification.js"></script>
    <script src="admin/plugins/chart.min.js"></script>
    <script src="admin/plugins/feather.min.js"></script>
    <script src="admin/js/script.js"></script>
  </body>
</html>
