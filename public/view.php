<?php include'layouts\header.php'; ?>
<?php
//keeping track of uri while posting data
if(isset($_GET['page'])){
$uri=$_SERVER['PHP_SELF']."?page=".$_GET['page'];
}
else
$uri=$_SERVER['PHP_SELF'];
if(isset( $_GET['topic']) && isset( $_GET['question']))
{
	$_SESSION['topic']=$_GET['topic'];
	$_SESSION['question']=$_GET['question'];
}
//for deleting particular post
if(isset($_POST['delete'])){
	$a_id=$_POST['delete'];
	open_database_connection();
	 $sql="DELETE  FROM `forum_answer` WHERE `a_id`='$a_id'";
	if(mysql_query($sql))
	{
		echo output("The Post deleted successfully");
	}
	else
		echo output("Something went wrong");
	close_database_connection();

}
if(isset( $_SESSION['topic']) && isset( $_SESSION['question'])){
	open_database_connection();
	$q=$_SESSION['question'];
	$t=$_SESSION['topic'];
	$sql="SELECT `tname` FROM `topic` WHERE `tid`='$t'";
	$r1=execute_query($sql);
	$sql="SELECT * FROM `forum_question` WHERE `question_id`='$q' AND `tid`='$t'";
	$topic_name=$r1[0]['tname'];
	$r2=execute_query($sql);
	$question=$r2[0]['detail'];
	$time=$r2[0]['datetime'];
	$name=$r2[0]['name'];
	$email=$r2[0]['email'];
	close_database_connection();
}
?>
<div class='question'>
	<div class="topic name" style="font-family:Calibri;">
	
	<div class="panel panel-default">
	 <div class="panel-heading text-uppercase"><h1><?php if(isset($topic_name)){echo $topic_name;} ?></h1></div>
		<div class="panel-body" align=left>
		 <p><h2><?php if(isset($topic_name)){echo $question;} ?><h2>
			<h6><?php if(isset($topic_name)){echo "By ".$name;} ?>
			<h6><?php if(isset($topic_name)){echo "At ".$time ;} ?></p>
		</div>
	
	</div>
</div>

<?php
open_database_connection();
	$q=$_SESSION['question'];
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;

	$per_page = 5; // Set how many records do you want to display per page.

	$startpoint = ($page * $per_page) - $per_page;

	$statement = "`forum_answer`  WHERE `question_id`='$q' ORDER BY `a_datetime` ASC"; // Change `records` according to  table name.

	$results = mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
		if (mysql_num_rows($results) != 0) {
			$i=$startpoint;
			while ($row = mysql_fetch_array($results)) {
			$a_id=$row['a_id'];
			$ans=$row['a_answer'];
			$name=$row['a_name'];
			$email=$row['a_email'];
			$datetime=$row['a_datetime'];
			echo "<a href=\"#\" class=\"list-group-item\" align=\"left\"><div>".($i+1);
			echo "<strong> $ans </strong></div><div><h6>By <i> $name </i></h6>";
			echo "</div><div><h6>At $datetime </h6>";

			
			if(loggedin() && $_SESSION['privilage']==100){
	
				echo"<form>";
				echo "<button formaction='".$uri."'' formmethod=post class='btn btn-default btn-lg' value=\"$a_id\" name=\"delete\">Delete</button>";
				echo "</form>";
			}
			 echo "</div></a>";
			$i++;
		}
			

	} else {
		echo "No Reply";
	}
close_database_connection();

?>
<div class="col-md-12" style="postion:relative;top:-10px;left:-15px;">
  <?php echo pagination($statement,$per_page,$page,$url='?');?>   
 </div>
<div name="post rply">
<?php if(isset($_SESSION['username'])){
echo "
<div class=\"jumbotron\">
<h1>Post  <small>a reply</small></h1>
<form method=\"post\" action=\"reply.php\" role=\"form\">
<div class=\"form-group\">
<textarea name=\"ans\" class=\"form-control\" rows=\"10\">
	
</textarea>
 </div>
 <button type=\"submit\" class=\"btn  btn-lg btn-block\" name=\"submit\" value=\"Reply\">Submit</button>

</form>
</div>
</div>
";
}
else
{
echo "
 <div class=\"jumbotron\">
<h1>Post  <small>a reply</small></h1>
	<form method=\"post\" action=\"post.php\" role=\"form\">
 <div class=\"form-group\">
	<textarea class=\"form-control\" rows=\"10\">
	</textarea>
 </div>
  <button type=\"submit\" class=\"btn  btn-lg btn-block\" name=\"submit\" value=\"Reply\">Submit</button>
	
	</form>
	</div>
	</div>
	";
}
?>
<?php include'layouts\footer.php'; ?>
