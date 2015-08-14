<!DOCTYPE HTML>
<html>
<script src="../js/jquery.min.js"></script>
<?php require_once "core.inc.php";
if (isset($_GET['name']))
{
	$log="";
	$permission="";
	$home="";
	if($_GET['name']=='log')
			$log="active";
	if($_GET['name']=='permission')
			$permission="active";
	
}

else
		$home="active";
?>
<head>
		<!-- Latest compiled and minified CSS -->
         <link rel="stylesheet" href="../stylesheets/css/bootstrap.min.css">

<!-- Optional theme -->
        <link rel="stylesheet" href="../stylesheets/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
         <script src="../js/bootstrap.min.js"></script>
 		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">

    <div class="navbar-header">
     <a class="navbar-brand" style="font-family:Grunge Face"; href="../index.php">TCET under construction</a>
  </div><!-- /.container-fluid -->
  <p class="navbar-text navbar-right" style="position:relative; left:-10px;">User Profile<br><?php echo $_SESSION['name'];?></p>
</nav>
<div class="row">
	<div class="col-xs-2" style="position:relative; left:20px;">
	<div class="list-group">
  		<a href="#" class="list-group-item disabled">
    	<form class="form" role="search">
  			<div class="form-group  has-feedback">
  				<label class="control-label sr-only" for="inputSuccess5">Hidden label</label>
  				<input type="text" class="form-control" id="inputSuccess5" placeholder="search..">
  				<span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
		</form>
  		</a>
 		 <a href="index.php?name=permission" class="list-group-item <?php if(isset($permission)){ echo $permission;}?>">User Profile</a>
 		 <a href="index.php" class="list-group-item <?php if(isset($home)){echo $home;}?>">Moderator home</a>
  		 <a href="index.php?name=log" class="list-group-item <?php if(isset($log)){ echo $log;}?>">Log</a>
 	</div>
	</div>
	<div class="col-xs-10">
		<div class="page-header">
<h1>Dashboard</h1>

<?php
if(isset($_GET['name']))
{
$name=$_GET['name'];
if($name=='log')
{
include "log.php";
die();

}
if($name=='permission')
{
include "permission.php";
die();
}
}

?>
<h3>Categories</h3>
<div class="row">
<div class="col-md-3">
<form action="" method=post>
<select name="username" class="form-control">
<?php
		
		$list=list_category();
		$n=count($list);
			echo '<option value="">SELECT CATEGORY</option>';
		for ($i=0; $i <$n ; $i++) { 
			echo '<option value='.$list[$i]['cname'].'>';
			echo $list[$i]['cname'];
			echo '</option>';


		}

	?>
</select>
</div>
<div class="col-md-3">
<input type="submit" name="submit" value="Detail" class="btn btn-default">
<input type="submit" name="delete" value="Delete category" class="btn btn-default" formmethod="post" >
</div>
<div class="col-md-6"></div>
</form>
</div>
<h3>topics</h3>
<div class="row">
<div class="col-md-3">
<form action="profile_editor.php" method=post>
<select name="username" class="form-control">
<?php
		


		

	?>
</select>
</div>
<div class="col-md-3">
<input type="submit" name="submit" value="View Profile" class="btn btn-default">
<input type="submit" name="delete" value="Delete User" class="btn btn-default" formmethod="post" formaction="index.php?name=permission">
</div>
<div class="col-md-6"></div>
</form>
</div>
<h3>replies</h3>
<div class="row">
<div class="col-md-3">
<form action="profile_editor.php" method=post>
<select name="username" class="form-control">
<?php
		
		

	?>
</select>
</div>
<div class="col-md-3">
<input type="submit" name="submit" value="View Profile" class="btn btn-default">
<input type="submit" name="delete" value="Delete User" class="btn btn-default" formmethod="post" formaction="index.php?name=permission">
</div>
<div class="col-md-6"></div>
</form>
</div>

		</div>
	</div>
	
</div>


</body>
</html>
