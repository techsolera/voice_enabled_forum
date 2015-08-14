<?php include'layouts\header.php'; ?>
<?php
login_redirect("login.php");
if(isset($_POST['create'])){
	if(!empty($_POST['category']))
	{
		open_database_connection();
			$datetime=date("d/m/y H:i:s");
			$category=$_POST['category'];
			$username=$_SESSION['username'];
			$sql="INSERT INTO `categorie` VALUES('','$category','$datetime','$username')" ;
			if(mysql_query($sql))
			{
				
			}
			else
			{
				echo mysql_error();
			}
		close_database_connection();
		echo output("Category Created Succesfully");
		$temp="Category ".$category."created";
		enter_log("category created");
		redirect_to("index.php");
	}
	else
		echo output("ERROR");
}

?>
