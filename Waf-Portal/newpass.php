<!DOCTYPE html>
<html lang="en">
<?php require_once("include/connection.php");?>
<?php require_once("include/session.php");?>
<?php
	$id=$_SESSION['temp_sessionid'];
	$message="";

	if(isset($_POST['submit']))
	{
		$password=$_POST['password'];
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		$hashed_password = sha1($password1);
		
		if(empty($password)||empty($password1)||empty($password2))
		{
			$message.= "\n Please fill the required fields. ";
		}
		else
		{
			if(strlen($password1)<=7)
		{
			$message.= "\n Password must be 8 character long ";
			$password="";
			$password1="";
		}
		if($password2!=$password1)
		{
			$message.= "\n Password should be same ";
			$password="";
			$password1="";
		}
		}if(empty($message))
		{
			$query="update user set password='".$hashed_password."' where id='".$id."'";
			$result = mysqli_query($con,$query);
			if($result)
			{
				$message="Password Successfully changed";
				//redirect_to("newpass.php");
			}
		}
		
	}
?>
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header.php");?>
  <div class="container">
<?php include("include/lside.php");?>
   
	  <div class="wrap">
    <div class="container">
        <section id="content">
            <div class="inside">
        <form  action="newpass.php" method="post">
        <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
      <table class="list">
      	<tr>
        <td><h4>Old Password *</h4></td>
        <td><input type="password" name="password" size="25"></td>
        </tr><tr>
        <td><h4>New Password *</h4></td>
        <td><input type="password" name="password1" size="25"></td>
        </tr><tr>
        <td><h4>Repeat Password *</h4></td>
        <td><input type="password" name="password2" size="25"></td>
        </tr><tr>
        <td></td>
        <td><input type="submit" name="submit" value="Register"></td>
        </tr>
      </table>
      </form> 
      </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->