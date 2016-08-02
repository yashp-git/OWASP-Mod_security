<!DOCTYPE html>
<html lang="en">
<?php require_once("include/connection.php");?>
<?php require_once("include/session.php");?>
<?php
	$message="";

	if(isset($_POST['submit']))
	{
		$userid=$_POST['id'];
		$que=$_POST['que'];
		$ans=$_POST['ans'];
				
		if(empty($userid)||empty($que)||empty($ans))
		{
			$message.= "\n Please fill the required fields. ";
		}
		if(empty($message))
		{
			$query="select que,answer from user where id='".$userid."'";
			$result = mysqli_query($con,$query);
			if($result)
			{
				$result_fetch=mysqli_fetch_array($result);
				if($que=$result_fetch[0] && $ans=$result_fetch[1])
				{
					$_SESSION['temp_sessionid']=$userid;
					header("Location:newpass.php");
					exit;
				}
				else
				{
					$message="Please Enter correct details";
				}
			}
		}
	}
?>
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header.php");?>
  <div class="container">
<?php include("include/lside.php");?>
   <section id="content">
	  <div class="wrap">
    <div class="container">
        <section id="content">
      <div class="inside">
        <form  action="forgot.php" method="post">
        <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
      <table class="list">
      	<tr>
        <td><h4>User id *</h4></td>
        <td><input type="text" name="id" size="25"></td>
        </tr><tr>
        <td><h4>Security Question *</h4></td>
        <td><input type="text" name="que" size="25"></td>
        </tr><tr>
        <td><h4>Answer *</h4></td>
        <td><input type="text" name="ans" size="25"></td>
        </tr><tr>
        <td></td>
        <td><input type="submit" name="submit" value="Submit"></td>
        </tr>
      </table>
      </form> 
      </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->