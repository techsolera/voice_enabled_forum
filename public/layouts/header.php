<link rel="stylesheet" type="text/css" href="stylesheets/1.css">

<?php require_once("../includes/config.php");
      require_once("../includes/functions.php");
      
      ob_start();
      session_start();
      $_SESSION['ip']=get_ip();
 ?>
<!-- for nav bar -->
<?php


  $flag="in";
 
 if(loggedin())
{
  $flag="out";
  if($_SESSION['privilage']==100)
  {
    $admin= '<a href="admin/index.php" class="btn btn-default" style="height:37px;"><span class="glyphicon glyphicon-cog"></span></a>';
  }
  echo "<div class=\"container\" align=\"center\" >
  <nav class=\"navbar navbar-default\" role=\"navigation\" style=\"width:750px\">
				<h1 style=\"font-family:Calibri \"; class=\"navbar-text pull-left text-muted\">TCET</h1>
				<h3 class=\"navbar-text pull-right\" style=\" position:relative; top:10px;\">Signed in as <small>".$_SESSION['name']."</small></h3>
				
		</nav>
	</div>
		";

}

else
{
echo "<div class=\"container\" align=\"center\" >
<nav class=\"navbar navbar-default\" role=\"navigation\" style=\"width:750px\">
				<h1 style=\"font-family:Calibri\"; class=\"navbar-text pull-left text-muted\">TCET</h1>
		</nav>
		";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </div>
    <title>TCET FORUM</title>
    <style>
    body
    {
      background-image: url('images/upload.jpg');
        background-repeat: repeat-x;
        background-position:bottom;
    }
    </style>
    <!-- Bootstrap -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="stylesheets/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="stylesheets/css/bootstrap-theme.min.css">
 	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
  </head>
	<body>
	<div class="container" style="width:750px;">
			<div class="container">
        <div class="row">
          <div class="col-lg-2">
            <div class="input-group">
              <input type="text" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" style="height:34px;"><span class="glyphicon glyphicon-search"></span></button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <DIV class="col-md-9">	
    						<div class="btn-group" style="position:relative; left:375px;">
                    <?php if(isset($admin)){echo $admin;} ?>
              			<a href="index.php" class="btn btn-default"  ><span class="glyphicon glyphicon-home"></span>&nbsp;</a>
                    <a href="log<?php echo $flag ?>.php" class="btn btn-default" style="height:37px;"><?php if(!strcasecmp($flag,"OUT")){echo "<span class=\"glyphicon glyphicon-log-out\"></span>";}else{echo "<span class=\"glyphicon glyphicon-log-in\"></span>";}?></a>
              			<?php 
                      if(!loggedin()){
                        echo '<a href="register.php" class="btn btn-default" style="height:37px;"><span class="glyphicon glyphicon-plus-sign"></span></a>'; 
                      }
                      else{
                        echo '<a href="profile.php" class="btn btn-default" style="height:37px;"><span class="glyphicon glyphicon-user" style=\"height:37px;\"></span></a>';
                      }
                    ?>
    			           
            		</ul>
            </div>
    					</div>
    				</div>
        </div>
   
				<br>
		