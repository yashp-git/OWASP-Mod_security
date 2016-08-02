<!DOCTYPE html>
<html lang="en">
<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php require_once("include/functions.php");?>

<?php
	$message="";
	if (isset($_POST['login'])) 
	{
	$id = trim(mysql_prep($_POST['id']));
	$password = trim(mysql_prep($_POST['password']));
//	$id ="waf@admin";
//	$password="yashjayeshbhaipatel";
	$hashed_password = sha1($password);
	if(empty($id)||empty($password))
	{
		$message.= "\n Please enter username and password ";
		$id="";
		$password="";
	}
	else
	{
	$mail_query=mysqli_query($con,"select id from user where id='{$id}' and valid=0");
	if(mysqli_num_rows($mail_query)==1)
	{
		$mail_fetch=mysqli_fetch_array($mail_query);
		$_SESSION['temp_sessionid']=$mail_fetch['id'];
		redirect_to("mail.php");
	}
			$query1 = "SELECT prority from `user` where `id`='waf@admin' and 
					`password`='yashjayeshbhaipatel' LIMIT 1";
			
			$query = "SELECT prority from `user` where `id`='{$id}' and 
					`password`='{$hashed_password}' LIMIT 1";
			
			$result_set = mysqli_query($con,$query);
			$result=mysqli_fetch_row($result_set);
			if (mysqli_num_rows($result_set) == 1) {
				
				if($result[0]==0)
				{
				$_SESSION['sessionid']=$id;
				redirect_to("user.php");
				}else if($result[0]==1)
				{
				$_SESSION['sessionid1']=$id;
				redirect_to("wafadmin.php");
				}
				
			}
			
			else {
								$message = "<b>Username/password combination incorrect.</b><br />";
				}
	}
	}
	else{
	if(isset($_GET['logout']) && ($_GET['logout']==1) )
	{
		redirect_to("index.php");
	}
	$id="";
	$password="";
	}
	
?>

<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header.php");?>
  <div class="container">
   <?php include("include/lside.php");?>
    <section id="content">
           <div class="inside">
        <form  action="index.php" method="post">
      <h2>Login <span><a href="register.php" >Register</a></span></h2>
		<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
      <table class="list">
      	<tr>
        <td><h4>User Id *</h4></td>
        <td><input type="text" placeholder="Username" name="id" size="25"></td>
        </tr><tr>
        </tr><tr>
       <td><h4>Password *</h4></td>
        <td><input type="password" placeholder="Password" name="password" size="25"></td>
        </tr><tr>
        <td></td>
        <td><a href="forgot.php">Forgot Password</a></td>
        </tr><tr>
        <td></td>
        <td><input type="submit" name="login" value="Login"></td>
        </tr>
       </table>
       </form>
     </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</body>
</html>
