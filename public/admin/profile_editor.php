<!DOCTYPE HTML>

<?php require_once "core.inc.php";?>
<?php
if(isset($_POST['username']))
{
  
  if(!empty($_POST['username'])){
  $username=$_POST['username'];
  $no_of_reply=count_user_rply($username);
  $no_of_post=count_user_post($username);
  open_database_connection();
  $sql="SELECT `stimedate` ,`fname`, `lname`FROM `users` WHERE `username`='".$username."'";
  $r=execute_query($sql);
  close_database_connection();
  $member_since=$r[0]['stimedate'];
  $name=$r[0]['fname'].' '.$r[0]['lname'];
 $image_path="../images/".$username.".png";
    if(!file_exists($image_path))
    {
       $image_path="../images/default.jpg";
    }

  }
}
else
  redirect_to('index.php');
a:
?>
<HTML>
	<HEAD>
    <script src="../js/jquery.min.js"></script>
		<!-- Latest compiled and minified CSS -->
         <link rel="stylesheet" href="../stylesheets/css/bootstrap.min.css">

<!-- Optional theme -->
        <link rel="stylesheet" href="../stylesheets/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
         <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
         <script type="text/javascript" src="https://www.google.com/jsapi"></script>
       <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
          var post=7;
          var reply=8;
          var data = google.visualization.arrayToDataTable([
            ['#', 'Contribution'],
            ['Post',   post],
            ['Replies',reply],
            
          ]);

          var options = {
            title: 'Contribution',
            pieHole: 0.4,
          };

          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(data, options);
        }
    </script>

	</HEAD>
	<body>
		<div class="container" style="width:750px;" >
			<div class="page-header" align="center">
  				<h1 style="font-family:Calibri"; class="text-muted";>TCET</h1>  				
			</div>
      <ul class="nav nav-tabs nav-justified" role="tablist"; role="tablist">
          <li  class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
          <li><a href="#statistics" role="tab" data-toggle="tab">Statistics</a></li>
          <li><a href="#log" role="tab" data-toggle="tab">Log</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="profile">
          <hr>
          <a href="index.php" class="btn btn-default " style="position:relative; top:15px; left:10px; z-index:1;"><span class="glyphicon glyphicon-home"></span></a>
          <div class="row" style="position:relative; top:-40px;">
            <div class="col-xs-12">
              <div class="thumbnail">
                <img src="<?php echo $image_path;?>" data-src="holder.js/300x300" alt="..." class="img-thumbnail" >
                <div class="caption" >
                <h3><small align="center">
                 <?php if(isset($name)){echo $name;}?></small></h3>
                </div>
               
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="statistics">
          <hr>
          <a href="#" style="position:relative; top:15px; left:70px; z-index:1;"><span class="glyphicon glyphicon-stats" ></span></a>
           <a href="index.php" class="btn btn-default " style="position:relative; top:15px; left:10px; z-index:1;"><span class="glyphicon glyphicon-home"></span></a>
          <div class="container" style="position:relative; top:-40px;">
  
            <div class="jumbotron" style="width:700px"  >
              <div id="donutchart" style="width: 700px; height: 200px;" ;></div>
              <br>
              <div align="center">
                <p>
                  <dl class="dl-horizontal"  >
                    <dt>Email:</dt>
                    <dd> <?php if(isset($username)){echo $username;}?></dd>
                    <dt>Member Since:</dt>
                    <dd><?php if(isset($member_since)){echo $member_since;}?></dd>
                    <dt>Last logged in:</dt>
                    <dd><?php if(isset($member_since)){echo $member_since;}?></dd>
                    <dt>forum post:</dt>
                    <dd><?php if(isset($no_of_post)){echo $no_of_post;}?></dd>
                    <dt>Reply:</dt>
                    <dd><?php if(isset($no_of_reply)){echo ($no_of_reply);}?></dd>
                    <dt>Active Contribution:</dt>
                    <dd><?php if(isset($no_of_post) && isset($no_of_reply)){echo ($no_of_reply+$no_of_post);}?></dd>
                  </dl>
                </p>
              </div>
            </div>
           </div>
         </div>
        <div class="tab-pane fade" id="log">..dasdas.</div>
      </div>
				<hr>
				<p>@TCET2014</p>	
  		
	</body>
</html>   