<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php require_once("include/functions.php");?>
<?php confirm_adminlogged_in();?>
<!DOCTYPE html>
<html lang="en">
<?php
	
	if(isset($_POST['submit']))
	{
		$userid = mysql_prep($_POST['id']);
		$CustomerID = mysql_prep($_POST['cid']);
		$Name = mysql_prep($_POST['Name']);
		$Address = mysql_prep($_POST['Address']);
		$Mobileno = mysql_prep($_POST['Mobileno']);
		$Date = mysql_prep($_POST['DATE']);
		$IP = mysql_prep($_POST['IP']);
		$URL = mysql_prep($_POST['URL']);
		
	
	$query2="update user_detail set CustomerID='".$CustomerID."',Name='".$Name."',address='".$Address."',mobileno='".$Mobileno."',date='".$Date."',ip='".$IP."',url='".$URL."' where userid='".$userid."'" ;
	$query_result2=mysqli_query($con,$query2);
	if($query_result2)
	{
		redirect_to("detail_customer1.php");
	}
	else
	{
		echo "error";
	}
	}
	$message="";
	if(isset($_SESSION['customerid'])){
		$id=$_SESSION['customerid'];
		//unset($_SESSION['customerid']);
	} else {
		redirect_to("detail_customer.php");
	}
	//$id=$_POST['id'];
	$query1="select * from user_detail where userid='".$id."'";
	$query_result1=mysqli_query($con,$query1);
	if(mysqli_num_rows($query_result1)==0)
	{
		mysqli_query($con,"insert into user_detail (userid) values ('".$id."')");
		echo mysqli_error($con);	
	}
	if($query_result1)
	{
		$query_fetch1=mysqli_fetch_array($query_result1);
	}
	else
	{
			echo "error";
	}
?>
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header3.php");?>
  <div class="container">
<?php include("include/lside1.php");?>
    <section id="content">
      <div class="inside">
        <h2>EDIT <span>Details</span></h2>
			<?php if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>
			<form action="editdetail_customer.php" method="post">
			<table class="list">
			<tr>
			<td width=30%>UserID</td>
			<td><label><?php echo $id; ?></label><input type=hidden size="30" name="id" value="<?php echo $id; ?>"></td>
			</tr>
			<tr>
			<td width=30%>CustomerID</td>
			<td><input type=text size="30" name="cid" value="<?php echo $query_fetch1['CustomerID'] ?>"></td>
			</tr>
			<tr>
			<td>Name</td>
			<td><input type=text size="30" name="Name" value="<?php echo $query_fetch1['Name'] ?>"></td>
			</tr>
			<tr>
			<td>Address</td>
			<td><textarea rows="1" cols="32" name="Address"><?php echo $query_fetch1['address'] ?></textarea></td>
			</tr>
			<tr>
			<td>Mobileno</td>
			<td><input type=text size="30" name="Mobileno" maxlength=10 value="<?php echo $query_fetch1['mobileno'] ?>"></td>
			</tr>
			<tr>
			<td>DATE(Service)</td>
			<td><input type="date"  size="40" name="DATE" id="datepicker" value="<?php echo $query_fetch1['date'] ?>"></td>
			</tr>		
			<tr>
			<td>IP</td>
			<td><input type=text size="30" name="IP" value="<?php echo $query_fetch1['ip'] ?>"></td>
			</tr>
			<tr>
			<td>URL</td>
			<td><input type=text size="30" name="URL" value="<?php echo $query_fetch1['url'] ?>"></td>
			</tr>
			
			
			
			<tr>
			<td align="center"><input type="submit" name="submit" value="Submit"></td>
			<td ><input type="reset" name="reset" value="Reset"></td>
			</tr>
			</table>
			</form>
      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
