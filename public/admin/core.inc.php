<?php 
      require_once("../../includes/config.php");
      require_once("../../includes/functions.php");
      ob_start();
      session_start();
      //check if the admin is logged in
      if(!loggedin())
      {

        redirect_to("index.php");
      }
      else
      {
      if($_SESSION['privilage']!='100')
        redirect_to("index.php");


      }
 ?>