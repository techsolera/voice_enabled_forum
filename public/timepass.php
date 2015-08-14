<?php include "layouts/header.php" ?>
<?php

open_database_connection();


$a="ajay";
$b="vijay";
$c="ajay";
echo strcmp($a,$a).'<br>';
echo strcmp($a,$b).'<br>';
echo strcmp($a,$c).'<br>';



?>
<?php require_once( "layouts/footer.php")?>