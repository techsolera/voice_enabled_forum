<?php
include "core.inc.php";
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
&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
  } else {
        
        $tmp_name=$_FILES["file"]["tmp_name"];
        $name=$_SESSION['username'];
        $extention="png";
        $newloc="../images/".$name.".".$extention;
        move_uploaded_file($tmp_name,$newloc);
        echo output("file uploaded");
        enter_log("profile changed");
        
  }
} else {
  echo "Invalid file";
}
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
