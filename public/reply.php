<?php include'layouts\header.php'; ?>

<?php
if(isset($_POST["submitlogin"]))
{
	login_redirect();
}
if (isset($_POST["ans"]))
{
	$qid=$_SESSION['question'];
	$tid=$_SESSION['topic'];
	$username=$_SESSION['username'];
	$name=$_SESSION['name'];
	$datetime=date("d/m/y H:i:s");
	$ans=$_POST['ans'];
	open_database_connection();
		$datetime=date("d/m/y H:i:s");
		$sql="INSERT INTO `forum_answer` VALUES ('$qid','','$name','$username','$ans','$datetime')";
		if(mysql_query($sql))
		{
			
			$sql="SELECT  `question_id` FROM `forum_answer` WHERE `question_id`='$qid'";

			$reply=mysql_num_rows(mysql_query($sql));
			$sql="UPDATE `forum_question` SET `reply`='$reply' WHERE `question_id`='$qid' ";
			mysql_query($sql);
			redirect_to("view.php");

		}
		else{
			echo mysql_error();
		}


	close_database_connection();
}

?>