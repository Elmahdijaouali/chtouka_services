<!doctype html>

<html lang="en"> 

 <head> 

  <meta charset="UTF-8"> 

  <title>admin login</title> 

  <link rel="stylesheet" href="css/login.css"> 
<style>
   .logo_cs{
    display:none;
  }
@media (max-width:1000px) {
  section span{
    display:none;
  }
  section{
    padding:0em;
    position: relative;
    
  }
  section:before{
    display:none;
  }
  section .signin{
    width:80% !important;
    height:auto;
    border-radius:.5em ;
  }
  section .logo_cs{
    display:block ; 
    position: absolute;
   
    width: 100%;
    height:100vh;
    text-align:center;
  }
  section .logo_cs img{
    width: 600px;
    height:auto;
    margin-top:20vh;
  }
  section .content form {
    font-size:2em;
  }
}
     
</style>
 </head> 

 <body>  

  <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> 
     

  <div class="logo_cs">
    <img src="img/logo_cs.png"  alt="">
  </div>
   <div class="signin "  > 

    <div class="content" > 
  
     <h2>login</h2> 

   
     
     <form action="pages/handleLogin.php" method="post" class="form form_login" >

    
              <div class="inputBox"> 
        
               <input type="email" name="email" autocomplete="off" required> <i>Email</i> 
        
              </div> 
        
              <div class="inputBox"> 
        
               <input type="password" name="password" autocomplete="off" required> <i>Password</i> 
        
              </div> 
             
             <div></div>
             <div class="inputBoxBtnLogin" > 
              <input type="submit" class="btn_login" value="Login"> 
       
             </div> 
   
    
        </form>
    

    </div> 

   </div> 

  </section>
 </body>

</html>