<?php 
   session_start();

   $availableLanguages = [ 'fr', 'ar'];
   $defaultLanguage = 'fr';
   
   if (isset($_GET['lang']) && in_array($_GET['lang'], $availableLanguages)) {
       $_SESSION['lang'] = $_GET['lang'];
   }
   
   $lang = $_SESSION['lang'] ?? $defaultLanguage;
   
   $langStrings = require "languages/$lang.php"; 
   