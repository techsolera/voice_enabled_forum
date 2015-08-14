<?php include "layouts/header.php" ?>

<!-- if the user submits the data properly then the further actions will be taken here -->
<?php
  if(isset($_POST['submit'])){
    if(!empty($_POST['username'])){$username=clean($_POST['username']);}
    if(!empty($_POST['password'])){$password=clean($_POST['password']);}
    if(!empty($_POST['fname'])){$fname=clean($_POST['fname']);}
    if(!empty($_POST['lname'])){$lname=clean($_POST['lname']);}
    if(isset($username) && isset($lname) && isset($fname) && isset($password)){
      $datetime=date("d/m/y H:i:s");
    }else{
    echo output("Please Fill Up all the detail");
    }
  }
  if (!isset($_SESSION['secure1'])){
    $str =md5(microtime());
    $cap=substr($str,0,6);
    $_SESSION['secure1']=$cap;
  }
  else{
    if(isset($_POST['submit'])){
      if( $_POST['cap']==$_SESSION['secure1']){
        open_database_connection();
        if(username_found($username)){
          echo output("Email address already in use");
          close_database_connection();
          goto end;
        }
        $sql=" INSERT INTO `users` ( `uid` , `fname` , `lname` , `username` , `password` , `privilage`,`stimedate` )";
        $sql=$sql."VALUES ( '', '$fname', '$lname', '$username', '$password', '' ,'$datetime')";
        open_database_connection();

        if(mysql_query($sql)){
        enter_log("user registered");
        redirect_to('login.php');
        }
        close_database_connection();
      }else{
        echo output( "CAPTCH did not match Please re-enter");
        $temp="autofocus";
        $str =md5(microtime());
        $cap=substr($str,0,6);
        $_SESSION['secure1']=$cap;
      }
    }
  }
end:
?>


			<div class="jumbotron">
  					<div class="container">
 						<h2 style="font-family:Calibri";><span class="glyphicon glyphicon-registration-mark"></span> &nbsp;TCET-Registration</h2><br>
            <form role="form" name="f1" method=post action='register.php'>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <label>First Name</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="text" class="form-control" placeholder="Enter first name" name="fname"  value="<?php if(isset($fname)){echo $fname;}?>" required <?php if (!isset($_POST['submit'])){echo "autofocus";}?> >
                  </div>
                  </div>
                  <br>
                  <div class="row">
                  <div class="col-xs-6">
                    <label>Last Name</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="text" class="form-control" placeholder="Enter Last name" name="lname" value="<?php if(isset($lname)){echo $lname;}?>" required>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-xs-6">
                    <label>Email</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="email" class="form-control" placeholder="Enter email"  value="<?php if(isset($username)){echo $username;}?>" required>
                  </div>
                </div>
                <br>
                  <div class="row">
                  <div class="col-xs-6">
                    <label>Confirm Email address</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="email" class="form-control" placeholder="Enter email" name="username" value="<?php if(isset($username)){echo $username;}?>" required>
                  </div>
                </div>
                <br>
                 <div class="row">
                  <div class="col-xs-6">
                    <label>Password</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="password" class="form-control" placeholder="Enter Password" value="<?php if(isset($password)){echo $password;}?>"  required>
                  </div>
                </div>
                <br>
                  <div class="row">
                  <div class="col-xs-6">
                    <label>Confirm Password</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" value="<?php if(isset($password)){echo $password;}?>"  required>
                  </div>
                </div>
              </div>
             
				</div>
</div>
<br>
				  <div class="jumbotron" >
  					<div class="container ">
              
 						<p style="font-family:Angelou";>Confirmation of Registration(captcha)</p>
            
                 <p style="font-family:Calibri; font-size:15px;">To prevent automated registrations the board requires you to enter a confirmation code. The code is displayed in the image you should see below. If you are visually impaired or cannot otherwise read this code please contact the Board Administrator.</p>
                    
                    <div class="row">
                      <div class="col-xs-6">
                        <label>Captcha:</label>
                      </div>
                   <div class="col-xs-6">
                       <img src="captcha.php"><input type='text' name='cap' autocomplete="off">
                       <p style="font-family:Calibri; font-size:15px;">Enter the code exactly as it appears. All letters are case insensitive.</p>
                       <p style="font-family:Calibri; font-size:15px;"></p>
                   </div> 
                  </div>   
            
          
           <div class="btn-group btn-group-justified">
              <div class="btn-group">
                <button type="reset" value="Reset" class="btn btn-default">reset</button>
              </div>
              <div class="btn-group">
                <input type="Submit" name="submit" value="Submit" class="btn btn-default">
              </div>
  					</div>
            </form>
				</div>
      </div>
				
				<?php include 'layouts\footer.php' ; ?>
        <!-- if the user submits the data properly then the further actions will be taken here -->
        