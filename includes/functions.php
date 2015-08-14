<?php
function clean($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function make_thumb($src, $dest, $desired_width) {
  $source_image = imagecreatefrompng($src);
  $width = imagesx($source_image);
  $height = imagesy($source_image); 
  $desired_height = floor($height * ($desired_width / $width));
  $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
  imagepng($virtual_image, $dest);
}


function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output($message="") {
  if (!empty($message)) { 
    return "<div class=\"alert alert-info\" role=\"alert\">
  <p class=\"message\">{$message}</p>
</div>";
  } else {
    return "";
  }
}


function open_database_connection()
{
  mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die("could not connect to database");
  mysql_select_db(DB_NAME) or die("could not find data base");
 

}
function close_database_connection()
{
  $flag=mysql_close();
  return $flag;
}


function execute_query($sql){
$result=mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
if (mysql_num_rows($result) == 0) {
    
    goto a;
    
}
if(mysql_num_rows($result) == 0)
{
$a=mysql_fetch_assoc($result);
}
$output;
$length=0;
while ($row = mysql_fetch_assoc($result)) {
    $output[$length]=$row;
    $length++;

}

return $output;
a:
}

function username_found($username="")
{

  $username=clean($username);
  
  $sql="SELECT uid FROM users WHERE username='".$username."'";

  $result=mysql_query($sql);
  
 
  if(mysql_num_rows($result)>=1)
  {
    return true;
  }
  else
    return false;
}
function user_found($username="",$password="")
{
  $username=clean($username);
  $password=clean($password);
  $sql="SELECT uid FROM users WHERE username='".$username."' AND password='".$password."'";

  $result=mysql_query($sql);
  echo mysql_error();
 
  if(mysql_num_rows($result)==1)
  {
    return true;
  }
  else
    return false;
}

function loggedin()
{
  if(isset($_SESSION['username']) && !empty($_SESSION['username']))
  {
    return true;
  }
  else{
    return false;
  }
}
function set_msg_redirect($msg,$page)//used for redirecting the user and passing the error msg to the next page
{
  $_SESSION['ERROR_MSG_SESSION']=$msg;
  redirect_to($page);
}
function login_redirect(){
if(!loggedin())
{
  $page=$_SERVER['PHP_SELF'];
  $_SESSION['not_login']="PLEASE LOGIN";
  $_SESSION['referer']=$page;
  

 redirect_to("login.php") ;

}}
function get_ip()
{
  if(isset($_SERVER['HTTP_CLIENT_IP']))
  $http_client=$_SERVER['HTTP_CLIENT_IP'];
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
  $http_x_forwarded_for=$_SERVER['HTTP_X_FORWARDED_FOR'];
  if(isset($_SERVER['REMOTE_ADDR']))
  $remote_address=$_SERVER['REMOTE_ADDR'];
  if(!empty($http_client)){
    return $http_client;
  }else if(!empty($http_x_forwarded_for)){
    return $http_x_forwarded_for;
  }else{
    return $remote_address;
  }
}
function enter_log($flag)
{
  $myfile = fopen("admin/log.txt", 'a') or die("Unable to open file!");

  if(isset($_SESSION['username']))
  {
    $data[0]=$_SESSION['username'];
  }
  else{
    $data[0]="Guest";
  }
  if(isset($_SESSION['ip']))
  {
    $data[1]=$_SESSION['ip'];
  }
  else{
    $data[1]="Unknown";
  }
    $data[2]=date("d/m/y H:i:s");
    $data[3]=$flag;
    $data =implode('#', $data);
  fwrite($myfile,$data);
  fwrite($myfile,'##');
  fclose($myfile);
  return true;  

}
function entry_exist($table,$column,$value)
{
  open_database_connection();
    $sql="SELECT `".$column."` FROM `".$table."` WHERE `".$column."`='".$value."'";
    $result=mysql_query($sql);
    close_database_connection();
    if(mysql_num_rows($result)>=1)
      return true;
    else
      return false;
}

//functions for moderator
//deleting any user entity
function delete_user($username)
{
  open_database_connection();
    if(username_found($username))
    {
      $sql="DELETE FROM `users` WHERE `username` ='".$username."' ";
      if(mysql_query($sql)){
      echo output("user deleted successfully");

      }
    }
    else
      echo output("user does not exist");

  close_database_connection();
}
//changing privilage
function change_privilage($username,$privilage)
{
  open_database_connection();
    if(username_found($username))
    {
      $sql="UPDATE `users` SET `privilage` = '".$privilage.'" WHERE `username` ="'.$username."'";
      mysql_query($sql);
    }
    else
      echo output("user does not exist");

  close_database_connection();
}
function update_user($username,$detail,$value)
{
  if($detail!=$username)
  {
  $sql="UPDATE `users_profile` SET `".$detail."` = '".$value.'" WHERE `username` ="'.$username."'";
  }
  else
    echo output("Can not change username");
}
//listing all the user
function list_user(){
  open_database_connection();
  $sql="SELECT * FROM `users`";
  $result=execute_query($sql);
  close_database_connection();
  return $result;
}
//conting user reply
function count_user_rply($username)
{
  open_database_connection();
  $sql="SELECT `a_id` FROM `forum_answer` WHERE `a_email`='".$username."'";
  $result=mysql_query($sql);
  $n=mysql_num_rows($result);
  close_database_connection();
  return $n;
}
function count_user_post($username)
{
  open_database_connection();
  $sql="SELECT `question_id` FROM `forum_question` WHERE `email`='".$username."'";
  $result=mysql_query($sql);
  $n=mysql_num_rows($result);
  close_database_connection();
  return $n;
}
//////pagination function
function pagination($query,$per_page=5,$page=1,$url='?'){   
    open_database_connection();
    $query = "SELECT COUNT(*) as `num` FROM {$query}";
    $row = mysql_fetch_array(mysql_query($query));
    $total = $row['num'];
    $adjacents = "2"; 
      
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
      
    $prev = $page - 1;                          
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination'>";
        $pagination .= "<li class='page_info'><div style=\"position:relative; top:30px; left:600px;\">Page {$page} of {$lastpage}</div></li>";
              
            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='active'>...</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
      close_database_connection();
    return $pagination;
}
function list_category(){

    $sql="SELECT * FROM `categorie`";
    open_database_connection();
    $r=execute_query($sql);
    close_database_connection();
    return $r;
  }


function list_topic(){}
function list_replies(){}
//deleting any user entity
function delete_category($category)
{
  if(entry_exist('categorie','cname',$category)){
    open_database_connection();
  $sql="SELECT `cid` from `categorie` WHERE `cname`='".$category."'";
  $result=execute_query($sql);
      close_database_connection();
  $id=$result[0]['cid'];
  if(delete_entry('categorie','cname',$category) && delete_entry('topic','cid',$id))
  {
    open_database_connection();
    $sql="SELECT `question_id` FROM `forum_question` WHERE `cid`='".$id."'";
    $result=execute_query($sql);
    $id2=$result[0]['question_id'];
    close_database_connection();

    if( delete_entry('forum_question','cid',$id) && delete_entry('forum_answer','question_id',$id2) )
    {
      return true;
    }
    else
      return false;
  }
  else
  {
    return false;
  }
  }
  else
    return false;
}
function delete_post($id){}
function delete_topic($id){}
?>
