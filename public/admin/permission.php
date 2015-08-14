<?php require_once "core.inc.php";?>
<?php
if(isset($_POST['delete']) && $_SESSION['privilage']==100)
{
	
	$username=$_POST['username'];
	if(!empty($username))
	{
		delete_user($username);
		enter_log($username."deleted");

	}
}
?>
<h3>User Profile:</h3>
<div class="row">
<div class="col-md-3">
<form action="profile_editor.php" method=post>
<select name="username" class="form-control">
	<?php
		$user=list_user();
		$n=count($user);
			echo '<option value="">SELECT USER</option>';
		for ($i=0; $i <$n ; $i++) { 
			echo '<option value='.$user[$i]['username'].'>';
			echo $user[$i]['username'];
			echo '</option>';


		}

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
