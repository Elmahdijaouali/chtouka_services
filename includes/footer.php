<link rel="stylesheet" href="css/notification.css">
<!-- Show notifications -->
<div class="show_notifications"></div>

<!-- Handle notification success -->
<?php if (isset($_SESSION['handle_notification_success']) || isset($_SESSION['handle_notification_error'])) { ?>
    <script>
        function show_notification(msg, type) {
            let div = document.createElement('div');
            div.innerHTML = "<p><i class='fa-solid " + (type === 'success' ? 'fa-check' : 'fa-xmark') + "' style='color: " + (type === 'success' ? '#7FAD39' : '#f70202') + ";'></i> " + msg + "</p>";
            div.classList.add(type === 'success' ? "success" : "error");
            document.querySelector(".show_notifications").appendChild(div);
            setTimeout(() => {
                div.remove();
            }, 5000);
        }

        // Check for success message
        <?php if (isset($_SESSION['handle_notification_success'])) { ?>
            var successMessage = "<?= addslashes($_SESSION['handle_notification_success']) ?>";
            show_notification(successMessage, 'success');
            <?php unset($_SESSION['handle_notification_success']); ?>
        <?php } ?>

        // Check for error message
        <?php if (isset($_SESSION['handle_notification_error'])) { ?>
            var errorMessage = "<?= addslashes($_SESSION['handle_notification_error']) ?>";
            show_notification(errorMessage, 'error');
            <?php unset($_SESSION['handle_notification_error']); ?>
        <?php } ?>
    </script>
<?php } ?>



<style>
    .text_right{
        text-align:right;
        padding-right:6.5em;
    }
    .ul_footer_ar{
        /* text-align:right; */

        width: 100% !important;
    }
</style>

<!-- Footer Section Begin -->
<footer class="footer spad <?php echo $lang === 'ar' ? 'text-right' : ''; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="index.php">  
                            <h4 class="logo">CHTOUKA SERVICES</h4>
                        </a>
                    </div>
                    <ul>
                        <li><?php echo $langStrings['address_company']; ?> </li>
                        <li><?php echo $langStrings['phone_company']; ?></li>
                        <li><?php echo $langStrings['email_company']; ?> </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6 ><?php echo $langStrings['useful_links']; ?></h6>
                    <ul class="<?php echo $lang === 'ar' ? 'ul_footer_ar' : ''; ?>">
                        <li><a href="about.php#about_us"><?php echo $langStrings['about_us']; ?></a></li>
                        <li><a href="about.php#about_shop"><?php echo $langStrings['about_shop']; ?></a></li>
                       
                        <li><a href="about.php#delivery_info"><?php echo $langStrings['delivery_info']; ?></a></li>
                        <li><a href="about.php#privacy_policy"><?php echo $langStrings['privacy_policy']; ?></a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6><?php echo $langStrings['newsletter']; ?></h6>
                    <p><?php echo $langStrings['newsletter_desc']; ?></p>
                    <form action="handle_pages/Subscribe.php" method="post">
                        <input type="email"  class="<?php echo $lang === 'ar' ? 'text_right' : ''; ?>" name="email" required placeholder="<?php echo $lang === 'ar' ? 'أدخل بريدك' : 'Enter your mail'; ?>">
                        <button type="submit" class="site-btn"><?php echo $langStrings['subscribe']; ?></button>
                    </form>
                    <div class="footer__widget__social">
                         <a href="https://www.instagram.com/ChtoukaServices" target="_blank" rel="noopener noreferrer">
                          <i class="fa-brands fa-instagram"></i>
                         </a>
                         <a href="https://www.facebook.com/ChtoukaServices" target="_blank" rel="noopener noreferrer">
                             <i class="fa-brands fa-facebook"></i>
                         </a>
                         <a href="https://twitter.com/ChtoukaServices" target="_blank" rel="noopener noreferrer">
                             <i class="fa-brands fa-twitter"></i>
                         </a>
                         <a href="https://www.linkedin.com/ChtoukaServices" target="_blank" rel="noopener noreferrer">
                             <i class="fa-brands fa-linkedin"></i>
                         </a>

                        <a href="whatsapp://send?phone=212633680761"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <?php if( $lang === 'ar' ){ ?>
                            <p> Chtouka Services <?php echo $langStrings['copyright']; ?> <script>document.write(new Date().getFullYear()); </script> </p>
                        <?php }else{ ?>
                            <p><?php echo $langStrings['copyright']; ?> <script>document.write(new Date().getFullYear());</script> Chtouka Services</p>
                       <?php }
                        ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/edit.js"></script>

    <script src="js/notification.js"></script>
   


</body>
</html>