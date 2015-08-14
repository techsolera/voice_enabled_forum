<!DOCTYPE HTML>
<?php include'layouts\header.php'; ?>
<?php
//for profile
if(isset($_POST['submit'])){
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000) //maximum 2mb is allowed
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
  } else {
        
        $tmp_name=$_FILES["file"]["tmp_name"];
        $name=$_SESSION['username'];
        $extention="png";
        $newloc="images/".$name.".".$extention;
        move_uploaded_file($tmp_name,$newloc);
        echo output("file uploaded");
        enter_log("profile changed");
        
  }
} else {
  echo output("Invalid file !!!!! Please upload valid image file with size less then 2MB  ");
}
}
?>
<?php

if(isset($_SESSION['username']))
{
  if(!empty($_SESSION['username'])){
    $username=$_SESSION['username'];
    $no_of_reply=count_user_rply($username);
    $no_of_post=count_user_post($username);
    open_database_connection();
    $sql="SELECT `stimedate` ,`fname`, `lname`FROM `users` WHERE `username`='".$username."'";
    $r=execute_query($sql);
    close_database_connection();
    $member_since=$r[0]['stimedate'];
    $name=$r[0]['fname'].' '.$r[0]['lname'];
    $image_path="images/".$username.".png";
    if(!file_exists($image_path))
    {
      $image_path="images/default.jpg";
    }
  }
}
else
  redirect_to('index.php');
?>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
          var post=<?php echo $no_of_post?>;
          var reply=<?php echo $no_of_reply?>;
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


		
        
      
      

      <ul class="nav nav-tabs nav-justified" role="tablist"; role="tablist">
          <li  class="active"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
          <li><a href="#statistics" role="tab" data-toggle="tab">Statistics</a></li>
          <li><a href="#log" role="tab" data-toggle="tab">Log</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="profile">
          <hr>
          <div class="row" >
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
            <button class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal" STYLE="position:relative; top:-80px; left:650px;">
                <span class="glyphicon glyphicon-open"></span></span></button>
        </div>
        <div class="tab-pane fade" id="statistics">
          
          <a href="#" style="position:relative; top:35px; left:35px; z-index:1;"><span class="glyphicon glyphicon-stats" ></span></a>
          <div class="container" >
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
      <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          
          <h4 class="modal-title" id="myModalLabel"><strong>Upload your photo</strong></h4>
      </div>
        <div class="modal-body">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <label for="file">Filename:</label>
                <input type="file" name="file" class="btn btn-info">
             
                <div class="page-header">
                  <strong><h3>Instructions<small> for image</small></h3></strong>
                </div>
                <dl class="dl-horizontal">
                  <dt>Maximum Image Size:</dt>
                  <dd>2 Mb</dd>
                  <dt>Ideal Image width:</dt>
                  <dd>710 px</dd>
                  <dt>Ideal Image height:</dt>
                  <dd>535 px</dd>
                </dl>

                <div align="left" STYLE="position:relative;  left:530px; height:37px;">
                <button type="submit" name="submit"  class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button><br><br>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

				<hr>
				<p>@TCET2014</p>	
  </div>		
	</body>
</html>   