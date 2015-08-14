 
<?php include 'layouts\header.php'; ?>
<?php 
      if(loggedin())
      {
          redirect_to('index.php');
          die();
      
      }
      if(isset($_SESSION['not_login'])){
        echo $_SESSION['not_login'];
        $_SESSION['not_login']='';
      }

          if(isset($_POST['login']))
      {
        open_database_connection();
        $username=clean($_POST['username']);
        $password=clean($_POST['password']);

        if(user_found($username,$password))
        {
            
           $_SESSION['username']=$username;
           enter_log("Login Succesful");
           $sql="SELECT fname,lname,privilage FROM users WHERE username='".$username."'";
           $result=execute_query($sql);
           $fname=$result[0]['fname'];
           $lname=$result[0]['lname'];
           $_SESSION['name']=$fname.$lname;
           $_SESSION['privilage']=$result[0]['privilage'];
           $privilage=$_SESSION['privilage'];

           if($privilage==100){
            redirect_to('admin/index.php');

          }
            else{
              if($_SESSION['referer']){
                $referer=$_SESSION['referer'];
                $_SESSION['referer']="";
                redirect_to($referer);
              }else
                redirect_to('index.php');
            }


        }
        else
          echo output("invalid username and password");
          enter_log("Login failed");
      }


?>
			<div class="jumbotron" align="left">
  					<div class="container">
             <h3 style="font-family:Angelou; position:relative; top:-25px;"> <span class="glyphicon glyphicon-user"></span>&nbsp;<strong>Login </strong></h3> 
 					    <form role="form" name="f1" method=post action="login.php"> 
                <div class="form-group">
                 <label for="username" name="username" >User name</label>
                    <input type="emaile" class="form-control" name="username" placeholder="User name" required autofocus>
                </div>
                <div class="form-group">
                  <label for="Password" name="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <p class="help-block">I forgot my password</p>
                </div>
               <div class="checkbox">
                <label>
                  <input type="checkbox">Log me in automatically each visit
                </label>
              </div>
             <input type="submit" name="login" class="btn btn-default" value="Login">
            </form>
  				 </div>
				</div>
				<div class="jumbotron">
  					<div class="container ">
 						<h2 style="font-family:Angelou";><span class="glyphicon glyphicon-plus"></span>&nbsp;Register</h2>
            <p style="font-family:Calibri; font-size:20px">In order to login you must be registered. Registering takes only a few moments but gives you increased capabilities. The board administrator may also grant additional permissions to registered users. Before you register please ensure you are familiar with our terms of use and related policies. Please ensure you read any forum rules as you navigate around the board.
            </p>
            <p>
Terms of use | Privacy Policy
            </p>
            <hr style="border: 0; border-bottom: 1px dashed black;">
            <a href="register.php"><button type="submit" class="btn btn-default">Register</button></a>
  					</div>
				</div>
			
        
				<?php include 'layouts\footer.php'; ?>
