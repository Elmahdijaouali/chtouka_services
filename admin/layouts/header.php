<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Dashboard | chtouka services</title>
  <!-- Favicon -->
  
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/style.min.css">

  <link rel="stylesheet" href="css/style_btn.css">

  <link rel="stylesheet" href="css/style_table.css">

  <link rel="stylesheet" href="css/style_form_edit_img_pro.css">

  <link rel="stylesheet" href="css/setting_profile.css">

  <link rel="stylesheet" href="css/form_add_product.css">
   <link rel="stylesheet" href="css/style_select.css">
</head>

<body>
  <div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="../admin/dashboard.php" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text"  >
                   
                    <span class="logo-title" >Admin</span>
                    <span class="logo-subtitle">Chtouka services </span>
                    
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active" href="dashboard.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
               
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Product
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="products.php">All product</a>
                        </li>
                        <li>
                            <a href="form_add_product.php">Add new product</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Categories
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="categories.php">All category</a>
                        </li>
                        <li>
                            <a href="form_add_category.php">Add new category</a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Images slider
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="show_slider_images.php">All image top slider</a>
                        </li>
                        <li>
                            <a href="form_add_img_top_slider.php">Add new img</a>
                        </li>
                    </ul>
                </li> -->
           
             
                <!-- <li>
                    <a href="comments.html">
                        <span class="icon message" aria-hidden="true"></span>
                        Comments
                    </a>
                    <span class="msg-counter">7</span>
                </li> -->


                <li>

                   <a  href="users.php"><span class="icon  user-3" aria-hidden="true"></span>Users</a>
                 
                </li>
        
                <li>
                    <a  href="orders.php"><span class="icon folder" aria-hidden="true"></span>Orders</a>
                </li>
                
                <li>
                    <a  href="subscribes.php"><span class="icon user-3" aria-hidden="true"></span>subscribes</a>
                </li>
            </ul>
            <ul class="sidebar-body-menu">
              <h4 style="color:white;">System</h4>

                
              <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Media
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="media-01.html">Facebook</a>
                        </li>
                        <li>
                            <a href="media-02.html">Instgram</a>
                        </li>
                        <li>
                            <a href="media-02.html">Twitter</a>
                        </li>
                        <li>
                            <a href="whatsapp://send?phone=212633680761">Whatsapp</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon  user-3" aria-hidden="true"></span>Admins
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="admins.php">All admin</a>
                        </li>
                        <?php 
                          if($_SESSION['role'] == "superadmin"){ ?>
                              <li>
                                 <a href="pages/add_admin.php">Add new admin</a>
                              </li>

                       <?php   }
                        ?>


                      
                      
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon paper" aria-hidden="true"></span>Pages
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">

                        <li>
                            <a href="../index.php" target="_blank">Home</a>
                        </li>
                       
                        <li>
                            <a href="../about.php" target="_blank">About us</a>
                        </li>
                        <li>
                            <a href="../contact.php" target="_blank">Contact us</a>
                        </li>
                        <li>
                            <a href="../login.php" target="_blank">Login user</a>
                        </li>
                        <li>
                            <a href="../register.php" target="_blank">Register</a>
                        </li>
                        
                    </ul>
                </li>


            </ul>
            
          
            
        </div>
    </div>
    <!-- <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture><source srcset="./img/avatar/avatar-illustrated-01.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">Nafisa Sh.</span>
                <span class="sidebar-user__subtitle">Support manager</span>
            </div>
        </a>
    </div> -->
</aside>
  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
      <!-- <div class="search-wrapper">
        <i data-feather="search" aria-hidden="true"></i>
        <input type="text" placeholder="Enter keywords ..." required>
      </div> -->
    </div>
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
      </button>
     
      <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
        <span class="sr-only">Switch theme</span>
        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
      </button>

      
      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture>
               <?php  
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                  $imgPath = "../images_uploaded/admins/" .htmlspecialchars($_SESSION['img_admin']);
                  ?>
                  <img src="<?php echo $imgPath; ?>" alt="Service Image" style="width:150px;height:150px;border-radius:50%;" onerror="this.onerror=null; this.src='../images/default-placeholder.png';">
            </picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="profile_setting_admin.php">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Profile</span>
            </a></li>
         
          <li><a class="danger" href="pages/logoutAdmin.php">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>Log out</span>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
  