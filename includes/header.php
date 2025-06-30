<?php 
session_start();
ob_start() ;

$availableLanguages = ['fr', 'ar' ];
$defaultLanguage = 'fr';

if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? $defaultLanguage;
$langStrings = require "languages/$lang.php"; 


include 'handle_pages/categories.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="Ogani Template" />
    <meta name="keywords" content="Ogani, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CHTOUKA SERVICES</title>

    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap"
      rel="stylesheet"
    />

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/edit.css" />
    <link rel="stylesheet" href="css/form_add_commande.css" />
    <link rel="stylesheet" href="css/products.css" />
    <link rel="stylesheet" href="css/index.css" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/header.css" />
    <style>
      .link_ar a {
        letter-spacing: 0px !important;
      }
    </style>
  </head>

  <body>
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
        <a href="#">
          <h4 class="logo">CHTOUKA SERVICES</h4>
        </a>
      </div>

      <div class="humberger__menu__widget">
        <div class="header__top__right__language">
          <img
            width="60px"
            height="30px"
            src="img/<?= $lang ?>.jpeg"
            alt="image lang"
          />
          <div><?php echo $lang === 'ar' ? 'عربي' : 'Français'; ?></div>
          <span class="arrow_carrot-down"></span>
          <ul>
            <li><a href="?lang=fr">Français</a></li>
            <li><a href="?lang=ar">عربي</a></li>
          </ul>
        </div>

        <div class="header__top__right__auth">
          <!-- <img src="img/logo_cs.png" alt="logo chtouka services"> -->

          <!-- <?php 
                if (isset($_SESSION['user_email'])) { ?>
                    <a href="handle_pages/logout.php" class="btn_logout"><i class="fa-solid fa-right-from-bracket"></i> <?php echo $langStrings['logout']; ?></a>
                <?php } else { ?>
                    <a href="register.php"><i class="fa fa-user"></i> <?php echo $langStrings['register']; ?></a>
                    <a href="login.php"><i class="fa fa-user"></i> <?php echo $langStrings['login']; ?></a>
                <?php } ?> -->
        </div>
      </div>
      <nav class="humberger__menu__nav mobile-menu">
        <ul>
          <li class="active">
            <a href="index.php"><?php echo $langStrings['home']; ?></a>
          </li>
          <li>
            <a href="about.php"><?php echo $langStrings['about']; ?></a>
          </li>
          <li>
            <a href="contact.php"><?php echo $langStrings['contact']; ?></a>
          </li>
        </ul>
      </nav>
      <!-- category -->
      <div class="category_products_mobile">
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
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
        <a
          href="https://www.facebook.com/ChtoukaServices"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a
          href="https://www.linkedin.com/ChtoukaServices"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fa-brands fa-linkedin"></i>
        </a>
        <a
          href="https://www.instagram.com/ChtoukaServices"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a
          href="https://twitter.com/ChtoukaServices"
          target="_blank"
          rel="noopener noreferrer"
        >
          <i class="fa-brands fa-twitter"></i>
        </a>
      </div>
      <div class="humberger__menu__contact">
        <ul>
          <li><i class="fa fa-envelope"></i> chtoukaservice01@gmail.com</li>
          <li><?php echo $langStrings['shipping_info']; ?></li>
        </ul>
      </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="header__top__left">
                <ul>
                  <li>
                    <i class="fa fa-envelope"></i> chtoukaservice01@gmail.com
                  </li>
                  <li style="<?= $lang == 'fr' ? 'font-size:.8em;' : '' ?>">
                    <?php echo $langStrings['shipping_info']; ?>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="header__top__right">
                <div class="header__top__right__social">
                  <a
                    href="https://www.facebook.com/ChtoukaServices"
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <i class="fa-brands fa-facebook"></i>
                  </a>
                  <a
                    href="https://www.linkedin.com/ChtoukaServices"
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <i class="fa-brands fa-linkedin"></i>
                  </a>
                  <a
                    href="https://www.instagram.com/ChtoukaServices"
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <i class="fa-brands fa-instagram"></i>
                  </a>
                  <a
                    href="https://twitter.com/ChtoukaServices"
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <i class="fa-brands fa-twitter"></i>
                  </a>
                </div>
                <div class="header__top__right__language">
                  <img
                    width="60px"
                    height="30px"
                    src="img/<?= $lang ?>.jpeg"
                    alt="image lang"
                  />
                  <div><?php echo $lang === 'ar' ? 'عربي' : 'Français'; ?></div>
                  <span class="arrow_carrot-down"></span>
                  <ul>
                    <li><a href="?lang=fr">Français</a></li>
                    <li><a href="?lang=ar">عربي</a></li>
                  </ul>
                </div>
                <!-- <div class="header__top__right__auth" style="padding:0em;">
                                <?php 
                                if (isset($_SESSION['user_email'])) { ?>
                                    <a href="handle_pages/logout.php" class="btn_logout"><i class="fa-solid fa-right-from-bracket"></i> <?php echo $langStrings['logout']; ?></a>
                                <?php } else { ?>
                                    <a href="register.php"><i class="fa fa-user"></i> <?php echo $langStrings['register']; ?></a>
                                    <a href="login.php"><i class="fa fa-user"></i> <?php echo $langStrings['login']; ?></a>
                                <?php } ?>

                            </div> -->
                <div>
                  <img
                    src="img/logo_cs.png"
                    width="80px"
                    height="30px"
                    alt="logo chtouka services"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row header_mobile px-5">
          <div class="col-lg-3">
            <div class="header__logo">
              <a href="index.php">
                <h4 class="logo">CHTOUKA SERVICES</h4>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <nav class="header__menu">
              <ul class="nav-links">
                <?php if ($lang === 'ar'): ?>
                <li class="link_ar">
                  <a href="contact.php"
                    ><?php echo $langStrings['contact']; ?></a
                  >
                </li>
                <li class="link_ar">
                  <a href="about.php"><?php echo $langStrings['about']; ?></a>
                </li>
                <li class="link_ar active">
                  <a href="index.php"><?php echo $langStrings['home']; ?></a>
                </li>
                <?php elseif ($lang === 'fr'): ?>
                <li class="active">
                  <a href="index.php"><?php echo $langStrings['home']; ?></a>
                </li>
                <li>
                  <a href="about.php"><?php echo $langStrings['about']; ?></a>
                </li>
                <li>
                  <a href="contact.php"
                    ><?php echo $langStrings['contact']; ?></a
                  >
                </li>
                <?php else: ?>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>
          <div class="col-lg-6 section_right_header">
            <div class="hero__search">
              <div class="hero__search__form">
                <form action="products.php">
                  <input
                    type="text"
                    name="name"
                    placeholder="<?php echo $langStrings['search_placeholder']; ?>"
                    style="width: 80%; padding-right: 2em"
                    class="<?php echo $lang === 'ar' ? 'text-right' : ''; ?>"
                  />
                  <button type="submit" class="site-btn">
                    <?php echo $langStrings['search_button']; ?>
                  </button>
                </form>
              </div>
              <div class="hero__search__phone">
                <div class="hero__search__phone__icon">
                  <i class="fa fa-phone"></i>
                </div>
                <div class="hero__search__phone__text">
                  <h5>+212 633680761</h5>
                  <span
                    style="display: block"
                    class="<?php echo $lang === 'ar' ? 'text-right' : ''; ?>"
                    ><?= $langStrings['support_24_7'] ?></span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="humberger__open">
          <i class="fa fa-bars"></i>
        </div>
      </div>
    </header>
    <!-- Header Section End -->

    <a
      href="whatsapp://send?phone=212633680761"
      target="_blank"
      class="a_whatsapp"
    >
      <button class="btn_whatsapp">
        <i class="fa-brands fa-whatsapp"></i>
      </button>
    </a>
  </body>
</html>
