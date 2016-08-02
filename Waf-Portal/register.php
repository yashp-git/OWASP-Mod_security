<!DOCTYPE html>
<?php require_once("include/connection.php");?>
<?php require_once("include/temp_session.php");?>
<?php require_once("include/functions.php");?>
<?php
	$message="";

	if(isset($_POST['submit']))
	{
		$id= trim($_POST['id']);
		$email= trim($_POST['email']);
		$password = $_POST['password1'];
		$password1= $_POST['password2'];
		$que= $_POST['que'];
		$answer = $_POST['answer'];
		$hashed_password = sha1($password);
		$random_hash = sha1(uniqid(rand(10000,100000)));
		$uniq=$_POST['uniq'];
		$n1=$_POST['n1'];
		$n2=$_POST['n2'];
	
		if(empty($id)||empty($email)||empty($password)||empty($que)||empty($answer)||empty($uniq))
		{
				$message.= "\n Please fill the required fields. ";
		}
		else
		{
		if(strlen($password)<=7)
		{
			$message.= "\n Password must be 8 character long ";
			$password="";
			$password1="";
		}
		if($password!=$password1)
		{
			$message.= "\n Password should be same ";
			$password="";
			$password1="";
		}
		if($uniq!=($n1+$n2))
		{
			$message.= "\n Please enter correct answer ";
			$password="";
			$password1="";
		}
		}
		if(empty($message))
		{
				
					$query = "INSERT INTO user (
							id, password ,que,answer,email,prority,rand_no,valid
						) VALUES (
							'{$id}', '{$hashed_password}','{$que}', '{$answer}','{$email}', 0, '{$random_hash}',0
						)";
			$result = mysqli_query($con,$query);
			$message.=$result;
			if ($result) {
				require_once("phpmailer/class.phpmailer.php");
						
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

				$_SESSION['temp_sessionid']=$id;
				  redirect_to("mail.php");

			} else {
				$message = "The user could not be created.";
				$id="";
				$password="";
				$branch="";
				$answer="";
				}
		}
	}
	else{
	$id="";
	$password="";
	$branch="";
	$answer="";
	}
?>
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header.php");?>
<?php include("./include/lside.php");?>
  <div class="container">
    <section id="content">
      <div class="inside">
      <form  action="register.php" method="post">
      <h2>Register <span>User</span></h2>
	 <?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
      <table class="list">
      	<tr>
        <td><h4>User Id *</h4></td>
        <td><input type="text" placeholder="example@1234" name="id" size="25" maxLength="15"></td>
        </tr><tr>
       <td><h4>Email Id *</h4></td>
        <td><input type="email" placeholder="example@gmail.com" name="email" size="25"></td>
        </tr><tr>
        <td><h4>Password *</h4></td>
        <td><input type="password" placeholder="Password must be 8 char" name="password1" size="25"></td>
        </tr><tr>
        <td><h4>Repeat Password *</h4></td>
        <td><input type="password" placeholder="Password must be 8 char" name="password2" size="25"></td>
        </tr><tr>
        <td><h4>Security Question *</h4></td>
        <td><input type="text" placeholder="Enter Your Question" name="que" size="25"></td>
        </tr><tr>
        <td><h4>Answer *</h4></td>
		<td><input type=text placeholder="Enter Your Answer" size="25" name="answer"></td>
        </tr><tr>
		<td><h4>What is sumation of <?php $n1=rand(10,99);	$n2=rand(10,99);echo $n1." and ".$n2; ?> *</h4></td>
        <input type="text" name="n1" hidden="hidden" value="<?php echo $n1;?>">
        <input type="text" name="n2" hidden="hidden" value="<?php echo $n2;?>">
        <td><input type="text" placeholder="Answer" size="25" name="uniq"</td>
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

<script type="text/javascript"> Cufon.now(); 
<!-- END PAGE SOURCE -->
