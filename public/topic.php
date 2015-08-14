<?php include'layouts\header.php'; ?>
<?php
    if(isset($_SESSION['category'])){
    open_database_connection();
    $category=$_SESSION['category'];
    $sql="SELECT `cid` FROM `categorie` WHERE `cname`='".$category."'";
    $result=execute_query($sql);
    close_database_connection();
    $cid=$result[0]['cid'];
    }

  if(isset($_GET['categorie'])){
    open_database_connection();
    $_SESSION['category']=$_GET['categorie'];
    $category=$_SESSION['category'];
    $sql="SELECT `cid` FROM `categorie` WHERE `cname`='".$category."'";
    $result=mysql_query($sql);
    if(mysql_num_rows($result)==0)
    {
      $category="No such category exists";
      exit;
    }
    else
    {
      $result=execute_query($sql);
      $cid=$result[0]['cid'];
    }
    
    close_database_connection();
  }
?>       
			
  					<div class="container" style="width:750px; position:relative; left:-10px">
            <div class="panel panel-default " align="center">
              <div class="panel-heading">
                <h3 class="panel-title"><?php if(isset($category)){echo $category;}?></h3>
              </div>
            <div class="panel-body" align="left">
              <div class="row">
                <div class="col-xs-3">
                    <form method=post action="post.php">
                    
                    <button type="submit" class="btn btn-default" formmethod="post" formaction="post.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Post new topic</button>
                    </form>
                </div>
                <div class="col-xs-9">
                  <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" class="form-control" placeholder="Search this category">
                 </div>
                </div>
             </div>
            </div>
            </div>
  					</div>
			   <div class="container" style="width:750px; position:relative; left:-10px">
          <div class="panel panel-default">
  <!-- Default panel contents -->
            <div class="panel-heading" align="center">Topics</div>
              <table class="table table-hover">
              <tr> 
              <th >#</th>
              <th style="width:500px">Topic</th>
              <th>Views</th>
              <th>Replies</th>
              </tr><?php include "topicloader.php"; ?>
              </table>
          </div>
            <div class="col-md-12" style="postion:relative;top:-30px;left:-15px;">
              <?php echo pagination($statement,$per_page,$page,$url='?');?>   
          </div>
          </div>
          
       
				<div class="jumbotron">
  					<div class="container ">
 						<h2 style="font-family:Angelou";>Forum Permissions</h2>
            <ul class="list-unstyled">
              <li>You cannot post new topics in this forum</li>
              <li>You cannot reply to topics in this forum</li>
              <li>You cannot edit your posts in this forum</li>
              <li>You cannot delete your posts in this forum</li>
              <li>You cannot post attachments in this forum</li>
            </ul>
  					</div>
				</div>
				<hr>
				<p>@TCET2014</p>	
		</div>
	</body>
</html>