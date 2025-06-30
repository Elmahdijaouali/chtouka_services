<?php 
   include 'includes/header.php'; 
?>

<main class="about-container">
    <section class="about-intro">
        <h2 class="title"><?php echo $langStrings['about']; ?></h2>
        <!-- <div class="video-about">
            <video src="path_to_your_video.mp4" controls class="video-player"></video>
        </div> -->
        <!-- <p class="<?= $lang=="ar" ? 'dir_ar' : '' ?>" style="text-align:center;">
           <?= $langStrings['subtitre_video'] ?> 
        </p> -->

        <div class="body_page <?= $lang=="ar" ? 'dir_ar' : '' ?> " >
            <div class="row">
                <div class="text">
                   <p id="about_us">
                    <h2  class="subtitle"><?php echo $langStrings['about_us']; ?></h2>
                    <?php echo $langStrings['about_us_content']; ?>
                </div>
                <div class="container_imgs">
                     <div class="img_one">
                          <img src="img/img1_about.jpeg" width="100%" height="100%" alt="">
                     </div>
                     <div class="scp_two">  
                         <div class="img_two">
                             <img src="img/img2_about.jpeg"  width="100%" height="100%" alt="">
                         </div>
                         <div class="img_three">
                            <img src="img/img3_about.jpeg"  width="100%" height="100%" alt="">
                         </div>
                     </div>
                </div>
            </div>
          
            <div class="row_two text">
                 <p id="about_shop">
                    <h2  class="subtitle"> <?php echo $langStrings['about_shop']; ?></h2>
                    <?php echo $langStrings['about_content']; ?>
                </p>
               
                <p id="delivery_info">
                    <h2  class="subtitle"> <?php echo $langStrings['delivery_info']; ?></h2>
                    <?php echo $langStrings['delivery_info_content']; ?>
                   
                </p>
                <p id="privacy_policy">
                    <h2  class="subtitle"><?php echo $langStrings['privacy_policy']; ?></h2>
                    <?php echo $langStrings['privacy_policy_content']; ?>
                </p>       
                             
            </div>
        </div>
    </section>

   
</main>


<style>
     .dir_ar{
        text-align: right;
        direction: rtl;
        font-size:1.2em;
     }
    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding:.5em 2em;
        font-family: Arial, sans-serif;
        color: #333;
    }
    .title {
        text-align: center;
        font-size: 3.5em;
        color: #7fad39;
        margin-bottom: 1em;
        font-weight:bold;
    }
    .subtitle {
        font-size: 2em;
        color: #7fad39;
        margin: 1.5em 0;
        font-weight:bold;
    }
    .video-about {
        text-align: center;
        margin: 1em 0;
    }
    .about-container   .subtitre{
            text-align: right;
            direction: rtl;
    }
    .video-player {
        width: 100%;
        height: 60vh; /* Adjust height for larger video */
        border-radius: 1em;
        overflow: hidden;
    }
    
    .card {
        background-color: #ffeb3b; /* Yellow background */
        border-radius: 1em;
        padding: 1.5em;
        margin: 1.5em 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .responsive-img {
        width: 100%;
        height: auto;
        border-radius: 1em;
    }
    .team-member {
        display: flex;
        align-items: center;
        margin: 1.5em 0;
        padding: 1em;
        background: #f9f9f9;
        border-radius: 1em;
    }
    .team-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-right: 1.5em;
    }

    /* body page  */
    .about-container .body_page{
        margin-bottom:5em;
    }
     .about-container .body_page .row , .row_two{
        width: 100%;
        height:50vh;
        margin-top:5em;
        
     }
     .about-container .body_page .row .text{
        width: 50%;
      
       
        padding:1.5em;

     }
     .about-container .body_page  .text p{
        color:#333;
        font-size:1.3em;
     }
     .about-container .body_page .row .container_imgs {
        width: 50%;
        height:100%;
    
     }
     .about-container .body_page .row .container_imgs img{
        border-radius:.5em;
     }
     .about-container .body_page .row .container_imgs .img_one{
        width: 100%;
        height:60%;
       
     }
     .about-container .body_page .row .container_imgs .scp_two{
        display:flex;
        justify-content:space-between;
        padding:.5em .5em 0em;
     }
     .about-container .body_page .row .container_imgs .scp_two div:first-child{
        width: 54%;
        height:40% ;
  
     }
     .about-container .body_page .row .container_imgs .scp_two .img_three{
        width: 45%;
        height:40%;
     }
     .row_two{
        height:auto !important;
     }
    @media (max-width: 768px) {
        .title {
            font-size: 2.5em;
        }
        .subtitle {
            font-size: 2em;
        }
        .video-player {
            height: 40vh; /* Smaller video height for mobile */
        }
    }
    @media (max-width:1000px) {
        .about-container .body_page .row{
            flex-direction:column;
            height:auto !important ;
        } 
        .about-container .body_page .row .text,
        .about-container .body_page .row .container_imgs{
             width:100% ;
        }   
    }
</style>

<?php 
   include 'includes/footer.php'; 
?>