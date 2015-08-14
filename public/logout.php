
<?php
require_once("layouts/header.php");
enter_log("Log out succesfull");
session_destroy();
redirect_to('index.php');   
    
?>
