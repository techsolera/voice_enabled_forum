
<?php include'layouts\header.php'; ?>
<?php
login_redirect("post.php");

  if(isset($_SESSION['category']) && isset($_SESSION['username'])){
    open_database_connection();
     $category=$_SESSION['category'];
    $sql="SELECT `cid` from `categorie` where `cname`='$category' ";
    $result=mysql_query($sql);
    if(mysql_num_rows($result)==0)
    {
      $category="No such category exists";
      exit;
    }
    close_database_connection();

  }
  else
    {
      echo "Please LOGIN";
      die();
    }
    
    if(isset($_POST['submit'])){
      $subject=$_POST['subject'];
      $detail=$_POST['detail'];
      $datetime=date("d/m/y H:i:s");
      $username=$_SESSION['username'];
      if(!empty($category) && !empty($subject) && !empty($detail)){
        open_database_connection();
        $sql="SELECT `cid` FROM `categorie` WHERE `cname`='$category'";
        $result=execute_query($sql);
        $cid=$result[0]['cid'];
        $sql="INSERT INTO `topic` VALUES ('','$subject','$cid','$username')";
        if(mysql_query($sql)){
            $sql="SELECT `tid` FROM `topic` WHERE `tname`='$subject'";
            $result=execute_query($sql);
            $tid=$result[0]['tid'];
            $name=$_SESSION['name'];
            $username=$_SESSION['username'];
            $sql="INSERT INTO `forum_question`(`question_id`, `detail`, `name`, `email`, `datetime`, `view`, `reply`, `tid`, `cid`)";
            $sql=$sql." VALUES('','$detail','$name','$username','$datetime','','','$tid','$cid')";
            if(mysql_query($sql))
            {
              echo '<div class="alert alert-success" role="alert" align="center">';
              echo        '<a href="topic.php?categorie='.$category.'" class="alert-link">View Post</a>';
               echo      '</div>';
            }
            else
              echo mysql_error();
          }
          else
            echo mysql_error();

        close_database_connection();
      }
      else
      {
        echo output("something is empty");
      }
    }
    
  
?>
<script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="application/x-javascript">
      tinymce.init({selector:'#TypeHere'});
    </script>
             
	
  				    <form method="post" action="post.php">
 						   <div class="panel panel-default"  style="width:720px;" align="center">
                <div class="panel-heading">
                  <h4 class="panel-title"><?php if(isset($category))echo $category?></h4>
                </div>
                <div class="panel-body" align="left">
                  <h3 style="position:relative; left:40px;">Post a new topic</h3>
                  <div class="row">
                    <div class="col-xs-2"><span style="position:relative; left:40px; top:5px;">Subject :</span></div>
                    <div class="col-xs-10">
                      <div class="input-group">
                        <input type="text" class="form-control" name="subject">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        </div>
                      </div>                    
                  </div>
                  <br>
     <div class="btn-group" style="position:relative; top:-10px; left:35px;
                  ">

                  </div>
                  <textarea class="form-control" rows="15" id="TypeHere" name="detail">Type some text here.</textarea>
                
                  <br>
                   <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                      <input  type="submit" class="btn btn-default" name="submit" value="Post">
                    </div>
                   <div class="btn-group">
                      <button type="button" class="btn btn-default">preview</button>
                  </div>
                  </div>
                </div>

              </div>
  			       </form>
       
				<hr>
				<p>@TCET2014</p>	
		</div>
	</body>
</html>