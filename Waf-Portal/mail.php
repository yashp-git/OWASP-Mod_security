<!DOCTYPE html>
<html lang="en">
<?php require_once("include/connection.php");?>
<?php require_once("include/temp_session.php");?>
<?php require_once("include/functions.php");?>
<?php
$id=$_SESSION['temp_sessionid'];
?>

<?php 

$query=mysqli_query($con,"select id from user where userid='{$id}' and valid=1");
if($query)
{
	redirect_to("user.php");
}	
else {

if(isset($_POST['submit']))
{
	$code= trim($_POST['code']);
	
	$confirmation_query=mysqli_query($con,"select id,prority from user where id='{$id}' and rand_no='{$code}'");
	$x=mysqli_fetch_array($confirmation_query);
		
	if(mysqli_num_rows($confirmation_query)==1)
	{
		$update_query=mysqli_query($con,"UPDATE `user` SET `valid`=1,`rand_no`=NULL WHERE id='{$id}'");
		if($x['prority']==0)
		{
				$_SESSION['sessionid']=$id;
				redirect_to("user.php");
		}else if($x['prority']==1)
		{
				$_SESSION['sessionid1']=$id;
				redirect_to("faculty.php");
		}
	}
	
	

}
if(isset($_POST['resend_submit']))
{
		require_once("phpmailer/class.phpmailer.php");
		require_once("include/connection.php");
				
		$email_query=mysqli_query($con,"select * from tnp_emailid");
		$result1=mysqli_fetch_array($email_query);
		
		$query=mysqli_query($con,"select rand_no,email from user where id='{$id}'");
		if(mysqli_num_rows($query)==1)
		{
			$result=mysqli_fetch_array($query);
		}
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->Username =$result1['userid'];
		$mail->Password = $result1['password'];
		$mail->SetFrom("noreply.indusface@gmail.com");
		$mail->Subject = "Confirmation Mail";
		$mail->Body = "Welcome to Indusface R&D CELL.<br> Here is your confirmation code: ".$result['rand_no']."<br><br>Regards,<br>Indusface-Team.";
		$mail->AddAddress($result['email']);
		 if(!$mail->Send())
		    {
		    echo "<script language=javascript>alert('{$mail}')</script>";
		    }
		    else
		    {
		    echo "<script language=javascript>alert('Confirmation Mail has been sent to your email-ID')</script>";
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
        <h2>Enter Your confirmation Code</h2>
		<h3>A confirmation code has been sent to your e-mail ID.</h3>
		<table class="list">
        <tr>
        <form action="mail.php" method=post>
        <td width="30%"><input type=text name=code size="30"/></td>
        <td><input type=submit class=buttons name=submit value="Confirm" /></td>
        </form>
        </tr>
		<tr>
        <form action=mail.php method=post>
        <td><input type=submit class=buttons name=resend_submit value="Resend Confirmation Code" /></td>
        </form>
        </tr>
		</table>		
      </div>
    </section>
  </div>
</div>
</section>
</div></div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->