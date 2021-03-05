<?php
   include('dbConnection.php');
   session_start();
   
   if(!isset($_SESSION['username'])){
      header("location:login.php");
      die();
   }
?>